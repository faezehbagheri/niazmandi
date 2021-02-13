<div class="loading_div" id="locationList">
    <div class="data_box">

        <div style="text-align:center">

            <span class="title">انتخاب شهر</span>

        </div>

        <div style="width:100%;float:right;margin-top: -22px;padding-bottom:10px">

            <div id="arrowright" onclick="back_location_list()">
                <span class="fa fa-arrow-right"></span>
                <span>بازگشت</span>
            </div>
            <span class="fa fa-close" onclick="close_data_box()"></span>

        </div>


        <ul class="list-inline" id="ostan">
            @foreach($location as $key=>$value)

                <li  onclick="show_area('shahr','{{ $value->id }}','{{ sizeof($value->getShahrs) }}','{{ $value->ostan_name }}')">

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
                    <li onclick="show_area('area','{{ $value2->id }}','{{ sizeof($value2->getAreaFromShahr) }}','{{ $value2->shahr_name }}')">
                        <span>{{ $value2->shahr_name }}</span>
                        @if(sizeof($value2->getAreaFromShahr)>0)
                            <span class="fa fa-angle-left"></span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endforeach



        @foreach($location as $key=>$value)

            @foreach($value->getShahrs as $key2=>$value2)
                <ul class="list-inline area" id="area_box_{{ $value2->id }}">
                    @foreach($value2->getAreaFromShahr as $key3=>$value3)
                        <li onclick="show_area('','{{ $value3->id }}','0','{{ $value3->area_name }}')">
                            <span>{{ $value3->area_name }}</span>
                        </li>
                    @endforeach
                </ul>
            @endforeach

        @endforeach

    </div>
</div>
