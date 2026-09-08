<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemasukanBarang extends Model
{
    protected $fillable = [
        'id_produk', 'tanggal', 'jumlah', 'harga_per_item', 'total_modal'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
