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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi'); // Kolom foreign key untuk relasi dengan transaksi
            $table->unsignedBigInteger('id_produk'); // Kolom foreign key untuk relasi dengan produk
            $table->integer('qty'); // Kolom qty
            $table->integer('subtotal'); // Kolom subtotal
            $table->timestamps();

            // Relasi dengan tabel transaksi
            $table->foreign('id_transaksi')->references('id')->on('transaksi')->onDelete('cascade');
            // Relasi dengan tabel produk
            $table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
