<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with(['details.menu']) // Pastikan relasi ini dipanggil
                    ->whereDate('created_at', now()->today())
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('kasir.dashboard', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status // Akan menerima 'completed' dari hidden input
        ]);

        return redirect()->back()->with('success', 'Pesanan #' . $order->order_code . ' telah selesai!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // Hapus detail pesanan terlebih dahulu jika tidak menggunakan cascade delete di database
        $order->details()->delete(); 
        $order->delete();

        return redirect()->back()->with('success', 'Pesanan telah berhasil dibatalkan/dihapus.');
    }

    public function cetakStruk($id)
    {
        $order = Order::with('details.menu')->findOrFail($id);
        $pdf = Pdf::loadView('kasir.struk_pdf', compact('order'));

        // Trik: Set lebar 58mm (164.4pt), tinggi cukup diisi angka kecil atau biarkan auto
        // DomPDF akan mencoba menyesuaikan tinggi jika kita menggunakan CSS 'size: 58mm auto'
        $pdf->setPaper([0, 0, 164.4, 500], 'portrait'); 

        return $pdf->stream('Struk-' . $order->order_code . '.pdf');
    }  
    
    public function indexLaporan()
    {
        // Mengambil data pesanan yang statusnya 'completed' pada hari ini
        $orders = Order::whereDate('created_at', today())
                    ->where('status', 'completed')
                    ->get();

        // Pastikan path file view sesuai: resources/views/admin/laporan/laporan_pendapatan.blade.php
        return view('admin.laporan.laporan_pendapatan', compact('orders'));
    }

    public function eksporLaporan()
    {
        // 1. Ambil data pesanan yang 'completed' hari ini
        $orders = Order::whereDate('created_at', today())
                    ->where('status', 'completed')
                    ->get();

        // 2. Validasi jika data kosong
        if($orders->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data untuk diekspor.');
        }

        // 3. Load view PDF yang sudah kita buat sebelumnya
        // Pastikan file ini ada di: resources/views/admin/laporan/laporan_pendapatan_pdf.blade.php
        $pdf = Pdf::loadView('admin.laporan.laporan_pendapatan_pdf', compact('orders'));
        
        // 4. Set ukuran kertas (A4 untuk laporan)
        $pdf->setPaper('a4', 'portrait');

        // 5. Download file dengan nama yang rapi
        return $pdf->download('Laporan-Pendapatan-' . now()->format('Y-m-d') . '.pdf');
    }
}