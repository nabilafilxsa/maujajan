<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Buat tabel `foods`
 *
 * Tabel ini menyimpan data master makanan kantin.
 */
return new class extends Migration
{
    /**
     * Run the migrations (buat tabel).
     */
   public function up(): void
{
    Schema::create('foods', function (Blueprint $table) {
        $table->id(); // primary key auto-increment
        $table->string('name'); /// nama makanan
        $table->enum('category', ['Makanan', 'Minuman', 'Cemilan']); // 3 kategori
        $table->integer('price'); // harga
        $table->text('description'); // deskripsi makanan
        $table->string('image')->nullable(); // path gambar
        $table->timestamps(); // created_at dan updated_at
    });
}

   /**
     * Batalkan migration (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
