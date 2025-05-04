<?php

namespace Database\Seeders;

use App\Models\Surat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $surats = [
            [
                'pengajuan_id' => 1,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(263 )->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
            [
                'pengajuan_id' => 2,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(263 )->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
            [
                'pengajuan_id' => 3,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(263 )->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
            [
                'pengajuan_id' => 4,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(value: 263)->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
            [
                'pengajuan_id' => 5,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(263 )->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
            [
                'pengajuan_id' => 6,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(263 )->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
            [
                'pengajuan_id' => 7,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(263 )->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
            [
                'pengajuan_id' => 8,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(263 )->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
            [
                'pengajuan_id' => 9,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(263 )->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
            [
                'pengajuan_id' => 10,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(263 )->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
            [
                'pengajuan_id' => 11,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(263 )->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
            [
                'pengajuan_id' => 12,
                'jenis_surat' => 'Surat Permohonan Izin',
                'tanggal_terbit' => Carbon::now()->subDays(263 )->toDateString(),
                'file_surat' => 'surat_rekomendasi_1.pdf',
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-05-01',
            ],
        ];

        foreach ($surats as $data) {
            Surat::create($data);
        }
    }
}
