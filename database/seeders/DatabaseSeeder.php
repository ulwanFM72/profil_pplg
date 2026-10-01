<?php

namespace Database\Seeders;

use App\Models\{Angkatan, Asset, Galeri, Laboratorium, Profil, ProgramKeahlian, Sejarah, Statistik, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun default hanya untuk awal instalasi — SEGERA ganti lewat:
        //   php artisan admin:credentials
        User::updateOrCreate(['username' => 'admin'], [
            'name' => 'Administrator',
            'email' => 'admin@smk.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $p = ProgramKeahlian::create([
            'nama' => 'Rekayasa Perangkat Lunak',
            'kompetensi' => 'Pengembangan Perangkat Lunak dan Gim',
            'tagline' => 'Belajar, berkarya, siap kerja.',
            'tahun_berdiri' => 2005,
            'akreditasi' => 'A',
            'deskripsi' => 'Program Keahlian Pengembangan Perangkat Lunak dan Gim (PPLG) merupakan bidang keahlian yang mempelajari pembuatan dan pengembangan perangkat lunak, website, aplikasi, serta gim. Siswa akan mempelajari pemrograman, basis data, desain antarmuka, dan teknologi digital.
Melalui pembelajaran teori dan praktik, siswa PPLG dipersiapkan untuk memiliki keterampilan di bidang teknologi informasi. Lulusannya dapat berkarier sebagai web developer, software developer, game developer, UI/UX designer, maupun mengembangkan produk digital secara mandiri.',
            'jumlah_guru' => 12,
            'jumlah_siswa' => 360,
        ]);

        Profil::create([
            'program_keahlian_id' => $p->id,
            'nama' => 'Nama Kaprog',
            'gelar' => 'S.Kom., M.T.',
            'deskripsi' => 'Memimpin pengembangan kurikulum dan kerja sama industri.',
        ]);

        $s = Sejarah::create(['program_keahlian_id' => $p->id, 'judul' => 'Perjalanan Kami', 'narasi' => 'Sejarah singkat program keahlian.']);
        foreach (
            [
                [2005, 'Program keahlian didirikan'],
                [2010, 'Pengembangan laboratorium'],
                [2015, 'Penambahan fasilitas praktik'],
                [2020, 'Kerja sama dengan industri'],
                [2025, 'Pengembangan program dan fasilitas']
            ] as $i => [$th, $j]
        ) {
            $s->timeline()->create(['tahun' => $th, 'judul' => $j, 'urutan' => $i]);
        }

        foreach (['Lab Pemrograman', 'Lab Jaringan', 'Lab Multimedia'] as $i => $nama) {
            $lab = Laboratorium::create([
                'program_keahlian_id' => $p->id,
                'nama' => $nama,
                'slug' => Str::slug($nama),
                'kapasitas' => 36,
                'lokasi' => 'Gedung B Lantai ' . ($i + 1),
                'fasilitas' => ['AC', 'Proyektor', 'Internet', 'Whiteboard'],
                'deskripsi' => "Ruang praktik $nama.",
            ]);
            Asset::create([
                'laboratorium_id' => $lab->id,
                'nama' => 'Komputer Desktop',
                'kategori' => 'Komputer',
                'jumlah' => 36,
                'kondisi' => 'baik',
                'tahun_pengadaan' => 2022
            ]);
        }

        foreach ([2022, 2023, 2024] as $th) {
            $a = Angkatan::create(['tahun' => $th, 'nama' => "Angkatan $th"]);
            Galeri::create([
                'angkatan_id' => $a->id,
                'judul' => "Dokumentasi Angkatan $th",
                'foto' => 'galeri/placeholder.jpg',
                'kategori' => 'Angkatan',
                'tahun' => $th
            ]);
        }

        foreach ([['Siswa', 360], ['Guru', 12], ['Laboratorium', 3], ['Angkatan', 3]] as $i => [$l, $n]) {
            Statistik::create(['label' => $l, 'nilai' => $n, 'urutan' => $i]);
        }
    }
}
