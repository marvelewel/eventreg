<nav x-data="{ isOpen: false }" class="sticky top-0 z-50 bg-blue-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left side: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="flex items-center text-white font-bold text-xl tracking-tight">
                    <i class="bi bi-calendar-event me-2 text-white"></i> EventReg
                </a>
            </div>
            
            <!-- Center: Desktop Nav Links -->
            <div class="hidden md:flex md:space-x-8">
                <a href="{{ url('/') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-white/80 hover:text-white hover:border-white transition-colors {{ request()->is('/') ? 'border-white text-white' : '' }}">Beranda</a>
                <a href="{{ url('/events') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-white/80 hover:text-white hover:border-white transition-colors {{ request()->is('events*') ? 'border-white text-white' : '' }}">Jelajah</a>
                <a href="{{ url('/about') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-white/80 hover:text-white hover:border-white transition-colors {{ request()->is('about') ? 'border-white text-white' : '' }}">Tentang</a>
            </div>

            <!-- Right side: Actions -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                @auth
                    <!-- Authenticated User Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false" type="button" class="inline-flex items-center px-3 py-2 border border-white/20 text-sm font-medium rounded-full text-white hover:bg-blue-800 focus:outline-none transition-colors">
                            <i class="bi bi-person-circle mr-2"></i> {{ Auth::user()->name }}
                            <i class="bi bi-chevron-down ml-2 text-xs"></i>
                        </button>
                        <div x-show="open" style="display: none;" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-slate-100 focus:outline-none z-50">
                            <div class="py-1">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                        <i class="bi bi-speedometer2 mr-2"></i> Dashboard Admin
                                    </a>
                                    <a href="{{ route('admin.registrations.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                        <i class="bi bi-card-checklist mr-2"></i> Kelola Pendaftaran
                                    </a>
                                @else
                                    <a href="{{ url('/user/dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                        <i class="bi bi-speedometer2 mr-2"></i> Dashboard
                                    </a>
                                @endif
                            </div>
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="bi bi-box-arrow-right mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-white/80 hover:text-white transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-full shadow-sm text-sm font-bold text-blue-900 bg-white hover:bg-slate-100 transition-colors">Daftar</a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="isOpen = !isOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white/80 hover:text-white hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Open main menu</span>
                    <i class="bi bi-list text-2xl" x-show="!isOpen"></i>
                    <i class="bi bi-x-lg text-xl" x-show="isOpen" style="display: none;"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="isOpen" style="display: none;" class="md:hidden border-t border-white/20 bg-blue-900">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ url('/') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white/80 hover:bg-blue-800 hover:border-white hover:text-white">Beranda</a>
            <a href="{{ url('/events') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white/80 hover:bg-blue-800 hover:border-white hover:text-white">Jelajah</a>
            <a href="{{ url('/about') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white/80 hover:bg-blue-800 hover:border-white hover:text-white">Tentang</a>
        </div>
        @auth
            <div class="pt-4 pb-3 border-t border-white/20">
                <div class="flex items-center px-4 mb-3">
                    <div class="flex-shrink-0">
                        <i class="bi bi-person-circle text-2xl text-white/80"></i>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-white/60">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="space-y-1">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-white/80 hover:text-white hover:bg-blue-800">Dashboard Admin</a>
                        <a href="{{ route('admin.registrations.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-white/80 hover:text-white hover:bg-blue-800">Kelola Pendaftaran</a>
                    @else
                        <a href="{{ url('/user/dashboard') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-white/80 hover:text-white hover:bg-blue-800">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left pl-3 pr-4 py-2 text-base font-medium text-red-300 hover:text-white hover:bg-blue-800">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-white/20">
                <div class="flex items-center px-4 space-x-3">
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 border border-white/20 rounded-full shadow-sm text-base font-medium text-white hover:bg-blue-800">Masuk</a>
                    <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2 border border-transparent rounded-full shadow-sm text-base font-medium text-blue-900 bg-white hover:bg-slate-100">Daftar</a>
                </div>
            </div>
        @endauth
    </div>
</nav>
