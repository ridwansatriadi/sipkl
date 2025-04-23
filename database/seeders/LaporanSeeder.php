<?php

namespace Database\Seeders;

use App\Models\laporan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporans = [
            [
                'bimbingan_id' => 1,
                'file_laporan' => 'laporan_2101010001.pdf',
                'status_verifikasi' => 'disetujui',
                'keterangan' => 'Laporan telah diterima dan dinyatakan lengkap.'
            ],
            [
                'bimbingan_id' => 2,
                'file_laporan' => 'laporan_2101010002.pdf',
                'status_verifikasi' => 'disetujui',
                'keterangan' => 'Laporan sesuai dengan pedoman PKL.'
            ],
            [
                'bimbingan_id' => 3,
                'file_laporan' => 'laporan_2101010003.pdf',
                'status_verifikasi' => 'pending',
                'keterangan' => 'Menunggu verifikasi oleh DPL.'
            ],
            [
                'bimbingan_id' => 4,
                'file_laporan' => 'laporan_2101010004.pdf',
                'status_verifikasi' => 'pending',
                'keterangan' => 'Belum dicek oleh pembimbing.'
            ],
            [
                'bimbingan_id' => 5,
                'file_laporan' => 'laporan_2101010005.pdf',
                'status_verifikasi' => 'ditolak',
                'keterangan' => 'Format laporan tidak sesuai.'
            ],
            [
                'bimbingan_id' => 6,
                'file_laporan' => 'laporan_2101020001.pdf',
                'status_verifikasi' => 'disetujui',
                'keterangan' => 'Sudah melalui proses revisi dan disetujui.'
            ],
            [
                'bimbingan_id' => 7,
                'file_laporan' => 'laporan_2101020002.pdf',
                'status_verifikasi' => 'pending',
                'keterangan' => 'Perlu perbaikan pada bagian kesimpulan.'
            ],
        ];        

        foreach ($laporans as $data) {
            laporan::create($data);
        }
    }
}
