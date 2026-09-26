<?php

namespace App\Livewire;

use App\Models\Galeri;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class GaleriSearch extends Component
{
    use WithPagination;

    #[Url(as: 'q', history: true)]
    public string $q = '';

    #[Url(as: 'kategori', history: true)]
    public string $kategori = '';

    #[Url(as: 'tahun', history: true)]
    public string $tahun = '';

    /** Balik ke halaman 1 setiap kali pencarian/filter berubah. */
    public function updating(string $property): void
    {
        if (in_array($property, ['q', 'kategori', 'tahun'], true)) {
            $this->resetPage();
        }
    }

    public function resetFilter(): void
    {
        $this->reset('q', 'kategori', 'tahun');
    }

    public function render()
    {
        return view('livewire.galeri-search', [
            'items' => Galeri::filter(['q' => $this->q, 'kategori' => $this->kategori, 'tahun' => $this->tahun])
                ->latest()->paginate(12),
            'kategoriList' => Galeri::KATEGORI,
            'tahunList' => Galeri::query()->distinct()->orderByDesc('tahun')->pluck('tahun'),
        ]);
    }
}
