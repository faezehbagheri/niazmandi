<div id="catListBox">

    <?php $r=0; ?>

    @foreach($catList as $key=>$value)



        @if($r==0)
            <div class="catDiv" >

                @endif
                <div>
                    <a href="{{ url('ایران').'/'.$value->url }}">
                        @if(!empty($value->icon))
                            <img src="{{ url('upload').'/'.$value->icon }}" class="cat_icon"/>
                        @endif
                        <span>{{ $value->category_name }}</span>
                    </a>

                    <ul class="list-inline">
                        @foreach($value->getChild as $key2=>$value2)
                            <li><a href="{{ url('ایران').'/'.$value->url.'/'.$value2->url }}"><span>{{ $value2->category_name }}</span></a></li>
                        @endforeach
                    </ul>
                </div>
                <?php $r++; ?>
                @if($r==2)  <?php $r=0; ?></div>

        @elseif($key==(sizeof($catList)-1))
</div>
@endif


@endforeach
<div style="clear:both"></div>
</div>
