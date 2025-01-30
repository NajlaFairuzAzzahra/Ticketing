<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login'); // 🔥 Redirect ke login jika belum login
        }

        if (Auth::user()->role_id == 1 && $role === 'Admin') {
            return $next($request);
        }

        if (Auth::user()->role_id == 2 && $role === 'Staff') {
            return $next($request);
        }

        if (Auth::user()->role_id == 3 && $role === 'User') {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Akses ditolak.');
    }
}
