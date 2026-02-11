@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
    <h1 class="text-2xl font-black text-gray-800 uppercase mb-6 italic tracking-tighter">Edit Menu: {{ $menu->name }}</h1>

    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                {{-- Nama & Kategori --}}
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase mb-2 tracking-widest">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $menu->name) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none font-bold" required>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase mb-2 tracking-widest">Kategori</label>
                    <select name="category_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $menu->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase mb-2 tracking-widest">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $menu->price) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none font-bold" required>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase mb-2 tracking-widest">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none text-sm">{{ old('description', $menu->description) }}</textarea>
                </div>
            </div>

            <div class="space-y-6">
                {{-- Foto Produk dengan Preview --}}
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase mb-2 tracking-widest">Foto Produk</label>
                    <div class="relative group w-full h-56 mb-4 overflow-hidden rounded-2xl border-2 border-dashed border-gray-200 flex items-center justify-center bg-gray-50">
                        <img id="preview-img" 
                        src="{{ $menu->image_path ? $menu->image_path : asset('images/default-menu.jpg') }}" 
                        class="w-full h-full object-cover transition duration-300 group-hover:opacity-75"
                        onerror="this.src='{{ asset('images/default-menu.jpg') }}'">
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                             <span class="bg-black/50 text-white text-[10px] px-3 py-1 rounded-full font-bold uppercase">Ganti Foto</span>
                        </div>
                    </div>
                    
                    <input type="file" name="image" id="image-input" accept="image/png, image/jpeg, image/jpg"
                           class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:bg-red-50 file:text-red-700 file:border-0 font-bold cursor-pointer">
                    <p class="text-[10px] text-gray-400 mt-2 font-medium">*Format: JPG, JPEG, atau PNG. Kosongkan jika tidak ganti.</p>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase mb-2 tracking-widest">Status Stok</label>
                    <div class="flex gap-4">
                        <label class="flex-1 flex items-center justify-center gap-2 cursor-pointer border py-3 rounded-xl transition has-[:checked]:bg-red-50 has-[:checked]:border-red-500">
                            <input type="radio" name="is_available" value="1" {{ $menu->is_available ? 'checked' : '' }} class="hidden">
                            <span class="text-xs font-black uppercase tracking-widest text-gray-600">Tersedia</span>
                        </label>
                        <label class="flex-1 flex items-center justify-center gap-2 cursor-pointer border py-3 rounded-xl transition has-[:checked]:bg-gray-100 has-[:checked]:border-gray-400">
                            <input type="radio" name="is_available" value="0" {{ !$menu->is_available ? 'checked' : '' }} class="hidden">
                            <span class="text-xs font-black uppercase tracking-widest text-gray-400">Habis</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10 flex gap-4">
            <button type="submit" class="flex-1 bg-gray-900 text-white py-4 rounded-2xl font-black hover:bg-black transition tracking-[0.2em] shadow-xl shadow-gray-200 uppercase text-sm">
                SIMPAN PERUBAHAN
            </button>
            <a href="{{ route('admin.menu.index') }}" class="px-8 bg-gray-100 text-gray-500 py-4 rounded-2xl font-black hover:bg-gray-200 transition uppercase text-sm tracking-widest">
                BATAL
            </a>
        </div>
    </form>
</div>

<<script>
    // Script untuk Preview Gambar Spontan
    const imageInput = document.getElementById('image-input');
    const previewImg = document.getElementById('preview-img');

    if (imageInput && previewImg) {
        imageInput.onchange = function (evt) {
            const [file] = this.files;
            if (file) {
                // Membuat URL sementara agar user bisa melihat gambar sebelum di-upload
                previewImg.src = URL.createObjectURL(file);
            }
        };
    }
</script>
@endsection