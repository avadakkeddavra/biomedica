<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    protected $fillable = [
        'analysis_id','city_id','value'
    ];

    public function city()
    {
        return $this->belongsTo(Cities::class,'city_id','id');
    }
}
