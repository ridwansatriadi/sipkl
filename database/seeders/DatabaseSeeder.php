<?php

namespace Database\Seeders;

use App\Models\SuratBalasan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            ProdiSeeder::class,         
            UserSeeder::class,          
            MahasiswaSeeder::class,     
            KaprodiSeeder::class,       
            DplSeeder::class,         
    
            BimbinganSeeder::class,     
            PengajuanSeeder::class,     
            SuratSeeder::class,  
            SuratBalasanSeeder::class,  
            LogbookSeeder::class,       
            LaporanSeeder::class,      
            NilaiSeeder::class,         
        ]);
    }
}
