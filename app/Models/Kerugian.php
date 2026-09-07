<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerugian extends Model
{
    use HasFactory;

    protected $table = 'kerugian';

    protected $fillable = [
        'id_produk',
        'tanggal',
        'jumlah',
        'nilai_rugi',
        'alasan',
        'catatan',
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

    // FILTER ALASAN
    public function scopeFilterAlasan($query, $alasan)
    {
        if ($alasan) {
            return $query->where('alasan', $alasan);
        }
        return $query;
    }
}
