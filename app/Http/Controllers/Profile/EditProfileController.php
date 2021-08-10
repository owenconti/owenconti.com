<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class EditProfileController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Profile/EditProfile', [
            'meta' => ['title' => 'Edit Profile'],
        ]);
    }
}
