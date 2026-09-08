<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = [
        'id_penjualan', 'id_produk', 'jumlah', 'harga_jual', 'harga modal', 'subtotal',  'laba'
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk'); // detail penjualan milik produk
    }
}
