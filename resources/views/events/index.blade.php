@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Daftar Event</h2>
        <p class="text-sm text-slate-500 mt-1">Temukan event yang sesuai dengan minat Anda.</p>
    </div>
    
    <!-- Search Bar -->
    <form action="{{ route('events.index') }}" method="GET" class="relative w-full md:w-80">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="bi bi-search text-slate-400"></i>
        </div>
        <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" placeholder="Cari event...">
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    @forelse($events as $event)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-slate-300">
            <img src="{{ $event->poster && Str::startsWith($event->poster, 'http') ? $event->poster : ($event->poster ? Storage::url($event->poster) : '') }}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
            
            <div class="p-5 flex-1 flex flex-col">
                <h3 class="text-lg font-bold text-slate-900 line-clamp-2">{{ $event->title }}</h3>
                <div class="flex items-center gap-2 text-sm text-slate-500 mt-2">
                    <i class="bi bi-calendar4"></i>
                    <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-slate-500 mt-1">
                    <i class="bi bi-geo-alt"></i>
                    <span class="truncate">{{ $event->location }}</span>
                </div>
                
                <hr class="my-3 border-slate-100">
                
                <div class="mt-auto flex items-center justify-between">
                    <div class="text-xs text-slate-500">
                        <span class="block font-bold text-slate-800">KUOTA</span>
                        {{ $event->quota }} Orang
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $event->status === 'available' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>

                <a href="{{ route('events.show', $event->id) }}" class="mt-4 block w-full text-center px-4 py-2 text-sm font-medium text-white bg-slate-900 rounded-lg hover:bg-slate-800 transition-colors duration-200">
                    Lihat Detail
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-full">
            <div class="text-center py-16 bg-white rounded-2xl border border-slate-200 shadow-sm">
                <i class="bi bi-calendar-x text-5xl text-slate-300 mb-4 block"></i>
                <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Event</h3>
                <p class="text-slate-500 text-sm">Maaf, belum ada event yang tersedia saat ini.</p>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $events->links() }}
</div>

@endsection
