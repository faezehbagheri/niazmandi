<form id="filter_ads_form">
    {{ csrf_field() }}
    <?php $r=0; ?>
    @foreach($catFilter as $key=>$value)

        @if($r==0) <div class="row"> @endif
            <div class="col-4">

                @if($value->filter_type==0)
                    <div class="col-6 input_filter_div">
                        <label>حداقل {{ $value->filter_name }}</label>
                        <input name="filter[{{ $value->id }}][]" type="text" class="form-control minInput">
                    </div>
                    <div class="col-6 input_filter_div">
                        <label>حداکثر {{ $value->filter_name }}</label>
                        <input name="filter[{{ $value->id }}][]" type="text" class="form-control maxInput">
                    </div>

                @elseif($value->filter_type==1)

                    @if(sizeof($value->getChild)<8)
                        <select class="selectpicker filter_ads_select" name="filter[{{ $value->id }}]">
                            @foreach($value->getChild as $key2=>$value2)
                                <option value="{{ $value2->id }}">{{ $value2->item_name }}</option>
                            @endforeach
                        </select>

                    @else

                        <div>
                            <div class="select_box form-control filter_select_box" id="filter_{{ $value->id }}">
                                <span id="area_name">{{ $value->filter_name }}</span>
                                <span class="fa fa-angle-down"></span>
                            </div>
                        </div>


                        <div class="loading_div" id="filter_box_{{ $value->id }}">
                            <div class="data_box"><div style="text-align:center">
                                    <span class="title">{{ $value->filter_text }}</span></div>
                                <div style="width:100%;float:right;margin-top: -22px;padding-bottom:10px">

                                    <span class="fa fa-close" onclick="close_data_box()"></span>
                                </div>

                                <ul class="list-inline filter_ul">
                                    <li>
                                        <input type="text"  class="form-control search_input" placeholder="جست و جو ...">
                                    </li>
                                    @foreach($value->getChild as $key2=>$value2)
                                        <li class="item_ads" id="" >
                                            <span>{{ $value2->item_name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                    @endif

                @endif
            </div>

            <?php $r++; ?>


            @if($key==(sizeof($catFilter)-1) && $r!=3)

        </div>
        @endif

        @if($r==3)
        <?php $r=0; ?>
        </div>
        @endif


    @endforeach


    <div class="form-group">
        <button class="btn save_btn_search">ذخیره جست وجو</button>
    </div>

    <div style="clear:both"></div>
    @if(sizeof($category->childCatWithAdsCount)>0)
        <ul class="list-inline search_cat_list">
            @foreach($category->childCatWithAdsCount as $key=>$value)
                <li><a href="{{ url('مکان').'/'.$shahr_name.'/'.$category->url.'/'.$value->url }}">
                        {{ $value->category_name }} ({{ \App\Ads::replace_number(number_format($value->ads_list2_count)) }})
                    </a></li>
            @endforeach
        </ul>
    @endif
    <div style="clear:both"></div>




</form>
