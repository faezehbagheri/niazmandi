<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsFilter extends Model
{
    protected $table='ads_filter';
    protected $fillable=['ads_id','filter_id','filter_value'];
    public function filter_parent()
    {
        return $this->hasOne('App\Filter','id','filter_id');
    }
    public function getItemName()
    {
        return $this->hasOne(Filter::class,'id','filter_id');
    }
    public function getItemValue()
    {
        return $this->hasOne(FilterItem::class,'id','filter_value');
    }
}
