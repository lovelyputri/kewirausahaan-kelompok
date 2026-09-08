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
        Schema::create('pemasukan_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->references('id')->on('produks');
            $table->date('tanggal')->nullable();
            $table->integer('harga_per_item')->nullable();
            $table->integer('total_modal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan_barangs');
    }
};
