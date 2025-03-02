<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code_product',
        'name',
        'last_buy',
        'selling_price',
        'id_category',
        'id_unit'
    ];

    public function category(){
        return $this->belongsTo(StockCategory::class, 'id_category', 'id');
    }

    public function main_unit(){
        return $this->belongsTo(Unit::class, 'id_unit', 'id');
    }

    // public function units(){
    //     return $this->hasManyThrough(Unit::class, ProductUnit::class, 'id_unit', 'id_unit', 'id', 'id');
    // }
}
