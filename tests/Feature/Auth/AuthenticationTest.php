<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthenticatedSessionController extends Controller
{
    protected function redirectTo()
    {
        if (auth()->user()->role->name === 'Admin') {
            return '/admin/dashboard';
        }

        return '/user/dashboard';
    }
}
