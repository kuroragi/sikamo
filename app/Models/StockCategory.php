<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'is_convertion',
        'id_convertion_group'
    ];

    public function product(){
        return $this->hasMany(Product::class, 'id_product', 'id');
    }
}
