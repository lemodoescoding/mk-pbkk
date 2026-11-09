# Tugas W10 PBKK - Portal Akademik ITS

| Name           | NRP        |
| ---            | ---        | 
| Ahmad Satrio Arrohman | 5025241061 |

Aplikasi Laravel 13 untuk Tugas Mandiri Pertemuan 10: **Admin Dashboard & Role-Based Access Control**.

Fitur utama:

- Public academic mini-site (beranda, profil mahasiswa, ide riset Agentic AI)
- Admin panel berbasis **Filament v5** pada `/admin`
- Autentikasi **Laravel Breeze** sebagai satu-satunya halaman login
- Otorisasi dinamis **Spatie Laravel Permission** dengan role `Admin` dan `Staf`
- Widget statistik dashboard dari kueri `count()` model
- Pencarian/filter memakai `when()` dan pagination `withQueryString()`
- Faker seeder untuk data mahasiswa, dosen, dan tugas
- Tombol auto-login akun demo (hanya aktif di environment `local`/`testing`)

## Prerequisites

Pastikan terpasang:

- PHP 8.3 atau lebih baru
- Composer
- Node.js 20.19+ atau 22.12+
- NPM
- Ekstensi PHP **`intl`** (wajib untuk Filament)

Cek versi:

```bash
php -v
composer -V
node -v
npm -v
php -m | grep intl
```

Jika `intl` belum ada (Fedora/RHEL):

```bash
sudo dnf install php-intl
```

Untuk distro lain, install paket `php-intl` / `php8.x-intl` sesuai sistem.

## Installation

### 1. Install dependency PHP

```bash
composer install
```

### 2. Install dependency JavaScript

```bash
npm install
```

### 3. Siapkan environment

```bash
cp .env.example .env
php artisan key:generate
```

Pastikan `DB_CONNECTION=sqlite` di `.env`, lalu buat file database jika belum ada:

```bash
touch database/database.sqlite
```

### 4. Jalankan migrasi dan seeder

```bash
php artisan migrate
php artisan db:seed
php artisan filament:assets
```

> **Catatan:** jangan gunakan `migrate:fresh` jika database sudah berisi data.
> Seeder pada proyek ini bersifat idempotent dan tidak menghapus data lama.
> Data dummy hanya dibuat jika tabel terkait masih kosong.

### 5. Build asset frontend

```bash
npm run build
```

atau untuk development:

```bash
npm run dev
```

## Running the Application

Jalankan Laravel:

```bash
php artisan serve
```

Buka:

```text
http://127.0.0.1:8000
```

Admin panel:

```text
http://127.0.0.1:8000/admin
```

Login:

```text
http://127.0.0.1:8000/login
```

## Demo Accounts

Semua akun demo memakai password: **`password`**

| Role | Email | Akses |
|---|---|---|
| Admin | `admin@demo.test` | Akses penuh, termasuk hapus data |
| Staf | `staf@demo.test` | Dashboard + CRUD, tanpa hapus data |
| Mahasiswa | `mahasiswa@demo.test` | Tidak bisa masuk panel admin |

Pada halaman login juga tersedia tombol **Auto-Login Akun Demo** saat `APP_ENV=local`.
Tombol tersebut otomatis nonaktif di production.

## License

MIT
