# Dokumentasi Arsitektur & Struktur Kode — EventReg

Dokumen ini menjelaskan arsitektur, struktur file, dan alur kerja dari sistem **EventReg** agar pengembang atau reviewer dapat memahami bagaimana setiap komponen saling terhubung dalam pola **MVC (Model-View-Controller)** yang disediakan oleh Laravel 12.

---

## 📋 Daftar Isi

- [Konsep Arsitektur](#1-konsep-arsitektur)
- [Struktur Routing](#2-struktur-routing)
- [Middleware](#3-middleware)
- [Models & Relasi Database](#4-models--relasi-database)
- [Controllers](#5-controllers)
- [Views (Frontend Blade Templates)](#6-views-frontend-blade-templates)
- [Alur Kerja Sistem](#7-alur-kerja-sistem)

---

## 1. Konsep Arsitektur

EventReg menggunakan arsitektur **MVC (Model-View-Controller)** bawaan Laravel 12:

```
┌─────────────┐      ┌──────────────┐      ┌─────────────┐
│    VIEW      │ ◄──► │  CONTROLLER  │ ◄──► │    MODEL    │
│  (Blade)     │      │  (PHP Logic) │      │  (Eloquent) │
└─────────────┘      └──────────────┘      └─────────────┘
       ▲                     ▲                     ▲
       │                     │                     │
  Tailwind CSS          Middleware            MySQL/MariaDB
  Alpine.js            (Auth + Role)
  Vite (Build)
```

| Lapisan | Teknologi | Fungsi |
|---------|-----------|--------|
| **Model** | Eloquent ORM | Representasi tabel database dan relasi antar tabel |
| **View** | Blade + Tailwind CSS | Template HTML yang dirender ke browser pengguna |
| **Controller** | PHP Classes | Menerima request, memproses logika bisnis, mengembalikan response |
| **Middleware** | `RoleMiddleware` | Menyaring akses berdasarkan autentikasi dan peran pengguna |
| **Routing** | `routes/web.php` | Memetakan URL ke method Controller yang sesuai |
| **Build Tool** | Vite | Mengompilasi Tailwind CSS dan JavaScript menjadi asset produksi |

---

## 2. Struktur Routing

Seluruh definisi route berada di file **`routes/web.php`**. Route dibagi menjadi **3 zona utama** berdasarkan tingkat akses:

### 2.1 Public Routes (Tanpa Login)

Route ini dapat diakses oleh siapa saja — termasuk pengunjung yang belum login (Guest).

| Method | URL | Controller | Fungsi |
|--------|-----|-----------|--------|
| `GET` | `/` | `HomeController@index` | Halaman beranda (landing page) |
| `GET` | `/events` | `EventController@index` | Daftar event dengan pencarian & pagination |
| `GET` | `/events/{event}` | `EventController@show` | Detail event (info lengkap + tombol daftar) |
| `GET` | `/about` | Static View | Halaman statis tentang sistem |

### 2.2 Auth Routes (Guest Only)

Route untuk autentikasi — hanya dapat diakses oleh pengguna yang **belum login** (dilindungi middleware `guest`).

| Method | URL | Controller | Fungsi |
|--------|-----|-----------|--------|
| `GET` | `/login` | `AuthController@showLogin` | Menampilkan form login |
| `POST` | `/login` | `AuthController@login` | Memproses login |
| `GET` | `/register` | `AuthController@showRegister` | Menampilkan form register |
| `POST` | `/register` | `AuthController@register` | Memproses registrasi akun baru |
| `POST` | `/logout` | `AuthController@logout` | Logout (dilindungi middleware `auth`) |

### 2.3 Admin Routes (`/admin/*`)

Dilindungi oleh middleware **`auth`** dan **`role:admin`**. Hanya pengguna dengan role `admin` yang dapat mengakses.

```php
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Semua route admin didefinisikan di sini
});
```

| Method | URL | Controller | Fungsi |
|--------|-----|-----------|--------|
| `GET` | `/admin/dashboard` | `Admin\DashboardController@index` | Dashboard statistik admin |
| `GET` | `/admin/events` | `Admin\EventController@index` | Daftar event (tabel admin) |
| `GET` | `/admin/events/create` | `Admin\EventController@create` | Form tambah event baru |
| `POST` | `/admin/events` | `Admin\EventController@store` | Simpan event baru ke database |
| `GET` | `/admin/events/{event}/edit` | `Admin\EventController@edit` | Form edit event |
| `PUT` | `/admin/events/{event}` | `Admin\EventController@update` | Update data event |
| `DELETE` | `/admin/events/{event}` | `Admin\EventController@destroy` | Hapus event dari database |
| `GET` | `/admin/registrations` | `Admin\RegistrationController@index` | Daftar semua pendaftaran |
| `PATCH` | `/admin/registrations/{registration}/status` | `Admin\RegistrationController@update` | Ubah status pendaftaran |

### 2.4 User Routes (`/user/*`)

Dilindungi oleh middleware **`auth`** dan **`role:user`**. Hanya pengguna dengan role `user` yang dapat mengakses.

```php
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    // Semua route user didefinisikan di sini
});
```

| Method | URL | Controller | Fungsi |
|--------|-----|-----------|--------|
| `GET` | `/user/dashboard` | `User\DashboardController@index` | Dashboard riwayat pendaftaran user |
| `POST` | `/user/events/{event}/register` | `User\RegistrationController@store` | Proses pendaftaran event |

---

## 3. Middleware

### 3.1 RoleMiddleware (`app/Http/Middleware/RoleMiddleware.php`)

File ini berfungsi sebagai **Gatekeeper (penjaga akses)** sistem. Middleware ini memeriksa apakah pengguna yang sedang login memiliki **role** yang sesuai dengan halaman yang diakses.

**Logika Utama:**

```php
public function handle(Request $request, Closure $next, $role): Response
{
    if (!Auth::check() || Auth::user()->role !== $role) {
        abort(403, 'Unauthorized access.');
    }
    return $next($request);
}
```

**Cara Kerja:**

1. Periksa apakah pengguna sudah login (`Auth::check()`).
2. Periksa apakah `role` pengguna sesuai dengan parameter yang diberikan.
3. Jika **tidak sesuai** → kembalikan error **403 Forbidden**.
4. Jika **sesuai** → lanjutkan request ke Controller.

**Registrasi Middleware:**

Middleware ini didaftarkan di **`bootstrap/app.php`** dengan alias `role`:

```php
$middleware->alias([
    'role' => \App\Http\Middleware\RoleMiddleware::class,
]);
```

**Skenario Proteksi:**

| Skenario | Hasil |
|----------|-------|
| User (`peserta@eventreg.com`) mengakses `/admin/dashboard` | ❌ **403 Forbidden** |
| Admin (`admin@eventreg.com`) mengakses `/user/dashboard` | ❌ **403 Forbidden** |
| Guest (belum login) mengakses `/admin/events` | ❌ **Redirect ke `/login`** (oleh middleware `auth`) |
| Admin mengakses `/admin/events` | ✅ **Diizinkan** |

---

## 4. Models & Relasi Database

Semua model berada di direktori **`app/Models/`** dan menggunakan **Eloquent ORM** untuk berinteraksi dengan database.

### 4.1 Diagram Relasi (ERD)

```
┌──────────────┐         ┌──────────────────┐         ┌──────────────┐
│    USERS     │         │  REGISTRATIONS   │         │    EVENTS    │
├──────────────┤         ├──────────────────┤         ├──────────────┤
│ id (PK)      │───┐     │ id (PK)          │     ┌───│ id (PK)      │
│ name         │   │     │ user_id (FK) ────│─────┘   │ title        │
│ email        │   └────►│ event_id (FK) ───│─────────│ description  │
│ password     │         │ status           │         │ date         │
│ role         │         │ created_at       │         │ location     │
│ created_at   │         │ updated_at       │         │ quota        │
│ updated_at   │         └──────────────────┘         │ poster       │
└──────────────┘                                      │ status       │
                                                      │ created_at   │
                                                      │ updated_at   │
                                                      └──────────────┘
```

### 4.2 User (`app/Models/User.php`)

Merepresentasikan tabel **`users`** — menyimpan data akun pengguna.

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `name` | string | Nama lengkap |
| `email` | string (unique) | Alamat email untuk login |
| `password` | string (hashed) | Password terenkripsi |
| `role` | enum (`admin`, `user`) | Peran pengguna dalam sistem |

**Relasi:**

```php
// User memiliki banyak Registrasi (One-to-Many)
public function registrations()
{
    return $this->hasMany(Registration::class);
}
```

### 4.3 Event (`app/Models/Event.php`)

Merepresentasikan tabel **`events`** — menyimpan data event yang dibuat oleh admin.

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `title` | string | Judul/nama event |
| `description` | text | Deskripsi lengkap event |
| `date` | date | Tanggal pelaksanaan |
| `location` | string | Lokasi pelaksanaan |
| `quota` | integer | Kuota maksimal peserta |
| `poster` | string (nullable) | Path file poster di storage atau URL eksternal |
| `status` | enum | Status event (`available`, `full`, `finished`, `cancelled`) |

**Relasi:**

```php
// Event memiliki banyak Registrasi (One-to-Many)
public function registrations()
{
    return $this->hasMany(Registration::class);
}
```

### 4.4 Registration (`app/Models/Registration.php`)

Merepresentasikan tabel **`registrations`** — tabel transaksi yang menghubungkan **User** dengan **Event**.

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `user_id` | FK → users.id | ID peserta yang mendaftar |
| `event_id` | FK → events.id | ID event yang didaftari |
| `status` | enum | Status pendaftaran (`pending`, `accepted`, `rejected`, `cancelled`) |

**Relasi:**

```php
// Registrasi milik satu User (Many-to-One)
public function user()
{
    return $this->belongsTo(User::class);
}

// Registrasi milik satu Event (Many-to-One)
public function event()
{
    return $this->belongsTo(Event::class);
}
```

**Cascade Delete:** Jika sebuah User atau Event dihapus, seluruh data registrasi terkait akan otomatis terhapus (`cascadeOnDelete` di migration).

---

## 5. Controllers

Semua controller berada di **`app/Http/Controllers/`** dan mengikuti prinsip **Single Responsibility** — setiap controller menangani satu domain logika.

### 5.1 AuthController (`AuthController.php`)

Menangani seluruh proses autentikasi pengguna secara custom (tanpa Laravel Breeze/Jetstream).

| Method | Fungsi |
|--------|--------|
| `showLogin()` | Menampilkan halaman login |
| `login()` | Memvalidasi kredensial, membuat session, dan redirect berdasarkan role |
| `showRegister()` | Menampilkan halaman register |
| `register()` | Membuat akun baru (role default: `user`), auto-login, redirect ke dashboard |
| `logout()` | Menghapus session dan redirect ke halaman utama |

**Fitur Penting — Redirect Berdasarkan Role:**

```php
if (Auth::user()->role === 'admin') {
    return redirect()->intended('/admin/dashboard');
}
return redirect()->intended('/user/dashboard');
```

### 5.2 EventController (`EventController.php`) — Public

Menangani tampilan event untuk **semua pengguna** (termasuk guest).

| Method | Fungsi |
|--------|--------|
| `index()` | Menampilkan daftar event dengan **pencarian dinamis** (`where('title', 'like', ...)`) dan **pagination** (9 per halaman). Query string dipertahankan saat berpindah halaman (`withQueryString()`). |
| `show()` | Menampilkan detail lengkap event. Menghitung jumlah pendaftar aktif (`pending`/`accepted`) dan memeriksa apakah user yang sedang login sudah terdaftar di event tersebut. |

### 5.3 Admin\DashboardController (`Admin/DashboardController.php`)

Menampilkan ringkasan statistik untuk admin.

| Statistik | Query |
|-----------|-------|
| Total Event | `Event::count()` |
| Total User (Peserta) | `User::where('role', 'user')->count()` |
| Total Pendaftaran | `Registration::count()` |
| Pendaftaran Pending | `Registration::where('status', 'pending')->count()` |

### 5.4 Admin\EventController (`Admin/EventController.php`)

Menangani operasi **CRUD penuh** untuk data event, termasuk manajemen file poster.

| Method | Fungsi |
|--------|--------|
| `index()` | Daftar event admin dengan pagination (10 per halaman) |
| `create()` | Menampilkan form tambah event |
| `store()` | Validasi 7 field + upload poster ke disk `public` via `Storage` |
| `edit()` | Menampilkan form edit event dengan data yang sudah ada |
| `update()` | Validasi + update data. Jika poster baru diunggah, poster lama dihapus dari storage |
| `destroy()` | Hapus event dari database + hapus file poster dari storage |

**Manajemen File Poster:**

```php
// Upload poster baru
$path = $request->file('poster')->store('posters', 'public');

// Hapus poster lama (hanya jika bukan URL eksternal)
if ($event->poster && !str_starts_with($event->poster, 'http')) {
    Storage::disk('public')->delete($event->poster);
}
```

### 5.5 Admin\RegistrationController (`Admin/RegistrationController.php`)

Menangani pengelolaan status pendaftaran oleh admin.

| Method | Fungsi |
|--------|--------|
| `index()` | Menampilkan daftar semua pendaftaran dengan eager loading (`with(['user', 'event'])`) dan pagination (15 per halaman) |
| `update()` | Mengubah status pendaftaran menjadi `accepted`, `rejected`, atau `pending` melalui request PATCH |

### 5.6 User\DashboardController (`User/DashboardController.php`)

Menampilkan dashboard peserta dengan statistik pribadi dan riwayat pendaftaran.

| Data | Sumber |
|------|--------|
| Total Terdaftar | `$user->registrations()->count()` |
| Menunggu Konfirmasi | `...->where('status', 'pending')->count()` |
| Disetujui | `...->where('status', 'accepted')->count()` |
| Riwayat Pendaftaran | `...->with('event')->latest()->get()` |

### 5.7 User\RegistrationController (`User/RegistrationController.php`)

Menangani proses pendaftaran event oleh peserta. Controller ini menegakkan **6 aturan bisnis** sebelum pendaftaran berhasil:

| # | Aturan Bisnis | Implementasi |
|---|--------------|-------------|
| 1 | User harus login | Dilindungi middleware `auth` di route |
| 2 | Event harus berstatus `available` | `if ($event->status !== 'available')` → tolak |
| 3 | Tidak boleh mendaftar dua kali | Query `whereIn('status', ['pending', 'accepted'])->exists()` |
| 4 | Tidak boleh mendaftar event `finished` | Dicakup oleh pengecekan status #2 |
| 5 | Tidak boleh mendaftar event `cancelled` | Dicakup oleh pengecekan status #2 |
| 6 | Kuota tidak boleh penuh | `if ($registeredCount >= $event->quota)` → tolak |

**Jika semua aturan terpenuhi:** Buat record `Registration` dengan status `pending`, redirect ke dashboard user dengan pesan sukses.

---

## 6. Views (Frontend Blade Templates)

Semua file view berada di **`resources/views/`** dan menggunakan **Blade template engine** dengan **Tailwind CSS** untuk styling.

### 6.1 Layout Utama (`layouts/app.blade.php`)

File ini adalah **master layout** yang digunakan oleh seluruh halaman. Berisi:

- **`<head>`** — Meta tags, Google Fonts (Inter), Bootstrap Icons CDN, Alpine.js CDN, dan directive `@vite` untuk memuat asset CSS/JS yang dikompilasi.
- **`@include('partials.navbar')`** — Menyisipkan komponen navbar.
- **Flash Messages** — Menampilkan notifikasi sukses/error menggunakan Alpine.js untuk animasi dismiss.
- **`@yield('content')`** — Placeholder untuk konten halaman.
- **Conditional Footer:**
  - **Public pages** (`/`, `/events`, `/about`) → Footer besar 4 kolom dengan link dan ikon sosial media.
  - **Dashboard pages** (`/admin/*`, `/user/*`) → Footer minimalis hanya copyright.

```php
@if(!request()->is('admin*') && !request()->is('user*'))
    {{-- Footer besar untuk halaman publik --}}
@else
    {{-- Footer mini untuk dashboard --}}
@endif
```

### 6.2 Navbar (`partials/navbar.blade.php`)

Komponen navigasi yang bersifat **auth-aware** — tampilan berubah berdasarkan status login dan role:

| Kondisi | Tampilan |
|---------|---------|
| **Guest** | Tombol "Login" dan "Daftar" |
| **Admin** | Dropdown: Dashboard Admin, Kelola Pendaftaran, Logout |
| **User** | Dropdown: Dashboard, Logout |

Navbar juga menyertakan **mobile menu** responsif menggunakan Alpine.js toggle.

### 6.3 Auth Views (`auth/`)

| File | Fungsi |
|------|--------|
| **`login.blade.php`** | Form login dengan validasi email & password, error handling, dan link ke register |
| **`register.blade.php`** | Form registrasi dengan nama, email, password + konfirmasi, checkbox terms, dan link ke login |

### 6.4 Event Views (`events/`)

| File | Fungsi |
|------|--------|
| **`index.blade.php`** | Grid 3 kolom kartu event dengan poster, judul, tanggal, lokasi, kuota, status badge, dan tombol "Lihat Detail". Dilengkapi **form pencarian** (`<form method="GET">`) dan **pagination** |
| **`show.blade.php`** | Detail event lengkap: poster ukuran penuh, deskripsi, info pelaksanaan, progress bar kuota, dan **tombol pendaftaran dinamis** dengan 5 kondisi (admin/sudah terdaftar/event tidak tersedia/kuota penuh/bisa daftar/belum login) |

### 6.5 Admin Views (`admin/`)

| File | Fungsi |
|------|--------|
| **`dashboard.blade.php`** | 4 kartu statistik + tabel pendaftaran terbaru (5 data terakhir) |
| **`events/index.blade.php`** | Tabel daftar event admin dengan kolom No, Nama, Tanggal, Lokasi, Kuota (+ jumlah pendaftar), Status badge, dan tombol aksi (Edit/Hapus) |
| **`events/create.blade.php`** | Form tambah event: judul, deskripsi, tanggal, lokasi, kuota, status (dropdown), upload poster. Dilengkapi validasi error display dan `old()` value |
| **`events/edit.blade.php`** | Form edit event: sama dengan create tetapi terisi data yang sudah ada. Poster bersifat opsional (tidak wajib diubah) |
| **`registrations/index.blade.php`** | Tabel manajemen pendaftaran: No, Nama Peserta, Event, Tanggal Daftar, Status badge, dan tombol aksi Accept/Reject (form PATCH) |

### 6.6 User Views (`user/`)

| File | Fungsi |
|------|--------|
| **`dashboard.blade.php`** | 3 kartu statistik (Total Terdaftar, Menunggu Konfirmasi, Disetujui) + tabel riwayat pendaftaran (5 kolom: Nama Event, Lokasi, Tgl Pelaksanaan, Tgl Pendaftaran, Status) + Menu Cepat |

### 6.7 Halaman Statis

| File | Fungsi |
|------|--------|
| **`home.blade.php`** | Landing page dengan hero section, kartu event terbaru, dan section fitur |
| **`about.blade.php`** | Halaman tentang sistem: tujuan, fitur utama, dan profil pengembang |

---

## 7. Alur Kerja Sistem

### 7.1 Alur Pendaftaran Event (User Flow)

```
User Login
    │
    ▼
Buka /events ──► Cari Event (Search) ──► Klik "Lihat Detail"
                                              │
                                              ▼
                                     /events/{id} (Detail)
                                              │
                                              ▼
                                    Klik "Daftar Event Sekarang"
                                              │
                                              ▼
                              ┌─── Validasi 6 Aturan Bisnis ───┐
                              │                                 │
                           GAGAL                             BERHASIL
                              │                                 │
                              ▼                                 ▼
                     Flash Error Message              Buat Registration
                     (redirect back)                 (status: pending)
                                                            │
                                                            ▼
                                                  Redirect ke /user/dashboard
                                                  Flash Success Message
```

### 7.2 Alur Pengelolaan Pendaftaran (Admin Flow)

```
Admin Login
    │
    ▼
/admin/dashboard ──► Lihat Statistik
    │
    ▼
/admin/registrations ──► Lihat Daftar Pendaftaran
    │
    ├── Klik "Terima" ──► PATCH status = accepted ──► Flash Success
    │
    └── Klik "Tolak"  ──► PATCH status = rejected ──► Flash Success
```

### 7.3 Alur CRUD Event (Admin Flow)

```
/admin/events ──► Lihat Daftar Event
    │
    ├── "Tambah Event Baru" ──► /admin/events/create ──► Submit Form
    │                               │                        │
    │                          Validasi Gagal            Validasi OK
    │                               │                        │
    │                          Redirect Back          Upload Poster + Simpan DB
    │                          + Error Messages        Redirect ke Index + Success
    │
    ├── Klik Edit ──► /admin/events/{id}/edit ──► Submit Form ──► Update DB
    │                                                (+ hapus poster lama jika diganti)
    │
    └── Klik Hapus ──► Confirm Dialog ──► DELETE ──► Hapus dari DB + Hapus Poster
```

---

## 📝 Catatan Teknis

- **CSRF Protection:** Setiap form menggunakan directive `@csrf` untuk mencegah serangan Cross-Site Request Forgery.
- **Method Spoofing:** Form yang membutuhkan `PUT`, `PATCH`, atau `DELETE` menggunakan `@method('PUT')` / `@method('PATCH')` / `@method('DELETE')`.
- **Eager Loading:** Controller menggunakan `with()` untuk menghindari masalah N+1 query saat memuat relasi.
- **Storage:** File poster disimpan di disk `public` (`storage/app/public/posters/`) dan diakses melalui symbolic link `public/storage`.

---

© 2026 Marvel Jeremia — EventReg Documentation
