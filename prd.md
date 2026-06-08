# EventReg: Sistem Pendaftaran dan Pengelolaan Event Sederhana Berbasis Laravel 12

## 1. Informasi Dokumen

| Keterangan | Detail |
|---|---|
| Nama Produk | EventReg |
| Nama Lengkap Produk | Sistem Pendaftaran dan Pengelolaan Event Sederhana |
| Jenis Produk | Website berbasis database |
| Framework | Laravel 12 |
| Frontend | Blade, Bootstrap, CSS, JavaScript |
| Backend | Laravel Controller, Model, Middleware |
| Database | MySQL / MariaDB |
| Target Pengguna | Admin dan User/Peserta |
| Jenis Project | Final Project Pemrograman Web 2026 |
| Pengembang | Marvel Jeremia |

---

## 2. Ringkasan Produk

**EventReg** adalah aplikasi web sederhana yang digunakan untuk mengelola data event dan pendaftaran peserta. Sistem ini memungkinkan admin untuk melakukan pengelolaan event melalui fitur CRUD, sedangkan user dapat melihat daftar event, mencari event, melihat detail event, mendaftar event, dan memantau status pendaftarannya.

EventReg dikembangkan menggunakan **Laravel 12** dengan database **MySQL/MariaDB**. Sistem ini dirancang agar dapat berjalan secara lokal, memiliki tampilan responsif, serta memenuhi kebutuhan utama Final Project Pemrograman Web 2026, yaitu integrasi antarmuka website, logika back-end, database, CRUD, fitur dinamis, dan fitur statis.

---

## 3. Latar Belakang

Pengelolaan event secara manual sering menyebabkan data event dan pendaftar tidak tersusun dengan baik. Informasi event dapat tersebar di berbagai media, sedangkan data peserta sering dikelola melalui dokumen atau form terpisah. Kondisi tersebut membuat admin kesulitan memantau event, jumlah peserta, dan status pendaftaran.

EventReg dibuat sebagai solusi sederhana untuk membantu proses pengelolaan event dan pendaftaran peserta dalam satu sistem berbasis web. Sistem ini memiliki ruang lingkup terbatas agar realistis untuk dikembangkan sebagai Final Project, tetapi tetap memenuhi seluruh ketentuan teknis dan fungsional yang diminta.

---

## 4. Tujuan Produk

Tujuan utama EventReg adalah menyediakan sistem berbasis web untuk mengelola event dan pendaftaran peserta secara sederhana, terstruktur, dan tersimpan permanen di database.

Tujuan khusus sistem ini adalah:

1. Menyediakan fitur CRUD untuk pengelolaan data event.
2. Menyimpan data user, event, dan pendaftaran secara permanen di database.
3. Menyediakan fitur authentication untuk login dan logout.
4. Membedakan hak akses antara admin dan user.
5. Menyediakan fitur pencarian event.
6. Menyediakan dashboard ringkasan untuk admin.
7. Menyediakan validasi form agar data yang masuk sesuai aturan.
8. Menyediakan halaman statis sebagai informasi sistem.
9. Menyediakan tampilan responsif untuk desktop dan mobile.

---

## 5. Target Pengguna

### 5.1 Admin

Admin adalah pengguna yang bertugas mengelola data event dan pendaftaran peserta.

Kebutuhan admin:

- Login ke sistem.
- Melihat dashboard ringkasan.
- Menambah data event.
- Melihat daftar event.
- Mengedit data event.
- Menghapus data event.
- Melihat daftar pendaftaran peserta.
- Mengubah status pendaftaran peserta.

### 5.2 User / Peserta

User adalah pengguna yang ingin melihat dan mendaftar event.

Kebutuhan user:

- Melakukan register akun.
- Login ke sistem.
- Melihat daftar event.
- Mencari event.
- Melihat detail event.
- Mendaftar event.
- Melihat riwayat pendaftaran dan statusnya.

---

## 6. Ruang Lingkup Produk

Ruang lingkup EventReg dibatasi pada fitur inti berikut:

1. Authentication sederhana.
2. Hak akses berdasarkan role admin dan user.
3. CRUD data event.
4. Daftar event untuk user.
5. Detail event.
6. Pendaftaran event oleh user.
7. Riwayat pendaftaran user.
8. Pengelolaan status pendaftaran oleh admin.
9. Dashboard statistik sederhana.
10. Pencarian event.
11. Pagination daftar event.
12. Validasi form.
13. Halaman statis About.
14. Tampilan responsif menggunakan Bootstrap.

---

## 7. Batasan Produk

Agar sistem tidak terlalu luas, EventReg tidak mencakup fitur berikut:

1. Pembayaran event.
2. QR code tiket.
3. Sertifikat otomatis.
4. Email notification.
5. Absensi peserta.
6. Komentar event.
7. Rating event.
8. Multi-admin kompleks.
9. Upload poster event.
10. Kalender event kompleks.
11. Integrasi API eksternal.
12. Chat atau forum diskusi.

Batasan ini dibuat agar sistem tetap fokus pada ketentuan utama Final Project, yaitu CRUD, database, fitur dinamis, fitur statis, dan responsive web.

---

## 8. Fitur Utama Sistem

## 8.1 Authentication

Sistem menyediakan fitur register, login, dan logout.

### Deskripsi

User dapat membuat akun melalui halaman register. Setelah login, sistem akan mengarahkan pengguna ke halaman sesuai role. Admin diarahkan ke dashboard admin, sedangkan user diarahkan ke halaman user atau daftar event.

### Role Pengguna

| Role | Akses |
|---|---|
| Admin | Dashboard admin, CRUD event, kelola pendaftaran |
| User | Daftar event, detail event, pendaftaran event, riwayat pendaftaran |

---

## 8.2 Hak Akses Berdasarkan Role

Sistem membatasi akses halaman berdasarkan role pengguna.

### Aturan Akses

| Halaman | Admin | User | Guest |
|---|---:|---:|---:|
| Landing page | Bisa | Bisa | Bisa |
| Daftar event | Bisa | Bisa | Bisa |
| Detail event | Bisa | Bisa | Bisa |
| About | Bisa | Bisa | Bisa |
| Dashboard admin | Bisa | Tidak | Tidak |
| Kelola event | Bisa | Tidak | Tidak |
| Kelola pendaftaran | Bisa | Tidak | Tidak |
| Riwayat pendaftaran user | Tidak | Bisa | Tidak |
| Daftar event sebagai peserta | Tidak | Bisa | Tidak |

---

## 8.3 CRUD Event

CRUD event adalah fitur utama dalam sistem.

### Akses

Fitur CRUD event hanya dapat digunakan oleh admin.

### Data Event

| Field | Keterangan |
|---|---|
| `title` | Nama event |
| `description` | Deskripsi event |
| `date` | Tanggal pelaksanaan event |
| `location` | Lokasi event |
| `quota` | Kuota peserta |
| `status` | Status event |

### Operasi CRUD

| Operasi | Deskripsi |
|---|---|
| Create | Admin menambahkan event baru |
| Read | Admin dan user dapat melihat daftar event |
| Update | Admin mengubah data event |
| Delete | Admin menghapus data event |

---

## 8.4 Daftar Event

User dapat melihat daftar event yang tersedia.

### Informasi yang Ditampilkan

- Nama event.
- Tanggal event.
- Lokasi event.
- Kuota peserta.
- Status event.
- Tombol detail event.

### Catatan

Daftar event ditampilkan dengan pagination agar halaman tetap rapi ketika jumlah data bertambah.

---

## 8.5 Detail Event

User dapat melihat informasi lengkap dari sebuah event sebelum melakukan pendaftaran.

### Informasi Detail Event

- Nama event.
- Deskripsi event.
- Tanggal event.
- Lokasi event.
- Kuota peserta.
- Jumlah peserta terdaftar.
- Status event.
- Tombol daftar event.

---

## 8.6 Pendaftaran Event

User yang sudah login dapat mendaftar ke event yang tersedia.

### Aturan Pendaftaran

1. User harus login sebelum mendaftar event.
2. User hanya dapat mendaftar satu kali pada event yang sama.
3. User tidak dapat mendaftar jika event berstatus `finished`.
4. User tidak dapat mendaftar jika event berstatus `cancelled`.
5. User tidak dapat mendaftar jika kuota peserta sudah penuh.
6. Status awal pendaftaran adalah `pending`.

---

## 8.7 Riwayat Pendaftaran User

User dapat melihat daftar event yang pernah didaftari.

### Informasi yang Ditampilkan

- Nama event.
- Tanggal event.
- Lokasi event.
- Status pendaftaran.
- Tanggal pendaftaran.

### Status Pendaftaran

| Status | Keterangan |
|---|---|
| `pending` | Pendaftaran sedang menunggu konfirmasi admin |
| `accepted` | Pendaftaran diterima oleh admin |
| `rejected` | Pendaftaran ditolak oleh admin |
| `cancelled` | Pendaftaran dibatalkan |

---

## 8.8 Kelola Pendaftaran Peserta

Admin dapat melihat daftar peserta yang mendaftar event.

### Fitur Admin

- Melihat nama peserta.
- Melihat event yang didaftari.
- Melihat tanggal pendaftaran.
- Melihat status pendaftaran.
- Mengubah status pendaftaran menjadi `accepted` atau `rejected`.

---

## 8.9 Dashboard Admin

Dashboard admin menampilkan ringkasan statistik sistem.

### Data Statistik

| Data | Keterangan |
|---|---|
| Total event | Jumlah seluruh event di database |
| Total user | Jumlah user dengan role peserta |
| Total pendaftaran | Jumlah seluruh data pendaftaran |
| Pendaftaran pending | Jumlah pendaftaran yang belum diproses |

Dashboard ini termasuk fitur dinamis karena data yang ditampilkan berasal langsung dari database.

---

## 8.10 Search Event

User dapat mencari event berdasarkan nama event.

### Contoh

Jika user mengetik kata kunci:

```text
seminar