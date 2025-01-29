<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            if ($user->role->name === 'Admin') {
                return redirect('/admin/dashboard');
            }

            return redirect('/user/dashboard');
        }

        return $next($request);
    }
}
