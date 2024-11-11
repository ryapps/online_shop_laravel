<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primarykey = 'id';
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga'
    ];
}
