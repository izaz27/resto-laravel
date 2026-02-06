<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 10pt; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; background-color: #eee; }
    </style>
</head>
<body>
    <div class="text-center">
        <h2>LAPORAN PENDAPATAN HARIAN</h2>
        <p>Tanggal: {{ now()->format('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Order</th>
                <th>Meja</th>
                <th class="text-right">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>#{{ $order->order_code }}</td>
                <td class="text-center">{{ $order->table_numbers }}</td>
                <td class="text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="3" class="text-right">GRAND TOTAL</td>
                <td class="text-right">Rp {{ number_format($orders->sum('total_price'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>