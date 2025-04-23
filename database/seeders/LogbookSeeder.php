<?php

namespace Database\Seeders;

use App\Models\Logbook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logbooks = [
            // Mahasiswa 1 - Ridwan Satriadi
            [
                'bimbingan_id' => 1, // Ridwan Satriadi
                'tanggal' => '2024-08-01',
                'kegiatan' => 'Melakukan observasi lapangan dan wawancara dengan pihak terkait.',
                'dokumentasi' => 'document_1.jpg',
                'status_verifikasi' => 'verifikasi',
            ],
            [
                'bimbingan_id' => 1, // Ridwan Satriadi
                'tanggal' => '2024-08-02',
                'kegiatan' => 'Menganalisis data yang dikumpulkan selama observasi lapangan.',
                'dokumentasi' => 'document_2.jpg',
                'status_verifikasi' => 'belum_verifikasi',
            ],
            // Mahasiswa 2 - Sabardi
            [
                'bimbingan_id' => 2, // Sabardi
                'tanggal' => '2024-08-01',
                'kegiatan' => 'Melakukan penelitian dan mengumpulkan referensi terkait dengan topik PKL.',
                'dokumentasi' => 'document_3.jpg',
                'status_verifikasi' => 'verifikasi',
            ],
            [
                'bimbingan_id' => 2, // Sabardi
                'tanggal' => '2024-08-02',
                'kegiatan' => 'Menyusun laporan sementara untuk tahap pertama.',
                'dokumentasi' => 'document_4.jpg',
                'status_verifikasi' => 'belum_verifikasi',
            ],
            // Mahasiswa 3 - Nindri Lia
            [
                'bimbingan_id' => 3, // Nindri Lia
                'tanggal' => '2024-08-01',
                'kegiatan' => 'Mengunjungi instansi untuk melakukan wawancara dengan supervisor PKL.',
                'dokumentasi' => 'document_5.jpg',
                'status_verifikasi' => 'verifikasi',
            ],
            [
                'bimbingan_id' => 3, // Nindri Lia
                'tanggal' => '2024-08-02',
                'kegiatan' => 'Menganalisis hasil wawancara untuk menyusun rekomendasi.',
                'dokumentasi' => 'document_6.jpg',
                'status_verifikasi' => 'belum_verifikasi',
            ],
            // Mahasiswa 4 - Satria Mulya
            [
                'bimbingan_id' => 4, // Satria Mulya
                'tanggal' => '2024-08-01',
                'kegiatan' => 'Melakukan kegiatan praktikum di perusahaan mitra PKL.',
                'dokumentasi' => 'document_7.jpg',
                'status_verifikasi' => 'verifikasi',
            ],
            [
                'bimbingan_id' => 4, // Satria Mulya
                'tanggal' => '2024-08-02',
                'kegiatan' => 'Menyusun laporan kegiatan PKL dan presentasi untuk dosen pembimbing.',
                'dokumentasi' => 'document_8.jpg',
                'status_verifikasi' => 'belum_verifikasi',
            ],
            [
                'bimbingan_id' => 4, // Satria Mulya
                'tanggal' => '2024-08-02',
                'kegiatan' => 'Menyusun laporan kegiatan PKL dan presentasi untuk dosen pembimbing.',
                'dokumentasi' => 'document_8.jpg',
                'status_verifikasi' => 'belum_verifikasi',
            ],
            [
                'bimbingan_id' => 5, 
                'tanggal' => '2024-08-02',
                'kegiatan' => 'Menyusun laporan kegiatan PKL dan presentasi untuk dosen pembimbing.',
                'dokumentasi' => 'document_8.jpg',
                'status_verifikasi' => 'belum_verifikasi',
            ],
            [
                'bimbingan_id' => 6, 
                'tanggal' => '2024-08-02',
                'kegiatan' => 'Menyusun laporan kegiatan PKL dan presentasi untuk dosen pembimbing.',
                'dokumentasi' => 'document_8.jpg',
                'status_verifikasi' => 'belum_verifikasi',
            ],
            [
                'bimbingan_id' => 7, 
                'tanggal' => '2024-08-02',
                'kegiatan' => 'Menyusun laporan kegiatan PKL dan presentasi untuk dosen pembimbing.',
                'dokumentasi' => 'document_8.jpg',
                'status_verifikasi' => 'belum_verifikasi',
            ],
    
        ];

        foreach ($logbooks as $data) {
            Logbook::create($data);
        }
    }
}
