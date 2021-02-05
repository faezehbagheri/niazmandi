@extends("layouts.admin")

@section('content')

    <div class="panel">

        <div class="header">
            مدیریت آگهی های تایید نشد
        </div>


        <div class="panel_content">


            <?php
            $Jdf=new \App\lib\Jdf();
            ?>

            <table class="table table-bordered table-striped">
                <tr>
                    <th>ردیف</th>
                    <th>عنوان اگهی</th>
                    <th>شماره موبایل کاربر</th>
                    <th>تاریخ ثبت</th>
                    <th>تاریخ بروز رسانی</th>
                    <th>عملیات</th>
                </tr>
                <?php $i=1; ?>
                @foreach($AdsList as $key=>$value)
                    <tr>

                        <td>{{ $i }}</td>
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->getUser->mobile }}</td>
                        <td>{{ $Jdf->jdate(' H:i:s / Y-n-j',strtotime($value->created_at)) }}</td>
                        <td>{{ $Jdf->jdate(' H:i:s / Y-n-j',strtotime($value->updated_at)) }}</td>
                        <td>
                            <a class="fa fa-eye" href="{{ url('admin/ads').'/'.$value->id.'/show' }}"></a>
                            <a class="fa fa-trash" onclick="del_row('{{ url('admin/ads').'/'.$value->id  }}','{{ Session::token() }}','آیا از حذف این آگهی مطمین هستین !')"></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </table>

            {{ $AdsList->links() }}
        </div>
    </div>

@endsection
