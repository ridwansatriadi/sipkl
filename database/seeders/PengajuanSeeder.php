<?php

namespace Database\Seeders;

use App\Models\Pengajuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengajuans = [
            // Ridwan Satriadi & Sabardi - PT. Lallo Digital Nusa Global
            ['mahasiswa_id' => 1, 'nama_instansi' => 'PT. Lallo Digital Nusa Global', 'alamat_instansi' => 'Jl. Merdeka No. 12, Mataram', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],
            ['mahasiswa_id' => 2, 'nama_instansi' => 'PT. Lallo Digital Nusa Global', 'alamat_instansi' => 'Jl. Merdeka No. 12, Mataram', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],

            // Nindri & Satria - Diskominfo NTB
            ['mahasiswa_id' => 3, 'nama_instansi' => 'Dinas Komunikasi Informatika dan Statistik Pemerintah Provinsi NTB', 'alamat_instansi' => 'Jl. Langko No. 32, Mataram', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],
            ['mahasiswa_id' => 4, 'nama_instansi' => 'Dinas Komunikasi Informatika dan Statistik Pemerintah Provinsi NTB', 'alamat_instansi' => 'Jl. Langko No. 32, Mataram', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],

            // Miftahul Jannah - Dispar Loteng
            ['mahasiswa_id' => 5, 'nama_instansi' => 'Dinas Pariwisata kab.Loteng', 'alamat_instansi' => 'Jl. Raya Praya No. 88, Lombok Tengah', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],

            // Sumarno & Viqiami - CV. LIGHTHOUSE
            ['mahasiswa_id' => 6, 'nama_instansi' => 'CV. LIGHTHOUSE INFORMATIKA SOLUSINDO', 'alamat_instansi' => 'Jl. Pendidikan No. 45, Mataram', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],
            ['mahasiswa_id' => 7, 'nama_instansi' => 'CV. LIGHTHOUSE INFORMATIKA SOLUSINDO', 'alamat_instansi' => 'Jl. Pendidikan No. 45, Mataram', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],

            // Syahrul, Angga, Satrio - Abhinaya
            ['mahasiswa_id' => 8, 'nama_instansi' => 'CV. Abhinaya Indo Group', 'alamat_instansi' => 'Jl. Swakarya No. 27, Mataram', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],
            ['mahasiswa_id' => 9, 'nama_instansi' => 'CV. Abhinaya Indo Group', 'alamat_instansi' => 'Jl. Swakarya No. 27, Mataram', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],
            ['mahasiswa_id' => 10, 'nama_instansi' => 'CV. Abhinaya Indo Group', 'alamat_instansi' => 'Jl. Swakarya No. 27, Mataram', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],

            // Dewe & Rahman - Gudang Garam
            ['mahasiswa_id' => 11, 'nama_instansi' => 'PT. Gudang Garam', 'alamat_instansi' => 'Jl. Industri No. 17, Kediri', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],
            ['mahasiswa_id' => 12, 'nama_instansi' => 'PT. Gudang Garam', 'alamat_instansi' => 'Jl. Industri No. 17, Kediri', 'status' => 'Diterima', 'tanggal_pengajuan' => '2024-07-24'],
        ];

        foreach ($pengajuans as $data) {
            Pengajuan::create($data);
        }
    }
}
