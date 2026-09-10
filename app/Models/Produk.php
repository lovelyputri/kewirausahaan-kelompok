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

    // ============================
    // RELASI
    // ============================
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

    // ============================
    // ACCESSOR
    // ============================

    // Hitung laba per unit
    public function getLabaAttribute()
    {
        return $this->harga_jual - $this->harga_beli;
    }

    // Status stok: tersedia / menipis / habis
    public function getStatusStokAttribute()
    {
        if ($this->stok <= 0) {
            return 'habis';
        } elseif ($this->stok <= 5) {
            return 'menipis';
        }
        return 'tersedia';
    }

    // Label status untuk badge
    public function getLabelStatusAttribute()
    {
        if ($this->status_stok == 'habis') {
            return 'Stok Habis';
        } elseif ($this->status_stok == 'menipis') {
            return 'Stok Menipis';
        }
        return 'Tersedia';
    }

    // Warna badge
    public function getWarnaStatusAttribute()
    {
        if ($this->status_stok == 'habis') {
            return 'bg-red-100 text-red-700';
        } elseif ($this->status_stok == 'menipis') {
            return 'bg-yellow-100 text-yellow-700';
        }
        return 'bg-green-100 text-green-700';
    }

    // Cek stok menipis
    public function isStokMenipis()
    {
        return $this->stok <= 5;
    }
}
