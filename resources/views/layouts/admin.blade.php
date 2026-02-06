<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Resto</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <div class="w-64 bg-white border-r border-gray-100 p-6 flex flex-col">
            <h1 class="text-xl font-black text-red-600 mb-10 tracking-tighter italic">RESTO<span class="text-gray-800 underline">ADMIN</span></h1>
            
            <nav class="space-y-2 flex-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 rounded-xl {{ request()->is('admin/dashboard') ? 'bg-red-50 text-red-600 font-bold' : 'text-gray-500 hover:bg-gray-50' }}">
                    <i data-lucide="layout-dashboard"></i> Dashboard
                </a>
                
                <a href="{{ route('admin.menu.index') }}" class="flex items-center gap-3 p-3 rounded-xl {{ request()->routeIs('admin.menu.*') ? 'bg-red-50 text-red-600 font-bold' : 'text-gray-500 hover:bg-gray-50' }}">
                    <i data-lucide="utensils"></i> Kelola Menu
                </a>
                
                <a href="{{ route('admin.category.index') }}" class="flex items-center gap-3 p-3 rounded-xl {{ request()->routeIs('admin.category.*') ? 'bg-red-50 text-red-600 font-bold' : 'text-gray-500 hover:bg-gray-50' }}">
                    <i data-lucide="layers"></i> Kategori
                </a>
                
                <a href="{{ route('admin.order.index') }}" class="flex items-center gap-3 p-3 rounded-xl {{ request()->routeIs('admin.order.*') ? 'bg-red-50 text-red-600 font-bold' : 'text-gray-500 hover:bg-gray-50' }}">
                    <i data-lucide="shopping-cart"></i> Pesanan
                </a>

                {{-- NAVIGASI BARU: LAPORAN --}}
                <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.laporan.*') ? 'bg-red-50 text-red-600 font-black' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-sm">Laporan</span>
                </a>
            </nav>

            <form action="{{ route('logout') }}" method="POST" class="pt-4 border-t border-gray-100">
                @csrf
                <button class="flex items-center gap-3 p-3 w-full text-left text-gray-400 hover:text-red-600 transition">
                    <i data-lucide="log-out"></i> Keluar
                </button>
            </form>
        </div>

        <main class="flex-1 p-10">
            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons(); // Inisialisasi ikon Lucide
    </script>
</body>
</html>