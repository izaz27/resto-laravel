<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user(); // Menggunakan Facade Auth agar Intelephense tahu ini adalah Model User

            if ($user->role === 'admin') {
                // Ubah dari intended('/admin/dashboard') menjadi route('admin.dashboard')
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'kasir') {
                // Sesuaikan jika nanti kamu punya rute kasir.dashboard
                return redirect()->route('kasir.dashboard'); 
            }

            return redirect()->route('customer.home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
