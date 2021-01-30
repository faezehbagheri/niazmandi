<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table="area";
    public $timestamps=false;
    protected $fillable=['area_name', 'shahr_id'];
    public static function search($data){
        $string='';
        $area = self::with('getShahr')->orderby('id','DESC');

        if(array_key_exists('area_name',$data) && !empty($data['area_name'])){
            $area = $area->where('area_name' , 'like' , '%'. $data['area_name']. '%');
            $string = '?area_name=' . $data['area_name'];
        }
        $area=$area->paginate(10);
        $area=$area->withPath($string);

        return $area;
    }
    public function getShahr()
    {
        return $this->hasOne(Shahr::class,'id','shahr_id')->withDefault(['shahr_name'=>'']);
    }
}
