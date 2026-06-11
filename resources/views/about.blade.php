@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    
    <div class="text-center mb-12">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-4">Tentang EventReg</h2>
        <p class="text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
            Sistem pendaftaran dan pengelolaan event yang didesain dengan pendekatan minimalis dan modern menggunakan Laravel 12.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-12">
        <div class="p-8 md:p-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Tujuan Sistem</h3>
                    <p class="text-slate-500 leading-relaxed">
                        EventReg dibuat sebagai solusi sederhana untuk membantu proses pengelolaan event dan pendaftaran peserta dalam satu sistem berbasis web. Sistem ini dirancang agar data event dan pendaftar lebih terstruktur, mempermudah pemantauan, serta memberikan pengalaman pendaftaran yang mulus bagi peserta.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Fitur Utama</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="bi bi-check-circle-fill text-indigo-500 mt-1 mr-3"></i>
                            <span class="text-slate-600">Autentikasi (Login & Register) aman</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-check-circle-fill text-indigo-500 mt-1 mr-3"></i>
                            <span class="text-slate-600">Manajemen hak akses Admin & User</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-check-circle-fill text-indigo-500 mt-1 mr-3"></i>
                            <span class="text-slate-600">Kelola Event (CRUD) terpusat</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-check-circle-fill text-indigo-500 mt-1 mr-3"></i>
                            <span class="text-slate-600">Pencarian event intuitif</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-check-circle-fill text-indigo-500 mt-1 mr-3"></i>
                            <span class="text-slate-600">Dashboard analitik interaktif</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="text-center pt-8 border-t border-slate-200">
        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Dikembangkan Oleh</h4>
        
        <div class="inline-flex items-center bg-white p-2 pr-6 rounded-full border border-slate-200 shadow-sm">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-slate-900 text-white font-bold mr-4">
                MJ
            </div>
            <div class="text-left">
                <p class="text-sm font-bold text-slate-900 leading-none mb-1">Christabel Arrowina</p>
                <p class="text-xs text-slate-500 leading-none">Final Project Pemrograman Web 2026</p>
            </div>
        </div>
    </div>

</div>
@endsection
