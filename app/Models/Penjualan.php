<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = [
        'no_penjualan',
        'id_pelanggan',
        'uang_bayar',
        'diskon',
        'total',
        'kembalian',
        'keterangan',
        'id_user',
    ];
}
