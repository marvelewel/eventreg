@extends('layouts.app')

@section('title', 'Detail Event')

@section('content')
<div class="mb-6">
    <a href="{{ url('/events') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">
        <i class="bi bi-arrow-left mr-2"></i> Kembali ke Daftar Event
    </a>
</div>

@if($event ?? false)
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 md:p-8">
                
                <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-slate-900">{{ $event['title'] }}</h2>
                    <div>
                        @if($event['status'] == 'published')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Tersedia</span>
                        @elseif($event['status'] == 'draft')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 ring-1 ring-inset ring-slate-500/20">Draft</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10">Selesai</span>
                        @endif
                    </div>
                </div>
                
                <hr class="border-slate-200 my-6">
                
                <h3 class="text-lg font-bold text-slate-900 mb-4">Deskripsi Event</h3>
                <div class="prose prose-slate max-w-none text-slate-600 text-sm leading-relaxed mb-8">
                    <p>{{ $event['description'] }}</p>
                </div>
                
                <h3 class="text-lg font-bold text-slate-900 mb-5">Informasi Pelaksanaan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 mr-4">
                            <i class="bi bi-calendar4 text-slate-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Tanggal</p>
                            <p class="text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($event['date'])->format('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 mr-4">
                            <i class="bi bi-geo-alt text-slate-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Lokasi</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $event['location'] }}</p>
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
                        <dd class="text-sm font-bold {{ $event['status'] == 'published' ? 'text-emerald-600' : 'text-red-600' }}">
                            {{ ucfirst($event['status']) }}
                        </dd>
                    </div>
                    <div class="flex justify-between items-center">
                        <dt class="text-sm font-medium text-slate-500">Kuota Tersedia</dt>
                        <dd class="text-sm font-bold text-slate-900">{{ $event['quota'] - $event['registered_count'] }} Orang</dd>
                    </div>
                    <div class="flex justify-between items-center">
                        <dt class="text-sm font-medium text-slate-500">Pendaftar</dt>
                        <dd class="text-sm font-bold text-slate-900">{{ $event['registered_count'] }} / {{ $event['quota'] }}</dd>
                    </div>
                </dl>
                
                <!-- Progress bar for quota -->
                @php $percentage = ($event['registered_count'] / $event['quota']) * 100; @endphp
                <div class="w-full bg-slate-100 rounded-full h-1.5 mb-6 overflow-hidden">
                    <div class="{{ $percentage >= 100 ? 'bg-red-500' : 'bg-slate-800' }} h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                </div>
                
                <form action="#" method="POST">
                    <!-- Dummy Form -->
                    <button type="submit" 
                        class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white transition-colors
                        {{ $event['status'] != 'published' || $event['registered_count'] >= $event['quota'] 
                            ? 'bg-slate-300 cursor-not-allowed text-slate-500' 
                            : 'bg-slate-900 hover:bg-slate-800' }}"
                        {{ $event['status'] != 'published' || $event['registered_count'] >= $event['quota'] ? 'disabled' : '' }}>
                        Daftar Event Sekarang
                    </button>
                </form>
                
                <div class="mt-4 text-center">
                    <p class="text-xs text-slate-500">Pastikan Anda sudah login sebelum mendaftar.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="bg-amber-50 border border-amber-200 text-amber-800 rounded-lg p-4">
    <p class="text-sm font-medium">Event tidak ditemukan.</p>
</div>
@endif
@endsection
