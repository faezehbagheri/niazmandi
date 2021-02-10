@foreach($ads as $key=>$value)
    <div class="col-sm-4 col-xl-3 col-12">
        <div class="ads_box d-flex flex-sm-column">


            <a class="img_box" href="{{ url("ads").'/'.$value->id.'-'.$value->url }}">
                @if($value->getFirstImage)
                    <img src="{{ url('thumbnails').'/'.$value->getFirstImage->url }}">

                @else
                    <img src="{{ url('images/default.png') }}">
                @endif
            </a>

            <div class="d-flex flex-column align-items-start">

            <a class="title" href="{{ url("ads").'/'.$value->id.'-'.$value->url }}">
                <h5>{{ $value->title }}</h5>
            </a>

            <span>{{ $value->getOstanName->ostan_name }} / {{ $value->getShahrName->shahr_name }} </span>


            @foreach($value->getFilter as $key=>$value)


                <?php $filter_parent=$value->filter_parent ?>
                @if(!empty($value->filter_value) && $filter_parent->show_filter==1)

                    <p>
                        <span class="item_ads_name">{{ $filter_parent->filter_name }} :</span>
                        @if(is_numeric($value->filter_value))

                            {{ \App\Ads::replace_number(number_format($value->filter_value)) }}
                        @endif
                    </p>
                @endif

            @endforeach

            </div>



        </div>
    </div>
@endforeach
