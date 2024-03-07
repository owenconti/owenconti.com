<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $pages = Page::posts()->orderBy('created_at', 'desc')->paginate();

        return view('pages.pages.list', ['pages' => $pages]);
    }
}
