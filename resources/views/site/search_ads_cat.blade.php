@extends('layouts.site')

@section('content')

    @include('include.index_search_box',['cat_name'=>$cat_name , 'location'=>$location, 'shahr_name'=>$shahr_name])
    @include('include.CatList',['catList'=>$catList, 'shahr_name'=>$shahr_name])


    <div class="index_search_box col-lg-8 col-12 py-0">

        @include('include.ads_filter_form',['catFilter'=>$catFilter, 'shahr_name'=>$shahr_name ,'shahr_id'=>$shahr_id])

    </div>



    <div class="content col-12 col-lg-8 px-0" style="padding-top:0px">

        <div class="filter_list_box row mx-0 mt-3">

            <div class="filter_item">
                <span>{{ $shahr_name }}</span>
                <span class="fa fa-close"></span>
            </div>
            <div class="filter_item">
                <span>{{ $category->category_name }}</span>
                <span class="fa fa-close"></span>
            </div>

        </div>

        <div id="serp-intro">
            <ul class="list-inline">
                <li><span class="fa fa-home text_li"></span>
                    <span class="fa fa-angle-left"></span>
                </li>
                <li>
                    <a href="">
                        <span class="text_li">
                            @if(isset($ostan_name))
                                {{ $ostan_name  }}
                            @else
                                ایران
                            @endif
                        </span>
                    </a>
                    <span class="fa fa-angle-left"></span>
                </li>

                <li>
                    <a href="">
                        <span class="text_li">
                            @if(isset($shahr_name))
                                {{ $shahr_name  }}
                            @else
                                ایران
                            @endif
                        </span>
                    </a>
                    <span class="fa fa-angle-left"></span>
                </li>

                <li><a href="">
                        <span class="text_li"> {{ $category->category_name }}</span>
                    </a></li>

            </ul>

            <div class="ads_content d-flex flex-wrap">
                @include('include.ads',['ads'=>$ads])
            </div>
        </div>


    </div>

    <div class="add_ads_btn fixed d-md-none">
        <div>
            <span class="fa fa-plus"></span>
            <a href="{{ url('ads/new') }}" id="add_new_ads">ثبت آگهی رایگان</a>
        </div>
    </div>

@endsection
