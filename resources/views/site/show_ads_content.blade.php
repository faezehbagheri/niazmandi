@extends('layouts.site')

@section('content')
    <div class="back d-md-none">
        <a href="{{ url('/') }}">
            <span class="fa fa-arrow-right"></span>
            <span>بازگشت</span>
        </a>
    </div>

        <div class="row col-md-8 px-0 mx-auto" id="ads_content">

            <div class="col-md-8" id="ads_tozihat">

                @include('include.gallery',['ads'=>$ads])


                <h4>{{ $ads->title }}</h4>
                <table class="table">
                    <tbody class="d-flex flex-wrap">
                    @foreach($ads->getAdsItem as $key=>$value)
                        <tr class="col-md-6">
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

            <div class="col-md-4 mt-3 mt-md-0">
                <div class="d-flex flex-column justify-content-around align-items-center user_info">
                    <h5>مشخصات آگهی دهنده</h5>
                    <p>تماس با</p>
                    <button>{{$ads->getUser->mobile}}</button>
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
