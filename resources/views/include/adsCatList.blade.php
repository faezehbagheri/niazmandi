<div class="adsCatList">

    <ul class="list-inline">
        @foreach($catList as $key=>$value)

            <li>
                <a href="{{ url('ایران').'/'.$value->url }}">
                    @if(!empty($value->icon))
                        <img src="{{ url('upload').'/'.$value->icon }}" class="cat_icon"/>
                    @endif

                    <span>
                        {{ $value->category_name }}
                        <span class="ads_count">({{ \App\Ads::replace_number(number_format($value->ads_list_count)) }})</span>
                    </span>
                </a>
            </li>

        @endforeach
    </ul>

    <div style="clear:both"></div>
</div>
