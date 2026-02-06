{{-- resources/views/admin/laporan/laporan_pendapatan.blade.php --}}
@extends('layouts.admin') {{-- Sesuaikan dengan nama layout admin kamu --}}

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-black text-gray-800 uppercase italic">Laporan <span class="text-red-600">Pendapatan</span></h2>
        
        {{-- Tombol untuk Download PDF --}}
        <a href="{{ route('admin.laporan.ekspor') }}" class="bg-emerald-600 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-700 transition-all">
            Download PDF
        </a>
    </div>

    {{-- Tambahkan ini di atas tabel --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-2">Omzet Hari Ini</span>
            <h3 class="text-2xl font-black text-emerald-600 italic">Rp {{ number_format($orders->sum('total_price'), 0, ',', '.') }}</h3>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-2">Total Transaksi</span>
            <h3 class="text-2xl font-black text-gray-800 italic">{{ $orders->count() }} Order</h3>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-2">Rata-rata Per Order</span>
            <h3 class="text-2xl font-black text-blue-600 italic">
                Rp {{ $orders->count() > 0 ? number_format($orders->avg('total_price'), 0, ',', '.') : 0 }}
            </h3>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-4 font-black text-gray-400 uppercase text-[10px]">No</th>
                    <th class="p-4 font-black text-gray-400 uppercase text-[10px]">Kode Order</th>
                    <th class="p-4 font-black text-gray-400 uppercase text-[10px]">Meja</th>
                    <th class="p-4 font-black text-gray-400 uppercase text-[10px]">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                <tr class="border-t border-gray-50">
                    <td class="p-4 text-sm font-bold text-gray-600">{{ $index + 1 }}</td>
                    <td class="p-4 text-sm font-black text-gray-800">#{{ $order->order_code }}</td>
                    <td class="p-4 text-sm font-bold text-gray-600">{{ $order->table_numbers }}</td>
                    <td class="p-4 text-sm font-black text-red-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection