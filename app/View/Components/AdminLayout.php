<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    public function __construct(public string $title, public ?string $active = null) {}

    public function render(): View
    {
        return view('components.admin-layout');
    }
}
