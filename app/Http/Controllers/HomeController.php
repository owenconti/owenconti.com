<?php

namespace App\Http\Controllers;

use App\Models\Page;

class HomeController extends Controller
{
    public function __invoke()
    {
        $pages = Page::posts()->orderBy('created_at', 'desc')->paginate();

        return view('pages.pages.list', ['pages' => $pages]);
    }
}
