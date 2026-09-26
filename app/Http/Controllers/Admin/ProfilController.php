<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilRequest;
use App\Models\{Profil, ProgramKeahlian};
use App\Services\ImageUploadService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/** Identitas program keahlian + kepala program (satu halaman, dua kartu). */
class ProfilController extends Controller
{
    public function edit()
    {
        return view('admin.profil.edit', ['program' => ProgramKeahlian::with('kepala')->firstOrFail()]);
    }

    public function update(ProfilRequest $request, ImageUploadService $uploader)
    {
        $data = $request->validated();
        $program = ProgramKeahlian::with('kepala')->firstOrFail();
        $kepala = $program->kepala ?? new Profil(['program_keahlian_id' => $program->id]);

        $programData = Arr::only($data, ['nama', 'kompetensi', 'tagline', 'deskripsi', 'tahun_berdiri', 'akreditasi', 'jumlah_guru', 'jumlah_siswa']);
        $kepalaData = [
            'nama' => $data['kepala_nama'],
            'gelar' => $data['kepala_gelar'] ?? null,
            'jabatan' => $data['kepala_jabatan'] ?? 'Kepala Program Keahlian',
            'deskripsi' => $data['kepala_deskripsi'] ?? null,
        ];

        $replace = function (string $input, $model, string $column, string $dir) use ($request, $uploader): ?string {
            if (! $request->hasFile($input)) {
                return null;
            }
            $new = $uploader->store($request->file($input), $dir);
            $uploader->delete($model->{$column});

            return $new;
        };

        if ($p = $replace('logo', $program, 'logo', 'logo')) { $programData['logo'] = $p; }
        if ($p = $replace('hero_image', $program, 'hero_image', 'profile')) { $programData['hero_image'] = $p; }
        if ($p = $replace('kepala_foto', $kepala, 'foto', 'profile')) { $kepalaData['foto'] = $p; }

        DB::transaction(function () use ($program, $kepala, $programData, $kepalaData) {
            $program->update($programData);
            $kepala->fill($kepalaData)->save();
        });

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
