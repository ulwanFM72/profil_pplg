<?php

use App\Models\{Laboratorium, ProgramKeahlian, User};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    ProgramKeahlian::factory()->create();
    $this->admin = User::factory()->create();
});

test('upload foto laboratorium dengan format valid berhasil tersimpan', function () {
    $file = UploadedFile::fake()->image('lab.jpg', 800, 600);

    $this->actingAs($this->admin)->post(route('admin.laboratorium.store'), [
        'nama' => 'Lab Foto Valid', 'kapasitas' => 30, 'status' => 'aktif', 'foto' => $file,
    ])->assertRedirect(route('admin.laboratorium.index'));

    $lab = Laboratorium::where('nama', 'Lab Foto Valid')->firstOrFail();
    expect($lab->foto)->not->toBeNull();
    Storage::disk('public')->assertExists($lab->foto);
});

test('upload file berformat tidak diizinkan (pdf) ditolak validasi', function () {
    $file = UploadedFile::fake()->create('dokumen.pdf', 500, 'application/pdf');

    $this->actingAs($this->admin)->post(route('admin.laboratorium.store'), [
        'nama' => 'Lab Foto Invalid', 'kapasitas' => 30, 'status' => 'aktif', 'foto' => $file,
    ])->assertSessionHasErrors('foto');

    $this->assertDatabaseMissing('laboratorium', ['nama' => 'Lab Foto Invalid']);
});

test('upload gambar melebihi 2 MB ditolak validasi', function () {
    $file = UploadedFile::fake()->create('besar.jpg', 3000, 'image/jpeg'); // 3000 KB > 2048 KB

    $this->actingAs($this->admin)->post(route('admin.laboratorium.store'), [
        'nama' => 'Lab Foto Besar', 'kapasitas' => 30, 'status' => 'aktif', 'foto' => $file,
    ])->assertSessionHasErrors('foto');
});
