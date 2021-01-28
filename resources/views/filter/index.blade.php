@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            مدیریت فیلتر های آگهی
        </div>
        <div class="panel_content">

            <a href="{{ url('admin/ads/filter/create') }}" class="btn btn-success">افزودن فیلتر جدید</a>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ردیف</th>
                    <th>نام فیلتر</th>
                    <th>دسته فیلتر</th>
                    <th>عملیات</th>
                </tr>
                <?php $i=1 ?>
                @foreach($filter as $key=>$value)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $value->filter_name }}</td>
                        <td>{{ $value->getCat->category_name }}</td>
                        <td>
                            <a href="{{ url('admin/ads/filter').'/'.$value->id.'/edit' }}" class="fa fa-edit"></a>
                            <a href="{{ url('admin/ads/filter').'/'.$value->id}}" class="fa fa-eye"></a>
                            <a onclick="del_row(' {{ url('admin/ads/filter').'/'. $value->id }}' , '{{Session::token()}}', 'آیا از حذف فیلتر مطمئن هستید؟')" class="fa fa-trash"></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </table>

            {{$filter->links()}}

        </div>
    </div>

@endsection
