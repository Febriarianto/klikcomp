<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianItem extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pembelian_item';
    protected $fillable = [
        'no_penjualan',
        'id_barang',
        'jumlah',
        'harga'
    ];
}
