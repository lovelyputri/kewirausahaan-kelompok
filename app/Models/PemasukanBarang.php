<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasukanBarang extends Model
{
    use HasFactory;

    protected $table = 'pemasukan_barang';

    protected $fillable = [
        'id_produk',
        'tanggal',
        'jumlah',
        'harga_per_item',
        'total_modal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    // FILTER TANGGAL
    public function scopeFilterTanggal($query, $startDate, $endDate)
    {
        return $query->whereBetween('tanggal', [$startDate, $endDate]);
    }
}
