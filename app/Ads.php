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
    public function createAdsFilters($ads_id,$array){
        if(is_array($array))
        {
            foreach ($array as $key=>$value)
            {
                DB::table('ads_filter')
                    ->insert([
                        'ads_id'=>$ads_id,
                        'filter_id'=>$key,
                        'filter_value'=>$value
                    ]);
            }
        }

    }
    public function getFirstImage(){
        return $this->hasOne(AdsImage::class,'ads_id','id');
    }
    public function getOstanName()
    {
        return $this->hasOne(Ostan::class,'id','ostan_id')
            ->withDefault(['ostan_name'=>'']);

    }
    public function getShahrName()
    {
        return $this->hasOne(Shahr::class,'id','shahr_id')
            ->withDefault(['ostan_name'=>'']);

    }
    public function getFilter()
    {
        return $this->hasMany('App\AdsFilter','ads_id','id');
    }
    public static function replace_number($number){
        $number=str_replace('0','۰',$number);
        $number=str_replace('1','۱',$number);
        $number=str_replace('2','۲',$number);
        $number=str_replace('3','۳',$number);
        $number=str_replace('4','۴',$number);
        $number=str_replace('5','۵',$number);
        $number=str_replace('6','۶',$number);
        $number=str_replace('7','۷',$number);
        $number=str_replace('8','۸',$number);
        $number=str_replace('9','۹',$number);
        return $number;
    }
    public static function getAdsData($url){

        $data=array();
        $e=explode('-',$url);
        if(sizeof($e)>=2)
        {
            $data['id']=$e[0];
            $url=str_replace($e[0].'-','',$url);
            $data['url']=$url;
        }
        return $data;
    }
    public function getGallery()
    {
        return $this->hasMany(AdsImage::class,'ads_id','id');
    }
    public function getAdsItem()
    {
        return $this->hasMany(AdsFilter::class,'ads_id','id')->with(['getItemName','getItemValue']);
    }
}
