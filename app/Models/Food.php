<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Food
 *
 * Mewakili tabel `foods` di database.
 * Berisi data master makanan/minuman kantin.
 */
class Food extends Model
{
    use HasFactory;

    // nama tabel 
    protected $table = 'foods';

    // 'id' auto-increment, jangan diisi manual
    protected $guarded = ['id'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'food_id');
    }
}