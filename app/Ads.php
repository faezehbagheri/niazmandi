<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Ads extends Model
{
    protected $table='ads';
    protected $dateFormat='U';
    protected $fillable=['user_id','title','cat1_id','cat2_id','cat3_id',
        'view','tozihat','ostan_id','shahr_id','area_id','area_name','url','status'];

    public function getUserId()
    {
        if(Auth::check())
        {
            return Auth::user()->id;
        }
        elseif(Cookie::has('user_id'))
        {
            return Cookie::get('user_id');
        }
        else
        {
            return false;
        }
    }
    public function createAdsImage($ads_id,$image_url)
    {
        $array=explode('@#!',$image_url);
        foreach ($array as $key=>$value)
        {
            if(!empty($value))
            {
                DB::table('ads_img')->insert([
                    'ads_id'=>$ads_id,
                    'url'=>$value,
                ]);
            }
        }
    }
}
