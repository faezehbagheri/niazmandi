@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            ویرایش کاربر -   {{$user->username}}
        </div>

        <?php

        $user_role=array();
        $user_role[0]= 'مدیر کل';
        $user_role[1]= 'ادمین';

        ?>

        <div class="panel_content">

            {{ Form::model($user, [ 'url'=>'admin/users/' . $user->id ] ) }}

                {{ method_field('PUT') }}

                <div class="form-group">
                    {{ Form::label('username' , 'نام کاربری :') }}
                    {{ Form::text('username',null,['class'=>'form-control']) }}
                    @if($errors->has('username'))
                        <p class="has_error">{{ $errors->first('username') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('password' , 'رمز عبور :') }}
                    {{ Form::text('password',null,['class'=>'form-control']) }}
                    @if($errors->has('password'))
                        <p class="has_error">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('role' , 'role :') }}
                    {{ Form::select('role',$user_role,null,['class'=>'selectpicker' , 'data-live-search'=>'true']) }}
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">ویرایش</button>
                </div>

            {{ Form::close() }}

        </div>
    </div>

@endsection
