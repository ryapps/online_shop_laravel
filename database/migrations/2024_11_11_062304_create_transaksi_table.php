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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelanggan'); // Kolom foreign key untuk relasi dengan transaksi
            $table->unsignedBigInteger('id_petugas'); // Kolom foreign key untuk relasi dengan produk
            $table->date('tgl_transaksi');
            $table->timestamps();

            // Relasi dengan tabel transaksi
            $table->foreign('id_pelanggan')->references('id')->on('pelanggan')->onDelete('cascade');
            // Relasi dengan tabel produk
            $table->foreign('id_petugas')->references('id')->on('petugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
