<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequest;
use DB;

class CategoryController extends Controller
{
    public function index(Request $request){
        $category= Category::search($request->all());
        return view('category.index', ['category'=>$category , 'data'=>$request->all()]);
    }

    public function create(){
        $catList=Category::getCatList();
        return view('category.create',['catList'=>$catList]);
    }

    public function store(CategoryRequest $request){
        $category=new Category($request->all());
        $url=str_replace('-' , '' , $request->get('category_name'));
        $url=preg_replace('/\s+/','-',$url);
        if($request->hasFile('pic')){
            $file_name='icon_'.time().'.'. $request->file('pic')->getClientOriginalExtension();
            if($request->file('pic')->move('upload',$file_name)){
                $category->icon = $file_name;
            }
        }
        $category->url=$url;
        $category->save();
        return redirect('admin/category');
    }

    public function edit($id){
        $category=Category::findOrFail($id);
        $catList=Category::getCatList();
        return view('category.update' , ['catList'=>$catList, 'category'=>$category]);
    } 

    public function update($id,CategoryRequest $request){
        $category= Category::findOrfail($id);
        $url=str_replace('-' , '' , $request->get('category_name'));
        $url=preg_replace('/\s+/','-',$url);
        if($request->hasFile('pic')){
            $file_name='icon_'.time().'.'. $request->file('pic')->getClientOriginalExtension();
            if($request->file('pic')->move('upload',$file_name)){
                $category->icon = $file_name;
            }
        }
        $category->url=$url;
        $category->update($request->all());
        return redirect('admin/category');
    }

    public function destroy($id){
        $category= Category::findOrfail($id);
        $category->delete();
        DB::table('category')->where(['parent_id'=>$id])->delete();
        return redirect('admin/category');
    }
}
