<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodis = [
            ['nama' => 'Teknologi Informasi'],
            ['nama' => 'Teknik Sipil'],
            ['nama' => 'Ilmu Komputer'],
        ];

        foreach ($prodis as $data) {
        Prodi::create(attributes: [
            'nama' => $data['nama'],
        ]);
        }
    }
}
