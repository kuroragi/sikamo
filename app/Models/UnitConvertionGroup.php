<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitConvertionGroup extends Model
{
    protected $fillable = [
        'name'
    ];

    public function unitConvertion(){
        return $this->hasMany(UnitConvertion::class, 'id_group', 'id');
    }
}
