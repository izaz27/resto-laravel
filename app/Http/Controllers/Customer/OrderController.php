<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class OrderController extends Controller
{
    public function process(Request $request)
    {
        $cart = session()->get('cart');
        $selectedTables = session()->get('selected_tables');

        if (!$cart || empty($cart)) {
            return redirect()->route('customer.menu.index')->with('error', 'Keranjang Anda kosong.');
        }

        if (!$selectedTables || empty($selectedTables)) {
            return redirect()->route('customer.cart.index')->with('error', 'Silakan pilih meja terlebih dahulu.');
        }

        try {
            DB::beginTransaction();

            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

            // SIMPAN KE TABEL ORDERS
            $order = Order::create([
                'order_code'     => 'ORD-' . strtoupper(uniqid()),
                'user_id'        => Auth::check() ? Auth::id() : null, // TAMBAHKAN INI: Isi ID jika login, null jika tamu
                'table_numbers'  => is_array($selectedTables) ? implode(', ', $selectedTables) : $selectedTables,
                'total_price'    => $total,
                'payment_method' => $request->payment_method,
                'status'         => 'pending',
            ]);

            // SIMPAN DETAIL PESANAN
            foreach ($cart as $id => $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    // Pastikan key 'id' atau 'menu_id' konsisten dengan apa yang Anda simpan di CartController
                    'menu_id'  => $item['id'] ?? $id, 
                    'qty'      => $item['qty'],
                    'price'    => $item['price'],
                    'note'     => $item['note'] ?? '-',
                ]);
            }

            DB::commit();

            session()->forget(['cart', 'selected_tables']);

            return redirect()->route('customer.order.success', $order->id)
                             ->with('success', 'Pesanan berhasil dikirim ke dapur!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Tampilkan pesan error yang lebih spesifik untuk debug
            return redirect()->back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $order = Order::with('details.menu')->findOrFail($id); 
        return view('customer.order_success', compact('order'));
    }
}