<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    protected $fillable = [
        'nik',
        'name',
        'phone',
        'email'
    ];

    public function sale(){
        return $this->hasMany(Sale::class, 'id_costumer', 'id');
    }
}
