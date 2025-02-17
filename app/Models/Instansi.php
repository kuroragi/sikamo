<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
