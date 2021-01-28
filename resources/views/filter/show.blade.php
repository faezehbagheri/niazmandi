@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            فیلتر -{{$filter->filter_name}}
        </div>
        <?php

        $filter_type=array();
        $filter_type[0]= 'فیلتر بازه ای';
        $filter_type[1]= 'فیلتر انتخابی';
        $filter_type[2]= 'فیلتر checkbox';

        ?>

        <div class="panel_content">
            <table class="table table-striped table-bordered">
                <tr>
                    <td style="width: 150px">نام فیلتر</td>
                    <td>{{ $filter->filter_name }}</td>
                </tr>
                <tr>
                    <td style="width: 150px">دسته فیلتر</td>
                    <td>{{ $filter->getCat->category_name }}</td>
                </tr>
                <tr>
                    <td style="width: 150px">نوع فیلتر</td>
                    <td>{{ $filter_type[$filter->filter_type] }}</td>
                </tr>
            </table>

            <form method="post" action="{{ url('admin/ads/filter/add_item') }}">
                {{ csrf_field() }}
                <input type="hidden" value="{{ $filter->id }}" name="filter_id">
                <div id="item_box">
                    @foreach($filter->getChild as $key=>$value)
                        <div style="width: 100%; float: right; margin-top: 10px">
                            <input type="text" name="{{ $value->id }}" value="{{ $value->item_name }}" class="form-control filter_item" placeholder="عنوان آیتم">
                            <span class="fa fa-trash" onclick="del_row(' {{ url('admin/ads/filter/del_item').'/'. $value->id }}' , '{{Session::token()}}', 'آیا از حذف آیتم مطمئن هستید؟')"></span>
                        </div>
                    @endforeach
                    <div style="clear: both;"></div>
                </div>
                <button class="btn btn-success add_item_btn" id="add_item_btn">ثبت</button>
            </form>

            @if(sizeof($filter->getChild)>0)
                <script>
                    document.getElementById('add_item_btn').style.display='block';
                </script>
            @endif

        @if($filter->filter_type!= 2)
                <p class="add_item_text" onclick="add_filter_item()">
                    <span class="fa fa-plus"></span>
                    <span>افزودن آیتم</span>
                </p>
            @endif
        </div>
    </div>
@endsection
