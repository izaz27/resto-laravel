@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8 flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-black text-gray-800 uppercase italic tracking-tighter">
                    Pesanan <span class="text-red-600">Hari Ini</span>
                </h2>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-1">Selamat Bekerja</p>
            </div>
            <div class="text-right">
                <span class="text-[10px] font-black text-gray-400 uppercase">Total Pesanan</span>
                <p class="text-2xl font-black text-gray-800">{{ $orders->count() }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4">
            @forelse($orders as $order)
            <div class="bg-white overflow-hidden rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                        
                        {{-- Info Utama --}}
                        <div class="flex-1 grid grid-cols-2 md:grid-cols-4 gap-4 w-full">
                            {{-- Klik Kode Order untuk buka Detail --}}
                            <button onclick="openDetailModal({{ $order->id }})" class="text-left group">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">Kode Order</span>
                                <h3 class="font-black text-gray-800 text-lg group-hover:text-red-600 transition-colors">#{{ $order->order_code }}</h3>
                                <span class="text-[14px] text-blue-500 font-bold tracking-tighter">Detail</span>
                            </button>

                            <div>
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">Meja</span>
                                <span class="inline-block bg-red-50 text-red-600 px-3 py-1 rounded-xl font-black text-mm border border-red-100">
                                    {{ $order->table_numbers }}
                                </span>
                            </div>

                            <div>
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">Status</span>
                                <span class="text-[16px] font-black {{ $order->status == 'completed' ? 'text-emerald-500' : 'text-amber-500' }} bg-gray-50 px-3 py-1 rounded-full">
                                    {{ $order->status == 'completed' ? 'Selesai' : 'Pending' }}
                                </span>
                            </div>

                            <div>
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">Total Bayar</span>
                                <span class="font-black text-gray-800 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        {{-- Aksi --}}
                        <div class="flex items-center gap-2 w-full md:w-auto border-t md:border-t-0 pt-4 md:pt-0">
                            @if($order->status != 'completed')
                                {{-- TAMPILAN SAAT PENDING --}}
                                
                                {{-- Tombol Batalkan --}}
                                <form action="{{ route('kasir.order.destroy', $order->id) }}" method="POST" class="flex-1 md:flex-none">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="konfirmasiHapus(this.form)" class="w-full p-4 rounded-2xl bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>

                                {{-- Tombol Selesai --}}
                                <form action="{{ route('kasir.order.updateStatus', $order->id) }}" method="POST" class="flex-[3] md:flex-none">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="button" onclick="konfirmasiSelesai(this.form)" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-emerald-100 transition-all">
                                        Selesaikan
                                    </button>
                                </form>
                            @else
                                {{-- TAMPILAN SAAT SELESAI (Ganti Tombol Cetak ke Sini) --}}
                                <a href="{{ route('kasir.order.cetak', $order->id) }}" target="_blank" 
                                    class="flex items-center justify-center gap-2 w-full md:w-auto bg-gray-800 hover:bg-black text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                    Cetak Struk
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL DETAIL (Hidden by default) --}}
            <div id="modal-{{ $order->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeDetailModal({{ $order->id }})"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white p-8">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <h3 class="text-2xl font-black text-gray-800 uppercase italic">Rincian <span class="text-red-600">Order</span></h3>
                                    <p class="text-xs font-bold text-gray-400">#{{ $order->order_code }} - Meja {{ $order->table_numbers }}</p>
                                </div>
                                <button onclick="closeDetailModal({{ $order->id }})" class="text-gray-400 hover:text-gray-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                            
                            <div class="space-y-4 mb-8">
                                @foreach($order->details as $detail)
                                <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl">
                                    <div>
                                        <p class="font-black text-gray-800 uppercase text-sm">{{ $detail->menu->name }}</p>
                                        <p class="text-[10px] font-bold text-red-500 italic">Rp {{ number_format($detail->price, 0, ',', '.') }} x {{ $detail->qty }}</p>
                                        @if($detail->note && $detail->note != '-')
                                            <p class="text-[12px] bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded mt-1 inline-block">Catatan: {{ $detail->note }}</p>
                                        @endif
                                    </div>
                                    <p class="font-black text-gray-800 text-sm">Rp {{ number_format($detail->price * $detail->qty, 0, ',', '.') }}</p>
                                </div>
                                @endforeach
                            </div>

                            <div class="border-t border-dashed pt-4 flex justify-between items-center">
                                <span class="font-black text-gray-400 uppercase text-xs tracking-widest">Metode Bayar</span>
                                <span class="font-black text-gray-800 uppercase text-xs">{{ $order->payment_method }}</span>
                            </div>
                            <div class="mt-2 flex justify-between items-center">
                                <span class="font-black text-gray-400 uppercase text-xs tracking-widest">Total Harga</span>
                                <span class="text-2xl font-black text-emerald-600 italic">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-100">
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-sm">Belum ada pesanan</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Modal Logic
    function openDetailModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeDetailModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // SweetAlert Konfirmasi
    function konfirmasiSelesai(form) {
        Swal.fire({
            title: 'Selesaikan Pesanan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            confirmButtonText: 'YA, SELESAI',
            cancelButtonText: 'BATAL',
            borderRadius: '20px'
        }).then((result) => { if (result.isConfirmed) form.submit(); });
    }

    function konfirmasiHapus(form) {
        Swal.fire({
            title: 'Batalkan Pesanan?',
            text: "Pesanan akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'YA, BATALKAN',
            cancelButtonText: 'JANGAN',
            borderRadius: '20px'
        }).then((result) => { if (result.isConfirmed) form.submit(); });
    }

    @if(session('success'))
        Swal.fire({ title: 'BERHASIL!', text: "{{ session('success') }}", icon: 'success', timer: 2000, showConfirmButton: false, borderRadius: '20px' });
    @endif
</script>
@endsection