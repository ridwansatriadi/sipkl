<?php

namespace Database\Seeders;

use App\Models\Nilai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nilais = [
            [
                'bimbingan_id' => 1,
                'pengamatan' => 90,
                'kesimpulan' => 85,
                'sistematika' => 88,
                'bahasa' => 87,
                'jumlah' => 90 + 85 + 88 + 87,
                'nilai' => (90 + 85 + 88 + 87) / 4,
            ],
            [
                'bimbingan_id' => 2,
                'pengamatan' => 92,
                'kesimpulan' => 89,
                'sistematika' => 91,
                'bahasa' => 88,
                'jumlah' => 92 + 89 + 91 + 88,
                'nilai' => (92 + 89 + 91 + 88) / 4,
            ],
            [
                'bimbingan_id' => 3,
                'pengamatan' => 86,
                'kesimpulan' => 90,
                'sistematika' => 85,
                'bahasa' => 91,
                'jumlah' => 86 + 90 + 85 + 91,
                'nilai' => (86 + 90 + 85 + 91) / 4,
            ],
            [
                'bimbingan_id' => 4,
                'pengamatan' => 95,
                'kesimpulan' => 90,
                'sistematika' => 91,
                'bahasa' => 93,
                'jumlah' => 95 + 90 + 91 + 93,
                'nilai' => (95 + 90 + 91 + 93) / 4,
            ],
            [
                'bimbingan_id' => 5,
                'pengamatan' => 83,
                'kesimpulan' => 86,
                'sistematika' => 87,
                'bahasa' => 85,
                'jumlah' => 83 + 86 + 87 + 85,
                'nilai' => (83 + 86 + 87 + 85) / 4,
            ],
            [
                'bimbingan_id' => 6,
                'pengamatan' => 88,
                'kesimpulan' => 90,
                'sistematika' => 89,
                'bahasa' => 89,
                'jumlah' => 88 + 90 + 89 + 89,
                'nilai' => (88 + 90 + 89 + 89) / 4,
            ],
        ];
        
        foreach ($nilais as $data) {
            Nilai::create($data);
        }
    }
}
