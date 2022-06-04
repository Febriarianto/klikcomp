<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = [
        'id',
        'nama_barang',
        'satuan',
        'keterangan',
        'barcode',
        'harga_jual',
        'harga_beli',
        'stok',
        'id_kategori',
        'id_supplier'
    ];
}
