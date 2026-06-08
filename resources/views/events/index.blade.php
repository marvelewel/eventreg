@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Daftar Event</h2>
        <p class="text-sm text-slate-500 mt-1">Temukan event yang sesuai dengan minat Anda.</p>
    </div>
    
    <!-- Minimalist Search Bar -->
    <div class="relative w-full md:w-80">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="bi bi-search text-slate-400"></i>
        </div>
        <input type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" placeholder="Cari event...">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    @forelse($events ?? [] as $event)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col transition-shadow hover:shadow-md">
            <div class="p-6 flex flex-col flex-grow">
                
                <div class="flex justify-between items-start mb-4">
                    @if($event['status'] == 'published')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                            Tersedia
                        </span>
                    @elseif($event['status'] == 'draft')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 ring-1 ring-inset ring-slate-500/20">
                            Draft
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10">
                            Selesai
                        </span>
                    @endif
                </div>
                
                <h3 class="text-lg font-bold text-slate-900 mb-2 leading-tight">{{ $event['title'] }}</h3>
                <p class="text-sm text-slate-500 mb-6 flex-grow line-clamp-3">
                    {{ Str::limit($event['description'], 110) }}
                </p>
                
                <div class="space-y-3 mb-6">
                    <div class="flex items-center text-sm text-slate-600">
                        <i class="bi bi-calendar4 text-slate-400 mr-3"></i>
                        <span>{{ \Carbon\Carbon::parse($event['date'])->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center text-sm text-slate-600">
                        <i class="bi bi-geo-alt text-slate-400 mr-3"></i>
                        <span>{{ $event['location'] }}</span>
                    </div>
                    <div class="flex items-center text-sm text-slate-600">
                        <i class="bi bi-people text-slate-400 mr-3"></i>
                        <span>Kuota: <span class="font-medium text-slate-900">{{ $event['registered_count'] }}</span> / {{ $event['quota'] }}</span>
                    </div>
                </div>
                
                <div class="mt-auto pt-4 border-t border-slate-100">
                    <a href="{{ url('/events/' . $event['id']) }}" class="flex justify-center w-full px-4 py-2 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-colors">
                        Lihat Detail
                    </a>
                </div>
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

<!-- Modernized Pagination -->
@if(count($events ?? []) > 0)
<div class="flex justify-center mt-8">
    <nav class="inline-flex rounded-md shadow-sm isolate space-x-2" aria-label="Pagination">
        <a href="#" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 cursor-not-allowed">
            <i class="bi bi-chevron-left"></i>
        </a>
        <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-slate-900 rounded-lg hover:bg-slate-800 focus:z-20">1</a>
        <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:z-20">2</a>
        <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:z-20">3</a>
        <a href="#" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:z-20">
            <i class="bi bi-chevron-right"></i>
        </a>
    </nav>
</div>
@endif

@endsection
