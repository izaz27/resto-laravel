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
        Schema::create('order_details', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel orders
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        // Menghubungkan ke tabel menus
        $table->foreignId('menu_id')->constrained()->onDelete('cascade');
        
        $table->integer('qty');
        $table->decimal('price', 12, 2); // Harga saat dibeli (untuk history jika harga menu berubah)
        $table->string('note')->nullable(); // Catatan per item (Pedas, dll)
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
