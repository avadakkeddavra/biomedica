<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $table = 'pays';

    protected $fillable = [
        'user_id','analysis_id','value'
    ];
}
