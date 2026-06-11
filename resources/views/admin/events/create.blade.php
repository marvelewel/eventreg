@extends('layouts.app')

@section('title', 'Tambah Event Baru')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Event Baru</h2>
    <nav class="flex mt-1" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="text-slate-500 hover:text-slate-900 transition-colors">Dashboard</a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="bi bi-chevron-right text-slate-400 mx-1 text-xs"></i>
                    <a href="{{ route('admin.events.index') }}" class="text-slate-500 hover:text-slate-900 transition-colors">Event</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="bi bi-chevron-right text-slate-400 mx-1 text-xs"></i>
                    <span class="text-slate-900 font-medium">Tambah</span>
                </div>
            </li>
        </ol>
    </nav>
</div>

<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 sm:p-8">
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200">
                    <ul class="text-red-700 text-sm font-medium space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center gap-2"><i class="bi bi-exclamation-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-900 mb-2">Judul Event <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" placeholder="Contoh: Seminar Teknologi 2026" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-900 mb-2">Deskripsi Event <span class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="4" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" placeholder="Jelaskan detail tentang event ini..." required>{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="date" class="block text-sm font-semibold text-slate-900 mb-2">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                        <input type="date" id="date" name="date" value="{{ old('date') }}" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" required>
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-semibold text-slate-900 mb-2">Lokasi <span class="text-red-500">*</span></label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" placeholder="Gedung / Online / Dst" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="quota" class="block text-sm font-semibold text-slate-900 mb-2">Kuota Peserta <span class="text-red-500">*</span></label>
                        <input type="number" id="quota" name="quota" min="1" value="{{ old('quota') }}" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" placeholder="100" required>
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-semibold text-slate-900 mb-2">Biaya Pendaftaran (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" min="0" value="{{ old('price', 0) }}" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" placeholder="0 untuk gratis" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-900 mb-2">Status <span class="text-red-500">*</span></label>
                        <select id="status" name="status" class="block w-full px-4 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-shadow" required>
                            <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="full" {{ old('status') === 'full' ? 'selected' : '' }}>Full</option>
                            <option value="finished" {{ old('status') === 'finished' ? 'selected' : '' }}>Finished</option>
                            <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="poster" class="block text-sm font-semibold text-slate-900 mb-2">Poster Event <span class="text-red-500">*</span></label>
                    <input type="file" id="poster" name="poster" accept="image/jpeg,image/png,image/jpg,image/webp" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 transition-all cursor-pointer" required>
                    <p class="mt-1 text-xs text-slate-500">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-slate-200">
                    <a href="{{ route('admin.events.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-colors duration-200">
                        Simpan Event
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
