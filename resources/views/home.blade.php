@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="bg-blue-900 rounded-3xl mx-4 mt-4 p-10 md:p-20 text-center text-white relative overflow-hidden mb-16">
    <div class="absolute inset-0 bg-[radial-gradient(#ffffff33_1px,transparent_1px)] [background-size:16px_16px] opacity-20"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
    
    <div class="relative z-10 max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight text-white">
            Platform Pendaftaran <br class="hidden md:block"> Event Modern
        </h1>
        <p class="text-lg md:text-xl text-white/80 mb-10 max-w-2xl mx-auto">
            Kelola dan temukan berbagai event terbaik dengan sistem yang mudah, cepat, dan terpercaya. Bergabunglah untuk mengembangkan potensimu.
        </p>
        <a href="{{ url('/events') }}" class="inline-flex items-center justify-center px-8 py-3 rounded-full text-lg font-bold text-blue-900 bg-white hover:bg-slate-100 shadow-sm transition-transform hover:scale-105">
            Jelajahi Event
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-slate-300">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-indigo-50 text-indigo-600 mb-6">
            <i class="bi bi-search text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-3">Cari Event</h3>
        <p class="text-sm text-slate-500 leading-relaxed">Temukan berbagai seminar, workshop, dan talkshow yang sesuai dengan minat Anda dengan sangat mudah.</p>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-slate-300">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-emerald-50 text-emerald-600 mb-6">
            <i class="bi bi-cursor text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-3">Daftar Cepat</h3>
        <p class="text-sm text-slate-500 leading-relaxed">Proses pendaftaran yang ringkas dan tidak ribet. Hanya dengan beberapa langkah sederhana, Anda sudah terdaftar.</p>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-slate-300">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-amber-50 text-amber-600 mb-6">
            <i class="bi bi-activity text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-3">Pantau Status</h3>
        <p class="text-sm text-slate-500 leading-relaxed">Pantau status pendaftaran Anda secara langsung dan real-time melalui dashboard interaktif.</p>
    </div>
</div>

<div class="pt-12 border-t border-slate-200">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight mb-2">Event Terbaru</h2>
        <p class="text-slate-500">Jangan lewatkan kesempatan untuk bergabung di event-event unggulan kami.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @foreach($latestEvents as $event)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-slate-300">
                <img src="{{ $event->poster && Str::startsWith($event->poster, 'http') ? $event->poster : ($event->poster ? Storage::url($event->poster) : '') }}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                
                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="text-lg font-bold text-slate-900 line-clamp-2">{{ $event->title }}</h3>
                    <div class="flex items-center gap-2 text-sm text-slate-500 mt-2">
                        <i class="bi bi-calendar4"></i> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-500 mt-1">
                        <i class="bi bi-geo-alt"></i> {{ $event->location }}
                    </div>
                    
                    <hr class="my-3 border-slate-100">
                    
                    <div class="mt-2 mb-3">
                        @if($event->price == 0)
                            <span class="text-lg font-bold text-emerald-600">Gratis</span>
                        @else
                            <span class="text-lg font-bold text-slate-800">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                        @endif
                    </div>
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
        @endforeach
    </div>

    <div class="text-center">
        <a href="{{ url('/events') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-slate-300 text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 shadow-sm transition-colors duration-200">
            Lihat Semua Event
        </a>
    </div>
</div>
@endsection
