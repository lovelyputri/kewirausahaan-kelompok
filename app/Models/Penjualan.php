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

    // Kode barang (gabungan dari semua produk)
    public function getKodeBarangAttribute()
    {
        return $this->detailPenjualan
                    ->map(fn($d) => $d->produk->kode_produk ?? '-')
                    ->filter()
                    ->unique()
                    ->implode(', ');
    }

    // Nama produk (gabungan dari semua produk)
    public function getNamaProdukAttribute()
    {
        return $this->detailPenjualan
                    ->map(fn($d) => $d->produk->nama_produk ?? '-')
                    ->filter()
                    ->implode(', ');
    }

    // Label status
    public function getLabelStatusAttribute()
    {
        return match($this->status) {
            'selesai' => 'Selesai',
            'pending' => 'Pending',
            'batal' => 'Batal',
            default => '-',
        };
    }

    // Warna badge status
    public function getWarnaStatusAttribute()
    {
        return match($this->status) {
            'selesai' => 'status-selesai',
            'pending' => 'status-pending',
            'batal' => 'status-batal',
            default => 'status-selesai',
        };
    }
}
