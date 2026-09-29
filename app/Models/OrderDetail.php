<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model OrderDetail
 *
 * Mewakili tabel `order_details` di database.
 * Berisi detail item per pesanan.
 */
class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $guarded = ['id'];

     /**
     * Relasi: OrderDetail milik 1 Food
     * Contoh akses: $detail->food->name
     */
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

    /**
     * Relasi: OrderDetail milik 1 Order
     * Contoh akses: $detail->order->id
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}