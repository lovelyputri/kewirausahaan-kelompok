<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'kode_produk',
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
    // AUTO GENERATE KODE PRODUK
    // ============================
    public static function generateKodeProduk()
    {
        // Cari produk terakhir berdasarkan kode
        $lastProduk = self::whereNotNull('kode_produk')
                         ->orderBy('id', 'desc')
                         ->first();

        if ($lastProduk && $lastProduk->kode_produk) {
            // Ambil angka dari kode terakhir (contoh: R005 → 5)
            $lastNumber = intval(substr($lastProduk->kode_produk, 1));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format: R + 3 digit (R001, R002, ...)
        return 'R' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // ============================
    // ACCESSOR
    // ============================
    public function getLabaAttribute()
    {
        return $this->harga_jual - $this->harga_beli;
    }

    public function getStatusStokAttribute()
    {
        if ($this->stok <= 0) {
            return 'habis';
        } elseif ($this->stok <= 5) {
            return 'menipis';
        }
        return 'tersedia';
    }

    public function getLabelStatusAttribute()
    {
        if ($this->status_stok == 'habis') {
            return 'Stok Habis';
        } elseif ($this->status_stok == 'menipis') {
            return 'Stok Menipis';
        }
        return 'Tersedia';
    }

    public function getWarnaStatusAttribute()
    {
        if ($this->status_stok == 'habis') {
            return 'bg-red-100 text-red-700';
        } elseif ($this->status_stok == 'menipis') {
            return 'bg-yellow-100 text-yellow-700';
        }
        return 'bg-green-100 text-green-700';
    }

    public function isStokMenipis()
    {
        return $this->stok <= 5;
    }
}
