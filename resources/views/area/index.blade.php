@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            مدیریت منطقه ها
        </div>
        <div class="panel_content">

            <a href="{{ url('admin/location/area/create') }}" class="btn btn-success">افزودن منطقه جدید</a>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ردیف</th>
                    <th>نام منطقه</th>
                    <th>نام شهر</th>
                    <th>عملیات</th>
                </tr>
                <form method="get">
                    <tr>
                        <td></td>
                        <td><input type="text" value="@if(array_key_exists('area_name', $data)){{$data['area']}}@endif" class="form-control" name="area"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </form>
                <?php $i=1; ?>
                @foreach($area as $key=>$value)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $value->area_name }}</td>
                        <td>{{ $value->getShahr->shahr_name }}</td>
                        <td>
                            <a href="{{ url('admin/location/area').'/'.$value->id.'/edit' }}" class="fa fa-edit"></a>
                            <a onclick="del_row(' {{ url('admin/location/area').'/'. $value->id }}' , '{{Session::token()}}', 'آیا از حذف منطقه مطمئن هستید؟')" class="fa fa-trash"></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </table>

            {{$area->links()}}

        </div>
    </div>

@endsection
