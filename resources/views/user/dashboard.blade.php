@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Halo, {{ auth()->user()->name }}!</h2>
    <p class="text-slate-500 mt-1">Selamat datang di dashboard Anda.</p>
</div>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3">
        <i class="bi bi-check-circle-fill text-lg"></i>
        <p class="text-sm font-medium">{{ session('success') }}</p>
    </div>
@endif
@if(session('error'))
    <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800 flex items-center gap-3">
        <i class="bi bi-exclamation-triangle-fill text-lg"></i>
        <p class="text-sm font-medium">{{ session('error') }}</p>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Event Terdaftar</p>
            <p class="text-3xl font-extrabold text-slate-900">{{ $totalRegistered }}</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-slate-50 text-slate-600">
            <i class="bi bi-calendar-check text-xl"></i>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Menunggu Konfirmasi</p>
            <p class="text-3xl font-extrabold text-slate-900">{{ $pendingCount }}</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-amber-50 text-amber-600">
            <i class="bi bi-hourglass text-xl"></i>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Event Disetujui</p>
            <p class="text-3xl font-extrabold text-slate-900">{{ $acceptedCount }}</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-50 text-emerald-600">
            <i class="bi bi-check-circle text-xl"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden h-full flex flex-col">
            <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-900">Riwayat Pendaftaran Anda</h3>
            </div>
            <div class="overflow-x-auto flex-grow">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Event</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Lokasi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tgl Pelaksanaan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tgl Pendaftaran</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($history as $registration)
                            <tr class="hover:bg-slate-50 transition-colors cursor-default">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                    <a href="{{ route('events.show', $registration->event->id) }}" class="hover:text-indigo-600 transition-colors">
                                        {{ $registration->event->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    {{ $registration->event->location }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    {{ \Carbon\Carbon::parse($registration->event->date)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    {{ $registration->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($registration->status === 'accepted')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Accepted</span>
                                    @elseif($registration->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20">Pending</span>
                                    @elseif($registration->status === 'rejected')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <i class="bi bi-calendar-x text-3xl text-slate-300 mb-3 block"></i>
                                    <p class="text-sm text-slate-500">Belum ada riwayat pendaftaran.</p>
                                    <a href="{{ route('events.index') }}" class="mt-2 inline-block text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors">
                                        Cari Event Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 h-full flex flex-col">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-900">Menu Cepat</h3>
            </div>
            <div class="p-6 space-y-4 flex-grow">
                <a href="{{ route('events.index') }}" class="flex items-center p-4 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 hover:border-slate-300 transition-all group">
                    <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-lg bg-white border border-slate-200 shadow-sm text-slate-600 group-hover:text-slate-900 mr-4">
                        <i class="bi bi-search text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900 mb-0.5">Cari Event Baru</p>
                        <p class="text-xs text-slate-500">Lihat daftar event yang tersedia</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
