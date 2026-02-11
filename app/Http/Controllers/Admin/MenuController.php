<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')->latest()->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

            try {
            if (!$request->hasFile('image')) {
                return back()->with('error', 'File tidak ditemukan.');
            }

            $file = $request->file('image');
            
            // Versi ini lebih stabil untuk Laravel 11/12
            $upload = \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::uploadApi()->upload($file->getRealPath(), [
                'folder' => 'menus_resto'
            ]);

            // Mengambil URL dengan cara yang lebih aman dari hasil upload
            $path = $upload['secure_url'] ?? null;

            if (!$path) {
                return back()->with('error', 'Cloudinary gagal memberikan URL. Cek API Key di Vercel.');
            }

            \App\Models\Menu::create([
                'name' => $request->name,
                'slug' => \Illuminate\Support\Str::slug($request->name),
                'category_id' => $request->category_id,
                'price' => $request->price,
                'description' => $request->description,
                'image_path' => $path,
                'is_available' => true
            ]);

            return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            // Jika masih error, kita ingin tahu error aslinya dari Cloudinary itu apa
            return back()->withInput()->with('error', 'Masalah: ' . $e->getMessage());
        }
    }

    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_available' => 'required|boolean', 
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'is_available' => (bool) $request->is_available,
        ];

        if ($request->hasFile('image')) {
            try {
                // Hapus gambar lama jika gambar tersebut adalah file lokal (bukan URL Cloudinary)
                if ($menu->image_path && !filter_var($menu->image_path, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($menu->image_path);
                }
                
                // Upload gambar baru ke Cloudinary
                $upload = Cloudinary::upload($request->file('image')->getRealPath(), [
                    'folder' => 'menus_resto'
                ]);
                $data['image_path'] = $upload->getSecurePath();

            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal update gambar ke Cloudinary: ' . $e->getMessage());
            }
        }

        $menu->update($data);
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        // Jika gambarnya adalah file lokal, hapus dari storage lokal
        if ($menu->image_path && !filter_var($menu->image_path, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($menu->image_path);
        }
        
        // Catatan: Untuk menghapus file di Cloudinary lewat code perlu 'public_id'. 
        // Sementara ini kita hapus record database-nya saja agar aplikasi tidak error.

        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}