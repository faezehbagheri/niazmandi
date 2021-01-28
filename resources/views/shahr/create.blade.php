@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            افزودن شهر
        </div>
        <div class="panel_content">
           
            {{ Form::open( [ 'url'=>'admin/location/shahr' ] ) }}

                <div class="form-group">
                    {{ Form::label('shahr_name' , 'نام شهر :') }}
                    {{ Form::text('shahr_name',null,['class'=>'form-control']) }}
                    @if($errors->has('shahr_name'))
                        <p class="has_error">{{ $errors->first('shahr_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('ostan_id' , 'انتخاب استان :') }}
                    {{ Form::select('ostan_id',$ostan,null,['class'=>'selectpicker' , 'data-live-search'=>'true']) }}
                </div>

                <div class="form-group">
                    <button class="btn btn-success">ثبت</button>
                </div>

            {{ Form::close() }}

        </div>
    </div>

@endsection