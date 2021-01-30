@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            ویرایش فیلتر {{$filter->filter_name}}
        </div>

        <?php

        $filter_type=array();
        $filter_type[0]= 'فیلتر بازه ای';
        $filter_type[1]= 'فیلتر انتخابی';
        $filter_type[2]= 'فیلتر checkbox';

        $validateType=array();
        $validateType[0]='رشته - میتواند خالی باشد';
        $validateType[1]='رشته - نمیتواند خالی باشد';
        $validateType[2]='عددی - میتواند خالی باشد';
        $validateType[3]='عددی - نمیتواند خالی باشد';

        ?>

        <div class="panel_content">

            {{ Form::model($filter, [ 'url'=>'admin/ads/filter/'.$filter->id , 'files'=>true ] ) }}

            {{method_field('PUT')}}
                <div class="form-group">
                    {{ Form::label('filter_name' , 'نام فیلتر :') }}
                    {{ Form::text('filter_name',null,['class'=>'form-control']) }}
                    @if($errors->has('filter_name'))
                        <p class="has_error">{{ $errors->first('filter_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('catId' , 'دسته فیلتر :') }}
                    {{ Form::select('catId',$catList,null,['class'=>'selectpicker' , 'data-live-search'=>'true']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('filter_type' , 'نوع فیلتر :') }}
                    {{ Form::select('filter_type',$filter_type,null,['class'=>'selectpicker' , 'data-live-search'=>'true']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('filter_text' , 'label فیلتر :') }}
                    {{ Form::text('filter_text',null,['class'=>'form-control']) }}
                    @if($errors->has('filter_text'))
                        <p class="has_error">{{ $errors->first('filter_text') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('validateType' , 'نوع اعتبار سنجی :') }}
                    {{ Form::select('validateType',$validateType,null,['class'=>'selectpicker' , 'data-live-search'=>'true']) }}
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">ویرایش</button>
                </div>

            {{ Form::close() }}

        </div>
    </div>

@endsection
