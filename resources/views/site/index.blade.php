@extends('layouts.site')

@section('content')

    <div class="new_ads_box">
        <h5>ثبت آگهی جدید</h5>

        <div class="row">


            <div class="col">
                <input type="text" name="ads_title" class="form-control" id="ads_title" placeholder="عنوان آگهی ...">
                <p id="title_error_message" class="has_error"></p>
            </div>

            <div class="col">
                <div class="select_box form-control" onclick="show_cat_list()">
                    <span id="cat_list_name">انتخاب گروه آگهی</span>
                    <span class="fa fa-angle-down"></span>
                    <p class="has_error"></p>
                </div>
            </div>
        </div>

        <div id="filter_box" style="padding-bottom: 20px" class="row">

            <div class="col-6">
                <div class="select_box form-control" onclick="show_location_list()">
                    <span id="area_name">انتخاب مکان</span>
                    <span class="fa fa-angle-down"></span>
                </div>
            </div>
        </div>


        <h5>عکس های آگهی</h5>


        <div class="row" id="image_div_box" style="padding:20px">

            <div id="image_box">



            </div>
            <div class="pic_div">

                <div class="pic_div_span">
                    <span class="fa fa-plus"></span>
                    <p>افزودن عکس</p>
                </div>

            </div>

            <div class="pic_div2">
                <div class="pic_div2_span">
                    <span class="fa fa-camera"></span>
                </div>
            </div>

            <div class="pic_div2">
                <div class="pic_div2_span">
                    <span class="fa fa-camera"></span>
                </div>
            </div>

            <div class="pic_div2">
                <div class="pic_div2_span">
                    <span class="fa fa-camera"></span>
                </div>
            </div>

            <div class="pic_div2">
                <div class="pic_div2_span">
                    <span class="fa fa-camera"></span>
                </div>
            </div>

            <input type="file" onchange="loadImage(event)" class="hidden_file_input" id="file_input1" accept="image/*">

        </div>


        <div class="form-group" style="margin-top: 20px;">
            <button class="btn btn-primary" id="add_ads_btn">ثبت آگهی</button>
        </div>

    </div>

    <div id="filter_div_box">
        @include('include.cat_list',['category'=>$category])
        @include('include.location',['location'=>$location])
    </div>
@endsection
