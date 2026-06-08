<?php

use Illuminate\Support\Facades\Route;

// Dummy Data
$events = [
    [
        'id' => 1,
        'title' => 'Seminar Karier Digital 2026',
        'description' => 'Mempersiapkan diri menghadapi tantangan karier di era digital 2026. Pembicara dari berbagai perusahaan teknologi terkemuka akan hadir membagikan insight menarik.',
        'date' => '2026-08-15',
        'location' => 'Gedung Serbaguna A, Universitas Teknologi',
        'quota' => 200,
        'registered_count' => 150,
        'status' => 'published',
    ],
    [
        'id' => 2,
        'title' => 'Workshop UI/UX Dasar',
        'description' => 'Pelatihan intensif 1 hari untuk mempelajari dasar-dasar User Interface dan User Experience menggunakan Figma.',
        'date' => '2026-08-20',
        'location' => 'Lab Komputer 1',
        'quota' => 50,
        'registered_count' => 50,
        'status' => 'published',
    ],
    [
        'id' => 3,
        'title' => 'Talkshow Startup Mahasiswa',
        'description' => 'Diskusi panel bersama para founder startup mahasiswa yang berhasil mendapatkan pendanaan tahap awal. Belajar cara membangun ide hingga eksekusi.',
        'date' => '2026-08-25',
        'location' => 'Auditorium Utama',
        'quota' => 300,
        'registered_count' => 120,
        'status' => 'published',
    ],
];

$registrations = [
    [
        'id' => 1,
        'user_name' => 'Budi Santoso',
        'event_id' => 1,
        'event_name' => 'Seminar Karier Digital 2026',
        'event_date' => '2026-08-15',
        'event_location' => 'Gedung Serbaguna A, Universitas Teknologi',
        'registered_at' => '2026-06-01 10:00:00',
        'status' => 'pending',
    ],
    [
        'id' => 2,
        'user_name' => 'Siti Aminah',
        'event_id' => 2,
        'event_name' => 'Workshop UI/UX Dasar',
        'event_date' => '2026-08-20',
        'event_location' => 'Lab Komputer 1',
        'registered_at' => '2026-06-02 14:30:00',
        'status' => 'accepted',
    ],
    [
        'id' => 3,
        'user_name' => 'Andi Wijaya',
        'event_id' => 3,
        'event_name' => 'Talkshow Startup Mahasiswa',
        'event_date' => '2026-08-25',
        'event_location' => 'Auditorium Utama',
        'registered_at' => '2026-06-03 09:15:00',
        'status' => 'accepted',
    ],
    [
        'id' => 4,
        'user_name' => 'Dewi Lestari',
        'event_id' => 1,
        'event_name' => 'Seminar Karier Digital 2026',
        'event_date' => '2026-08-15',
        'event_location' => 'Gedung Serbaguna A, Universitas Teknologi',
        'registered_at' => '2026-06-04 16:45:00',
        'status' => 'rejected',
    ],
    [
        'id' => 5,
        'user_name' => 'Rizky Pratama',
        'event_id' => 2,
        'event_name' => 'Workshop UI/UX Dasar',
        'event_date' => '2026-08-20',
        'event_location' => 'Lab Komputer 1',
        'registered_at' => '2026-06-05 11:20:00',
        'status' => 'pending',
    ],
];

// PUBLIC ROUTES
Route::get('/', function () {
    return view('home');
});

Route::get('/events', function () use ($events) {
    return view('events.index', compact('events'));
});

Route::get('/events/{id}', function ($id) use ($events) {
    $event = collect($events)->firstWhere('id', $id);
    if (!$event) {
        abort(404);
    }
    return view('events.show', compact('event'));
});

Route::get('/about', function () {
    return view('about');
});

// AUTH ROUTES
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

// ADMIN ROUTES
Route::prefix('admin')->group(function () use ($events, $registrations) {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/events', function () use ($events) {
        return view('admin.events.index', compact('events'));
    });

    Route::get('/events/create', function () {
        return view('admin.events.create');
    });

    Route::get('/events/{id}/edit', function ($id) use ($events) {
        $event = collect($events)->firstWhere('id', $id);
        return view('admin.events.edit', compact('event'));
    });

    Route::get('/registrations', function () use ($registrations) {
        return view('admin.registrations.index', compact('registrations'));
    });
});

// USER ROUTES
Route::prefix('user')->group(function () use ($registrations) {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    });

    Route::get('/registrations', function () use ($registrations) {
        // Mock filtering registrations to only show current user's (e.g. Budi Santoso and Andi Wijaya's stuff to simulate)
        // Or just pass all for visual demo purpose
        return view('user.registrations', compact('registrations'));
    });
});
