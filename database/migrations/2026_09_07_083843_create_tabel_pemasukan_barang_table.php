<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemasukan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->constrained('produk')->cascadeOnDelete();
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->decimal('harga_per_item', 15, 2);
            $table->decimal('total_modal', 15, 2);
            $table->timestamps();

            $table->index(['tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemasukan_barang');
    }
};
