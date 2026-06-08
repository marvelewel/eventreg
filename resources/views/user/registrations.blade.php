@extends('layouts.app')

@section('title', 'Riwayat Pendaftaran')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Riwayat Pendaftaran</h2>
        <nav class="flex mt-1" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
                <li class="inline-flex items-center">
                    <a href="{{ url('/user/dashboard') }}" class="text-slate-500 hover:text-slate-900 transition-colors">Dashboard</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-slate-400 mx-1 text-xs"></i>
                        <span class="text-slate-900 font-medium">Riwayat</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <a href="{{ url('/events') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-colors duration-200">
        <i class="bi bi-search mr-2"></i> Cari Event Lain
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-16">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Event</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Event</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Lokasi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Daftar</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($registrations ?? [] as $index => $registration)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                        <a href="{{ url('/events/' . $registration['event_id']) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors">
                            {{ $registration['event_name'] }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ \Carbon\Carbon::parse($registration['event_date'])->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $registration['event_location'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ \Carbon\Carbon::parse($registration['registered_at'])->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($registration['status'] == 'accepted')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Diterima</span>
                        @elseif($registration['status'] == 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20">Menunggu</span>
                        @elseif($registration['status'] == 'rejected')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10">Ditolak</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 ring-1 ring-inset ring-slate-500/20">Dibatalkan</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                        <i class="bi bi-inbox text-4xl text-slate-300 mb-3 block"></i>
                        <p class="text-sm">Anda belum mendaftar ke event apapun.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
