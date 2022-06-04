<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pelanggan';
    protected $fillable = [
        'id',
        'nama_pelanggan',
        'alamat',
        'no_tlp'
    ];
}
