<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $table='filter';
    public $timestamps=false;
    protected $fillable=['filter_name','filter_type','filter_text','validateType', 'catId'];
    public function getCat(){
        return $this->hasOne('App\Category' , 'id' , 'catId')->withDefault(['category_name'=>'']);

    }
    public function getChild(){
        return $this->hasMany('App\FilterItem' ,'filter_id', 'id');
    }
}
