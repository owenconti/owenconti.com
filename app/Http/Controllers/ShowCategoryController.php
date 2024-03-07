<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class ShowCategoryController extends Controller
{
    public function __invoke(Category $category): View
    {
        return view('pages.categories.show', ['category' => $category]);
    }
}
