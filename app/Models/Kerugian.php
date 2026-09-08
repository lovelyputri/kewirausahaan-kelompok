<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kerugian extends Model
{
    protected $fillable = [
        'id_produk', 'tanggal', 'jumlah', 'nilai_rugi', 'catatan'
    ];
    
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
