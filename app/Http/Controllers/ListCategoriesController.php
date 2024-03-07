<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class ListCategoriesController extends Controller
{
    public function __invoke(): View
    {
        seo()->title('Articles');

        $categories = Category::get();

        return view('pages.categories.list', ['categories' => $categories]);
    }
}
