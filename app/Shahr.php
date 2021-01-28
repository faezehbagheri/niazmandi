<?php

namespace App;
use App\Ostan;

use Illuminate\Database\Eloquent\Model;

class Shahr extends Model
{
    protected $table="shahr";
    public $timestamps=false;
    protected $fillable=['shahr_name', 'ostan_id'];
    public static function search($data){
        $string='';
        $shahr = self::with('getOstan')->orderby('id','DESC');

        if(array_key_exists('shahr_name',$data) && !empty($data['shahr_name'])){
            $shahr = $shahr->where('shahr_name' , 'like' , '%'. $data['shahr_name']. '%');
            $string = '?shahr_name=' . $data['shahr_name'];
        }
        $shahr=$shahr->paginate(10);
        $shahr=$shahr->withPath($string);

        return $shahr;
    }
    public function getOstan(){
        return $this->hasOne(Ostan::class, 'id', 'ostan_id');
    }
    public function getAreaFromShahr(){
        return $this->hasMany('App\Area', 'shahr_id', 'id');
    }
}
