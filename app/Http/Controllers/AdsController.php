<?php

namespace App\Http\Controllers;

use App\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function verified()
    {
        $AdsList=Ads::with('getUser')->where('status',0)->orderBy('updated_at','DESC')->paginate(10);
        return view('ads.list',['AdsList'=>$AdsList]);
    }
    public function destroy($id)
    {
        $ads=Ads::findOrFail($id);
        $ads->delete();

        return redirect()->back();
    }
    public function show($id)
    {
        $ads=Ads::with(['getGallery','getAdsItem','getUser'])->where(['id'=>$id])->firstOrFail();
        return view('ads.show',['ads'=>$ads]);
    }
    public function changeStatus(Request $request)
    {
        $ads=Ads::findOrFail($request->get('ads_id'));
        $status=$request->get('status');

        $ads->status=$status;
        $ads->update();

        return  redirect()->back();
    }
}
