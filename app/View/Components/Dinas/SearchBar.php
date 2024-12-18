<?php

namespace App\View\Components\Dinas;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchBar extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $placeholder;

    public function __construct($id = 'search', $placeholder = 'Cari...')
    {
        $this->id = $id;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dinas.search-bar');
    }
}
