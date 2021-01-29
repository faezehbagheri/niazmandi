<div class="loading_div" id="catList">
    <div class="data_box">

        <div style="text-align:center">

            <span class="title">انتخاب گروه آگهی</span>

        </div>

        <div style="width:100%;float:right;margin-top: -22px;padding-bottom:10px">

            <div id="arrow_right" onclick="back_cat_list()">
                <span class="fa fa-arrow-right"></span>
                <span>بازگشت</span>
            </div>
            <span class="fa fa-close" onclick="close_data_box()"></span>

        </div>
        <ul class="list-inline" id="cat1">
            @foreach($category as $key=>$value)

                <li  onclick="show_child_menu('{{ $value->id }}','{{ sizeof($value->getChild) }}','{{ $value->category_name }}')">
                    @if(!empty($value->icon))
                        <img src="{{ url('upload').'/'.$value->icon }}">
                    @endif
                    <span>{{ $value->category_name }}</span>
                    @if(sizeof($value->getChild)>0)
                        <span class="fa fa-angle-left"></span>
                    @endif
                </li>
            @endforeach
        </ul>

        @foreach($category as $key=>$value)
            <ul class="list-inline child_menu1" id="cat_{{ $value->id }}">
                @foreach($value->getChild as $key2=>$value2)
                    <li onclick="show_child_menu('{{ $value2->id }}','{{ sizeof($value2->getChild) }}','{{ $value2->category_name }}')">
                        <span>{{ $value2->category_name }}</span>
                        @if(sizeof($value2->getChild)>0)
                            <span class="fa fa-angle-left"></span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endforeach

        @foreach($category as $key=>$value)

            @foreach($value->getChild as $key2=>$value2)
                <ul class="list-inline child_menu2" id="cat_{{ $value2->id }}">
                    @foreach($value2->getChild as $key3=>$value3)
                        <li onclick="show_child_menu('{{ $value3->id }}','0','{{ $value3->category_name }}')">
                            <span>{{ $value3->category_name }}</span>
                        </li>
                    @endforeach
                </ul>
            @endforeach

        @endforeach
    </div>
</div>
