<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{

    protected $table = 'pelanggan';
    protected $primarykey = 'id';
    protected $fillable = [
        'nama',
        'alamat',
        'telp'
    ];
}
