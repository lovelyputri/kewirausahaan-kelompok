<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'tanggal',
        'total_pemasukan',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // ============================
    // RELASI
    // ============================
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan');
    }

    // ============================
    // ACCESSOR
    // ============================

    // Total item (jumlah semua produk terjual)
    public function getTotalItemAttribute()
    {
        return $this->detailPenjualan->sum('jumlah');
    }

    // Kode barang (gabungan dari semua produk, contoh: R001, R002)
    public function getKodeBarangAttribute()
    {
        return $this->detailPenjualan
                    ->map(function ($d) {
                        return $d->produk->kode_produk ?? '-';
                    })
                    ->filter()
                    ->unique()
                    ->implode(', ');
    }

    // Label status
    public function getLabelStatusAttribute()
    {
        if ($this->status == 'selesai') {
            return 'Selesai';
        } elseif ($this->status == 'pending') {
            return 'Pending';
        } elseif ($this->status == 'batal') {
            return 'Batal';
        }
        return '-';
    }

    // Warna badge status
    public function getWarnaStatusAttribute()
    {
        if ($this->status == 'selesai') {
            return 'bg-green-100 text-green-700';
        } elseif ($this->status == 'pending') {
            return 'bg-yellow-100 text-yellow-700';
        } elseif ($this->status == 'batal') {
            return 'bg-red-100 text-red-700';
        }
        return 'bg-gray-100 text-gray-700';
    }
}
