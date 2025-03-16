<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = [
        'id_sale_master', 
        'id_product', 
        'quantity', 
        'price', 
        'sub_total'
    ];

    public function sale_master()
    {
        return $this->belongsTo(Sale::class, 'id_sale_master', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}
