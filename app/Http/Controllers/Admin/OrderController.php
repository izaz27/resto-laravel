<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        // Eager loading details dan menu untuk optimasi query
        $orders = Order::with(['details.menu'])->latest()->get();
        
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        // Load relasi agar data detail dan menu tersedia
        $order->load(['details.menu']);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Memperbarui status pesanan (misal: dari pending ke processing).
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        // Mengarahkan kembali dengan data session 'status_updated'
        return redirect()->back()->with('status_updated', $request->status);
    }

    public function destroy(Order $order)
    {
        // Detail pesanan akan otomatis terhapus jika Anda menggunakan 'onDelete cascade' di migration
        // Jika tidak, kita hapus manual detailnya terlebih dahulu
        $order->details()->delete();
        $order->delete();

        return redirect()->route('admin.order.index')->with('success', 'History pesanan berhasil dihapus.');
    }

    public function clearHistory()
    {
        // Menghapus pesanan yang statusnya 'completed' atau 'cancelled'
        $orders = Order::whereIn('status', ['completed', 'cancelled'])->get();
        
        foreach($orders as $order) {
            $order->details()->delete();
            $order->delete();
        }

        return redirect()->route('admin.order.index')->with('success', 'Semua riwayat pesanan selesai/batal telah dibersihkan.');
    }
}