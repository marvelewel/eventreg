<nav x-data="{ isOpen: false }" class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side: Logo & Desktop Links -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center text-slate-900 font-bold text-xl tracking-tight">
                    <i class="bi bi-calendar-event me-2 text-slate-800"></i> EventReg
                </a>
                
                <!-- Desktop Nav Links -->
                <div class="hidden md:ml-10 md:flex md:space-x-8">
                    <a href="{{ url('/') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-900 hover:border-slate-300 transition-colors {{ request()->is('/') ? 'border-slate-900 text-slate-900' : '' }}">Home</a>
                    <a href="{{ url('/events') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-900 hover:border-slate-300 transition-colors {{ request()->is('events*') ? 'border-slate-900 text-slate-900' : '' }}">Events</a>
                    <a href="{{ url('/about') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-900 hover:border-slate-300 transition-colors {{ request()->is('about') ? 'border-slate-900 text-slate-900' : '' }}">About</a>
                </div>
            </div>

            <!-- Right side: Actions -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                
                <!-- Demo Roles Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.outside="open = false" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-amber-600 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 focus:outline-none transition-colors">
                        <i class="bi bi-tools mr-2"></i> Demo Roles
                        <i class="bi bi-chevron-down ml-2 text-xs"></i>
                    </button>
                    <div x-show="open" style="display: none;" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-slate-100 focus:outline-none">
                        <div class="py-1">
                            <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Admin Dashboard</a>
                            <a href="{{ url('/user/dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">User Dashboard</a>
                        </div>
                    </div>
                </div>

                <div class="h-6 w-px bg-slate-200"></div>

                <a href="{{ url('/login') }}" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">Login</a>
                <a href="{{ url('/register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 transition-colors">Register</a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="isOpen = !isOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-slate-500">
                    <span class="sr-only">Open main menu</span>
                    <i class="bi bi-list text-2xl" x-show="!isOpen"></i>
                    <i class="bi bi-x-lg text-xl" x-show="isOpen" style="display: none;"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="isOpen" style="display: none;" class="md:hidden border-t border-slate-200 bg-white">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ url('/') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-slate-600 hover:bg-slate-50 hover:border-slate-300 hover:text-slate-800">Home</a>
            <a href="{{ url('/events') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-slate-600 hover:bg-slate-50 hover:border-slate-300 hover:text-slate-800">Events</a>
            <a href="{{ url('/about') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-slate-600 hover:bg-slate-50 hover:border-slate-300 hover:text-slate-800">About</a>
        </div>
        <div class="pt-4 pb-3 border-t border-slate-200">
            <div class="px-4 mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Demo Roles</div>
            <div class="space-y-1">
                <a href="{{ url('/admin/dashboard') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50">Admin Dashboard</a>
                <a href="{{ url('/user/dashboard') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50">User Dashboard</a>
            </div>
        </div>
        <div class="pt-4 pb-3 border-t border-slate-200">
            <div class="flex items-center px-4 space-x-3">
                <a href="{{ url('/login') }}" class="block w-full text-center px-4 py-2 border border-slate-300 rounded-md shadow-sm text-base font-medium text-slate-700 bg-white hover:bg-slate-50">Login</a>
                <a href="{{ url('/register') }}" class="block w-full text-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-slate-900 hover:bg-slate-800">Register</a>
            </div>
        </div>
    </div>
</nav>
