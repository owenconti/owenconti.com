<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Category;

class ListCategoriesController extends Controller
{
    public function __invoke(): View
    {
        seo()->title('Articles');

        $categories = Category::get();

        return view('pages.categories.list', ['categories' => $categories]);
    }
}
