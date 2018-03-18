<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
class Analysis extends Model
{
    protected $table = 'analysis';

    protected $fillable = [
        'name','cat_id','description','doct_desc','status','article_id'
    ];

    public function category()
    {
       return $this->belongsTo(Categories::class,'cat_id','id');
    }

    public function article()
    {
        return $this->belongsTo(Articles::class,'article_id','id');
    }

    public function prices()
    {
        return $this->hasMany(Prices::class,'analysis_id','id');
    }
    public function price()
    {
       $price = $this->join('prices',$this->table.'.id','=','prices.analysis_id')->select('prices.*')->where($this->table.'.id',$this->id)->where('city_id',$_COOKIE['city_id'])->first();
       return $price->value;
    }

    public function getCityPrice($city_id)
    {

    }
}
