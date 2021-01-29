@extends('layouts.site')

@section('content')


    <div class="login_box">

        @if(Session::get('status')=='ok')

            <div id="active_box">
                <h5>تایید شماره موبایل</h5>
                <p class="gray">کد 6 رقمی ارسال شده به شماره موبایل {{ Session::get('login_mobile_number') }} را وارد نمایید</p>


                <div class="form-group">

                    <form method="post" id="active_form" action="{{ url('active_code') }}">
                        {{ csrf_field() }}

                        <p class="active_form_span">
                            <span>ارسال مجدد کد فعال سازی</span>

                            <span class="active_form_span left">تصحیح شماره موبایل</span>
                        </p>

                        <div class="number_input_div">
                            <input type="text" name="active_code" id="active_code" value="{{ old('active_code') }}" class="number_input number" maxlength="6">
                        </div>


                        <div class="line_box">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>


                        <p class="has_error">

                            {{ Session::get('active_error') }}
                        </p>


                        <div class="form-group">
                            <div id="btn_active_code" class="btn btn-primary">تایید نهایی و وورد به نیازمندی ها</div>
                        </div>
                    </form>
                </div>
            </div>
        @endif


        <div id="login_div" @if(Session::get('status')=='ok') style="display:none" @endif>
            <h5>ورود / ثبت نام </h5>
            <p class="gray">لطفا برای ورود یا ثبت نام شماره تلفن همراه  خود را وارد کنید. </p>

            <form method="post" action="{{ Route('login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>شماره موبایل</label>
                    <input type="text" name="mobile_number" value="{{ old('mobile_number') }}" id="mobile_number" class="form-control number">
                    @if($errors->has('mobile_number'))
                        <p class="has_error">{{ $errors->first('mobile_number') }}</p>
                    @endif
                </div>




                <div class="form-group">
                    <button class="btn btn-primary">ورود یا ثبت نام در نیازمندی ها</button>
                </div>
            </form>
        </div>

    </div>

@endsection
