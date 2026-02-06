@extends('layouts.admin')

@section('content')
<div class="p-2">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-black text-gray-800 tracking-tighter uppercase">Dashboard Admin</h1>
            <p class="text-gray-500 text-sm">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        </div>
        <div class="text-right">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Status Dapur</p>
            <span class="flex items-center gap-2 text-orange-500 font-black italic">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                </span>
                {{ $pendingOrders }} PESANAN MASUK
            </span>
        </div>
    </div>

    {{-- Ringkasan Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest">Total Menu</p>
            <h3 class="text-4xl font-black text-gray-800 mt-2">{{ $totalMenus }}</h3>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest">Total Kategori</p>
            <h3 class="text-4xl font-black text-gray-800 mt-2">{{ $totalCategories }}</h3>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 bg-gradient-to-br from-white to-green-50">
            <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Pendapatan Hari Ini</p>
            <h2 class="text-4xl font-black text-green-600 italic">
                Rp {{ number_format($todayRevenue, 0, ',', '.') }}
            </h2>
        </div>
    </div>

    {{-- Menu Navigasi Cepat --}}
    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Navigasi Cepat</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.menu.index') }}" class="p-6 bg-white border border-gray-100 rounded-3xl text-center hover:shadow-md transition-all group">
            <span class="block text-2xl mb-1 group-hover:scale-110 transition">📦</span>
            <span class="font-bold uppercase text-[10px] tracking-tighter">Kelola Menu</span>
        </a>

        <a href="{{ route('admin.category.index') }}" class="p-6 bg-white border border-gray-100 rounded-3xl text-center hover:shadow-md transition-all group">
            <span class="block text-2xl mb-1 group-hover:scale-110 transition">📂</span>
            <span class="font-bold uppercase text-[10px] text-gray-600 tracking-tighter">Kategori</span>
        </a>

        <a href="{{ route('admin.order.index') }}" class="p-6 bg-white border border-gray-100 rounded-3xl text-center hover:shadow-md transition-all group">
            <span class="block text-2xl mb-1 group-hover:scale-110 transition">🛒</span>
            <span class="font-bold uppercase text-[10px] text-gray-600 tracking-tighter">Pesanan</span>
        </a>
    </div>
</div>
@endsection