<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Menu;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('customer.cart', compact('cart'));
    }

    public function add(Request $request, Menu $menu)
    {
        $qty = (int) $request->input('qty', 1);
        $note = $request->input('note', ''); 
        $cart = session()->get('cart', []);

        $cartId = $menu->id . '-' . Str::slug($note);

        if(isset($cart[$cartId])) {
            $cart[$cartId]['qty'] += $qty;
        } else {
            $cart[$cartId] = [
                "id" => $menu->id,
                "name" => $menu->name,
                "qty" => $qty,
                "price" => (int) $menu->price,
                "image_path" => $menu->image_path, // UBAH DARI "image" MENJADI "image_path"
                "note" => $note
            ];
        }

        session()->put('cart', $cart);

        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        return response()->json([
            'status' => 'success',
            'menuName' => $menu->name,
            'cartCount' => count($cart),
            'totalPrice' => number_format($totalPrice, 0, ',', '.')
        ]);
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            if($request->action == 'increase') {
                $cart[$id]['qty']++;
            } elseif($request->action == 'decrease' && $cart[$id]['qty'] > 1) {
                $cart[$id]['qty']--;
            }
            session()->put('cart', $cart);

            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

            return response()->json([
                'status' => 'success',
                'newQty' => $cart[$id]['qty'],
                'subtotal' => number_format($cart[$id]['price'] * $cart[$id]['qty'], 0, ',', '.'),
                'cartTotal' => number_format($total, 0, ',', '.')
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Item tidak ditemukan'], 404);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('customer.cart.index')->with('success', 'Menu dihapus dari keranjang');
    }
}