<?php

namespace Database\Seeders;

use App\Models\Kaprodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kaprodis = [
            [
                'user_id' => 2, // Syahrani Lonang
                'nidn' => 1984121001,
                'prodi_id' => 1, // Teknologi Informasi
            ],
            [
                'user_id' => 3, // Ahmad Fatoni Dwi Putra
                'nidn' => 1985022202,
                'prodi_id' => 2, // Ilmu Komputer
            ],
            [
                'user_id' => 4, // Bagus
                'nidn' => 1983031103,
                'prodi_id' => 3, // Teknik Sipil
            ],
        ];

        foreach ($kaprodis as $data) {
            Kaprodi::create($data);
        }
    }
}
