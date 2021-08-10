<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ShowDashboardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Dashboard', [
            'meta' => [
                'title' => 'Dashboard',
            ],
        ]);
    }
}
