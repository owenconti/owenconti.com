<?php

// Disable auth routes
// require __DIR__.'/auth.php';

use App\Http\Controllers\ShowSearchResultsController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/blog'));
Route::get('/search', ShowSearchResultsController::class);

Route::get('/{page}', config('pages.routes.handler'))
    ->where('page', '.*')
    ->prefix(config('pages.routes.prefix'))
    ->name(config('pages.routes.name'));
