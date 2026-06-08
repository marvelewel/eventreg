@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Event</h2>
    <nav class="flex mt-1" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
            <li class="inline-flex items-center">
                <a href="{{ url('/admin/dashboard') }}" class="text-slate-500 hover:text-slate-900 transition-colors">Dashboard</a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="bi bi-chevron-right text-slate-400 mx-1 text-xs"></i>
                    <a href="{{ url('/admin/events') }}" class="text-slate-500 hover:text-slate-900 transition-colors">Event</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="bi bi-chevron-right text-slate-400 mx-1 text-xs"></i>
                    <span class="text-slate-900 font-medium">Edit</span>
                </div>
            </li>
        </ol>
    </nav>
</div>

<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 sm:p-8">
            <form action="#" method="POST" class="space-y-6">
                <!-- Method spoofing dummy -->
                <input type="hidden" name="_method" value="PUT">
                
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-900 mb-2">Judul Event <span class="text-red-500">*</span></label>
                    <input type="text" id="title" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" value="{{ $event['title'] ?? 'Seminar Karier Digital 2026' }}" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-900 mb-2">Deskripsi Event <span class="text-red-500">*</span></label>
                    <textarea id="description" rows="4" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" required>{{ $event['description'] ?? 'Event yang membahas seputar dunia digital di tahun 2026.' }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="date" class="block text-sm font-semibold text-slate-900 mb-2">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                        <input type="date" id="date" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" value="{{ isset($event['date']) ? \Carbon\Carbon::parse($event['date'])->format('Y-m-d') : '2026-08-15' }}" required>
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-semibold text-slate-900 mb-2">Lokasi <span class="text-red-500">*</span></label>
                        <input type="text" id="location" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" value="{{ $event['location'] ?? 'Gedung Serbaguna A' }}" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="quota" class="block text-sm font-semibold text-slate-900 mb-2">Kuota Peserta <span class="text-red-500">*</span></label>
                        <input type="number" id="quota" min="1" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" value="{{ $event['quota'] ?? 100 }}" required>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-900 mb-2">Status <span class="text-red-500">*</span></label>
                        <select id="status" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" required>
                            <option value="draft" {{ ($event['status'] ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ ($event['status'] ?? 'published') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="finished" {{ ($event['status'] ?? '') == 'finished' ? 'selected' : '' }}>Finished</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-slate-200">
                    <a href="{{ url('/admin/events') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-colors duration-200">
                        Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
