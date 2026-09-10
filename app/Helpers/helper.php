<?php

namespace App\Helpers;

class helper
{
    public static function tanggal($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }

        return $query;
    }

    public static function alasan($query, $alasan)
    {
        if ($alasan) {
            $query->where('alasan', $alasan);
        }

        return $query;
    }

    public static function search($query, $keyword)
    {
        if ($keyword) {
            $query->where(
                'nama_produk',
                'LIKE',
                "%{$keyword}%"
            );
        }

        return $query;
    }

    public static function kategori($query, $kategoriId)
    {
        if ($kategoriId) {
            $query->where('id_kategori', $kategoriId);
        }

        return $query;
    }
}