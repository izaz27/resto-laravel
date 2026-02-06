@extends('layouts.customer') {{-- Gunakan layout yang sudah ada agar hemat waktu --}}

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
        <div class="text-center">
            <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Login</h2>
            <p class="mt-2 text-sm text-gray-500">Silakan masuk untuk mengelola restoran</p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                    <input name="email" type="email" required class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 rounded-xl focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" placeholder="admin@resto.com">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                    <input name="password" type="password" required class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 rounded-xl focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-sm text-gray-600">Ingat Saya</label>
                </div>
                <div class="text-sm">
                    <a href="#" class="font-bold text-red-600 hover:text-red-500">Lupa Password?</a>
                </div>
            </div>

            <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-black rounded-xl text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all transform active:scale-95">
                Login
            </button>
        </form>
    </div>
</div>
@endsection