<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;

class MainNavigation extends Component
{
    public $items;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->items = collect(config('nav.main', []))->map(function ($item) {
            $url = url($item['url']);

            return array_merge($item, [
                'url' => $url,
                'active' => url()->current() === $url,
            ]);
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|Closure|string
     */
    public function render()
    {
        return view('components.main-navigation');
    }
}
