<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'code',
        'id_costumer',
        'keterangan',
        'date_sale'
    ];

    public function costumer(){
        return $this->belongsTo(Costumer::class, 'id_costumer', 'id');
    }
}
