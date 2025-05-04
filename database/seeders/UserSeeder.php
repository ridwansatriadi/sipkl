<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Muhammad Yamin',
                'email' => 'yamin@gmail.com',
                'role' => 'admin',
                'password' => 'yamin123',
            ],
            [
                'name' => 'Syahrani Lonang',
                'email' => 'syahranilonang@gmail.com',
                'role' => 'kaprodi',
                'password' => 'kaproditi123',
            ],
            [
                'name' => 'Ahmad Fatoni Dwi Putra',
                'email' => 'fatoni@gmail.com',
                'role' => 'kaprodi',
                'password' => 'kaprodiilkom123',
            ],
            [
                'name' => 'Bagus',
                'email' => 'bagus@gmail.com',
                'role' => 'kaprodi',
                'password' => 'kaprodisipil123',
            ],
            [
                'name' => 'Ridwan Satriadi',
                'email' => 'ridwans@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'ridwans123',
            ],
            [
                'name' => 'Sabardi',
                'email' => 'sabardi@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'sabardi123',
            ],
            [
                'name' => 'Nindri Lia Desmita',
                'email' => 'nindri@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'nindri123',
            ],
            [
                'name' => 'Satria Mulya Jati Apriadi',
                'email' => 'satria@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'satria123',
            ],
            [
                'name' => 'Miftahul Jannah',
                'email' => 'mifta@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'mifta123',
            ],
            [
                'name' => 'Sumarno Wijaya',
                'email' => 'marno@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'marno123',
            ],
            [
                'name' => 'Viqiami Zulkarnaen',
                'email' => 'viqi@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'viqi123',
            ],
            [
                'name' => 'Syahrul Tamami',
                'email' => 'tami@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'tami123',
            ],
            [
                'name' => 'Satrio Budi Santoso',
                'email' => 'budi@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'budi123',
            ],
            [
                'name' => 'Angga Wiranata',
                'email' => 'angga@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'angga123',
            ],
            [
                'name' => 'Dewe Made Chandra Dika',
                'email' => 'dewe@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'dewe123',
            ],
            [
                'name' => 'Abd Rahman',
                'email' => 'rahman@gmail.com',
                'role' => 'mahasiswa',
                'password' => 'rahman123',
            ],
            [
                'name' => 'Nuraqilla Widha Bintang Grendis',
                'email' => 'bintang@example.com',
                'role' => 'dpl',
                'password' => 'bintang123',
            ],
            [
                'name' => 'Asno Azzawagama Firdaus',
                'email' => 'asno@gmail.com',
                'role' => 'dpl',
                'password' => 'asno123',
            ],
            [
                'name' => 'Syarifatul ulfah',
                'email' => 'ulfah@gmail.com',
                'role' => 'dpl',
                'password' => 'ulfah123',
            ],
            [
                'name' => 'Valian Yoga Pudya Ardhana',
                'email' => 'valian@gmail.com',
                'role' => 'dpl',
                'password' => 'valian123',
            ],
            [
                'name' => 'M. Afriansyah',
                'email' => 'afrian@gmail.com',
                'role' => 'dpl',
                'password' => 'afrian123',
            ],
            [
                'name' => 'Danang Tejo Kumoro',
                'email' => 'danang@gmail.com',
                'role' => 'dpl',
                'password' => 'danang123',
            ],
        ];

       
        foreach ($users as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role'],
                'password' => Hash::make($data['password']),
            ]);

            // Buat role jika belum ada dan assign
            // $role = Role::firstOrCreate(['name' => $data['role']]);
            // $user->assignRole($role);
        }
    }
}
