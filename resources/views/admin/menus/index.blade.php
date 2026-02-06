@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-black text-gray-800 uppercase italic tracking-tighter">Daftar Menu</h1>
            <p class="text-gray-400 text-xs uppercase">Kelola item makanan dan minuman</p>
        </div>
        <a href="{{ route('admin.menu.create') }}" class="bg-red-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-700 transition shadow-lg shadow-red-100 flex items-center gap-2">
            <span>+ TAMBAH MENU</span>
        </a>
    </div>

    {{-- Table Container --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-gray-400 text-[10px] uppercase tracking-[0.2em] border-b">
                    <th class="pb-4 font-black">Produk</th>
                    <th class="pb-4 font-black">Kategori</th>
                    <th class="pb-4 font-black">Harga</th>
                    <th class="pb-4 font-black text-center">Status</th>
                    <th class="pb-4 font-black text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse($menus as $menu)
                <tr class="border-b last:border-0 hover:bg-gray-50/50 transition">
                    {{-- Produk & Gambar --}}
                    <td class="py-4 flex items-center gap-4">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $menu->image_path) }}" class="w-14 h-14 object-cover rounded-2xl border shadow-sm" onerror="this.src='{{ asset('images/default-menu.jpg') }}'">
                        </div>
                        <div>
                            <p class="font-black text-gray-800 uppercase text-sm tracking-tight">{{ $menu->name }}</p>
                            <p class="text-[10px] text-gray-400 italic">{{ Str::limit($menu->description, 40) }}</p>
                        </div>
                    </td>

                    {{-- Kategori --}}
                    <td class="py-4">
                        <span class="bg-gray-100 px-3 py-1 rounded-lg text-[10px] font-black uppercase text-gray-500 tracking-wider">
                            {{ $menu->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>

                    {{-- Harga --}}
                    <td class="py-4 font-black text-red-600 text-sm">
                        Rp{{ number_format($menu->price, 0, ',', '.') }}
                    </td>

                    {{-- Status --}}
                    <td class="py-4 text-center">
                        @if($menu->is_available)
                            <span class="text-green-600 text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-1">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> TERSEDIA
                            </span>
                        @else
                            <span class="text-gray-300 text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-1">
                                <span class="w-1.5 h-1.5 bg-gray-300 rounded-full"></span> HABIS
                            </span>
                        @endif
                    </td>

                    {{-- Tombol Aksi --}}
                    <td class="py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm" title="Edit Menu">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                            <button type="button" onclick="openDeleteModal('{{ route('admin.menu.destroy', $menu->id) }}')" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm" title="Hapus Menu">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-20 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-4xl mb-2">🍽️</span>
                            <p class="text-gray-400 italic text-sm font-medium">Belum ada menu yang didaftarkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Custom Modal Delete --}}
@include('admin.components.modal-delete') 
@endsection