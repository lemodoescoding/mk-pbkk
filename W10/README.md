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

## Halaman Login

<img width="872" height="648" alt="image" src="https://github.com/user-attachments/assets/23154c8a-8cd1-4cf1-ab03-d88b26c0bc14" />

## Login sebagai Admin (dapat edit, delete)

<img width="1363" height="663" alt="image" src="https://github.com/user-attachments/assets/492f6310-a861-4d85-b88c-d19e38641b3d" />
<img width="1365" height="660" alt="image" src="https://github.com/user-attachments/assets/cecdf077-734f-4b8b-8d94-1be9027799f8" />

## Login sebagai Staf (tanpa delete data)

<img width="1365" height="663" alt="image" src="https://github.com/user-attachments/assets/8f15ce07-5c9d-44f0-81e1-90d81a0b6da9" />
<img width="1365" height="664" alt="image" src="https://github.com/user-attachments/assets/6ab09dc7-fdd7-4c9b-8512-ffeccb2f0713" />

## Login sebagai Mahasiswa (no access to admin dashboard, redirected to beranda/homepage)

<img width="1365" height="707" alt="image" src="https://github.com/user-attachments/assets/a263dce0-3516-4ef0-9d46-30333363ba04" />

## License

MIT
