<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'harga_beli',
        'harga_jual',
        'stok',
    ];

    // RELASI
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function pemasukanBarang()
    {
        return $this->hasMany(PemasukanBarang::class, 'id_produk');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_produk');
    }

    public function kerugian()
    {
        return $this->hasMany(Kerugian::class, 'id_produk');
    }

    // HITUNG LABA PER UNIT
    public function getLabaAttribute()
    {
        return $this->harga_jual - $this->harga_beli;
    }

    // CEK STOK MENIPIS
    public function isStokMenipis()
    {
        return $this->stok <= 5;
    }
}
