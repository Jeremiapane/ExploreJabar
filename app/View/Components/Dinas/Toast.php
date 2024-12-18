<?php

namespace App\View\Components\Dinas;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toast extends Component
{
    public $type;
    public $message;

    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.dinas.toast');
    }
}
