@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
    <h1 class="text-2xl font-black text-gray-800 uppercase mb-6">Tambah Menu Baru</h1>

    {{-- TAMBAHKAN BLOK INI UNTUK MELIHAT ERROR --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
            <p class="font-bold text-sm uppercase italic mb-1">Ada masalah pada inputanmu:</p>
            <ul class="list-disc list-inside text-xs font-bold">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Menu --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase italic">Nama Menu</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none" placeholder="Contoh: Ayam Geprek" required>
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase italic">Kategori</label>
                <select name="category_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Harga --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase italic">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none" placeholder="Contoh: 25000" required>
            </div>

            {{-- Foto Produk --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase italic">Foto Produk</label>
                <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100" required>
            </div>
        </div>

        <div class="mt-6">
            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase italic">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none" placeholder="Jelaskan detail menu...">{{ old('description') }}</textarea>
        </div>

        <div class="mt-8 flex gap-3">
            <button type="submit" class="flex-1 bg-red-600 text-white py-4 rounded-xl font-black hover:bg-red-700 transition tracking-widest uppercase">SIMPAN MENU</button>
            <a href="{{ route('admin.menu.index') }}" class="flex-1 bg-gray-100 text-center text-gray-600 py-4 rounded-xl font-black hover:bg-gray-200 transition tracking-widest uppercase">BATAL</a>
        </div>
    </form>
</div>
@endsection