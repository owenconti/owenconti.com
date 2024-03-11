<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class IndexPostsController extends Controller
{
    public function __invoke(): View
    {
        seo()->title('Articles');

        return view('pages.posts.index', [
            'articles' => Page::where('type', 'post')->latest()->paginate(20),
        ]);
    }
}
