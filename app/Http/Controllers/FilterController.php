<?php

namespace App\Http\Controllers;

use App\Category;
use App\Filter;
use App\FilterItem;
use App\Http\Requests\FilterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function index(){
        $filter=Filter::with('getCat')->orderBy('id','DESC')->paginate(10);
        return view('filter.index',['filter'=>$filter]);
    }

    public  function  create(){
        $catList=Category::getTotalCatList();
        return view('filter.create',['catList'=>$catList]);
    }

    public function store(FilterRequest $request){
        $show_filter=$request->has('show_filter') ? 1 : 0;
        $filter=new Filter($request->all());
        $filter->show_filter=$show_filter;
        $filter->save();
        return redirect('admin/ads/filter');;
    }

    public function edit($id){
        $catList=Category::getTotalCatList();
        $filter=Filter::findOrFail($id);
        return view('filter.update',['catList'=>$catList , 'filter'=>$filter]);
    }

    public function update($id,FilterRequest $request){
        $array=$request->all();
        $show_filter=$request->has('show_filter') ? 1 : 0;
        $filter=Filter::findOrFail($id);
        $array['show_filter']=$show_filter;
        $filter->update($array);
        return redirect('admin/ads/filter');
    }

    public function destroy($id){
        $filter=Filter::with('getChild')->findOrFail($id);
        $filter->getChild()->delete();
        $filter->delete();
        return redirect('admin/ads/filter');
    }
    public function show($id){
        $filter=Filter::with(['getCat' , 'getChild'])->findOrFail($id);
        return view('filter.show' , ['filter'=>$filter]);
    }

    public function add_item(Request $request){
        $item = $request->get('item');
        $filter_id=$request->get('filter_id');
        if(is_array($item)){
            foreach ($item as $key=>$value){
                if(!empty($value)){
                    if($key>0){
                        DB::table('filterItem')->where('id',$key)->update(['item_name'=>$value]);
                    }else{
                        DB::table('filterItem')->insert(['item_name'=>$value , 'filter_id'=>$filter_id]);

                    }
                }
            }
        }
        return redirect()->back();
    }
     public function del_item($id){
        $item = FilterItem::findOrFail($id);
        $item->delete();
        return redirect()->back();
     }
}
