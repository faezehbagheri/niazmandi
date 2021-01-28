@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            افزودن استان
        </div>
        <div class="panel_content">
           
            {{ Form::open( [ 'url'=>'admin/location/ostan' ] ) }}

                <div class="form-group">
                    {{ Form::label('ostan_name' , 'نام استان :') }}
                    {{ Form::text('ostan_name',null,['class'=>'form-control']) }}
                    @if($errors->has('ostan_name'))
                        <p class="has_error">{{ $errors->first('ostan_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button class="btn btn-success">ثبت</button>
                </div>

            {{ Form::close() }}

        </div>
    </div>

@endsection