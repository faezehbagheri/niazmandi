<?php

namespace App\Http\Controllers;
use App\Http\Requests\OstanRequest;
use App\Http\Requests\ShahrRequest;
use App\Shahr;
use App\Ostan;

use Illuminate\Http\Request;

class ShahrController extends Controller
{
    public function index(Request $request){
        $shahr= Shahr::search($request->all());
        return view('shahr.index', ['shahr'=>$shahr , 'data'=>$request->all()]);
    }

    public function create(){
        $ostan= Ostan::pluck('ostan_name','id')->toArray();
        return view("shahr.create" , ['ostan'=>$ostan]);
    }

    public function store(ShahrRequest $request){
        $shahr=new Shahr($request->all());
        $shahr->save();
        return redirect('admin/location/shahr');
    }

    public function edit($id){
        $shahr= Shahr::findOrfail($id);
        $ostan= Ostan::pluck('ostan_name','id')->toArray();
        return view('shahr.update',['shahr'=>$shahr, 'ostan'=>$ostan]);
    }

    public function update($id,ShahrRequest $request){
        $shahr= Shahr::findOrfail($id);
        $shahr->update($request->all());
        return redirect('admin/location/shahr');
    }

    public function destroy($id){
        $shahr= shahr::with('getAreaFromShahr')->findOrfail($id);
        $shahr->getAreaFromShahr()->delete();
        $shahr->delete();
        return redirect('admin/location/shahr');
    }
}
