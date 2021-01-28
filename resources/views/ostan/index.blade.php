@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            مدیریت استان ها
        </div>
        <div class="panel_content">

            <a href="{{ url('admin/location/ostan/create') }}" class="btn btn-success">افزودن استان جدید</a>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ردیف</th>
                    <th>نام استان</th>
                    <th>عملیات</th>
                </tr>
                <form method="get">
                    <tr>
                        <td></td>
                        <td><input type="text" value="@if(array_key_exists('ostan_name', $data)){{$data['ostan_name']}}@endif" class="form-control" name="ostan_name"></td>
                        <td></td>
                    </tr>
                </form>
                <?php $i=1; ?>
                @foreach($ostan as $key=>$value)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $value->ostan_name }}</td>
                        <td>
                            <a href="{{ url('admin/location/ostan').'/'.$value->id.'/edit' }}" class="fa fa-edit"></a>
                            <a onclick="del_row(' {{ url('admin/location/ostan').'/'. $value->id }}' , '{{Session::token()}}', 'آیا از حذف استان مطمئن هستید؟')" class="fa fa-trash"></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </table>

            {{$ostan->links()}}

        </div>
    </div>

@endsection
