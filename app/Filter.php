<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $table='filter';
    public $timestamps=false;
    protected $fillable=['filter_name','filter_type','filter_text','validateType', 'catId', 'show_filter'];
    public function getCat(){
        return $this->hasOne('App\Category' , 'id' , 'catId')->withDefault(['category_name'=>'']);

    }
    public function getChild(){
        return $this->hasMany('App\FilterItem' ,'filter_id', 'id');
    }
    public function filterValue()
    {
        return $this->hasOne(AdsFilter::class,'filter_id','id');
    }
}
