<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kerugian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->constrained('produk')->cascadeOnDelete();
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->decimal('nilai_rugi', 15, 2);
            $table->enum('alasan', ['rusak', 'kedaluwarsa', 'hilang', 'lainnya'])->default('rusak');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['tanggal', 'id_produk']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kerugian');
    }
};
