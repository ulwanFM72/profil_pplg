# Website Profil Program Keahlian SMK

Website profil program keahlian dengan Admin Dashboard CRUD penuh. Laravel (Blade + Tailwind
CSS untuk halaman publik, Vue 3 sebagai "island" untuk bagian interaktif seperti lightbox
galeri, Bootstrap 5 untuk Admin Dashboard), MySQL/MariaDB, gaya visual Neo-Brutalism
(merah–putih–hitam).

## Ringkasan arsitektur

| Bagian | Teknologi | Alasan |
|---|---|---|
| Backend | Laravel 11 (MVC) | Auth, validasi, upload, dan CRUD sudah tersedia bawaan. |
| Halaman publik | Blade + Tailwind CSS | Dirender di server → cepat & ramah SEO. |
| Interaktivitas publik | Vue 3 (island) | Hanya untuk lightbox galeri; grid tetap Blade. |
| Admin Dashboard | Blade + Bootstrap 5 | Tabel, form, modal siap pakai; bundle CSS terpisah dari Tailwind. |
| Database | MySQL / MariaDB | — |

React dan Next.js sengaja tidak dipakai — lihat alasan lengkap di catatan Tahap 1 percakapan
pengembangan proyek ini.

## Prasyarat

- PHP ≥ 8.2 dengan ekstensi: `pdo_mysql`, `mbstring`, `gd` (untuk kompresi gambar ke WEBP;
  fitur upload tetap jalan tanpa GD, hanya tanpa kompresi)
- Composer 2
- Node.js ≥ 18 & npm
- MySQL 8 / MariaDB 10.6+

## Instalasi dari nol

```bash
# 1. Dependensi PHP & JS
composer install
npm install
npm i vue @vitejs/plugin-vue bootstrap @popperjs/core chart.js

# 2. Environment
cp .env.example .env
php artisan key:generate
```

Edit `.env`, isi kredensial database Anda dan tambahkan:

```env
FILESYSTEM_DISK=public
APP_NAME="Program Keahlian SMK"
```

```bash
# 3. Database
php artisan migrate --seed

# 4. Symlink storage (WAJIB — tanpa ini gambar upload 404 di halaman publik)
php artisan storage:link

# 5. Build aset frontend
npm run dev      # mode pengembangan (hot reload)
# atau:
npm run build     # build produksi

# 6. Jalankan server
php artisan serve
```

Buka `http://localhost:8000` untuk situs publik, dan `http://localhost:8000/admin/login`
untuk Admin Dashboard.

**Akun admin bawaan dari seeder** (ganti passwordnya sebelum dipakai di server sungguhan):

```
Email    : admin@smk.test
Password : password
```

## Menjalankan test

```bash
cp .env .env.testing   # ubah DB_DATABASE ke database testing yang terpisah dari database utama
php artisan test
```

## Struktur folder singkat

```
app/
├── Http/Controllers/{Admin,Site}/   # Admin = dashboard, Site = halaman publik
├── Http/Requests/Admin/             # Validasi tiap modul
├── Models/                          # ProgramKeahlian, Profil, Sejarah, Timeline,
│                                     # Laboratorium, Asset, Galeri, Angkatan, Statistik
├── Services/                        # ImageUploadService, DashboardService
database/{migrations,seeders,factories}/
resources/
├── css/{public,admin}.css           # Tailwind (publik) & Bootstrap 5 (admin), terpisah
├── js/{public,admin}.js             # + components/Lightbox.vue
├── views/{site,admin,partials,components}/
routes/{web,admin,console}.php
storage/app/public/{profile,laboratorium,asset,galeri,angkatan,logo}/
tests/Feature/{Admin,Public}/
```

## Rute utama

**Publik:** `/`, `/profil`, `/laboratorium`, `/laboratorium/{slug}`, `/asset`, `/galeri`

**Admin** (butuh login, prefix `/admin`): `dashboard`, `profil`, `sejarah`, `timeline`,
`laboratorium`, `asset`, `galeri`, `angkatan`, `statistik` — semua dengan CRUD penuh
(index/create/store/edit/update/destroy) kecuali `profil` & `sejarah` yang berupa satu
halaman edit langsung.

## Peran pengguna

- **admin** — akses penuh, termasuk menghapus data.
- **editor** — bisa menambah dan mengubah data, **tidak bisa menghapus** (mendapat 403).

## Troubleshooting cepat

| Gejala | Kemungkinan penyebab |
|---|---|
| Gambar upload 404 | Lupa `php artisan storage:link` |
| Halaman `/` menampilkan 503 | Tabel `program_keahlian` masih kosong — isi lewat `/admin/profil`, atau jalankan `php artisan migrate --seed` |
| Tampilan admin & publik bentrok/berantakan | Pastikan `npm run build`/`npm run dev` sudah dijalankan ulang setelah menambah file di `resources/` |
| Upload gambar besar selalu gagal | Cek juga `upload_max_filesize` & `post_max_size` di `php.ini`, bukan hanya validasi Laravel |
# profil_pplg
