@extends('layouts.app')

@section('title', 'Pembayaran Event')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Pembayaran Event</h2>
    <nav class="flex mt-1" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
            <li class="inline-flex items-center">
                <a href="{{ route('user.dashboard') }}" class="text-slate-500 hover:text-slate-900 transition-colors">Dashboard</a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="bi bi-chevron-right text-slate-400 mx-1 text-xs"></i>
                    <span class="text-slate-900 font-medium">Pembayaran</span>
                </div>
            </li>
        </ol>
    </nav>
</div>

<div class="max-w-2xl mx-auto">
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

            <div class="text-center mb-8">
                <h3 class="text-xl font-bold text-slate-900">{{ $event->title }}</h3>
                <p class="text-sm text-slate-500 mt-1">Silakan lakukan pembayaran untuk menyelesaikan pendaftaran.</p>
            </div>

            <div class="bg-slate-50 rounded-xl p-6 border border-slate-100 mb-8 text-center">
                <p class="text-sm font-medium text-slate-500 mb-2">Total Pembayaran</p>
                <p class="text-4xl font-bold text-slate-900">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                
                <hr class="border-slate-200 my-6">
                
                <p class="text-sm font-medium text-slate-500 mb-3">Transfer ke Rekening Berikut:</p>
                <div class="flex flex-col items-center justify-center space-y-2">
                    <p class="text-lg font-bold text-slate-900">Bank Fiktif Sejahtera</p>
                    <p class="text-2xl font-mono text-indigo-600 bg-indigo-50 px-4 py-2 rounded-lg">123-456-7890</p>
                    <p class="text-sm text-slate-500">a.n. Event Registration System</p>
                </div>
            </div>

            <form action="{{ route('user.events.payment.store', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div>
                    <label for="payment_proof" class="block text-sm font-semibold text-slate-900 mb-2">Unggah Bukti Transfer <span class="text-red-500">*</span></label>
                    <input type="file" id="payment_proof" name="payment_proof" accept=".jpg,.jpeg,.png" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 transition-all cursor-pointer border border-slate-200 rounded-lg" required>
                    <p class="mt-2 text-xs text-slate-500"><i class="bi bi-info-circle mr-1"></i>Format yang didukung: JPG, JPEG, PNG. Maksimal ukuran: 2MB.</p>
                </div>

                <div class="pt-4 border-t border-slate-200">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-colors duration-200">
                        <i class="bi bi-cloud-arrow-up mr-2"></i> Kirim Bukti Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
