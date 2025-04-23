<?php

namespace Database\Seeders;

use App\Models\SuratBalasan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuratBalasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $surat_balasans = [
            [
                'pengajuan_id' => 1,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],
            [
                'pengajuan_id' => 2,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],
            [
                'pengajuan_id' => 3,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],
            [
                'pengajuan_id' => 4,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],
            [
                'pengajuan_id' => 5,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],
            [
                'pengajuan_id' => 6,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],
            [
                'pengajuan_id' => 7,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],
            [
                'pengajuan_id' => 8,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],
            [
                'pengajuan_id' => 9,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],
            [
                'pengajuan_id' => 10,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],
            [
                'pengajuan_id' => 11,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],
            [
                'pengajuan_id' => 12,
                'file' => 'surat_balasan.pdf',
                'tanggal_upload' => '2024-07-29',
                'status' => 'disetujui',
            ],

        ];

        foreach ($surat_balasans as $data) {
            SuratBalasan::create($data);
        }
    }
}
