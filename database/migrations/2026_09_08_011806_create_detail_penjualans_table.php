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
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penjualan')->references('id')->on('penjualans');
            $table->foreignId('id_produk')->references('id')->on('produks');
            $table->integer('jumlah')->nullable();
            $table->integer('harga_jual')->nullable();
            $table->integer('harga_modal')->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('laba')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
    }
};
