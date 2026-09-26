<?php

namespace App\View\Components;

use App\Models\ProgramKeahlian;
use Illuminate\View\Component;
use Illuminate\View\View;

class PublicLayout extends Component
{
    public ?ProgramKeahlian $program;

    public function __construct(public ?string $title = null, public ?string $description = null)
    {
        $this->program = ProgramKeahlian::first();
    }

    public function render(): View
    {
        return view('components.public-layout');
    }
}
