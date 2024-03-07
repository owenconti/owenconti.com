<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Page;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $pages = Page::posts()->orderBy('created_at', 'desc')->paginate();

        return view('pages.pages.list', ['pages' => $pages]);
    }
}
