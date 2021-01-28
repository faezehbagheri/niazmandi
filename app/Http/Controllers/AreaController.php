<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\AreaRequest;
use App\Shahr;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(Request $request){
        $area= Area::search($request->all());
        return view('area.index', ['area'=>$area , 'data'=>$request->all()]);
    }

    public function create(){
        $shahr= Shahr::pluck('shahr_name','id')->toArray();
        return view("area.create" , ['shahr'=>$shahr]);
    }

    public function store(AreaRequest $request){
        $area=new Area($request->all());
        $area->save();
        return redirect('admin/location/area');
    }

    public function edit($id){
        $area= Area::findOrfail($id);
        $shahr= Shahr::pluck('shahr_name','id')->toArray();
        return view('area.update',['shahr'=>$shahr, 'area'=>$area]);
    }

    public function update($id,AreaRequest $request){
        $area= Area::findOrfail($id);
        $area->update($request->all());
        return redirect('admin/location/area');
    }

    public function destroy($id){
        $area= shahr::findOrfail($id);
        $area->delete();
        return redirect('admin/location/area');
    }
}
