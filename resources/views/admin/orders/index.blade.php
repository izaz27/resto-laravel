@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-black text-gray-800">Daftar Pesanan</h2>
    </div>
    <form action="{{ route('admin.order.clearHistory') }}" method="POST" onsubmit="return confirm('Hapus semua riwayat pesanan yang sudah selesai?')">
        @csrf
        @method('DELETE')
        <div class="flex justify-end ">
        <button type="submit" class="text-xs bg-red-100 text-red-500 px-4 py-2 rounded hover:bg-red-200 hover:text-red-600 transition font-bold uppercase">
            Bersihkan Riwayat Selesai
        </button>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-gray-400 text-sm uppercase tracking-wider border-b">
                    <th class="pb-4">Kode Order</th>
                    <th class="pb-4">Meja</th>
                    <th class="pb-4">Total</th>
                    <th class="pb-4">Metode</th>
                    <th class="pb-4">Status</th>
                    <th class="pb-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($orders as $order)
                <tr>
                    <td class="py-4 font-bold">#{{ $order->order_code }}</td>
                    <td class="py-4 text-gray-600">Meja {{ $order->table_numbers }}</td>
                    <td class="py-4 font-bold text-red-600">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="py-4 uppercase text-xs font-bold">{{ $order->payment_method }}</td>
                    <td class="py-4">
                        <span class="px-3 py-1 rounded text-xs font-bold 
                            {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : '' }}
                            {{ $order->status == 'completed' ? 'bg-green-100 text-green-600' : '' }}
                            {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-600' : '' }}">
                            {{ strtoupper($order->status) }}
                            
                        </span>
                    </td>
                    <td class="py-4 text-right">
                        <a href="{{ route('admin.order.show', $order->id) }}" class="text-blue-600 hover:underline">Detail</a>
                        <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 ml-2">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection