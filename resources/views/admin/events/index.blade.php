@extends('layouts.app')

@section('title', 'Kelola Event')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Kelola Event</h2>
        <nav class="flex mt-1" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
                <li class="inline-flex items-center">
                    <a href="{{ url('/admin/dashboard') }}" class="text-slate-500 hover:text-slate-900 transition-colors">Dashboard</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-slate-400 mx-1 text-xs"></i>
                        <span class="text-slate-900 font-medium">Event</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <a href="{{ url('/admin/events/create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-colors duration-200">
        <i class="bi bi-plus-lg mr-2"></i> Tambah Event Baru
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-16">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Event</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Lokasi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kuota (Terisi)</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($events ?? [] as $index => $event)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $event['title'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ \Carbon\Carbon::parse($event['date'])->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $event['location'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $event['quota'] }} <span class="text-slate-400">({{ $event['registered_count'] }})</span></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($event['status'] == 'published')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Published</span>
                        @elseif($event['status'] == 'draft')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 ring-1 ring-inset ring-slate-500/20">Draft</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10">Finished</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                        <div class="inline-flex rounded-md shadow-sm border border-slate-200" role="group">
                            <a href="{{ url('/admin/events/' . $event['id'] . '/edit') }}" class="inline-flex items-center px-3 py-1.5 bg-white text-indigo-600 hover:text-indigo-900 hover:bg-slate-50 rounded-l-md border-r border-slate-200 transition-colors" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button type="button" class="btn-delete inline-flex items-center px-3 py-1.5 bg-white text-red-600 hover:text-red-900 hover:bg-red-50 rounded-r-md transition-colors" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-sm text-slate-500">Belum ada data event.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(count($events ?? []) > 0)
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
