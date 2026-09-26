<?php

use App\Models\{Laboratorium, ProgramKeahlian, User};

beforeEach(function () {
    ProgramKeahlian::factory()->create();
    $this->admin = User::factory()->create();
});

test('admin dapat melihat daftar laboratorium', function () {
    Laboratorium::factory()->count(3)->create();

    $this->actingAs($this->admin)
        ->get(route('admin.laboratorium.index'))
        ->assertOk()
        ->assertSee(Laboratorium::first()->nama);
});

test('admin dapat menambah laboratorium baru', function () {
    $response = $this->actingAs($this->admin)->post(route('admin.laboratorium.store'), [
        'nama' => 'Lab Jaringan Komputer',
        'deskripsi' => 'Ruang praktik jaringan.',
        'kapasitas' => 30,
        'lokasi' => 'Gedung B',
        'status' => 'aktif',
        'fasilitas' => "AC\nProyektor",
    ]);

    $response->assertRedirect(route('admin.laboratorium.index'));
    $this->assertDatabaseHas('laboratorium', ['nama' => 'Lab Jaringan Komputer', 'slug' => 'lab-jaringan-komputer']);
});

test('nama laboratorium wajib diisi', function () {
    $this->actingAs($this->admin)
        ->post(route('admin.laboratorium.store'), ['kapasitas' => 30, 'status' => 'aktif'])
        ->assertSessionHasErrors('nama');

    $this->assertDatabaseCount('laboratorium', 0);
});

test('admin dapat mengubah data laboratorium', function () {
    $lab = Laboratorium::factory()->create(['nama' => 'Lab Lama']);

    $this->actingAs($this->admin)->put(route('admin.laboratorium.update', $lab), [
        'nama' => 'Lab Baru', 'kapasitas' => 25, 'status' => 'perawatan',
    ])->assertRedirect(route('admin.laboratorium.index'));

    expect($lab->fresh()->nama)->toBe('Lab Baru');
    expect($lab->fresh()->status)->toBe('perawatan');
});

test('admin dapat menghapus laboratorium (soft delete)', function () {
    $lab = Laboratorium::factory()->create();

    $this->actingAs($this->admin)->delete(route('admin.laboratorium.destroy', $lab))
        ->assertRedirect();

    $this->assertSoftDeleted('laboratorium', ['id' => $lab->id]);
});

test('data laboratorium yang dihapus tidak lagi muncul di halaman publik', function () {
    $lab = Laboratorium::factory()->create();
    $lab->delete();

    $this->get(route('laboratorium.index'))->assertDontSee($lab->nama);
});
