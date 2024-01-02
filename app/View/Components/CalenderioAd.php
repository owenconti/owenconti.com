<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;

class CalenderioAd extends Component
{
    private $images = [
        'calenderio-all-your-events-one-calendar',
        'calenderio-auto-block-work-meetings',
        'calenderio-freelancer',
        'calenderio-love-vue',
        'calenderio-multiple-jobs',
        'calenderio-personal-work-image',
        'calenderio-vue-your-events',
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|Closure|string
     */
    public function render()
    {
        $image = $this->images[array_rand($this->images)];

        return view('components.calenderio-ad', [
            'image_url' => asset("/dist/assets/calenderio/{$image}.jpg"),
            'link_url' => "https://calenderio.com?utm_source=owenconti-com&utm_medium=website&utm_campaign=calenderio-owenconti-com&utm_content={$image}",
        ]);
    }
}
