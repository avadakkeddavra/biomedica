<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $fillable = [
      'name','description','docs_desc'
    ];
}
