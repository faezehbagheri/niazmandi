<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilterItem extends Model
{
    protected $table='filteritem';
    public $timestamps=false;
    protected $fillable=['item_name','filter_id'];

}
