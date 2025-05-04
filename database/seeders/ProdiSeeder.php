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
            ['nama' => 'Teknologi Informasi','kode' => 'TI'],
            ['nama' => 'Teknik Sipil','kode' => 'SIPIL'],
            ['nama' => 'Ilmu Komputer','kode' => 'ILKOM'],
        ];

        foreach ($prodis as $data) {
        Prodi::create(attributes: [
            'nama' => $data['nama'],
            'kode' => $data['kode'],
        ]);
        }
    }
}
