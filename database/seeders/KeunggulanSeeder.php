<?php

namespace Database\Seeders;

use App\Models\Keunggulan;
use Illuminate\Database\Seeder;

class KeunggulanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul' => 'Fasilitas Laboratorium', 'teks' => 'Ruang praktik lengkap dengan perangkat yang terawat.', 'warna' => 'bg-sun'],
            ['judul' => 'Tenaga Pengajar', 'teks' => 'Guru produktif berpengalaman dan tersertifikasi.', 'warna' => 'bg-sky'],
            ['judul' => 'Kurikulum', 'teks' => 'Selaras dengan kebutuhan dunia usaha dan industri.', 'warna' => 'bg-leaf'],
            ['judul' => 'Kegiatan Praktik', 'teks' => 'Belajar langsung lewat proyek nyata setiap semester.', 'warna' => 'bg-brand text-white'],
            ['judul' => 'Sertifikasi', 'teks' => 'Uji kompetensi untuk bekal kerja lulusan.', 'warna' => 'bg-sun'],
            ['judul' => 'Kerja Sama Industri', 'teks' => 'Kunjungan, magang, dan kelas industri.', 'warna' => 'bg-sky'],
        ];

        foreach ($data as $i => $item) {
            Keunggulan::create($item + ['urutan' => $i]);
        }
    }
}
