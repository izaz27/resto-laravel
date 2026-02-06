@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-black text-gray-800 uppercase">Nomor Meja Pesanan</h1>
        <p class="text-gray-500 mt-2">Kamu bisa memilih lebih dari satu meja jika datang rombongan</p>
    </div>

    {{-- Tambahkan ID pada form agar bisa di-submit via JavaScript --}}
    <form action="{{ route('customer.table.store') }}" method="POST" id="table-form">
        @csrf
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach($tables as $table)
                <label class="cursor-pointer group">
                    {{-- Pastikan name adalah 'table_numbers[]' agar sesuai dengan controller --}}
                    <input type="checkbox" name="table_numbers[]" value="{{ $table }}" class="hidden peer">
                    <div class="aspect-square flex flex-col items-center justify-center border-2 border-gray-100 rounded-2xl bg-white shadow-sm transition peer-checked:border-red-600 peer-checked:bg-red-50 group-hover:shadow-md">
                        <span class="text-xs text-gray-400 uppercase font-bold">Meja</span>
                        <span class="text-3xl font-black text-gray-800">{{ $table }}</span>
                    </div>
                </label>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            {{-- Ubah type menjadi 'button' agar tidak langsung submit --}}
            <button type="button" onclick="validateTableSelection()" class="bg-red-600 text-white px-12 py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-red-700 transition transform hover:scale-105 active:scale-95">
                Konfirmasi & Lihat Menu
            </button>
        </div>
    </form>
</div>

{{-- MODAL PERINGATAN (POPUP) --}}
<div id="table-warning-modal" class="fixed inset-0 z-[110] hidden">
    {{-- Overlay gelap --}}
    <div class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm" onclick="closeWarningModal()"></div>
    
    {{-- Content Modal --}}
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 text-center animate-slide-up">
            <div class="bg-yellow-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-2">Meja Belum Dipilih</h3>
            <p class="text-gray-500 mb-8 text-sm">Silakan pilih minimal satu nomor meja tempat Anda duduk agar kami bisa mengantar pesanan.</p>
            
            <button type="button" onclick="closeWarningModal()" class="w-full bg-red-600 text-white font-bold py-4 rounded-2xl shadow-lg hover:bg-red-700 transition">
                Oke, Saya Pilih Meja
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes slide-up {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .animate-slide-up {
        animation: slide-up 0.3s ease-out;
    }
</style>

<script>
    function validateTableSelection() {
        // Cek apakah ada checkbox table_numbers yang dicentang
        const selected = document.querySelectorAll('input[name="table_numbers[]"]:checked');
        
        if (selected.length === 0) {
            // Jika kosong, tampilkan modal
            const modal = document.getElementById('table-warning-modal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Kunci scroll
        } else {
            // Jika ada yang dipilih, submit form-nya
            document.getElementById('table-form').submit();
        }
    }

    function closeWarningModal() {
        const modal = document.getElementById('table-warning-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto'; // Aktifkan scroll lagi
    }
</script>
@endsection