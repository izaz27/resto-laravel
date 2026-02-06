<?php

namespace App\Repositories;

use App\Interfaces\MenuRepositoryInterface;
use App\Models\Menu; // Perlu Model Menu
use Illuminate\Support\Str; // Perlu Str untuk slug (di create/update)

class MenuRepository implements MenuRepositoryInterface
{
    // READ: Ambil semua menu dengan relasi kategori
    public function getAllMenus()
    {
        return Menu::orderBy('id', 'asc')->with('category')->get();
    }

    // READ: Ambil menu berdasarkan ID
    public function getMenuById($menuId)
    {
        return Menu::findOrFail($menuId);
    }

    // CREATE
    public function createMenu(array $menuDetails)
    {
        // Menyimpan data
        return Menu::create($menuDetails); 
    }

    // UPDATE
    public function updateMenu($menuId, array $newDetails)
    {
        // Temukan dan perbarui data berdasarkan ID
        return Menu::whereId($menuId)->update($newDetails);
    }

    // DELETE
    public function deleteMenu($menuId)
    {
        // Hapus menu berdasarkan ID
        return Menu::destroy($menuId); 
    }
}