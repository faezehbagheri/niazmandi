<form id="filter_ads_form">
    {{ csrf_field() }}
    <div class="col-12 d-flex flex-wrap pb-3">
    @foreach($catFilter as $key=>$value)
            <div class="col-12 col-sm-6 col-md-4">

                @if($value->filter_type==0)
                    <div class="col-6 input_filter_div mt-3">
                        <label>حداقل {{ $value->filter_name }}</label>
                        <input name="filter[{{ $value->id }}][]" type="text" class="form-control minInput">
                    </div>
                    <div class="col-6 input_filter_div mt-3">
                        <label>حداکثر {{ $value->filter_name }}</label>
                        <input name="filter[{{ $value->id }}][]" type="text" class="form-control maxInput">
                    </div>

                @elseif($value->filter_type==1)

{{--                    @if(sizeof($value->getChild)<8)--}}
                        <select class="selectpicker filter_ads_select mt-3" name="filter[{{ $value->id }}]">
                            @foreach($value->getChild as $key2=>$value2)
                                <option value="{{ $value2->id }}">{{ $value2->item_name }}</option>
                            @endforeach
                        </select>

{{--                    @else--}}

{{--                        <div>--}}
{{--                            <div class="select_box form-control filter_select_box" id="filter_{{ $value->id }}">--}}
{{--                                <span id="area_name">{{ $value->filter_name }}</span>--}}
{{--                                <span class="fa fa-angle-down"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="loading_div" id="filter_box_{{ $value->id }}">--}}
{{--                            <div class="data_box"><div style="text-align:center">--}}
{{--                                    <span class="title">{{ $value->filter_text }}</span></div>--}}
{{--                                <div style="width:100%;float:right;margin-top: -22px;padding-bottom:10px">--}}

{{--                                    <span class="fa fa-close" onclick="close_data_box()"></span>--}}
{{--                                </div>--}}

{{--                                <ul class="list-inline filter_ul">--}}
{{--                                    <li>--}}
{{--                                        <input type="text"  class="form-control search_input" placeholder="جست و جو ...">--}}
{{--                                    </li>--}}
{{--                                    @foreach($value->getChild as $key2=>$value2)--}}
{{--                                        <li class="item_ads" id="" >--}}
{{--                                            <span>{{ $value2->item_name }}</span>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                    @endif--}}

                @endif
            </div>
    @endforeach
    </div>


    <div style="clear:both"></div>
    @if(sizeof($category->childCatWithAdsCount)>0)
        <ul class="list-inline search_cat_list d-flex flex-wrap pb-3">
            @foreach($category->childCatWithAdsCount as $key=>$value)
                <li class="col-lg-3 col-sm-6 col-12"><a href="{{ url('مکان').'/'.$shahr_name.'/'.$category->url.'/'.$value->url }}">
                        {{ $value->category_name }} ({{ \App\Ads::replace_number(number_format($value->ads_list2_count)) }})
                    </a></li>
            @endforeach
        </ul>
    @endif
    <div style="clear:both"></div>




</form>
