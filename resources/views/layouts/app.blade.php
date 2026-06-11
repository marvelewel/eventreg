<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventReg - @yield('title', 'Sistem Pendaftaran Event')</title>
    
    <!-- Bootstrap Icons (Retained for Iconography) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js (Lightweight replacement for Bootstrap JS interactivity) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen font-sans bg-slate-50 text-slate-800 antialiased">

    @include('partials.navbar')

    <main class="flex-grow flex flex-col">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full flex-grow">
            
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex justify-between items-center shadow-sm">
                    <div class="flex items-center text-emerald-800">
                        <i class="bi bi-check-circle-fill me-2 text-lg"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-600 hover:text-emerald-800 transition-colors">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 flex justify-between items-center shadow-sm">
                    <div class="flex items-center text-red-800">
                        <i class="bi bi-exclamation-triangle-fill me-2 text-lg"></i>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="text-red-600 hover:text-red-800 transition-colors">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif

            @yield('content')
            
        </div>
    </main>

    <!-- Render Large Footer ONLY for public routes -->
    @if(!request()->is('admin*') && !request()->is('user*'))
        <footer class="bg-blue-900 text-white/80 py-12 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <div class="md:col-span-1">
                        <a href="{{ url('/') }}" class="flex items-center text-white font-bold text-2xl tracking-tight mb-4">
                            <i class="bi bi-calendar-event me-2"></i> EventReg
                        </a>
                        <p class="text-sm">Your Professional Ticketing Partner</p>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-4">Tentang Kami</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Tentang Kami</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Our Journey</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Hubungi Kami</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Biaya</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-4">Informasi</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Tiket Gelang</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-4">Kategori Event</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Musik</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Pameran</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Wahana</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Olahraga</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-white/20 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-xs font-medium mb-4 md:mb-0">&copy; {{ date('Y') }} EventReg by Christabel Arrowina. Hak Cipta Dilindungi.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white/80 hover:text-white"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="text-white/80 hover:text-white"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white/80 hover:text-white"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="text-white/80 hover:text-white"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    @else
        <!-- Mini Footer for Admin/User Dashboards -->
        <footer class="py-6 text-center text-sm text-slate-400 bg-slate-50 mt-auto border-t border-slate-200">
            &copy; {{ date('Y') }} EventReg by Christabel Arrowina. Hak Cipta Dilindungi.
        </footer>
    @endif

    <!-- Inline scripts for active state & confirmation -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Confirm delete
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if(!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>
