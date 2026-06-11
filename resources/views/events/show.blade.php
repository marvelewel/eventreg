@extends('layouts.app')

@section('title', $event->title . ' - Detail Event')

@section('content')
<div class="mb-6">
    <a href="{{ route('events.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">
        <i class="bi bi-arrow-left mr-2"></i> Kembali ke Daftar Event
    </a>
</div>



<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            {{-- Poster Image --}}
            @if($event->poster)
                <img src="{{ Str::startsWith($event->poster, 'http') ? $event->poster : Storage::url($event->poster) }}" alt="{{ $event->title }}" class="w-full h-64 md:h-80 object-cover">
            @endif

            <div class="p-6 md:p-8">
                
                <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-slate-900">{{ $event->title }}</h2>
                    <div>
                        @if($event->status === 'available')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Tersedia</span>
                        @elseif($event->status === 'full')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20">Kuota Penuh</span>
                        @elseif($event->status === 'finished')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 ring-1 ring-inset ring-slate-500/20">Selesai</span>
                        @elseif($event->status === 'cancelled')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10">Dibatalkan</span>
                        @endif
                    </div>
                </div>
                
                <hr class="border-slate-200 my-6">
                
                <h3 class="text-lg font-bold text-slate-900 mb-4">Deskripsi Event</h3>
                <div class="prose prose-slate max-w-none text-slate-600 text-sm leading-relaxed mb-8">
                    <p>{{ $event->description }}</p>
                </div>
                
                <h3 class="text-lg font-bold text-slate-900 mb-5">Informasi Pelaksanaan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 mr-4">
                            <i class="bi bi-calendar4 text-slate-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Tanggal</p>
                            <p class="text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 mr-4">
                            <i class="bi bi-geo-alt text-slate-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Lokasi</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden sticky top-24">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-900 text-center">Pendaftaran</h3>
            </div>
            
            <div class="p-6">
                <dl class="space-y-4 mb-6">
                    <div class="flex justify-between items-center">
                        <dt class="text-sm font-medium text-slate-500">Status</dt>
                        <dd class="text-sm font-bold {{ $event->status === 'available' ? 'text-emerald-600' : 'text-red-600' }}">
                            @if($event->status === 'available') Tersedia
                            @elseif($event->status === 'full') Kuota Penuh
                            @elseif($event->status === 'finished') Selesai
                            @elseif($event->status === 'cancelled') Dibatalkan
                            @endif
                        </dd>
                    </div>
                    <div class="flex justify-between items-center">
                        <dt class="text-sm font-medium text-slate-500">Kuota Tersedia</dt>
                        <dd class="text-sm font-bold text-slate-900">{{ max(0, $event->quota - $registeredCount) }} Orang</dd>
                    </div>
                    <div class="flex justify-between items-center">
                        <dt class="text-sm font-medium text-slate-500">Biaya Pendaftaran</dt>
                        <dd class="text-sm font-bold {{ $event->price == 0 ? 'text-emerald-600' : 'text-slate-900' }}">
                            {{ $event->price == 0 ? 'Gratis' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                        </dd>
                    </div>
                    <div class="flex justify-between items-center">
                        <dt class="text-sm font-medium text-slate-500">Pendaftar</dt>
                        <dd class="text-sm font-bold text-slate-900">{{ $registeredCount }} / {{ $event->quota }}</dd>
                    </div>
                </dl>
                
                {{-- Progress bar for quota --}}
                @php $percentage = $event->quota > 0 ? ($registeredCount / $event->quota) * 100 : 0; @endphp
                <div class="w-full bg-slate-100 rounded-full h-1.5 mb-6 overflow-hidden">
                    <div class="{{ $percentage >= 100 ? 'bg-red-500' : 'bg-slate-800' }} h-1.5 rounded-full transition-all duration-500" style="width: {{ min($percentage, 100) }}%"></div>
                </div>
                
                {{-- Registration Button Logic --}}
                @auth
                    @if(auth()->user()->role === 'admin')
                        {{-- Admin cannot register --}}
                        <button type="button" disabled
                            class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium bg-slate-100 text-slate-500 cursor-not-allowed">
                            <i class="bi bi-shield-lock mr-2"></i> Mode Admin (Tidak dapat mendaftar)
                        </button>
                    @elseif($isRegistered)
                        {{-- User already registered --}}
                        <button type="button" disabled
                            class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium bg-slate-200 text-slate-500 cursor-not-allowed">
                            <i class="bi bi-check-circle mr-2"></i> Sudah Terdaftar
                        </button>
                    @elseif($event->status !== 'available' || $registeredCount >= $event->quota)
                        {{-- Event not available or full --}}
                        <button type="button" disabled
                            class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium bg-slate-200 text-slate-500 cursor-not-allowed">
                            {{ $registeredCount >= $event->quota ? 'Kuota Penuh' : 'Event Tidak Tersedia' }}
                        </button>
                    @else
                        {{-- Can register --}}
                        <form action="{{ route('user.registrations.store', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 transition-colors">
                                Daftar Event Sekarang
                            </button>
                        </form>
                    @endif
                @else
                    {{-- Not logged in --}}
                    <a href="{{ route('login') }}"
                        class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 transition-colors">
                        Login untuk Mendaftar
                    </a>
                @endauth
                
                <div class="mt-4 text-center">
                    @auth
                        @if($isRegistered)
                            <p class="text-xs text-slate-500">Anda sudah terdaftar di event ini. Pantau status di <a href="{{ route('user.dashboard') }}" class="text-indigo-600 hover:underline">Dashboard</a>.</p>
                        @else
                            <p class="text-xs text-slate-500">Dengan mendaftar, Anda setuju dengan syarat dan ketentuan yang berlaku.</p>
                        @endif
                    @else
                        <p class="text-xs text-slate-500">Pastikan Anda sudah <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">login</a> sebelum mendaftar.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
