<div class="adsCatList col-lg-8 col-12 px-0">

    <ul class="list-inline">
        @foreach($catList as $key=>$value)

            <li>
                <a href="{{ url('مکان').'/'.$shahr_name.'/'.$value->url }}" class="d-flex flex-column flex-lg-row align-items-center">
                    @if(!empty($value->icon))
                        <img src="{{ url('upload').'/'.$value->icon }}" class="cat_icon"/>
                    @endif

                    <span class="cat_name">
                        {{ $value->category_name }}
                        <?php $r=0; ?>
                        @if($shahr_id != "ایران")
                            @foreach ($value['ads_list'] as $key2=>$value2)
                                @if ($value2['shahr_id']==$shahr_id)
                                    <?php $r++; ?>
                                @endif
                            @endforeach
                            <span class="ads_count d-none d-md-block">({{ $r }})</span>
                        @else
                            @foreach ($value['ads_list'] as $key2=>$value2)
                                <?php $r++; ?>
                            @endforeach
                            <span class="ads_count d-none d-md-block">({{ $r }})</span>
                        @endif
                        <?php $r=0; ?>
                    </span>
                </a>
            </li>

        @endforeach
    </ul>

    <div style="clear:both"></div>
</div>
