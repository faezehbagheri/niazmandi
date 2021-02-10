<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Lib\ThrottlesActiveCode;
use App\Rules\MobileValidate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['login_form','login','active_code']);
    }
    public function index(){
        $users=User::whereIn('role', [1,0])->get();
        return view('user.index',['users'=>$users]);
    }
    public function create(){
        return view('user/create');
    }
    public function store(UserRequest $request){
        $user=new User($request->all());
        $user->role=(int)$request->role;
        $user->username=$request->username;
        $user->save();
        return redirect('admin/users');
    }
    public function edit($id){
        $user=User::findOrFail($id);
        return view('user.update',['user'=>$user]);
    }

    public function update($id,UserRequest $request){
        $array=$request->all();
        $user=User::findOrFail($id);
        $user->role=(int)$request->role;
        $user->username=$request->username;
        $user->update($array);
        return redirect('admin/users');
    }

    public function destroy($id){
        $user=User::findOrFail($id);
        $user->delete();
        return redirect('admin/users');
    }
    public function adminlogin_form(){
        return view('user.admin_login');
    }
    public function login_form(){
        return view('user.login_form');
    }
    public function adminlogin(Request $request){
        $username=$request->get('username');
        $user=User::where('username', $username)->first();
        if($user){
            Auth::login($user, true);
            return redirect('/admin');
        }else{

        }
    }
    public function login(Request $request)
    {

        $request->validate([
            'mobile_number' => ['required',new MobileValidate()],
        ],[],['mobile_number'=>'شماره موبایل']);

        $Throttles=new ThrottlesActiveCode();
        if($Throttles->hasTooManyActiveCodeAttempts($request))
        {
            $Throttles->fireLockoutEvent($request);
            $Throttles->sendLockoutResponse($request);
        }
        $Throttles->incrementLoginAttempts($request);

        $active_code=rand(99999,1000000);
        $mobile_number=$request->get('mobile_number');
        Session::put('login_mobile_number',$mobile_number);
        $user=User::where('mobile',$mobile_number)->first();
        if($user)
        {
            $user->active_code=$active_code;
            $user->update();
        }
        else
        {
            $user=new User();
            $user->mobile=$mobile_number;
            $user->active_code=$active_code;
            $user->role=2;
            $user->save();
        }
        return redirect()->back()->with('status','ok')->withInput($request->all());

    }
    public function active_code(Request $request)
    {
        if(Session::has('login_mobile_number'))
        {
            $mobile_number=Session::get('login_mobile_number');
            $active_code=$request->get('active_code',0);


            $user=User::where(['active_code'=>$active_code,'mobile'=>$mobile_number])->first();
            if($user)
            {
                Session::forget('login_mobile_number');
                $user_id=Cookie::get('user_id');
                DB::table('ads')->where('user_id',$user_id)->update(['user_id'=>$user->id]);
                Auth::login($user, true);
                return redirect('/');
            }
            else
            {
                return redirect()->back()->with(['active_error'=>'کد فعال سازی حساب کاربری اشتباه می باشد',
                    'status'=>'ok']);
            }
        }
        else
        {
            return redirect('login');
        }

    }
}
