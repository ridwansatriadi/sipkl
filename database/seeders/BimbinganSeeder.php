<?php

namespace Database\Seeders;

use App\Models\Bimbingan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BimbinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bimbingans = [
            // Ridwan Satriadi & Sabardi dengan DPL Nuraqilla Widha Bintang Grendis
            [
                'mahasiswa_id' => 1, // Ridwan Satriadi
                'dpl_id' => 1, // Nuraqilla Widha Bintang Grendis
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
            [
                'mahasiswa_id' => 2, // Sabardi
                'dpl_id' => 1, // Nuraqilla Widha Bintang Grendis
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
            // Nindri Lia Desmita & Satria Mulya Jati Apriadi dengan DPL Asno Azzawagama Firdaus
            [
                'mahasiswa_id' => 3, // Nindri Lia Desmita
                'dpl_id' => 2, // Asno Azzawagama Firdaus
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
            [
                'mahasiswa_id' => 4, // Satria Mulya Jati Apriadi
                'dpl_id' => 2, // Asno Azzawagama Firdaus
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
            // Miftahul Jannah dengan DPL Danang Tejo Kumoro
            [
                'mahasiswa_id' => 5, // Miftahul Jannah
                'dpl_id' => 6, // Danang Tejo Kumoro
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
            // Sumarno Wijaya & Viqiami Zulkarnaen dengan DPL Valian Yoga Pudya Ardhana
            [
                'mahasiswa_id' => 6, // Sumarno Wijaya
                'dpl_id' => 4, // Valian Yoga Pudya Ardhana
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
            [
                'mahasiswa_id' => 7, // Viqiami Zulkarnaen
                'dpl_id' => 4, // Valian Yoga Pudya Ardhana
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
            // Syahrul Tamami, Angga Winarta & Satrio Budi Santoso dengan DPL M. Afriansyah
            [
                'mahasiswa_id' => 8, // Syahrul Tamami
                'dpl_id' => 5, // M. Afriansyah
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
            [
                'mahasiswa_id' => 9, // Satrio Budi Santoso
                'dpl_id' => 5, // M. Afriansyah
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
            [
                'mahasiswa_id' => 10, // Angga Winarta
                'dpl_id' => 5, // M. Afriansyah
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
            // Dewe Made Chandra Dika & Abd Rahman dengan DPL Syarifatul ulfah
            [
                'mahasiswa_id' => 11, // Dewe Made Chandra Dika
                'dpl_id' => 3, // Syarifatul ulfah
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
            [
                'mahasiswa_id' => 12, // Abd Rahman
                'dpl_id' => 3, // Syarifatul ulfah
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
            ],
        ];

        foreach ($bimbingans as $bimbingan) {
            Bimbingan::create($bimbingan);
        }
    }
}

