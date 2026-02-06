
@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
    <h1 class="text-2xl font-black text-gray-800 uppercase mb-6">Edit Kategori</h1>

    <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-tighter">Nama Kategori</label>
            <input type="text" name="name" value="{{ $category->name }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="flex-1 bg-gray-800 text-white py-3 rounded-xl font-black hover:bg-black transition">UPDATE</button>
            <a href="{{ route('admin.category.index') }}" class="flex-1 bg-gray-100 text-center text-gray-600 py-3 rounded-xl font-black hover:bg-gray-200 transition">BATAL</a>
        </div>
    </form>
</div>
@endsection