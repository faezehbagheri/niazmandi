<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $fillable=['category_name','url','parent_id','icon','without_filter_id'];

    public static function getCatList(){
        $array=array();
        $array[0]='دسته اصلی';
        $cat1=self::with('getChild')->where('parent_id',0)->get();
        foreach($cat1 as $key=>$value){
            $array[$value->id]=$value->category_name;
            foreach($value->getChild as $key2=>$value2){
                $array[$value2->id]= ' ' .$value2->category_name;
            }
        }
        return $array;
    }
    public function getChild(){
        return $this->hasMany(Category::class , 'parent_id' , 'id');
    }
    public function childCatWithAdsCount()
    {
        return $this->hasMany(Category::class,'parent_id','id')->withCount('ads_list2');
    }
    public function getParent(){
        return $this->hasOne(Category::class , 'id' , 'parent_id')->withDefault(['category_name' => '']);
    }
    public static function search($data){
        $string='';
        $category = self::with('getParent')->orderby('id','DESC');

        if(array_key_exists('category_name',$data) && !empty($data['category_name'])){
            $category = $category->where('category_name' , 'like' , '%'. $data['category_name']. '%');
            $string = '?category_name=' . $data['category_name'];
        }
        $category=$category->paginate(10);
        $category=$category->withPath($string);

        return $category;
    }
    public static function getTotalCatList(){
        $array=array();
        $cat1=self::with('getChild')->where('parent_id',0)->get();
        foreach($cat1 as $key=>$value){
            $array[$value->id]=$value->category_name;
            foreach($value->getChild as $key2=>$value2){
                $array[$value2->id]= ' -' .$value2->category_name;
                foreach($value2->getChild as $key3=>$value3){
                    $array[$value3->id]= ' - - ' .$value3->category_name;
                }
            }
        }
        return $array;
    }
    public function ads_list()
    {
        return $this->hasMany(Ads::class,'cat1_id','id');
    }
    public function ads_list2()
    {
        return $this->hasMany(Ads::class,'cat2_id','id');
    }
}

