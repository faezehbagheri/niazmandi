@extends('layouts.site')

@section('content')

    <div class="header d-none d-md-block col-8">

        <h2>نیازمندیهای رایگان</h2>
        <p>

            خرید و فروش خودرو، املاک، آپارتمان، گوشی موبایل، تبلت، لوازم خانگی، لوازم دست دوم، استخدام و هر چه فکر کنید!
        </p>
    </div>


    @include('include.index_search_box',['location'=>$location])
    @include('include.CatList',['catList'=>$catList])


    @include('include.adsCatList',['catList'=>$catList, 'shahr_name'=>"ایران",'shahr_id'=>"ایران"])


    <div  class="content col-12 col-lg-8 px-0">


        <h5 class="color-gray">جدیدترین آگهی‌ها</h5>

        <div class="row">
            @include('include.ads',['ads'=>$newAds])
        </div>

        <div class="row">
            {{ $newAds->links() }}
        </div>
    </div>

    <div class="add_ads_btn fixed d-md-none">
        <div>
            <span class="fa fa-plus"></span>
            <a href="{{ url('ads/new') }}" id="add_new_ads">ثبت آگهی رایگان</a>
        </div>
    </div>

@endsection
