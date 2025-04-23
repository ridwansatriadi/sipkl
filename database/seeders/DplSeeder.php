<?php

namespace Database\Seeders;

use App\Models\Dpl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DplSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dpls = [
            [
                'user_id' => 17, // Nuraqilla Widha Bintang Grendis
                'nidn' => '10101010',
                'bidang_keahlian' => 'Sistem Informasi',
            ],
            [
                'user_id' => 18, // Asno Azzawagama Firdaus
                'nidn' => '20202020',
                'bidang_keahlian' => 'Jaringan Komputer',
            ],
            [
                'user_id' => 19, // Syarifatul Ulfah
                'nidn' => '30303030',
                'bidang_keahlian' => 'Manajemen Konstruks',
            ],
            [
                'user_id' => 20, // Valian Yoga Pudya Ardhana
                'nidn' => '40404040',
                'bidang_keahlian' => 'Jaringan Komputer',
            ],
            [
                'user_id' => 21, // M. Afriansyah
                'nidn' => '50505050',
                'bidang_keahlian' => 'Jaringan Komputer',
            ],
            [
                'user_id' => 22, // Danang Tejo Kumoro
                'nidn' => '60606060',
                'bidang_keahlian' => 'UI/UX',
            ],
        ];

        foreach ($dpls as $dpl) {
            Dpl::create($dpl);
        }
    }
}
