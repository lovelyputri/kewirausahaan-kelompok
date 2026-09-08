<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'id_kategori', 'nama_produk', 'harga_beli', 'harga_jual', 'stok'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_produk');
    }

    public function kerugians()
    {
        return $this->hasMany(Kerugian::class, 'id_produk');
    }
}
