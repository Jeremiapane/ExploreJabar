<?php

namespace App\View\Components\Dinas;

use Illuminate\View\Component;

class MenuItem extends Component
{
    public $active;

    public function __construct($active = false)
    {
        $this->active = $active;
    }

    public function render()
    {
        return view('components.dinas.menu-item');
    }
}

