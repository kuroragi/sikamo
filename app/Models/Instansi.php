<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $fillable = [
        'name',
        'slogan',
        'alamat',
        'kelurahan',
        'kecamatan',
        'propinsi',
        'zipcode',
        'cp',
        'email',
        'image',
    ];
}
