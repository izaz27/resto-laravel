<?php

namespace App\Interfaces;

use App\Models\Menu;

interface MenuRepositoryInterface
{
    // READ
    public function getAllMenus();
    public function getMenuById($menuId);
    
    // CREATE
    public function createMenu(array $menuDetails);
    
    // UPDATE
    public function updateMenu($menuId, array $newDetails);
    
    // DELETE
    public function deleteMenu($menuId);
}