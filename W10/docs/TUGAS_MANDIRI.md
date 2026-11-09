# Tugas Mandiri Pertemuan 10 — Checklist

Dokumen ini memetakan implementasi proyek ke ketentuan PDF
`pertemuan_10_lengkap_compressed.pdf`.

## Spesifikasi Wajib

| Ketentuan | Implementasi | Lokasi |
|---|---|---|
| Integrasi UI backoffice | Filament v5 panel `/admin` | `app/Providers/Filament/AdminPanelProvider.php` |
| Login via Breeze | Breeze Blade auth, satu halaman `/login` | `resources/views/auth/`, `routes/auth.php` |
| Otorisasi Spatie di database | Tabel permission + role `Admin`/`Staf` | `database/seeders/RolePermissionSeeder.php` |
| Minimal 3 widget agregat | Total Mahasiswa, Dosen, Tugas Aktif | `app/Filament/Widgets/StatOverview.php` |
| Proteksi controller | Middleware `permission:hapus-data` + policy | `app/Http/Controllers/Admin/MahasiswaController.php` |
| Role Admin akses penuh | Semua permission | `RolePermissionSeeder` |
| Role Staf akses terbatas | Semua permission kecuali `hapus-data` | `RolePermissionSeeder` |
| Hapus data hanya Admin | `@can('hapus-data')`, route middleware, policy | `resources/views/filament/pages/pencarian-mahasiswa.blade.php` |

## Tantangan Tambahan

| Tantangan | Implementasi | Lokasi |
|---|---|---|
| Pencarian dengan `when()` | Filter multi-kolom `nama`/`nrp` | `app/Filament/Pages/PencarianMahasiswa.php` |
| `withQueryString()` | Pagination mempertahankan filter | `PencarianMahasiswa::getViewData()` |
| Faker seeder realistis | Factory `id_ID` + seeder 40/12/30 data | `database/factories/`, `database/seeders/` |
| Auto-login akun uji coba | Tombol demo di halaman login | `resources/views/auth/login.blade.php`, `DemoLoginController` |

## Rubrik

| Komponen | Bobot | Bukti |
|---|---:|---|
| Integrasi UI dashboard & widget | 30% | Screenshot dashboard dan CRUD |
| Keamanan otorisasi Spatie RBAC | 30% | Policy, middleware, `@can`, test RBAC |
| Pencarian & filter `when()` | 20% | Halaman Pencarian Mahasiswa + test |
| Kerapian kode PSR-12 | 10% | `vendor/bin/pint --dirty` |
| Demo & presentasi | 10% | Akun demo + auto-login |

## Skenario Demo

1. Login sebagai **Admin** → dashboard → buka Pencarian Mahasiswa → cari/filter → hapus data.
2. Logout, login sebagai **Staf** → dashboard → buka Pencarian Mahasiswa → pastikan tombol hapus tidak muncul.
3. Coba akses URL hapus secara manual sebagai Staf → server mengembalikan **403**.
4. Login sebagai **Mahasiswa** → diarahkan ke beranda publik dan ditolak saat membuka `/admin`.
