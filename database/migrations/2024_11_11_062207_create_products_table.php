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
        Schema::create('produk', function (Blueprint $table) {
            $table->id(); // Kolom id dengan auto_increment dan primary key
            $table->string('nama_produk', 100); // Kolom nama produk
            $table->string('deskripsi', 255)->nullable(); // Kolom deskripsi (nullable)
            $table->integer('harga'); // Kolom harga tanpa auto_increment
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
