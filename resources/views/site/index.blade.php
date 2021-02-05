@extends('layouts.site')

@section('content')

    <div class="header">

        <p>نیازمندیهای رایگان</p>
        <p>

            خرید و فروش خودرو، املاک، آپارتمان، گوشی موبایل، تبلت، لوازم خانگی، لوازم دست دوم، استخدام و هر چه فکر کنید!
        </p>
    </div>


    @include('include.index_search_box')
    @include('include.CatList',['catList'=>$catList])


    @include('include.adsCatList',['catList'=>$catList])


    <div  class="content">


        <h5 class="color-gray">جدیدترین آگهی‌ها</h5>

        @include('include.ads',['ads'=>$newAds])

    </div>

@endsection
