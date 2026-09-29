<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * DatabaseSeeder
 *
 * Seeder utama yang dijalankan saat `php artisan db:seed`.
 * Bertugas mengisi data awal (admin & menu kantin).
 */
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * isi data awal ke database
     */
    public function run(): void
    {
        // 1. Buat Akun Admin Bawaan untuk Uji Coba Asesor
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@gmail.com',
            // Hash::make() = enkripsi password pakai bcrypt
            'password' => Hash::make('password123'),
        ]);

        // 2. Jalankan Seeder Makanan
        $this->call([
            FoodSeeder::class,
        ]);
    }
}