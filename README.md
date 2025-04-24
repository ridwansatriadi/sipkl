# SIPKL - Sistem Informasi Praktek Kerja Lapangan

Sistem Informasi PKL berbasis web menggunakan Laravel dan Filament Admin Panel. Aplikasi ini dibuat untuk mempermudah proses pengajuan, monitoring, dan penilaian Praktek Kerja Lapangan (PKL) oleh mahasiswa, Dosen Pembimbing Lapangan (DPL), dan Kaprodi.

## 📦 Fitur Utama

- ✅ Autentikasi dengan peran: Mahasiswa, DPL, dan Kaprodi
- 📨 Pengajuan PKL dan pembuatan surat otomatis
- 📆 Pencatatan Logbook Harian
- 📄 Upload dan Verifikasi Laporan
- 🎯 Penilaian berbasis indikator
- 🔐 Manajemen Role & Permission dengan [Filament Shield](https://github.com/bezhanSalleh/filament-shield)

## 🚀 Tech Stack

- Laravel 10+
- FilamentPHP v3
- MySQL / MariaDB
- Spatie Laravel Permission
- Filament Shield (Role/Permission Management)

## 🛠️ Instalasi

```bash
git clone https://github.com/your-username/sipkl.git
cd sipkl
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
