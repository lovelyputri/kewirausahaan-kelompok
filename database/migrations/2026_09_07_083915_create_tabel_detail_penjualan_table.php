<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penjualan')->constrained('penjualan')->cascadeOnDelete();
            $table->foreignId('id_produk')->constrained('produk')->cascadeOnDelete();
            $table->integer('jumlah');
            $table->decimal('harga_jual', 15, 2);
            $table->decimal('harga_modal', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->decimal('laba', 15, 2);
            $table->timestamps();

            $table->index(['id_penjualan', 'id_produk']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
