<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'code',
        'id_costumer',
        'keterangan',
        'date_sale',
        'discount',
        'payment',
        'is_finish'
    ];

    public function costumer(){
        return $this->belongsTo(Costumer::class, 'id_costumer', 'id');
    }

    public function sale_details(){
        return $this->hasMany(SaleDetail::class, 'id_sale_master', 'id');
    }
}
