<div class="adsCatList col-8 px-0">

    <ul class="list-inline">
        @foreach($catList as $key=>$value)

            <li>
                <a href="{{ url('مکان').'/'.$shahr_name.'/'.$value->url }}">
                    @if(!empty($value->icon))
                        <img src="{{ url('upload').'/'.$value->icon }}" class="cat_icon"/>
                    @endif

                    <span>
                        {{ $value->category_name }}
                        <?php $r=0; ?>
                        @if($shahr_id != "ایران")
                            @foreach ($value['ads_list'] as $key2=>$value2)
                                @if ($value2['shahr_id']==$shahr_id)
                                    <?php $r++; ?>
                                @endif
                            @endforeach
                            <span class="ads_count">({{ $r }})</span>
                        @else
                            @foreach ($value['ads_list'] as $key2=>$value2)
                                <?php $r++; ?>
                            @endforeach
                            <span class="ads_count">({{ $r }})</span>
                        @endif
                        <?php $r=0; ?>
                    </span>
                </a>
            </li>

        @endforeach
    </ul>

    <div style="clear:both"></div>
</div>
