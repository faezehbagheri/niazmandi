@extends('layouts.site')

@section('content')

    @include('include.index_search_box',['cat_name'=>$cat_name])
    @include('include.CatList',['catList'=>$catList])


    <div class="index_search_box">

        @include('include.ads_filter_form',['catFilter'=>$catFilter])

    </div>



    <div class="content" style="padding-top:0px">

        <div class="filter_list_box">

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
                <li><a href=""><span class="text_li">ایران</span></a>
                    <span class="fa fa-angle-left"></span>
                </li>

                <li><a href="">
                        <span class="text_li"> {{ $category->category_name }}</span>
                    </a></li>

            </ul>

            <div class="ads_content">
                @include('include.ads',['ads'=>$ads])
            </div>
        </div>


    </div>


@endsection
