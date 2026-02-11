<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Str;
use Cloudinary\Cloudinary;

class MenuController extends Controller
{
    // Konfigurasi Cloudinary Manual agar aman di Vercel
    private function getCloudinary()
    {
        return new Cloudinary([
            'cloud' => [
                'cloud_name' => 'dksbtxo4b',
                'api_key'    => '417616867997447',
                'api_secret' => 'fddU0eCPMni8FgtZMAfUzf8ijWg',
            ],
        ]);
    }

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
            $cloudinary = $this->getCloudinary();

            // Upload ke Cloudinary
            $upload = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                'folder' => 'menus_resto'
            ]);

            // Ambil URL aman (secure_url)
            $path = $upload['secure_url'];

            Menu::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'category_id' => $request->category_id,
                'price' => $request->price,
                'description' => $request->description,
                'image_path' => $path,
                'is_available' => true
            ]);

            return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal Simpan: ' . $e->getMessage());
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
            'is_available' => 'required', 
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
                $file = $request->file('image');
                $cloudinary = $this->getCloudinary();

                $upload = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                    'folder' => 'menus_resto'
                ]);

                $data['image_path'] = $upload['secure_url'];

            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal update gambar: ' . $e->getMessage());
            }
        }

        $menu->update($data);
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        // Langsung hapus dari database
        // Catatan: Menghapus di Cloudinary butuh public_id, 
        // untuk saat ini kita hapus record DB agar aplikasi lancar dulu.
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}