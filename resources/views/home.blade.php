@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="mb-12 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden relative">
    <!-- Subtle background accent -->
    <div class="absolute inset-0 bg-slate-50/50"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-500/5 rounded-full blur-3xl"></div>
    
    <div class="relative px-6 py-16 md:py-24 text-center max-w-4xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">
            Platform Pendaftaran <br class="hidden md:block"> 
            <span class="text-indigo-600">Event Modern</span>
        </h1>
        <p class="text-lg text-slate-500 mb-10 max-w-2xl mx-auto leading-relaxed">
            Kelola dan temukan berbagai event terbaik dengan sistem yang mudah, cepat, dan terpercaya. Bergabunglah untuk mengembangkan potensimu.
        </p>
        <a href="{{ url('/events') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-colors duration-200">
            Jelajahi Event
            <i class="bi bi-arrow-right ml-2"></i>
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center transition-shadow hover:shadow-md">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-indigo-50 text-indigo-600 mb-6">
            <i class="bi bi-search text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-3">Cari Event</h3>
        <p class="text-sm text-slate-500 leading-relaxed">Temukan berbagai seminar, workshop, dan talkshow yang sesuai dengan minat Anda dengan sangat mudah.</p>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center transition-shadow hover:shadow-md">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-emerald-50 text-emerald-600 mb-6">
            <i class="bi bi-cursor text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-3">Daftar Cepat</h3>
        <p class="text-sm text-slate-500 leading-relaxed">Proses pendaftaran yang ringkas dan tidak ribet. Hanya dengan beberapa langkah sederhana, Anda sudah terdaftar.</p>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center transition-shadow hover:shadow-md">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-amber-50 text-amber-600 mb-6">
            <i class="bi bi-activity text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-3">Pantau Status</h3>
        <p class="text-sm text-slate-500 leading-relaxed">Pantau status pendaftaran Anda secara langsung dan real-time melalui dashboard interaktif.</p>
    </div>
</div>

<div class="text-center pt-12 border-t border-slate-200">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight mb-2">Event Terbaru</h2>
    <p class="text-slate-500 mb-8">Jangan lewatkan kesempatan untuk bergabung di event-event unggulan kami.</p>
    <a href="{{ url('/events') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-slate-300 text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 shadow-sm transition-colors duration-200">
        Lihat Semua Event
    </a>
</div>
@endsection
