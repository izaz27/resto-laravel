@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-black text-gray-800 uppercase">Daftar Kategori</h1>
        <a href="{{ route('admin.category.create') }}" class="bg-red-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-700 transition shadow-lg shadow-red-100 text-sm">
            + TAMBAH KATEGORI
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 p-4 rounded-xl mb-6 font-bold text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 font-bold text-sm border border-red-100">
        ⚠️ {{ session('error') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-gray-400 text-xs uppercase tracking-widest border-b">
                    <th class="pb-4 font-black">Nama Kategori</th>
                    <th class="pb-4 font-black text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse($categories as $cat)
                <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                    <td class="py-4 font-bold">{{ $cat->name }}</td>
                    <td class="py-4 text-center flex justify-center gap-2">
                        <a href="{{ route('admin.category.edit', $cat->id) }}" class="text-blue-500 hover:bg-blue-50 px-3 py-1 rounded-lg font-bold text-xs uppercase">
                            Edit
                        </a>

                        <form action="{{ route('admin.category.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="button" 
                                    onclick="openDeleteModal('{{ route('admin.category.destroy', $cat->id) }}')" 
                                    class="text-red-500 hover:bg-red-50 px-3 py-1 rounded-lg font-bold text-xs uppercase">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="py-10 text-center text-gray-400 italic">Belum ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-3xl max-w-sm w-full p-8 shadow-2xl transform transition-all">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                    <i data-lucide="trash-2" class="text-red-600 h-8 w-8"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase">Hapus Kategori?</h3>
                <p class="text-sm text-gray-500 mt-2">
                    Tindakan ini tidak bisa dibatalkan. Data kategori akan hilang permanen.
                </p>
            </div>

            <div class="mt-8 flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition">
                    BATAL
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-3 bg-red-600 text-white rounded-xl font-black hover:bg-red-700 transition shadow-lg shadow-red-200">
                        YA, HAPUS
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function openDeleteModal(actionUrl) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        
        // Set action form secara dinamis
        form.action = actionUrl;
        
        // Tampilkan modal dengan menghapus class 'hidden'
        modal.classList.remove('hidden');
        // Tambahkan efek sedikit delay untuk transisi jika perlu
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
    }

    // Menutup modal jika user klik di luar area putih modal
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target == modal.querySelector('.bg-opacity-50')) {
            closeDeleteModal();
        }
    }
</script>
@endsection