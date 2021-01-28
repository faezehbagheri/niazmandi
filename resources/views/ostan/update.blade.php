@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            ویرایش استان  {{$ostan->ostan_name}}
        </div>
        <div class="panel_content">
           
            {{ Form::model($ostan, [ 'url'=>'admin/location/ostan/' . $ostan->id ] ) }}

                {{ method_field('PUT') }}
                <div class="form-group">
                    {{ Form::label('ostan_name' , 'نام استان :') }}
                    {{ Form::text('ostan_name',null,['class'=>'form-control']) }}
                    @if($errors->has('ostan_name'))
                        <p class="has_error">{{ $errors->first('ostan_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">ویرایش</button>
                </div>

            {{ Form::close() }}

        </div>
    </div>

@endsection