@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            ویرایش دسته {{$category->category_name}}
        </div>
        <div class="panel_content">
           
            {{ Form::model($category, [ 'url'=>'admin/category/'. $category->id , 'files'=>true ] ) }}

            {{method_field('PUT')}}
                <div class="form-group">
                    {{ Form::label('category_name' , 'نام دسته :') }}
                    {{ Form::text('category_name',null,['class'=>'form-control']) }}
                    @if($errors->has('category_name'))
                        <p class="has_error">{{ $errors->first('category_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('parent_id' , 'سر دسته :') }}
                    {{ Form::select('parent_id',$catList,null,['class'=>'selectpicker' , 'data-live-search'=>'true']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('pic' , 'آیکون دسته :') }}
                    {{ Form::file('pic') }}
                    @if($errors->has('pic'))
                        <p class="has_error">{{ $errors->first('pic') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button class="btn btn-success">ویرایش</button>
                </div>

            {{ Form::close() }}

        </div>
    </div>

@endsection