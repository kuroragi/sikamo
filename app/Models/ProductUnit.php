<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    protected $fillable = [
        'id_product',
        'id_unit',
        'type',
        'amount'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class, 'id_unit', 'id');
    }
}
