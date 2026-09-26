<?php

use App\Models\{Laboratorium, ProgramKeahlian, User};

beforeEach(function () {
    ProgramKeahlian::factory()->create();
});

test('editor tidak dapat menghapus data', function () {
    $editor = User::factory()->editor()->create();
    $lab = Laboratorium::factory()->create();

    $this->actingAs($editor)
        ->delete(route('admin.laboratorium.destroy', $lab))
        ->assertForbidden();

    $this->assertDatabaseHas('laboratorium', ['id' => $lab->id]);
});

test('editor tetap dapat menambah dan mengubah data', function () {
    $editor = User::factory()->editor()->create();

    $this->actingAs($editor)->post(route('admin.laboratorium.store'), [
        'nama' => 'Lab Multimedia', 'kapasitas' => 20, 'status' => 'aktif',
    ])->assertRedirect(route('admin.laboratorium.index'));

    $this->assertDatabaseHas('laboratorium', ['nama' => 'Lab Multimedia']);
});

test('pengguna biasa (belum login) tidak dapat mengakses rute admin manapun', function () {
    $lab = Laboratorium::factory()->create();

    $this->get(route('admin.laboratorium.index'))->assertRedirect(route('admin.login'));
    $this->get(route('admin.laboratorium.create'))->assertRedirect(route('admin.login'));
    $this->post(route('admin.laboratorium.store'), [])->assertRedirect(route('admin.login'));
    $this->delete(route('admin.laboratorium.destroy', $lab))->assertRedirect(route('admin.login'));
});
