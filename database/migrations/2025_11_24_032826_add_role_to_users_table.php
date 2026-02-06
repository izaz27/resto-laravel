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
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom 'role' dengan opsi 'admin', 'kasir', atau 'customer'
            // Default diatur sebagai 'customer' dan ditempatkan setelah kolom 'password'
            $table->enum('role', ['admin', 'kasir', 'customer'])
                  ->default('customer')
                  ->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom 'role' jika terjadi rollback
            $table->dropColumn('role');
        });
    }
};
