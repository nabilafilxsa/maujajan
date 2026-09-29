<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * FoodSeeder
 *
 * Mengisi data menu awal ke tabel `foods`.
 * Ini memudahkan testing & demo aplikasi.
 */
class FoodSeeder extends Seeder
{
    public function run(): void
    {
        // ⬇️ EDIT DI SINI untuk ubah menu awal
        $foods = [
            [
                'name' => 'Nasi Goreng Spesial',
                'category' => 'Makanan',
                'price' => 10000,
                'description' => 'Nasi goreng dengan telur, ayam suwir, dan kerupuk.',
                'image' => null, //belum ada gambar
            ],
            [
                'name' => 'Sandwich',
                'category' => 'Makanan',
                'price' => 6000,
                'description' => 'Roti dengan lapisan sayur, telur, dan bacon',
                'image' => null,
            ],
            [
                'name' => 'Bakso Aci',
                'category' => 'Makanan',
                'price' => 12000,
                'description' => 'Bakso aci dengan kuah gurih.',
                'image' => null,
            ],
            [
                'name' => 'Es Teh Poci',
                'category' => 'Minuman',
                'price' => 3000,
                'description' => 'Es teh segar.',
                'image' => null,
            ],
            [
                'name' => 'Jus Alpukat',
                'category' => 'Minuman',
                'price' => 10000,
                'description' => 'Jus alpukat murni dengan susu cokelat.',
                'image' => null,
            ],
            [
                'name' => 'Es Jeruk',
                'category' => 'Minuman',
                'price' => 5000,
                'description' => 'Es jeruk peras segar.',
                'image' => null,
            ],
            [
                'name' => 'Kentang Goreng',
                'category' => 'Cemilan',
                'price' => 5000,
                'description' => 'Kentang goreng renyah dengan saus keju.',
                'image' => null,
            ],
            [
                'name' => 'Donat',
                'category' => 'Cemilan',
                'price' => 5000,
                'description' => 'Donat lezat dengan topping gula halus.',
                'image' => null,
            ],
        ];

        foreach ($foods as $food) {
            DB::table('foods')->insert(array_merge($food, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}