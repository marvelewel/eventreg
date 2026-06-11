# EventReg - Sistem Manajemen Pendaftaran Event

**EventReg** adalah aplikasi web untuk mengelola data event dan pendaftaran peserta, dibangun menggunakan **Laravel 12** dan **Tailwind CSS**. Sistem ini mendukung dua peran pengguna: **Admin** (mengelola event dan pendaftaran) dan **User/Peserta** (mendaftar event dan memantau status). Sistem kini dilengkapi dengan dukungan fitur **Event Berbayar (Paid Events)** beserta alur unggah bukti pembayaran yang terintegrasi.

Dikembangkan oleh **Marvel Jeremia** sebagai Final Project Pemrograman Web 2026.

---

## 📋 Daftar Isi

- [Persyaratan Sistem](#-persyaratan-sistem)
- [Langkah Instalasi](#-langkah-instalasi)
- [Setup Database](#-setup-database)
- [Setup Storage Link](#-setup-storage-link)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Akun Testing](#-akun-testing)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)

---

## 🖥 Persyaratan Sistem

Pastikan perangkat Anda telah memenuhi persyaratan berikut sebelum melakukan instalasi:

| Persyaratan | Versi Minimum |
|-------------|---------------|
| PHP | >= 8.2 |
| Composer | >= 2.x |
| Node.js | >= 18.x |
| NPM | >= 9.x |
| MySQL / MariaDB | >= 8.0 / 10.x |

---

## 🚀 Langkah Instalasi

### 1. Clone atau Ekstrak Project

```bash
git clone https://github.com/username/eventreg.git
cd eventreg
```

Atau ekstrak file `.zip` project, lalu buka terminal di dalam direktori project tersebut.

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Install Dependensi Frontend & Compile Asset

```bash
npm install
npm run build
```

Perintah `npm run build` akan mengompilasi Tailwind CSS dan JavaScript menjadi file produksi yang siap digunakan.

### 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Buka file `.env` dan sesuaikan konfigurasi database dengan pengaturan lokal Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eventreg_db
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan:** Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan kredensial MySQL/MariaDB di perangkat Anda.

### 5. Generate Application Key

```bash
php artisan key:generate
```

---

## 🗄 Setup Database

Buat database baru di MySQL/MariaDB dengan nama sesuai konfigurasi `.env` (contoh: `eventreg_db`). Kemudian pilih **salah satu** opsi berikut:

### Opsi 1: Otomatis via Artisan (Disarankan)

```bash
php artisan migrate:fresh --seed
```

Perintah ini akan:
- Membuat seluruh tabel yang dibutuhkan (users, events, registrations, dll.) beserta kolom `price` dan `payment_proof`.
- Mengisi data dummy secara otomatis (akun admin, akun peserta, dan 3 event contoh)

### Opsi 2: Import Manual via SQL

Import file `eventreg_db.sql` yang tersedia di root project langsung ke database menggunakan tools seperti **phpMyAdmin**, **TablePlus**, atau command line:

```bash
mysql -u root -p eventreg_db < eventreg_db.sql
```

> **Catatan:** Pastikan database `eventreg_db` sudah dibuat terlebih dahulu sebelum melakukan import.

---

## 🔗 Setup Storage Link

**Langkah ini wajib dilakukan** agar gambar poster event yang diunggah oleh admin dapat ditampilkan di halaman publik website.

```bash
php artisan storage:link
```

Perintah ini membuat symbolic link dari `public/storage` ke `storage/app/public`, sehingga file yang diunggah dapat diakses melalui URL publik.

---

## ▶ Menjalankan Aplikasi

Jalankan server development Laravel:

```bash
php artisan serve
```

Akses aplikasi melalui browser di alamat:

```
http://localhost:8000
```

> **Tips:** Jika menggunakan `npm run dev` (bukan `npm run build`), jalankan perintah tersebut di terminal terpisah agar Vite melakukan hot-reload saat pengembangan.

---

## 🔑 Akun Testing

Berikut adalah akun default yang sudah tersedia setelah menjalankan seeder:

### Admin
| Field | Value |
|-------|-------|
| Email | `admin@eventreg.com` |
| Password | `password` |
| Akses | Dashboard Admin, CRUD Event, Kelola Pendaftaran |

### Peserta (User)
| Field | Value |
|-------|-------|
| Email | `peserta@eventreg.com` |
| Password | `password` |
| Akses | Dashboard User, Daftar Event, Riwayat Pendaftaran |

---

## ✨ Fitur Utama

### Fitur Admin
- 📊 **Dashboard** — Ringkasan statistik (total event, total user, total pendaftaran, pending)
- 📝 **CRUD Event** — Tambah, lihat, edit, dan hapus event dengan upload poster
- ✅ **Kelola Pendaftaran** — Terima (Accept) atau Tolak (Reject) pendaftaran peserta

### Fitur User / Peserta
- 🔍 **Pencarian Event** — Cari event berdasarkan judul
- 📋 **Detail Event** — Lihat informasi lengkap event beserta kuota dan status
- 📝 **Pendaftaran Event** — Daftar event dengan validasi otomatis (cek kuota, cek duplikasi, cek status)
- 📈 **Riwayat Pendaftaran** — Pantau status pendaftaran (Pending / Accepted / Rejected)

### Fitur Umum
- 🔐 **Autentikasi** — Register, Login, dan Logout dengan session
- 🛡 **Hak Akses** — Middleware role-based (admin vs user) dengan proteksi 403
- 📱 **Responsif** — Tampilan responsif untuk desktop dan mobile (Tailwind CSS)
- 📄 **Halaman Statis** — Halaman About sebagai informasi sistem
- 📦 **Pagination** — Daftar event dengan pagination untuk performa optimal

---

## 🛠 Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|-----------|
| **Laravel 12** | Framework PHP untuk backend |
| **Blade** | Template engine untuk frontend |
| **Tailwind CSS** | CSS framework untuk styling responsif |
| **Alpine.js** | Library JavaScript ringan untuk interaktivitas |
| **MySQL / MariaDB** | Database relasional |
| **Vite** | Build tool untuk kompilasi asset |
| **Bootstrap Icons** | Library ikon |
| **Google Fonts (Inter)** | Tipografi modern |

---

## 📁 Struktur Direktori Utama

```
eventreg/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # Controller untuk admin (Dashboard, Event CRUD, Registrasi)
│   │   │   ├── User/            # Controller untuk user (Dashboard, Pendaftaran)
│   │   │   ├── AuthController   # Login, Register, Logout
│   │   │   ├── EventController  # Daftar & Detail event publik
│   │   │   └── HomeController   # Halaman beranda
│   │   └── Middleware/
│   │       └── RoleMiddleware   # Proteksi akses berdasarkan role
│   └── Models/                  # Model Eloquent (User, Event, Registration)
├── database/
│   ├── migrations/              # Skema tabel database
│   └── seeders/                 # Data dummy (admin, user, event)
├── resources/views/
│   ├── admin/                   # View halaman admin
│   ├── auth/                    # View login & register
│   ├── events/                  # View daftar & detail event
│   ├── layouts/                 # Layout utama (app.blade.php)
│   ├── partials/                # Komponen (navbar)
│   └── user/                    # View dashboard user
├── routes/web.php               # Definisi semua route
├── eventreg_db.sql              # File SQL untuk import manual
└── prd.md                       # Dokumen Product Requirements
```

---

## 📝 Lisensi

Project ini dikembangkan untuk keperluan akademik — Final Project Pemrograman Web 2026.

© 2026 Marvel Jeremia. Hak Cipta Dilindungi.
