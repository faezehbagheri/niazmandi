<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ostan extends Model
{
    protected $table="ostan";
    public $timestamps=false;
    protected $fillable=['ostan_name'];

    public static function search($data){
        $string='';
        $ostan = self::orderby('id','DESC');

        if(array_key_exists('ostan_name',$data) && !empty($data['ostan_name'])){
            $ostan = $ostan->where('ostan_name' , 'like' , '%'. $data['ostan_name']. '%');
            $string = '?ostan_name=' . $data['ostan_name'];
        }
        $ostan=$ostan->paginate(10);
        $ostan=$ostan->withPath($string);

        return $ostan;
    }
    public function getShahrs()
    {
        return $this->hasMany('App\Shahr','ostan_id','id');
    }
    public function getAreaFromOstan()
    {
        return $this->hasManyThrough(
            'App\Area',
            'App\Shahr'
        );
    }
}
