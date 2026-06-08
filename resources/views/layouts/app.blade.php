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

    <footer class="bg-white border-t border-slate-200 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-slate-500 text-sm font-medium mb-1">&copy; {{ date('Y') }} EventReg by Marvel Jeremia. All rights reserved.</p>
            <p class="text-slate-400 text-xs">Final Project Pemrograman Web</p>
        </div>
    </footer>

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
