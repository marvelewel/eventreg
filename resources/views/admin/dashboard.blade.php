@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Admin Dashboard</h2>
    
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" @click.outside="open = false" type="button" class="inline-flex items-center px-4 py-2 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 focus:outline-none transition-colors">
            <i class="bi bi-gear mr-2 text-slate-400"></i> Menu Admin
        </button>
        <div x-show="open" style="display: none;" class="origin-top-right absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-slate-100 z-10">
            <div class="py-1">
                <a href="{{ route('admin.events.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Kelola Event</a>
                <a href="{{ route('admin.registrations.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Kelola Pendaftaran</a>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Event</p>
            <p class="text-3xl font-extrabold text-slate-900">{{ $totalEvents }}</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-slate-50 text-slate-600">
            <i class="bi bi-calendar-event text-xl"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total User</p>
            <p class="text-3xl font-extrabold text-slate-900">{{ $totalUsers }}</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-50 text-emerald-600">
            <i class="bi bi-people text-xl"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Pendaftar</p>
            <p class="text-3xl font-extrabold text-slate-900">{{ $totalRegistrations }}</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-indigo-50 text-indigo-600">
            <i class="bi bi-card-checklist text-xl"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Pending</p>
            <p class="text-3xl font-extrabold text-slate-900">{{ $pendingRegistrations }}</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-amber-50 text-amber-600">
            <i class="bi bi-hourglass-split text-xl"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden h-full flex flex-col">
            <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-900">Pendaftaran Terbaru</h3>
                <a href="{{ route('admin.registrations.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto flex-grow">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Peserta</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Event</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Daftar</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Bukti Bayar</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($recentRegistrations as $reg)
                        <tr class="hover:bg-slate-50 transition-colors cursor-default">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $reg->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $reg->event->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $reg->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                @if($reg->payment_proof)
                                    <a href="{{ Storage::url($reg->payment_proof) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 transition-colors" title="Lihat Bukti">
                                        <i class="bi bi-file-earmark-image text-lg"></i> Bukti
                                    </a>
                                @elseif($reg->event->price == 0)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-50 text-emerald-700">Gratis</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-500">Belum Bayar</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($reg->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20">Pending</span>
                                @elseif($reg->status === 'accepted')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Accepted</span>
                                @elseif($reg->status === 'rejected')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10">Rejected</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 ring-1 ring-inset ring-slate-500/20">{{ ucfirst($reg->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-sm text-slate-500">Belum ada data pendaftaran.</td>
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
                <h3 class="text-base font-bold text-slate-900">Aksi Cepat</h3>
            </div>
            <div class="p-6 space-y-4 flex-grow">
                <a href="{{ route('admin.events.create') }}" class="flex items-center p-4 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 hover:border-slate-300 transition-all group">
                    <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-lg bg-white border border-slate-200 shadow-sm text-slate-600 group-hover:text-slate-900 mr-4">
                        <i class="bi bi-plus-lg text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900 mb-0.5">Tambah Event Baru</p>
                        <p class="text-xs text-slate-500">Buat event baru untuk pendaftaran</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.events.index') }}" class="flex items-center p-4 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 hover:border-slate-300 transition-all group">
                    <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-lg bg-white border border-slate-200 shadow-sm text-slate-600 group-hover:text-slate-900 mr-4">
                        <i class="bi bi-list-task text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900 mb-0.5">Kelola Event</p>
                        <p class="text-xs text-slate-500">Edit atau hapus event yang ada</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
