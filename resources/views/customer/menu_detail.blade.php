@extends('layouts.customer')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 bg-white min-h-screen">
    <a href="{{ route('customer.menu.index') }}" class="inline-flex items-center text-gray-600 hover:text-red-600 mb-6 transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Menu
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="relative">
            <img src="{{ asset('storage/' . $menu->image_path) }}" 
                 class="w-full h-[500px] object-cover rounded-3xl shadow-lg" 
                 alt="{{ $menu->name }}"
                 onerror="this.src='{{ asset('images/default-menu.jpg') }}'">
        </div>

        <div class="flex flex-col">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-tight">{{ $menu->name }}</h1>
            
            <div class="text-3xl font-bold text-red-600 mt-4">
                Rp{{ number_format($menu->price, 0, ',', '.') }}
            </div>

            <p class="text-gray-600 mt-6 text-lg leading-relaxed border-b pb-6">
                {{ $menu->description }}
            </p>

            {{-- Rekomendasi Pendamping --}}
            <div class="mt-8">
                <h3 class="font-bold text-gray-800 mb-4 text-xl">Rekomendasi Pendamping</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($recommendations as $rec)
                        <div class="flex items-center gap-4 bg-gray-50 p-2 rounded-xl">
                            <img src="{{ asset('storage/' . $rec->image_path) }}" class="w-16 h-16 rounded-lg object-cover" onerror="this.src='{{ asset('images/default-menu.jpg') }}'">
                            <div class="flex-1">
                                <h4 class="font-bold text-sm">{{ $rec->name }}</h4>
                                <p class="text-red-600 font-bold text-sm">Rp{{ number_format($rec->price, 0, ',', '.') }}</p>
                            </div>
                            
                            {{-- Tombol Rekomendasi AJAX --}}
                            <button type="button" onclick="addToCartDetail('{{ $rec->id }}', 1, '')" 
                                class="bg-white border border-gray-200 rounded-full w-8 h-8 flex items-center justify-center shadow-sm hover:bg-red-50 text-xl font-bold">+</button>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Bagian Catatan & Quantity --}}
            <div class="mt-10 bg-gray-50 p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-3">
                    <label class="font-bold text-gray-800">Catatan Khusus</label>
                    <span class="text-xs text-gray-400">Maksimal 20 karakter</span>
                </div>
                {{-- Tambahkan ID pada textarea --}}
                <textarea id="note-input" maxlength="20"
                          class="w-full border-gray-200 rounded-xl p-4 text-sm focus:ring-red-500 focus:border-red-500" 
                          placeholder="Contoh: Kurangi pedas, tanpa seledri..."></textarea>

                <div class="mt-8 flex items-center gap-6">
                    <div class="flex items-center bg-white border border-gray-200 rounded-xl px-4 py-3 gap-8 shadow-sm">
                        <button type="button" onclick="decrement()" class="text-2xl font-bold text-gray-400 hover:text-red-600 transition">-</button>
                        <span id="qty-display" class="font-bold text-xl min-w-[20px] text-center">1</span>
                        <button type="button" onclick="increment()" class="text-2xl font-bold text-gray-400 hover:text-red-600 transition">+</button>
                    </div>
                    
                    {{-- Tombol Utama AJAX --}}
                    <button type="button" onclick="submitMainForm('{{ $menu->id }}')" 
                            class="flex-1 bg-red-600 text-white font-bold py-4 rounded-xl hover:bg-red-700 shadow-lg shadow-red-200 transition-all transform active:scale-[0.98]">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let qty = 1;
    function increment() {
        qty++;
        updateQty();
    }
    function decrement() {
        if(qty > 1) qty--;
        updateQty();
    }
    function updateQty() {
        document.getElementById('qty-display').innerText = qty;
    }

    // Fungsi khusus untuk tombol utama (mengambil nilai qty dan note)
    function submitMainForm(menuId) {
        const note = document.getElementById('note-input').value;
        addToCartDetail(menuId, qty, note);
    }

    // Fungsi utama Fetch API
    function addToCartDetail(menuId, quantity, note) {
        // PERBAIKAN URL: Sesuaikan dengan rute /cart/add/{menu}
        fetch(`/cart/add/${menuId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ 
                qty: quantity,
                note: note 
            })
        })
        .then(response => {
            if (!response.ok) throw new Error('Gagal menambahkan ke keranjang');
            return response.json();
        })
        .then(data => {
            if(data.status === 'success') {
                // Redirect ke daftar menu agar user bisa melihat floating cart
                window.location.href = "{{ route('customer.menu.index') }}";
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Maaf, gagal menambahkan ke keranjang. Silakan coba lagi.');
        });
    }
</script>
@endsection