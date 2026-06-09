<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create an Admin User
        User::create([
            'name' => 'Admin EventReg',
            'email' => 'admin@eventreg.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Create a Regular User (Peserta)
        User::create([
            'name' => 'Marvel Jeremia',
            'email' => 'peserta@eventreg.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 3. Create Dummy Events
        // Note: For the 'poster', we use external Unsplash URLs for the dummy data.
        // Later in Blade, we will check if the string starts with 'http' or use Storage::url().
        Event::create([
            'title' => 'Seminar Karier Digital 2026',
            'description' => 'Mempersiapkan diri menghadapi tantangan karier di era digital 2026. Pembicara dari berbagai perusahaan teknologi terkemuka akan hadir membagikan insight menarik.',
            'date' => '2026-08-15',
            'location' => 'Gedung Serbaguna A, Universitas Teknologi',
            'quota' => 200,
            'poster' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop',
            'status' => 'available',
        ]);

        Event::create([
            'title' => 'Workshop UI/UX Dasar',
            'description' => 'Pelatihan intensif 1 hari untuk mempelajari dasar-dasar User Interface dan User Experience menggunakan Figma. Cocok untuk pemula.',
            'date' => '2026-08-20',
            'location' => 'Lab Komputer 1',
            'quota' => 50,
            'poster' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?q=80&w=800&auto=format&fit=crop',
            'status' => 'available',
        ]);

        Event::create([
            'title' => 'Talkshow Startup Mahasiswa',
            'description' => 'Diskusi panel bersama para founder startup mahasiswa yang berhasil mendapatkan pendanaan tahap awal. Belajar cara membangun ide bisnis.',
            'date' => '2026-08-25',
            'location' => 'Auditorium Utama',
            'quota' => 300,
            'poster' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=800&auto=format&fit=crop',
            'status' => 'available',
        ]);
    }
}
