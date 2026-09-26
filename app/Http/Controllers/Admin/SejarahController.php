<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SejarahRequest;
use App\Models\{ProgramKeahlian, Sejarah};

class SejarahController extends Controller
{
    private function current(): Sejarah
    {
        return Sejarah::firstOrCreate(
            ['program_keahlian_id' => ProgramKeahlian::firstOrFail()->id],
            ['judul' => 'Sejarah Program Keahlian']
        );
    }

    public function edit()
    {
        return view('admin.sejarah.edit', ['sejarah' => $this->current()->load('timeline')]);
    }

    public function update(SejarahRequest $request)
    {
        $this->current()->update($request->validated());

        return back()->with('success', 'Sejarah berhasil diperbarui.');
    }
}
