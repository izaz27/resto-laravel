{{-- resources/views/layouts/customer.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restoran OOP | @yield('title', 'Beranda')</title>

    {{-- Memuat Tailwind CSS melalui Vite --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 font-sans antialiased">
    
    {{-- BAGIAN 1: NAVBAR (Jika suatu saat ingin diaktifkan kembali) --}}
    {{-- 
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
             <a href="/" class="text-xl font-bold">Resto YPKP</a>
        </nav>
    </header> 
    --}}

    {{-- BAGIAN 2: KONTEN UTAMA --}}
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    {{-- BAGIAN 3: FLOATING BUTTON (SUDAH DIHAPUS) --}}
    {{-- 
        Tombol keranjang melayang sebelumnya di sini telah dihapus 
        untuk menjaga kebersihan tampilan UI pada perangkat mobile.
    --}}

    {{-- BAGIAN 4: FOOTER --}}
    {{-- 
    <footer class="bg-gray-800 text-white mt-12 py-6">
        <div class="container mx-auto text-center text-sm">
            <p>&copy; {{ date('Y') }} Resto OOP. All rights reserved.</p>
        </div>
    </footer> 
    --}}

</body>
</html>