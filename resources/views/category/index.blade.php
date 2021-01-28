@extends('layouts.admin')

@section('content')

    <div class="panel">
        <div class="header">
            مدیریت دسته ها
        </div>
        <div class="panel_content">

            <a href="{{ url('admin/category/create') }}" class="btn btn-success">افزودن دسته جدید</a>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ردیف</th>
                    <th>نام دسته</th>
                    <th>دسته والد</th>
                    <th>عملیات</th>
                </tr>
                <form method="get">
                    <tr>
                        <td></td>
                        <td><input type="text" value="@if(array_key_exists('category_name', $data)){{$data['category_name']}}@endif" class="form-control" name="category_name"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </form>
                <?php $i=1 ?>
                @foreach($category as $key=>$value)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $value->category_name }}</td>
                        <td>{{ $value->getParent->category_name }}</td>
                        <td>
                            <a href="{{ url('admin/category').'/'.$value->id.'/edit' }}" class="fa fa-edit"></a>
                            <a onclick="del_row(' {{ url('admin/category').'/'. $value->id }}' , '{{Session::token()}}', 'آیا از حذف دسته مطمئن هستید؟')" class="fa fa-trash"></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </table>

            {{$category->links()}}

        </div>
    </div>

@endsection
