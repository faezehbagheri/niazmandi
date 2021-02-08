@extends('layouts.site')

@section('content')

    <div class="header col-10">

        <h2>نیازمندیهای رایگان</h2>
        <p>

            خرید و فروش خودرو، املاک، آپارتمان، گوشی موبایل، تبلت، لوازم خانگی، لوازم دست دوم، استخدام و هر چه فکر کنید!
        </p>
    </div>


    @include('include.index_search_box')
    @include('include.CatList',['catList'=>$catList])


    @include('include.adsCatList',['catList'=>$catList])


    <div  class="content col-10">


        <h5 class="color-gray">جدیدترین آگهی‌ها</h5>

        @include('include.ads',['ads'=>$newAds])

    </div>

@endsection
