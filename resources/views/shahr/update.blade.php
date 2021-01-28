@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            ویرایش شهر  {{$shahr->shahr_name}}
        </div>
        <div class="panel_content">
           
            {{ Form::model($shahr, [ 'url'=>'admin/location/shahr/' . $shahr->id ] ) }}

                {{ method_field('PUT') }}
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
                    <button class="btn btn-primary">ویرایش</button>
                </div>

            {{ Form::close() }}

        </div>
    </div>

@endsection