<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowOgImageController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = base64_decode(json_decode($request->input('data')), true);

        return view('pages.og-image', $data);
    }
}
