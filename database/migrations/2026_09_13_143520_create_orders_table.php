<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Buat tabel `orders`
 *
 * Tabel ini menyimpan data pesanan dari customer.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('customer_name'); // nama kustomer
        $table->string('table_number'); // nomor meja
        $table->text('notes')->nullable(); // catatan
        $table->integer('total_price'); // total harga
        $table->enum('status', ['Pending', 'Diproses', 'Selesai'])->default('Pending'); // status
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
