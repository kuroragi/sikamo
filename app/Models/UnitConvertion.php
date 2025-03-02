<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitConvertion extends Model
{
    protected $fillable = [
        'id_category',
        'id_unit',
        'kali_utama',
        'is_main',
        'is_greater'
    ];

    public function convertionUnit(){
        return $this->belongsTo(StockCategory::class, 'id_category', 'id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class, 'id_unit', 'id');
    }
}
