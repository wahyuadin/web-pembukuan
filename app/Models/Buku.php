<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        'nama_buku',
        'isbn',
        'tgl_terbit',
        'penulis',
        'stok',
    ];

    protected $hidden = [
        'id_buku'
    ];
    use HasFactory;
}
