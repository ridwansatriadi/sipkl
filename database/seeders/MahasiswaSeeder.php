<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswas = [
            // Prodi: Teknologi Informasi (id: 1)
            ['user_id' => 5,  'nim' => '2101010001', 'prodi_id' => 1, 'angkatan' => '2021'], // Ridwan Satriadi
            ['user_id' => 6,  'nim' => '2101010002', 'prodi_id' => 1, 'angkatan' => '2021'], // Sabardi
            ['user_id' => 7,  'nim' => '2101010003', 'prodi_id' => 1, 'angkatan' => '2021'], // Nindri Lia
            ['user_id' => 8,  'nim' => '2101010004', 'prodi_id' => 1, 'angkatan' => '2021'], // Satria Mulya
            ['user_id' => 9,  'nim' => '2101010005', 'prodi_id' => 1, 'angkatan' => '2021'], // Miftahul Jannah

            // Prodi: Ilmu Komputer (id: 2)
            ['user_id' => 10, 'nim' => '2101020001', 'prodi_id' => 3, 'angkatan' => '2021'], // Sumarno
            ['user_id' => 11, 'nim' => '2101020002', 'prodi_id' => 3, 'angkatan' => '2021'], // Viqiami
            ['user_id' => 12, 'nim' => '2101020003', 'prodi_id' => 3, 'angkatan' => '2021'], // Syahrul
            ['user_id' => 13, 'nim' => '2101020004', 'prodi_id' => 3, 'angkatan' => '2021'], // satrio
            ['user_id' => 14, 'nim' => '2101020004', 'prodi_id' => 3, 'angkatan' => '2021'], // Angga

            // Prodi: Teknik Sipil (id: 3)
            ['user_id' => 15, 'nim' => '2101030001', 'prodi_id' => 2, 'angkatan' => '2021'], // Dewe
            ['user_id' => 16, 'nim' => '2101030002', 'prodi_id' => 2, 'angkatan' => '2021'], // Rahman
        ];

        foreach ($mahasiswas as $data) {
            Mahasiswa::create([
                'user_id'   => $data['user_id'],
                'nim'       => $data['nim'],
                'prodi_id'  => $data['prodi_id'],
                'angkatan'  => $data['angkatan'],
            ]);
        }
    }
}
