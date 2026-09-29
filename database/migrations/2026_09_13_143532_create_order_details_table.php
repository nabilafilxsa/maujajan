<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Buat tabel `order_details`
 *
 * Tabel ini menyimpan detail item per pesanan.
 * Relasi ke orders & foods lewat foreign key.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('order_details', function (Blueprint $table) {
        $table->id();
        // Foreign key ke tabel orders
        // onDelete('cascade') = kalau order dihapus, detailnya ikut terhapus
        $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
        // Foreign key ke tabel foods
        $table->foreignId('food_id')->constrained('foods')->onDelete('cascade');
        $table->integer('quantity'); // jumlah posri
        $table->integer('subtotal'); // quantity x price
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
