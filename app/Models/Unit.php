<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function product(){
        return $this->hasMany(Product::class, 'id_product', 'id');
    }

    public function unitConvertion(){
        return $this->hasMany(UnitConvertion::class, 'id_unit', 'id');
    }
}
