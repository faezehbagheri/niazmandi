@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            مدیریت شهر ها
        </div>
        <div class="panel_content">

            <a href="{{ url('admin/location/shahr/create') }}" class="btn btn-success">افزودن شهر جدید</a>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ردیف</th>
                    <th>نام شهر</th>
                    <th>نام استان</th>
                    <th>عملیات</th>
                </tr>
                <form method="get">
                    <tr>
                        <td></td>
                        <td><input type="text" value="@if(array_key_exists('shahr_name', $data)){{$data['shahr_name']}}@endif" class="form-control" name="shahr_name"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </form>
                <?php $i=1; ?>
                @foreach($shahr as $key=>$value)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $value->shahr_name }}</td>
                        <td>{{ $value->getOstan->ostan_name }}</td>
                        <td>
                            <a href="{{ url('admin/location/shahr').'/'.$value->id.'/edit' }}" class="fa fa-edit"></a>
                            <a onclick="del_row(' {{ url('admin/location/shahr').'/'. $value->id }}' , '{{Session::token()}}', 'آیا از حذف شهر مطمئن هستید؟')" class="fa fa-trash"></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </table>

            {{$shahr->links()}}

        </div>
    </div>

@endsection
