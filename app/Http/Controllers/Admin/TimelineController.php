<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TimelineRequest;
use App\Models\Timeline;
use App\Models\{ProgramKeahlian, Sejarah};
use Illuminate\Database\Eloquent\Model;

class TimelineController extends ResourceController
{
    protected function model(): string { return Timeline::class; }
    protected function request(): string { return TimelineRequest::class; }
    protected function view(): string { return 'admin.timeline'; }
    protected function routeName(): string { return 'admin.timeline'; }

    protected array $searchable = ['judul'];
    protected string $orderBy = 'urutan';
    protected string $direction = 'asc';

    protected function payload(array $data, ?Model $item): array
    {
        $program = ProgramKeahlian::firstOrFail();
        $data['sejarah_id'] = Sejarah::firstOrCreate(
            ['program_keahlian_id' => $program->id],
            ['judul' => 'Sejarah Program Keahlian']
        )->id;
        $data['urutan'] = $data['urutan'] ?? 0;

        return $data;
    }
}
