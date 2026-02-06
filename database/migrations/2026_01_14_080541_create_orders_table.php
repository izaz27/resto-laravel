<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_code')->unique(); // Contoh: ORD-65A2BC
        $table->string('table_numbers');        // Menyimpan nomor meja (misal: "1, 2")
        $table->decimal('total_price', 12, 2);  // Total bayar
        $table->enum('payment_method', ['cash', 'qris']); 
        $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
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
