<div class="index_search_box col-8">


    <div class="col-4">
        <input type="text" name="seach" id="search" class="form-control"  placeholder="جست و جو ...">
    </div>
    <div class="select_box form-control col-3" id="select_cat">
        <span class="box_title">
            @if(isset($cat_name))
                {{ $cat_name  }}
            @else
                همه گروه ها
            @endif
        </span>
        <span class="fa fa-angle-down"></span>
    </div>

    <div class="select_box form-control col-3" onclick="show_location_list()">
        <span class="box_title" id="area_name">
            @if(isset($shahr_name))
                {{ $shahr_name  }}
            @else
                همه ایران
            @endif
        </span>
        <span class="fa fa-angle-down"></span>
    </div>

    <div class="col-2 btn_search">
        <div>
            <span class="fa fa-search"></span>
            <span>جست و جو</span>
        </div>
    </div>

    <div style="clear:both"></div>

    <div id="filter_div_box">
        <div class="loading_div" id="locationList">
            <div class="data_box">

                <div style="text-align:center">

                    <span class="title">انتخاب شهر</span>

                </div>

                <div style="width:100%;float:right;margin-top: -22px;padding-bottom:10px">

                    <div id="arrow_right" onclick="back_area_list()">
                        <span class="fa fa-arrow-right"></span>
                        <span>بازگشت</span>
                    </div>
                    <span class="fa fa-close" onclick="close_data_box()"></span>

                </div>


                <ul class="list-inline" id="ostan">
                    @foreach($location as $key=>$value)

                        <li  onclick="show_shahr('shahr','{{ $value->id }}','{{ sizeof($value->getShahrs) }}')">

                            <span>{{ $value->ostan_name }}</span>
                            @if(sizeof($value->getShahrs)>0)
                                <span class="fa fa-angle-left"></span>
                            @endif
                        </li>
                    @endforeach
                </ul>

                @foreach($location as $key=>$value)
                    <ul class="list-inline shahr" id="shahr_box_{{ $value->id }}">
                        @foreach($value->getShahrs as $key2=>$value2)
                            <li onclick="show_shahr('area','{{ $value2->id }}','0')">
                                <a href="{{ url( 'مکان/'.$value2->shahr_name ) }}">{{ $value2->shahr_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach

            </div>
        </div>
    </div>
</div>
