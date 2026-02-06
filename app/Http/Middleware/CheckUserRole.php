<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            // Jika belum login, arahkan ke halaman login
            return redirect()->route('login'); 
        }
        
        // 2. Cek apakah role user sama dengan role yang diminta
        $user = Auth::user();
        if ($user->role !== $role) {
            // Jika role tidak sesuai, arahkan ke halaman utama dengan pesan error
            return redirect('/')->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk halaman ' . strtoupper($role) . '.');
        }
        
        return $next($request);
    }
}