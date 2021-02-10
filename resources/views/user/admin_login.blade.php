@extends('layouts.site')

@section('content')


    <div class="login_box">

        <div id="login_div" @if(Session::get('status')=='ok') style="display:none" @endif>
            <h5>ورود به بخش مدیریت</h5>

            <form method="post" action="{{ Route('adminlogin') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>نام کاربری</label>
                    <input type="text" name="username" value="{{ old('username') }}" id="username" class="form-control">
                    @if($errors->has('username'))
                        <p class="has_error">{{ $errors->first('username') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>رمز عبور</label>
                    <input type="password" name="password" value="{{ old('password') }}" id="password" class="form-control">
                </div>


                <div class="form-group">
                    <button class="btn btn-primary">ورود </button>
                </div>
            </form>
        </div>

    </div>

@endsection
