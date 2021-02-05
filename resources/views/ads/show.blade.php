@extends("layouts.admin")

@section('content')

    <div class="panel">

        <div class="header">
            {{ $ads->title }}
        </div>


        <div class="panel_content">





            <div class="row">

                <div class="col-md-6">

                    <form method="post" action="{{ url('admin/ads/changeStatus') }}" id="statusForm">
                        <input type="hidden" value="{{ $ads->id }}" id="ads_id" name="ads_id">
                        {{ csrf_field() }}
                        <table class="table table-bordered" id="ads_item_table">


                            @foreach($ads->getAdsItem as $key=>$value)
                                @if($value->getItemName)
                                    <tr>
                                        <td> {{ $value->getItemName->filter_name }}</td>
                                        <td>
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
                                        </td>
                                    </tr>
                                @endif
                            @endforeach


                            <tr>
                                <td>شماره تماس</td>
                                <td>{{ $ads->getUser->mobile }}</td>
                            </tr>

                            <tr>
                                <td>وضعیت اگهی</td>
                                <td>
                                    <select id="ads_status" name="status" class="selectpicker">
                                        <option @if($ads->status==1) selected="selected"  @endif value="1">تایید شده</option>
                                        <option @if($ads->status==0) selected="selected"  @endif value="0">در انتظار تایید</option>
                                        <option @if($ads->status==2) selected="selected"  @endif value="2">رد شده</option>
                                    </select>
                                </td>
                            </tr>
                        </table>

                    </form>

                    {{ nl2br($ads->tozihat) }}

                </div>
                <div class="col-md-6">




                    @if(sizeof($ads->getGallery)>0)
                        <img src="{{ url('upload'.'/'.$ads->getGallery[0]->url) }}" style="width:100%" id="ad_img">
                    @endif
                    @foreach($ads->getGallery as $key=>$value)
                        <div class="ads_gallery_div">
                            <img src="{{ url('upload'.'/'.$value->url) }}" class="ads_gallery_img">
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection
