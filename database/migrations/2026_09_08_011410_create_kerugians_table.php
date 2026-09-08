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
        Schema::create('kerugians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->references('id')->on('produks');
            $table->date('tanggal')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('nilai_rugi')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerugians');
    }
};
