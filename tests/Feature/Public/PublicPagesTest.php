<?php

use App\Models\{Asset, Galeri, Laboratorium, ProgramKeahlian};

beforeEach(fn () => $this->program = ProgramKeahlian::factory()->create());

test('beranda menampilkan nama program dan data terbaru', function () {
    Laboratorium::factory()->create(['nama' => 'Lab Uji Coba']);
    Galeri::factory()->create(['judul' => 'Kegiatan Uji Coba']);

    $this->get(route('beranda'))
        ->assertOk()
        ->assertSee($this->program->nama)
        ->assertSee('Lab Uji Coba')
        ->assertSee('Kegiatan Uji Coba');
});

test('halaman beranda menampilkan 503 bila belum ada data program', function () {
    ProgramKeahlian::query()->delete();

    $this->get(route('beranda'))->assertStatus(503);
});

test('halaman profil menampilkan identitas program', function () {
    $this->get(route('profil'))->assertOk()->assertSee($this->program->kompetensi);
});

test('daftar laboratorium dan halaman detailnya dapat diakses', function () {
    $lab = Laboratorium::factory()->create(['nama' => 'Lab Detail Test']);

    $this->get(route('laboratorium.index'))->assertOk()->assertSee('Lab Detail Test');
    $this->get(route('laboratorium.show', $lab))->assertOk()->assertSee($lab->deskripsi);
});

test('filter kategori pada halaman asset bekerja', function () {
    Asset::factory()->create(['nama' => 'Komputer Rakitan', 'kategori' => 'Komputer']);
    Asset::factory()->create(['nama' => 'Switch 24 Port', 'kategori' => 'Jaringan']);

    $response = $this->get(route('asset', ['kategori' => 'Komputer']));

    $response->assertSee('Komputer Rakitan')->assertDontSee('Switch 24 Port');
});

test('pencarian dan filter tahun pada galeri bekerja bersamaan', function () {
    Galeri::factory()->create(['judul' => 'Lomba Robotik 2024', 'tahun' => 2024, 'kategori' => 'Lomba']);
    Galeri::factory()->create(['judul' => 'Lomba Robotik 2023', 'tahun' => 2023, 'kategori' => 'Lomba']);

    $response = $this->get(route('galeri', ['q' => 'Robotik', 'tahun' => 2024]));

    $response->assertSee('Lomba Robotik 2024')->assertDontSee('Lomba Robotik 2023');
});
