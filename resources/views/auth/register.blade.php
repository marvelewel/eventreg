@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden sm:rounded-2xl">
            <div class="px-6 py-8 sm:px-10">
                <div class="text-center mb-8">
                    <div class="inline-flex justify-center items-center w-16 h-16 rounded-full bg-indigo-50 text-indigo-600 mb-4 shadow-sm">
                        <i class="bi bi-person-plus-fill text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight mb-1">Buat Akun Baru</h3>
                    <p class="text-sm text-slate-500 font-medium">Daftar sekarang untuk mengikuti berbagai event menarik</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
                        <ul class="text-red-700 text-sm font-medium space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-center gap-2"><i class="bi bi-exclamation-circle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-900 mb-1.5">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="block w-full px-4 py-3 border border-slate-300 rounded-lg bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white sm:text-sm transition-all" placeholder="Masukkan nama lengkap Anda" required>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-900 mb-1.5">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="block w-full px-4 py-3 border border-slate-300 rounded-lg bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white sm:text-sm transition-all" placeholder="name@example.com" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-slate-900 mb-1.5">Password</label>
                            <input type="password" id="password" name="password" class="block w-full px-4 py-3 border border-slate-300 rounded-lg bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white sm:text-sm transition-all" placeholder="••••••••" required>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-slate-900 mb-1.5">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="block w-full px-4 py-3 border border-slate-300 rounded-lg bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white sm:text-sm transition-all" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="terms" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded" required>
                        <label for="terms" class="ml-2 block text-sm font-medium text-slate-600">
                            Saya menyetujui <a href="#" class="text-indigo-600 hover:text-indigo-500 transition-colors">Syarat & Ketentuan</a> yang berlaku.
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-colors">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-slate-200 text-center">
                    <p class="text-sm font-medium text-slate-500">
                        Sudah punya akun? 
                        <a href="{{ url('/login') }}" class="font-bold text-slate-900 hover:text-indigo-600 transition-colors">Masuk di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
