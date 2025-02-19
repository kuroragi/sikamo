<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitConvertion extends Model
{
    protected $fillable = [
        'id_group',
        'id_unit',
        'kali_utama'
    ];

    public function unitConvertionGroup(){
        return $this->belongsTo(UnitConvertionGroup::class, 'id_group', 'id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class, 'id_unit', 'id');
    }
}
