@extends('layouts.site')

@section('content')


    <div  class="content">


        <h5 class="color-gray">جدیدترین آگهی‌ها</h5>

        @include('include.ads',['ads'=>$newAds])

    </div>

@endsection
