@extends('layouts.customer')

@section('content')
<div class="max-w-5xl mx-auto py-6 md:py-10 px-4">
    <div class="flex items-center gap-3 md:gap-4 mb-6 md:mb-8">
        <a href="{{ route('customer.menu.index') }}" class="p-2 rounded-full hover:bg-gray-100 transition duration-200 border border-gray-200 shadow-sm">
            <svg class="w-5 h-5 md:w-7 md:h-7 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800">Keranjang</h1>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
        {{-- List Item --}}
        <div class="lg:col-span-2 space-y-4">
            @php $total = 0 @endphp
            @foreach($cart as $id => $details)
                @php $total += $details['price'] * $details['qty'] @endphp
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6 flex items-start md:items-center gap-4 md:gap-6">
                    <img src="{{ !empty($details['image_path']) ? $details['image_path'] : asset('images/default-menu.jpg') }}" 
                    class="w-20 h-20 md:w-24 md:h-24 rounded-xl object-cover flex-shrink-0" 
                    onerror="this.src='{{ asset('images/default-menu.jpg') }}'">
                    
                    <div class="flex-1 min-w-0"> <h3 class="text-base md:text-xl font-bold text-gray-800 uppercase truncate">{{ $details['name'] }}</h3>
                        <p class="text-red-600 font-bold text-sm md:text-base">Rp{{ number_format($details['price'], 0, ',', '.') }}</p>
                        
                        @if(!empty($details['note']))
                            <p class="text-[10px] md:text-xs text-gray-400 mt-1 italic leading-tight">Catatan: {{ $details['note'] }}</p>
                        @endif

                        <div class="flex md:hidden items-center mt-3 gap-4">
                            <div class="flex items-center bg-gray-100 rounded-full px-2 py-1 border border-gray-200">
                                <button type="button" onclick="updateCart('{{ $id }}', 'decrease')" class="w-7 h-7 flex items-center justify-center font-bold text-gray-600">-</button>
                                <span id="qty-mobile-{{ $id }}" class="font-bold w-6 text-center text-sm text-gray-800">{{ $details['qty'] }}</span>
                                <button type="button" onclick="updateCart('{{ $id }}', 'increase')" class="w-7 h-7 flex items-center justify-center font-bold text-gray-600">+</button>
                            </div>
                            <form action="{{ route('customer.cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 p-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="hidden md:flex flex-col items-end gap-3">
                        <form action="{{ route('customer.cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>

                        <div class="flex items-center bg-gray-100 rounded-full px-2 py-1 border border-gray-200">
                            <button type="button" onclick="updateCart('{{ $id }}', 'decrease')" class="w-8 h-8 flex items-center justify-center font-bold text-gray-600 hover:bg-gray-200 rounded-full transition">-</button>
                            <span id="qty-{{ $id }}" class="font-bold w-8 text-center text-gray-800">{{ $details['qty'] }}</span>
                            <button type="button" onclick="updateCart('{{ $id }}', 'increase')" class="w-8 h-8 flex items-center justify-center font-bold text-gray-600 hover:bg-gray-200 rounded-full transition">+</button>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <a href="{{ route('customer.menu.index') }}" class="inline-block text-red-600 font-bold mt-2 text-sm md:text-base hover:underline">
                + Tambah Menu Lain
            </a>
        </div>

        {{-- Sidebar Ringkasan --}}
        <div class="space-y-4">
            <div class="p-4 bg-red-50 rounded-xl border border-red-100">
                <h3 class="text-xs font-bold text-red-800 uppercase mb-2">Meja Pesanan</h3>
                <div class="flex flex-wrap gap-2">
                    @if(session()->has('selected_tables'))
                        @foreach(session('selected_tables') as $table)
                            <span class="bg-white border border-red-200 text-red-600 px-3 py-1 rounded-lg text-xs font-bold">Meja {{ $table }}</span>
                        @endforeach
                    @else
                        <span id="no-table-indicator" class="text-gray-400 text-[10px] md:text-xs italic">Belum memilih meja</span>
                        <a href="{{ route('customer.table.index') }}" class="text-[10px] md:text-xs text-red-600 underline ml-2 font-bold">Pilih Sekarang</a>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-5 md:p-6 h-fit lg:sticky lg:top-6 mb-20 md:mb-0">
                <h2 class="text-lg md:text-xl font-bold mb-4 border-b pb-2">Ringkasan</h2>
                <div class="flex justify-between items-center mb-6">
                    <span class="text-gray-500 text-sm md:text-base">Total Bayar</span>
                    <span id="cart-total" class="text-xl md:text-2xl font-black text-gray-900">
                        Rp{{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>

                <button type="button" onclick="openPaymentModal()" class="w-full bg-red-600 text-white font-bold py-3 md:py-4 rounded-xl shadow-lg hover:bg-red-700 transition">
                    Pesan Sekarang
                </button>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-16 md:py-20 bg-gray-50 rounded-3xl px-4">
        <div class="mb-4 flex justify-center text-gray-300">
            <svg class="w-16 h-16 md:w-20 md:h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        </div>
        <p class="text-gray-500 text-base md:text-lg italic">Wah, keranjangmu kosong melompong.</p>
        <a href="{{ route('customer.menu.index') }}" class="mt-6 inline-block bg-red-600 text-white px-8 py-3 rounded-full font-bold shadow-md">Cari Makan Yuk!</a>
    </div>
    @endif
</div>

{{-- MODAL PEMBAYARAN: Fixed Overflow Issue --}}
{{-- MODAL PEMBAYARAN: Fixed Selection Style --}}
<div id="payment-modal" class="fixed inset-0 z-[100] hidden">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closePaymentModal()"></div>
    
    <div class="relative min-h-full flex items-end md:items-center justify-center p-0 md:p-4">
        <div class="relative bg-white rounded-t-3xl md:rounded-3xl shadow-2xl max-w-md w-full p-6 md:p-8 transform transition-all animate-slide-up max-h-[90vh] flex flex-col">
            
            <div class="w-12 h-1.5 bg-gray-200 rounded-full mx-auto mb-6 md:hidden flex-shrink-0"></div>
            
            <div class="flex-shrink-0">
                <h3 class="text-xl md:text-2xl font-black text-gray-900 mb-1">Metode Pembayaran</h3>
                <p class="text-sm text-gray-500 mb-6">Pilih cara bayar ternyaman.</p>
            </div>
            
            <form action="{{ route('customer.order.process') }}" method="POST" id="payment-form" class="flex flex-col overflow-hidden">
                @csrf
                <div class="space-y-3 overflow-y-auto pr-1 flex-1 custom-scrollbar">
                    
                    {{-- Opsi Tunai / Cash --}}
                    <label class="relative flex items-center p-4 border-2 border-gray-100 rounded-2xl cursor-pointer transition-all duration-200 hover:bg-gray-50 group">
                        <input type="radio" name="payment_method" value="cash" class="peer hidden" checked>
                        {{-- Border Effect: Otomatis merah saat peer dicentang --}}
                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-red-600 rounded-2xl pointer-events-none transition-all"></div>
                        
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="flex-1">
                            <span class="block font-bold text-gray-800 text-sm md:text-base peer-checked:text-red-600">Bayar di Kasir</span>
                            <span class="text-[10px] md:text-xs text-gray-500">Tunai setelah makan</span>
                        </div>
                    </label>

                    {{-- Opsi QRIS --}}
                    <label class="relative flex items-center p-4 border-2 border-gray-100 rounded-2xl cursor-pointer transition-all duration-200 hover:bg-gray-50 group">
                        <input type="radio" name="payment_method" value="qris" class="peer hidden">
                        {{-- Border Effect --}}
                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-red-600 rounded-2xl pointer-events-none transition-all"></div>
                        
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        </div>
                        <div class="flex-1">
                            <span class="block font-bold text-gray-800 text-sm md:text-base">QRIS / E-Wallet</span>
                            <span class="text-[10px] md:text-xs text-gray-500">Otomatis & Cepat</span>
                        </div>
                    </label>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mt-6 flex-shrink-0 pb-2">
                    <button type="button" onclick="closePaymentModal()" class="py-3 md:py-4 font-bold text-gray-400">Batal</button>
                    <button type="submit" class="bg-red-600 text-white font-bold py-3 md:py-4 rounded-2xl shadow-lg hover:bg-red-700 active:scale-95 transition-all">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    /* CSS tambahan untuk memastikan visual border radio button bekerja di Tailwind 4 */
    input[type="radio"]:checked ~ div.flex-1 + div {
        border-color: #dc2626; /* red-600 */
    }
    input[type="radio"]:checked ~ .flex-1 span.block {
        color: #dc2626;
    }
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
</style>

{{-- MODAL WARNING MEJA (Identik dengan di atas untuk konsistensi mobile) --}}
<div id="table-warning-modal" class="fixed inset-0 z-[110] hidden">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeWarningModal()"></div>
    <div class="relative min-h-screen flex items-end md:items-center justify-center p-0 md:p-4">
        <div class="bg-white rounded-t-3xl md:rounded-3xl shadow-2xl max-w-sm w-full p-8 text-center animate-slide-up">
            <div class="bg-yellow-100 w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 md:w-10 md:h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-2">Meja Belum Dipilih</h3>
            <p class="text-gray-500 mb-8 text-sm leading-relaxed">Pilih nomor meja dulu ya supaya pesananmu tidak tertukar dengan pelanggan lain.</p>
            <div class="flex flex-col gap-3">
                <a href="{{ route('customer.table.index') }}" class="bg-red-600 text-white font-bold py-4 rounded-2xl shadow-lg">
                    Pilih Nomor Meja
                </a>
                <button type="button" onclick="closeWarningModal()" class="text-gray-400 font-bold py-2">Batal</button>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes slide-up {
        from { transform: translateY(100%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    @media (min-width: 768px) {
        @keyframes slide-up {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    }
    .animate-slide-up { animation: slide-up 0.3s ease-out forwards; }
</style>

<script>
    // JS tetap sama, hanya menambahkan update untuk double ID qty (mobile & desktop)
    function updateCart(id, action) {
        fetch(`/cart/update/${id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ action: action })
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                // Update Qty di Desktop
                const qtyElement = document.getElementById(`qty-${id}`);
                if(qtyElement) qtyElement.innerText = data.newQty;
                
                // Update Qty di Mobile
                const qtyMobileElement = document.getElementById(`qty-mobile-${id}`);
                if(qtyMobileElement) qtyMobileElement.innerText = data.newQty;
                
                const totalElement = document.getElementById('cart-total');
                if(totalElement) totalElement.innerText = 'Rp' + data.cartTotal;
                
                if(data.newQty <= 0) location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function openPaymentModal() {
        const isTableSelected = {{ session()->has('selected_tables') ? 'true' : 'false' }};
        if (!isTableSelected) {
            document.getElementById('table-warning-modal').classList.remove('hidden');
        } else {
            document.getElementById('payment-modal').classList.remove('hidden');
        }
        document.body.style.overflow = 'hidden';
    }

    function closePaymentModal() {
        document.getElementById('payment-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function closeWarningModal() {
        document.getElementById('table-warning-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endsection