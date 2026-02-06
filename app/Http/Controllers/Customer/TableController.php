<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        // Anggap saja ada 10 meja tersedia
        $tables = range(1, 10); 
        return view('customer.pilih_meja', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_numbers' => 'required|array|min:1',
        ]);

        // Simpan array nomor meja ke session
        session(['selected_tables' => $request->table_numbers]);

        return redirect()->route('customer.menu.index');
    }
}
