<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;

class Footer extends Component
{
    public $nav;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nav = config('nav');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
