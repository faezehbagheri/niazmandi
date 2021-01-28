@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            افزودن منطقه
        </div>
        <div class="panel_content">

            {{ Form::open( [ 'url'=>'admin/location/area' ] ) }}

                <div class="form-group">
                    {{ Form::label('area_name' , 'نام منطقه :') }}
                    {{ Form::text('area_name',null,['class'=>'form-control']) }}
                    @if($errors->has('area_name'))
                        <p class="has_error">{{ $errors->first('area_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('shahr_id' , 'انتخاب شهر :') }}
                    {{ Form::select('shahr_id',$shahr,null,['class'=>'selectpicker' , 'data-live-search'=>'true']) }}
                </div>

                <div class="form-group">
                    <button class="btn btn-success">ثبت</button>
                </div>

            {{ Form::close() }}

        </div>
    </div>

@endsection
