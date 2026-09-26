<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/** Basis CRUD admin: pencarian, filter, pagination, upload gambar, flash message. */
abstract class ResourceController extends Controller
{
    /** @var array<string,string> kolom gambar => folder storage */
    protected array $images = [];
    protected array $searchable = [];
    protected array $filterable = [];
    protected string $orderBy = 'id';
    protected string $direction = 'desc';

    public function __construct(protected ImageUploadService $uploader) {}

    abstract protected function model(): string;
    abstract protected function request(): string;
    abstract protected function view(): string;      // mis. admin.laboratorium
    abstract protected function routeName(): string; // mis. admin.laboratorium

    /** Ubah data tervalidasi sebelum disimpan (slug, relasi, dll). */
    protected function payload(array $data, ?Model $item): array
    {
        return $data;
    }

    /** Data tambahan untuk form (dropdown, dll). */
    protected function formData(): array
    {
        return [];
    }

    public function index(Request $request)
    {
        $rows = $this->model()::query()
            ->when($request->q, function ($q, $term) {
                $q->where(fn ($w) => collect($this->searchable)->each(fn ($c) => $w->orWhere($c, 'like', "%{$term}%")));
            })
            ->tap(function ($q) use ($request) {
                foreach ($this->filterable as $col) {
                    $q->when($request->filled($col), fn ($q) => $q->where($col, $request->input($col)));
                }
            })
            ->orderBy($this->orderBy, $this->direction)
            ->paginate(10)
            ->withQueryString();

        return view($this->view().'.index', ['rows' => $rows] + $this->formData());
    }

    public function create()
    {
        return view($this->view().'.form', ['item' => new ($this->model())] + $this->formData());
    }

    public function store()
    {
        $this->save();

        return redirect()->route($this->routeName().'.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view($this->view().'.form', ['item' => $this->model()::findOrFail($id)] + $this->formData());
    }

    public function update($id)
    {
        $this->save($this->model()::findOrFail($id));

        return redirect()->route($this->routeName().'.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        abort_unless(auth()->user()->role === 'admin', 403, 'Hanya admin yang dapat menghapus data.');

        $item = $this->model()::findOrFail($id);
        $soft = in_array(SoftDeletes::class, class_uses_recursive($item), true);

        DB::transaction(function () use ($item, $soft) {
            $item->delete();
            if (! $soft) {
                foreach (array_keys($this->images) as $col) {
                    $this->uploader->delete($item->{$col});
                }
            }
        });

        return back()->with('success', 'Data berhasil dihapus.');
    }

    protected function save(?Model $item = null): Model
    {
        $request = app($this->request()); // FormRequest tervalidasi otomatis
        $data = $request->validated();

        foreach ($this->images as $field => $dir) {
            unset($data[$field]);
            if ($request->hasFile($field)) {
                $data[$field] = $this->uploader->store($request->file($field), $dir);
                if ($item?->{$field}) {
                    $this->uploader->delete($item->{$field});
                }
            }
        }

        $data = $this->payload($data, $item);

        return DB::transaction(fn () => $item ? tap($item)->update($data) : $this->model()::create($data));
    }
}
