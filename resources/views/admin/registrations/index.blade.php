@extends('layouts.app')

@section('title', 'Kelola Pendaftaran')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Kelola Pendaftaran</h2>
        <nav class="flex mt-1" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
                <li class="inline-flex items-center">
                    <a href="{{ url('/admin/dashboard') }}" class="text-slate-500 hover:text-slate-900 transition-colors">Dashboard</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-slate-400 mx-1 text-xs"></i>
                        <span class="text-slate-900 font-medium">Pendaftaran</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-16">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Peserta</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Event</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Daftar</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($registrations ?? [] as $index => $registration)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $registration['user_name'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $registration['event_name'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ \Carbon\Carbon::parse($registration['registered_at'])->format('d M Y, H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($registration['status'] == 'accepted')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Diterima</span>
                        @elseif($registration['status'] == 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20">Pending</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                        @if($registration['status'] == 'pending')
                            <div class="inline-flex space-x-2">
                                <form action="#" method="POST" class="inline">
                                    <button type="button" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none transition-colors" title="Terima">
                                        <i class="bi bi-check-lg mr-1"></i> Terima
                                    </button>
                                </form>
                                <form action="#" method="POST" class="inline">
                                    <button type="button" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none transition-colors" title="Tolak">
                                        <i class="bi bi-x-lg mr-1"></i> Tolak
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-slate-400 text-xs italic">Sudah diproses</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-sm text-slate-500">Belum ada data pendaftaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(count($registrations ?? []) > 0)
<div class="flex justify-end mt-6">
    <nav class="inline-flex rounded-md shadow-sm isolate space-x-2" aria-label="Pagination">
        <a href="#" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 cursor-not-allowed">Previous</a>
        <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-slate-900 rounded-lg hover:bg-slate-800 focus:z-20">1</a>
        <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:z-20">2</a>
        <a href="#" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:z-20">Next</a>
    </nav>
</div>
@endif
@endsection
