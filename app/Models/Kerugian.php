<?php

namespace App\Models;

use App\Models\Produk;
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
}
