<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\View\Component;

class RelatedArticles extends Component
{
    public $relatedArticles;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
        $this->relatedArticles = Page::where('slug', '!=', $this->page->slug)->inCategory($this->page->category_slug)->limit(5)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|Closure|string
     */
    public function render()
    {
        return view('components.related-articles');
    }
}
