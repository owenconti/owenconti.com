<?php

// Disable auth routes
// require __DIR__.'/auth.php';

use App\Http\Controllers\ListCategoriesController;
use App\Http\Controllers\ShowCategoryController;
use App\Http\Controllers\ShowSearchResultsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/category', '/articles');
Route::redirect('/blog', '/articles');

Route::get('/', fn () => redirect('list.categories'));
Route::get('/articles', ListCategoriesController::class)->name('list.categories');
Route::get('/articles/{category}', ShowCategoryController::class)->name('show.category');
Route::get('/search', ShowSearchResultsController::class);

Route::get('/{page}', config('pages.routes.handler'))
    ->where('page', '.*')
    ->prefix(config('pages.routes.prefix'))
    ->name(config('pages.routes.name'));
