@extends('layouts.customer')

@section('content')
<div class="min-h-screen bg-gray-50 pb-10 md:pb-20">
    {{-- Banner: Tinggi disesuaikan (h-52 di mobile, h-80 di desktop) --}}
    <div class="h-52 md:h-80 bg-cover bg-center shadow-inner relative transition-all duration-500" style="background-image: url('{{ asset('images/restaurant-banner.jpg') }}')">
        <div class="absolute inset-0 bg-black/30 backdrop-blur-[1px]"></div>
    </div>

    <div class="max-w-5xl mx-auto px-4 md:px-6">
        {{-- Card Utama: -mt-16 di mobile agar tidak terlalu menutupi banner --}}
        <div class="relative -mt-16 md:-mt-24 bg-white rounded-3xl shadow-xl p-6 md:p-8 border border-gray-100 flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-8">
            
            {{-- Logo Container: Ukuran lebih proporsional di mobile --}}
            <div class="flex-shrink-0">
                <div class="w-32 h-32 md:w-40 md:h-40 bg-white rounded-2xl shadow-lg flex items-center justify-center p-3 border-4 border-white transform md:-rotate-3">
                    <img src="{{ asset('images/logo.png') }}" class="w-full h-full object-contain" alt="Logo">
                </div>
            </div>

            <div class="flex-1 text-center md:text-left">
                <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4">
                    <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 tracking-tight">{{ $info->name ?? 'Nama Resto' }}</h1>
                    <span class="px-3 py-1 bg-green-100 text-green-600 text-[10px] md:text-sm font-bold rounded-full w-fit mx-auto md:mx-0 flex items-center gap-1">
                        <span class="animate-pulse text-xs">●</span> Sedang Buka
                    </span>
                </div>
                
                {{-- Info Alamat & Jam: Menggunakan text-sm di mobile --}}
                <div class="mt-4 space-y-2 md:space-y-0 md:grid md:grid-cols-2 md:gap-4 text-gray-600">
                    <div class="flex items-start md:items-center justify-center md:justify-start gap-2 md:gap-3">
                        <span class="text-lg">📍</span>
                        <p class="text-sm md:text-lg leading-tight">{{ $info->address ?? 'Alamat belum diatur' }}</p>
                    </div>
                    <div class="flex items-center justify-center md:justify-start gap-2 md:gap-3">
                        <span class="text-lg">🕒</span>
                        <p class="text-sm md:text-lg">
                            <span class="hidden md:inline">Operasional:</span> 
                            <span class="font-semibold text-gray-800">{{ $info->open_time ?? '09:00' }} - {{ $info->close_time ?? '21:00' }}</span>
                        </p>
                    </div>
                </div>

                {{-- Button: Dibuat full width di mobile agar mudah di-klik --}}
                <div class="mt-8 md:mt-10 flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="{{ route('customer.table.index') }}" 
                       class="group flex items-center justify-center md:justify-start gap-4 bg-red-600 text-white px-6 md:px-8 py-4 rounded-2xl shadow-lg hover:bg-red-700 transition-all active:scale-95">
                        <span class="text-2xl group-hover:scale-110 transition">🍲</span>
                        <div class="text-left">
                            <p class="text-[10px] opacity-80 uppercase font-bold tracking-wider leading-none">Mulai Pesan</p>
                            <p class="font-bold text-lg md:text-xl">Pesan Sekarang</p>
                        </div>
                        <span class="hidden md:block ml-4 text-2xl font-bold group-hover:translate-x-1 transition">→</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Fitur/Badge: Grid 3 kolom di Desktop, Grid 1 kolom di Mobile --}}
        <div class="mt-8 md:mt-12 grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex md:flex-col items-center gap-4 md:text-center transition hover:shadow-md">
                <div class="text-3xl bg-orange-50 w-14 h-14 flex items-center justify-center rounded-xl md:mx-auto md:mb-2">⭐</div>
                <div>
                    <h3 class="font-bold text-gray-800">Kualitas Terbaik</h3>
                    <p class="text-xs md:text-sm text-gray-500">Bahan segar pilihan setiap hari.</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex md:flex-col items-center gap-4 md:text-center transition hover:shadow-md">
                <div class="text-3xl bg-blue-50 w-14 h-14 flex items-center justify-center rounded-xl md:mx-auto md:mb-2">⚡</div>
                <div>
                    <h3 class="font-bold text-gray-800">Pelayanan Cepat</h3>
                    <p class="text-xs md:text-sm text-gray-500">Pesanan prioritas utama kami.</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex md:flex-col items-center gap-4 md:text-center transition hover:shadow-md">
                <div class="text-3xl bg-green-50 w-14 h-14 flex items-center justify-center rounded-xl md:mx-auto md:mb-2">🛡️</div>
                <div>
                    <h3 class="font-bold text-gray-800">Bayar Aman</h3>
                    <p class="text-xs md:text-sm text-gray-500">Tunai maupun QRIS tersedia.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection