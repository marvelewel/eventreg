@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Halo, Peserta!</h2>
    <p class="text-slate-500 mt-1">Selamat datang di dashboard Anda.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Event Terdaftar</p>
            <p class="text-3xl font-extrabold text-slate-900">3</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-slate-50 text-slate-600">
            <i class="bi bi-calendar-check text-xl"></i>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Menunggu Konfirmasi</p>
            <p class="text-3xl font-extrabold text-slate-900">1</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-amber-50 text-amber-600">
            <i class="bi bi-hourglass text-xl"></i>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Event Disetujui</p>
            <p class="text-3xl font-extrabold text-slate-900">2</p>
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
                <a href="{{ url('/user/registrations') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors">Lihat Selengkapnya</a>
            </div>
            <div class="overflow-x-auto flex-grow">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Event</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Pelaksanaan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">Seminar Karier Digital 2026</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">15 Agu 2026</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Accepted</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">Workshop UI/UX Dasar</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">20 Agu 2026</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20">Pending</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">Talkshow Startup Mahasiswa</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">25 Agu 2026</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Accepted</span>
                            </td>
                        </tr>
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
                <a href="{{ url('/events') }}" class="flex items-center p-4 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 hover:border-slate-300 transition-all group">
                    <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-lg bg-white border border-slate-200 shadow-sm text-slate-600 group-hover:text-slate-900 mr-4">
                        <i class="bi bi-search text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900 mb-0.5">Cari Event Baru</p>
                        <p class="text-xs text-slate-500">Lihat daftar event yang tersedia</p>
                    </div>
                </a>
                
                <a href="{{ url('/user/registrations') }}" class="flex items-center p-4 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 hover:border-slate-300 transition-all group">
                    <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-lg bg-white border border-slate-200 shadow-sm text-slate-600 group-hover:text-slate-900 mr-4">
                        <i class="bi bi-clock-history text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900 mb-0.5">Riwayat Pendaftaran</p>
                        <p class="text-xs text-slate-500">Pantau status pendaftaran Anda</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
