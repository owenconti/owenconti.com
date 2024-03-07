<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ShowOgImageController extends Controller
{
    public function __invoke(Request $request): View
    {
        $data = json_decode(base64_decode($request->input('data'), true), true);

        return view('pages.og-image', $data);
    }
}
