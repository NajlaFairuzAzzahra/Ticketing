<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if (($role === 'Admin' && $user->role_id != 1) ||
            ($role === 'Staff' && $user->role_id != 2) ||
            ($role === 'User' && $user->role_id != 3)) {
            return redirect()->route('home')->with('error', 'Unauthorized access!');
        }

        return $next($request);
    }
}
