@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            مدیریت کاربران
        </div>
        <?php

        $user_role=array();
        $user_role[0]= 'مدیر کل';
        $user_role[1]= 'ادمین';

        ?>
        <div class="panel_content">

            <table class="table table-bordered table-striped">
                <tr>
                    <th>ردیف</th>
                    <th>نام کاربری</th>
                    <th>رمز عبور</th>
                    <th>role</th>
                    <th>عملیات</th>
                </tr>
                <?php $i=1; ?>
                @foreach($users as $key=>$value)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $value->username }}</td>
                        <td>{{ $value->password }}</td>
                        <td>{{ $user_role[$value->role] }}</td>
                        <td>
                            <a href="{{ url('admin/users').'/'.$value->id.'/edit' }}" class="fa fa-edit"></a>
                            <a onclick="del_row(' {{ url('admin/users').'/'. $value->id }}' , '{{Session::token()}}', 'آیا از حذف کاربر مطمئن هستید؟')" class="fa fa-trash"></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </table>

        </div>
    </div>

@endsection
