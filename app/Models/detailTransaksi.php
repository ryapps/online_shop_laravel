<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_transaksi',
        'Id_produk',
        'qty',
        'subtotal'
    ];
}
