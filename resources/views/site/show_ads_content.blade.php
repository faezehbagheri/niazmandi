@extends('layouts.site')

@section('content')

    <div class="container">

        <div class="row" id="ads_content">

            <div class="col-md-8" id="ads_tozihat">

                @include('include.gallery',['ads'=>$ads])


                <h4>{{ $ads->title }}</h4>
                <table class="table">
                    <tbody class="d-flex flex-wrap">
                    @foreach($ads->getAdsItem as $key=>$value)
                        <tr class="col-6">
                            @if($value->getItemName)
                                <td class="w-100">
                                    <div>
                                        <span>{{ $value->getItemName->filter_name }}</span>
                                        @if($value->getItemValue)
                                            <span class="ads_item_value">
                                         @if(is_numeric($value->filter_value) && strlen($value->filter_value)>=5)
                                                    {{ number_format($value->getItemValue->item_name) }}
                                                @else
                                                    {{ $value->getItemValue->item_name }}
                                                @endif

                                     </span>

                                        @else

                                            <span class="ads_item_value">
                                         @if(is_numeric($value->filter_value) && strlen($value->filter_value)>=5)
                                                    {{ number_format($value->filter_value) }}
                                                @else
                                                    {{ $value->filter_value }}
                                                @endif

                                     </span>
                                        @endif
                                    </div>
                                </td
                            @endif
                        </tr>

                    @endforeach
                    </tbody>
                </table>


                <p>{{ nl2br($ads->tozihat) }}</p>
            </div>

            <div class="col-md-4">


            </div>

        </div>

    </div>

@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('.carousel').carousel('pause');
        })
    </script>
@endsection
