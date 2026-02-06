@extends('layouts.customer')

@section('title', 'Pesanan Berhasil')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12 text-center">
    {{-- Animasi Centang Sederhana --}}
    <div class="mb-8 flex justify-center">
        <div class="bg-green-100 p-6 rounded-full">
            <svg class="w-20 h-20 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
    </div>

    <h1 class="text-4xl font-black text-gray-900 mb-2">PESANAN DITERIMA!</h1>
    <p class="text-gray-500 text-lg mb-8">Mohon tunggu sejenak, koki kami sedang menyiapkan hidangan lezat untuk Anda.</p>

    {{-- Ringkasan Pesanan --}}
    <div class="bg-white border-2 border-dashed border-gray-200 rounded-3xl p-8 mb-8 text-left">
        <div class="flex justify-between items-center mb-6 pb-4 border-b">
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">ID Pesanan</p>
                <p class="text-lg font-bold text-gray-800">#{{ $order->order_code }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Nomor Meja</p>
                <p class="text-lg font-bold text-gray-800">{{ $order->table_numbers }}</p>
            </div>
        </div>

        <div class="space-y-4 mb-6">
            @foreach($order->details as $item)
            <div class="flex justify-between text-gray-700">
                <span><span class="font-bold text-gray-900">{{ $item->qty }}x</span> {{ $item->menu->name }}</span>
                <span class="font-medium">Rp{{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
            </div>
            @if($item->note)
                <p class="text-xs text-red-500 italic mt-1">- "{{ $item->note }}"</p>
            @endif
            @endforeach
        </div>

        <div class="pt-4 border-t-2 border-gray-100 flex justify-between items-center">
            <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
            <span class="text-2xl font-black text-red-600">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- Instruksi Pembayaran --}}
    <div class="bg-blue-50 p-6 rounded-2xl mb-10">
        <div class="flex items-start gap-4 text-left">
            <div class="bg-blue-500 text-white p-2 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="font-bold text-blue-900">Instruksi Pembayaran</p>
                @if($order->payment_method == 'cash')
                    <p class="text-blue-700 text-sm">Silakan lakukan pembayaran di kasir setelah Anda selesai menikmati hidangan.</p>
                @else
                    <p class="text-blue-700 text-sm">Pesanan Anda menggunakan QRIS. Silakan tunjukkan bukti bayar atau panggil pelayan jika ada kendala.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Tombol Kembali --}}
    <a href="{{ route('customer.menu.index') }}" class="inline-block w-full bg-gray-900 text-white font-bold py-4 rounded-2xl hover:bg-gray-800 transition active:scale-95">
        Pesan Menu Lainnya
    </a>
</div>
@endsection