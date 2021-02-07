<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Category;
use App\Filter;
use App\Ostan;
//use Intervention\Image\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class SiteController extends Controller
{
    public function index(){
        $catList=Category::with('getChild')->withCount('ads_list')
            ->where('parent_id','0')->get();
        $newAds=Ads::with(['getFirstImage','getOstanName','getShahrName',
            'getFilter.filter_parent'])
            ->where(['status'=>1])->OrderBy('created_at','DESC')->get();


        return view('site.index',['newAds'=>$newAds,'catList'=>$catList]);
    }

    public function new_ads(){
        $category=Category::with('getChild.getChild')->where('parent_id',0)->get();
        $location=Ostan::with("getShahrs.getAreaFromShahr")->get();

        return view('site.new', ['category'=>$category , 'location'=>$location]);
    }
    public function get_filter(Request $request)
    {
        if($request->ajax())
        {
            $without_filter_id=array();
            $cat_list=array();
            $catId=$request->get('catId');
            $parent_cat=\App\Category::where('id',$catId)->first();
            $parent_cat2=\App\Category::where('id',$parent_cat->parent_id)->first();

            $cat_list[0]=$catId;
            if($parent_cat)
            {
                $cat_list[1]=$parent_cat->parent_id;
                if(!empty($parent_cat->without_filter_id))
                {
                    $without_filter_id[1]=$parent_cat->without_filter_id;
                }
            }
            if($parent_cat2)
            {
                $cat_list[2]=$parent_cat2->parent_id;
                if(!empty($parent_cat2->without_filter_id))
                {
                    $without_filter_id[2]=$parent_cat2->without_filter_id;
                }
            }

            $Filter=\App\Filter::with('getChild')
                ->whereIn('catId',$cat_list)
                ->whereNotIn('id',$without_filter_id)
                ->get()->toJson();
            return $Filter;
        }
    }
    public function ads_image_upload(Request $request)
    {
        if($request->hasFile('pic'))
        {
            $file=$request->file('pic');
            $file_name=$file->getFilename().uniqid().'.'.$file->getClientOriginalExtension();
            if($request->file('pic')->move('upload',$file_name))
            {
                $img = Image::make('upload/'.$file_name);
                $img->fit(600,600);
                if($img->save('upload/'.$file_name))
                {
                    $thum = Image::make('upload/'.$file_name);
                    $thum->fit(200,200);
                    $thum->save('thumbnails/'.$file_name);
                    return $file_name;
                }
                else
                {
                    return 'error';
                }
            }
        }
    }
    public function del_ads_img(Request $request)
    {
        $src=$request->get('src');
        $file_name=str_replace(url('thumbnails').'/','',$src);
        if(file_exists('thumbnails/'.$file_name) && file_exists('upload/'.$file_name))
        {
            unlink('thumbnails/'.$file_name);
            unlink('upload/'.$file_name);
            return 'ok';
        }
        else
        {
            return 'error';
        }
    }
    public function create_ads(Request $request)
    {
        $redirect_login=false;
        $images=$request->get('images');
        $location=$request->get('location');
        $location_array=explode('_',$location);
        $filters=$request->get('filter_id');
        $Ads=new Ads($request->all());
        $Ads->view=0;
        $user_id=$Ads->getUserId();

        $url=str_replace('-','',$request->get('title'));
        $url=str_replace('/','',$url);
        $url=preg_replace('/\s+/','-',$url);
        $Ads->url=$url;
        if(!$user_id)
        {
            $user_id=uniqid('guest_');
        }
        if(!Auth::check())
        {
            $redirect_login=true;
        }

        $Ads->user_id=$user_id;

        if(sizeof($location_array)==3)
        {
            $Ads->ostan_id=$location_array[0];
            $Ads->shahr_id=$location_array[1];
            $Ads->area_id=$location_array[2];

            $Ads->save();

            $Ads->createAdsImage($Ads->id,$images);
            $Ads->createAdsFilters($Ads->id,$filters);
        }
        else
        {
            return redirect('/');
        }

        if($redirect_login)
        {
            return redirect('login')
                ->withCookie(cookie()->forever('user_id',$user_id));
        }
        else
        {
//            return redirect('list')->with('status','آگهی شما ثبت شده و بعد از تایید نمایش داده میشود ');
            return redirect('/');
        }


    }
    public function getCatAds($location_name,$cat_url)
    {
        $catList=Category::with('getChild')->withCount('ads_list')->where('parent_id','0')->get();

        $category=Category::with('childCatWithAdsCount')->where(['url'=>$cat_url])->firstOrFail();
        $catFilter=Filter::with('getChild')->where('catId',$category->id)->get();
        $Ads=Ads::with(['getFirstImage','getOstanName','getShahrName',
            'getFilter.filter_parent'])
            ->where('cat1_id',$category->id)->where('status',1)
            ->OrderBy('created_at','DESC')->get();

        return view('site.search_ads_cat',
            [
                'ads'=>$Ads,
                'category'=>$category,
                'catFilter'=>$catFilter,
                'cat_name'=>$category->category_name,
                'catList'=>$catList
            ]);
    }
    public function getCat2Ads($location_name,$cat_url,$cat2_url)
    {
        $catList=Category::with('getChild')->withCount('ads_list')->where('parent_id','0')->get();

        $category=Category::where(['url'=>$cat_url])->firstOrFail();
        $category2=Category::with('childCatWithAdsCount')
            ->where(['url'=>$cat2_url,'parent_id'=>$category->id])->firstOrFail();
        $catFilter=Filter::with('getChild')
            ->whereIn('catId',[$category->id,$category2->id])
            ->get();

        $Ads=Ads::with(['getFirstImage','getOstanName','getShahrName','getFilter.filter_parent'])
            ->where(['cat1_id'=>$category->id,'cat2_id'=>$category2->id,'status'=>1])
            ->OrderBy('created_at','DESC')->get();
        return view('site.search_ads_cat',
            [
                'ads'=>$Ads,
                'category'=>$category2,
                'catFilter'=>$catFilter,
                'cat_name'=>$category2->category_name,
                'catList'=>$catList
            ]);
    }
    public function ads_filter(Request $request)
    {
        $search=new Search();
        $search->filter=$request->get('filter',array());
        $ads=$search->getAds();

        return view('include.ads',['ads'=>$ads]);
    }
    public function show_ads($url)
    {
        $data=Ads::getAdsData($url);
        if(sizeof($data)==2){

            $id=$data['id'];
            settype($id,'integer');
            $ads=Ads::with(['getGallery','getAdsItem'])->where(['id'=>$id,'url'=>$data['url']])->firstOrFail();

            return view('site.show_ads_content',['ads'=>$ads]);
        }
        else{
            abort(404);
        }
    }
}
