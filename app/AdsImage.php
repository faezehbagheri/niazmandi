<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsImage extends Model
{
    protected $table='ads_img';
    protected $fillable=['url','ads_id'];
}
