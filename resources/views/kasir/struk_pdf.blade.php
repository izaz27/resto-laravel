<!DOCTYPE html>
<html>
<head>
    <style>
        /* Mengatur ukuran kertas (Contoh 58mm) */
       @page { 
        margin: 0px; 
        /* Gunakan lebar tetap, tapi biarkan dompdf menentukan tinggi */
        size: 58mm auto; 
        }
        html, body {
            margin: 0;
            padding: 0;
        }
        body { 
        font-family: 'Courier', monospace;
        font-size: 8pt; /* Sedikit diperkecil agar pas di kertas 58mm */
        margin: 4mm; /* Memberi jarak aman agar teks tidak terpotong printer */
        width: 50mm; /* Lebar konten sedikit di bawah lebar kertas */
        }
        .header, .footer { text-align: center; margin-bottom: 5px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        .line { border-top: 1px dashed #000; margin: 5px 0; }
        .table { width: 100%; }
        .text-right { text-align: right; }
        .item-name { font-weight: bold; display: block; }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <h2>Resto YPKP</h2>
        <p>Jl. Khp Hasan Mustopa No.68, Cikutra, Kec. Cibeunying Kidul, Kota Bandung, Jawa Barat 40124
    </div>

    <div class="line"></div>
    <p>ID: #{{ $order->order_code }}<br>Meja: {{ $order->table_numbers }}<br>{{ $order->created_at->format('d/m/Y H:i') }}</p>
    <div class="line"></div>

    {{-- Content/Items --}}
    <table class="table">
        @foreach($order->details as $detail)
        <tr>
            <td colspan="2">
                <span class="item-name">{{ $detail->menu->name }}</span>
                {{ $detail->qty }} x {{ number_format($detail->price) }}
            </td>
            <td class="text-right">{{ number_format($detail->price * $detail->qty) }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    {{-- Total --}}
    <table class="table">
        <tr>
            <td><strong>TOTAL</strong></td>
            <td class="text-right"><strong>Rp {{ number_format($order->total_price) }}</strong></td>
        </tr>
    </table>

    <div class="line"></div>

    {{-- Footer --}}
    <div class="footer">
        <p>Terima Kasih Atas Kunjungannya!<br>Barang yang sudah dibeli tidak dapat ditukar.</p>
    </div>
</body>
</html>