@extends('layouts.customer')

@section('title', 'Daftar Menu')

@section('content')
<div class="max-w-6xl mx-auto py-6 md:py-8 px-4">
    
    {{-- Header --}}
    <div class="flex items-center gap-3 md:gap-4 mb-6 md:mb-8">
        <a href="{{ url('/') }}" class="p-2 rounded-full hover:bg-gray-100 transition duration-200 border border-gray-200 shadow-sm">
            <svg class="w-5 h-5 md:w-7 md:h-7 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h2 class="text-2xl md:text-4xl font-extrabold text-gray-800 border-b-4 border-red-600 pb-1">Semua Menu</h2>
    </div>

    {{-- Daftar Kategori --}}
    <div class="flex flex-nowrap overflow-x-auto gap-2 md:gap-3 mb-8 md:mb-10 pb-2 no-scrollbar">
        <a href="{{ route('customer.menu.index') }}" 
           class="whitespace-nowrap px-5 py-2 {{ !request('category') ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-red-50' }} rounded-full text-sm font-semibold shadow-sm transition border border-gray-200">
            Semua
        </a>
        
        @foreach ($categories as $category)
            <a href="{{ route('customer.menu.index', ['category' => $category->slug]) }}" 
               class="whitespace-nowrap px-5 py-2 {{ request('category') == $category->slug ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-red-50' }} border border-gray-300 rounded-full text-sm font-medium transition shadow-sm">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    {{-- Grid Menu: Sekarang berjejer rapi --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 mb-24">
    @forelse ($menus as $menu)
        {{-- Card Container --}}
        <div class="group flex flex-col bg-white rounded-xl md:rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden h-full">
            
            {{-- Bagian Gambar: Ukuran Otomatis Sama --}}
            <div class="relative aspect-square w-full overflow-hidden bg-gray-100">
                <img src="{{ !empty($menu->image_path) ? $menu->image_path : asset('images/default-menu.jpg') }}" 
                    alt="{{ $menu->name }}" 
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    onerror="this.src='{{ asset('images/default-menu.jpg') }}'">
                
                {{-- Badge Kategori --}}
                <div class="absolute top-2 left-2 z-10">
                    <span class="text-[8px] md:text-[10px] uppercase tracking-wider font-bold text-white bg-red-600/90 backdrop-blur-sm px-2 py-0.5 rounded-md">
                        {{ $menu->category->name }}
                    </span>
                </div>
            </div>

            {{-- Bagian Konten --}}
            <div class="p-3 md:p-5 flex flex-col flex-1">
                {{-- Judul Menu --}}
                <div class="min-h-[2.5rem] md:min-h-[3rem] mb-1">
                    <h3 class="text-sm md:text-lg font-bold text-gray-900 leading-tight line-clamp-2 group-hover:text-red-600 transition">
                        {{ $menu->name }}
                    </h3>
                </div>
                
                {{-- Harga --}}
                <div class="mb-3">
                    <p class="text-base md:text-xl font-black text-red-600">
                        Rp{{ number_format($menu->price, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Deskripsi (Desktop Only) --}}
                <p class="hidden md:block text-xs text-gray-500 mb-4 line-clamp-2">
                    {{ $menu->description ?? 'Nikmati kelezatan menu pilihan kami.' }}
                </p>
                
                {{-- Tombol Aksi: Menggunakan Onclick Asli Kamu --}}
                <div class="mt-auto pt-3 border-t border-gray-50 flex flex-col md:flex-row items-center gap-2">
                    <button type="button" 
                            onclick="addToCart('{{ $menu->id }}')" 
                            class="w-full bg-green-500 text-white px-3 py-2 rounded-lg hover:bg-green-600 transition text-xs md:text-sm font-bold shadow-sm active:scale-95 cursor-pointer">
                        + Keranjang
                    </button>

                    <a href="{{ route('customer.menu.show', $menu->slug) }}" class="text-[11px] md:text-xs text-blue-600 hover:text-blue-800 font-bold underline underline-offset-4">
                        Detail
                    </a>
                </div> 
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
            <p class="text-gray-400 text-lg font-medium italic">Menu belum tersedia...</p>
        </div>
    @endforelse
    </div>
</div>

{{-- Floating Cart Button (Sistem Tetap Sama) --}}
<div id="floating-cart" class="fixed bottom-0 left-0 right-0 z-50 w-full px-4 pb-6 transition-all duration-500 transform translate-y-full opacity-0">
    <div class="max-w-md mx-auto">
        <a href="{{ route('customer.cart.index') }}" class="flex items-center justify-between bg-red-600 text-white p-4 rounded-2xl shadow-2xl hover:bg-red-700 active:scale-95 transition border-2 border-white/20">
            <div class="flex items-center">
                <div class="relative mr-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 10-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span id="cart-badge" class="absolute -top-1 -right-1 bg-yellow-400 text-red-900 text-[10px] font-black rounded-full w-4 h-4 flex items-center justify-center">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </div>
                <span class="font-bold tracking-wide uppercase text-xs">Keranjang</span>
            </div>
            <span id="cart-total-price" class="font-black text-base italic">
                Rp{{ session('cart') ? number_format(collect(session('cart'))->sum(fn($item) => $item['price'] * $item['qty']), 0, ',', '.') : '0' }}
            </span>
        </a>
    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
// Logic JavaScript kamu tidak ada yang diubah
function checkCartStatus() {
    const cartBadge = document.getElementById('cart-badge');
    if (!cartBadge) return;
    
    const cartCount = parseInt(cartBadge.innerText);
    const cartElement = document.getElementById('floating-cart');
    
    if (cartCount > 0) {
        cartElement.classList.remove('translate-y-full', 'opacity-0');
        cartElement.classList.add('translate-y-0', 'opacity-100');
    } else {
        cartElement.classList.add('translate-y-full', 'opacity-0');
        cartElement.classList.remove('translate-y-0', 'opacity-100');
    }
}

window.addEventListener('pageshow', function() {
    checkCartStatus();
});

function addToCart(menuId) {
    fetch(`/cart/add/${menuId}`, { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ qty: 1 })
    })
    .then(response => {
        if (!response.ok) throw new Error('Gagal');
        return response.json();
    })
    .then(data => {
        if(data.status === 'success') {
            document.getElementById('cart-badge').innerText = data.cartCount;
            document.getElementById('cart-total-price').innerText = 'Rp' + data.totalPrice;
            checkCartStatus();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection