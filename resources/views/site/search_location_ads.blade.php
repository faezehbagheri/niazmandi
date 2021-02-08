@extends('layouts.site')

@section('content')

    @include('include.index_search_box',['location'=>$location , 'shahr_name'=>$shahr_name])
    @include('include.CatList',['catList'=>$catList])


    @include('include.adsCatList',['catList'=>$catList, 'shahr_name'=>$shahr_name])



    <div class="content col-8 px-0" style="padding-top:0px">

        <div class="filter_list_box">

            <div class="filter_item">
                <span>{{ $shahr_name }}</span>
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
                </li>

            </ul>

            <div class="ads_content">
                @include('include.ads',['ads'=>$ads])
            </div>
        </div>


    </div>


@endsection
