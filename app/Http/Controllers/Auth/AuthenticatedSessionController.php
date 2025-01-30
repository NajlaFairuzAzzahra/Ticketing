<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        // Menampilkan halaman login
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ✅ Perbaiki redirect berdasarkan role
            $user = Auth::user();
            if ($user->role_id == 1) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role_id == 2) {
                return redirect()->route('staff.dashboard');
            } else {
                return redirect()->route('user.dashboard'); // User biasa
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
