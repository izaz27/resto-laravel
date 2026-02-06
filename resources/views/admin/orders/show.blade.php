@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.order.index') }}" class="p-2 rounded-full hover:bg-gray-100 transition border border-gray-200 shadow-sm bg-white">
            <i data-lucide="arrow-left" class="w-6 h-6 text-gray-800"></i>
        </a>
        <div>
            <h1 class="text-3xl font-black text-gray-800 uppercase italic tracking-tighter">Detail Pesanan <span class="text-red-600">#{{ $order->order_code }}</span></h1>
            <p class="text-gray-500 text-sm italic font-medium">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- List Item Pesanan (Kiri) --}}
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-sm font-black mb-6 border-b pb-4 text-gray-400 uppercase tracking-widest">Item Pesanan</h3>
                <div class="space-y-6">
                    @foreach($order->details as $detail)
                    <div class="flex items-center gap-6 p-4 rounded-2xl border border-gray-50 bg-gray-50/30">
                        <img src="{{ asset('storage/' . $detail->menu->image_path) }}" 
                             class="w-20 h-20 rounded-xl object-cover shadow-sm border border-white"
                             onerror="this.src='{{ asset('images/default-menu.jpg') }}'">
                        
                        <div class="flex-1">
                            <h4 class="font-black text-gray-800 text-lg uppercase italic">{{ $detail->menu->name }}</h4>
                            <p class="text-red-600 font-bold text-sm">Rp{{ number_format($detail->price, 0, ',', '.') }} <span class="text-gray-400">x</span> {{ $detail->qty }}</p>
                            @if($detail->note && $detail->note !== '-')
                                <div class="mt-2 text-[10px] bg-yellow-50 text-yellow-700 px-3 py-1 rounded-lg inline-block border border-yellow-100 font-bold uppercase tracking-tight">
                                    Catatan: {{ $detail->note }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="text-right">
                            <p class="font-black text-gray-900">Rp{{ number_format($detail->price * $detail->qty, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8 pt-6 border-t border-dashed border-gray-200 flex justify-between items-center">
                    <span class="text-gray-400 font-black uppercase tracking-widest text-xs">Total Pembayaran</span>
                    <span class="text-3xl font-black text-gray-900 italic tracking-tighter">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Sidebar Info (Kanan) --}}
        <div class="space-y-6">
            {{-- Status Saat Ini (Ganti dari Form Update) --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-[10px] font-black text-gray-400 uppercase mb-4 tracking-widest text-center">Status Pesanan</h3>
                
                <div class="flex flex-col items-center gap-3">
                    @php
                        $statusClasses = [
                            'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                            'processing' => 'bg-blue-50 text-blue-600 border-blue-100',
                            'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                            'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                        ];
                        $statusIcons = [
                            'pending' => '⌛',
                            'processing' => '🍳',
                            'completed' => '✅',
                            'cancelled' => '❌',
                        ];
                    @endphp

                    <div class="w-full text-center py-4 px-6 rounded-2xl border-2 font-black uppercase italic tracking-tighter text-lg {{ $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-500' }}">
                        {{ $statusIcons[$order->status] ?? '' }} {{ $order->status }}
                    </div>
                    
                    <p class="text-[9px] text-gray-400 font-bold uppercase text-center leading-tight">
                        Status ini dikelola oleh tim kasir melalui panel operasional.
                    </p>
                </div>
            </div>

            {{-- Info Meja & Bayar --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-[10px] font-black text-gray-400 uppercase mb-4 tracking-widest text-center">Detail Lokasi & Bayar</h3>
                
                <div class="space-y-4">
                    <div>
                        <span class="text-[10px] text-gray-400 font-bold uppercase block mb-2 text-center">Nomor Meja</span>
                        <div class="flex flex-wrap justify-center gap-2">
                            @foreach(explode(', ', $order->table_numbers) as $table)
                                <span class="bg-gray-900 text-white px-4 py-2 rounded-xl font-black text-xs">MEJA {{ $table }}</span>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-50">
                        <span class="text-[10px] text-gray-400 font-bold uppercase block mb-2 text-center">Metode Pembayaran</span>
                        <div class="text-center font-black text-gray-800 uppercase bg-gray-50 p-3 rounded-xl border border-gray-100 text-xs">
                            {{ $order->payment_method }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection