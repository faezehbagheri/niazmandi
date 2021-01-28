<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OstanRequest;
use App\Ostan;

class OstanController extends Controller
{
    public function index(Request $request){
        $ostan= Ostan::search($request->all());
        return view('ostan.index', ['ostan'=>$ostan , 'data'=>$request->all()]);
    }

    public function create(){
        return view("ostan.create");
    }

    public function store(OstanRequest $request){
        $ostan=new Ostan($request->all());
        $ostan->save();
        return redirect('admin/location/ostan');
    }

    public function edit($id){
        $ostan= Ostan::findOrfail($id);
        return view('ostan.update',['ostan'=>$ostan]);
    }

    public function update($id,OstanRequest $request){
        $ostan= Ostan::findOrfail($id);
        $ostan->update($request->all());
        return redirect('admin/location/ostan');
    }

    public function destroy($id){
        $ostan= Ostan::with(['getShahrs', 'getAreaFromOstan'])->findOrfail($id);
        $ostan->getAreaFromOstan()->delete();
        $ostan->getShahrs()->delete();
        $ostan->delete();
        return redirect('admin/location/ostan');
    }
}
