<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>نیازمندی ها</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/site.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

<script type="text/javascript" src="{{ url('js/app.js') }}"></script>
<script>

    var cat_id=0;
    var cat1_id=0;
    var cat2_id=0;
    var cat3_id=0;
    var ostan_id=0;
    var shahr_id=0;
    var area_id=0;
    var ostan_name='';
    var shahr_name='';
    var area_name='';
    var location_text='';
    var location_id='';
    var cat1_name='';
    var cat2_name='';
    var cat3_name='';
    var cat_text='';
    var image_url='';
    var images_count=0;
    var site_url="http://127.0.0.1:8000/";

    show_cat_list=function () {
        $('.child_menu1').hide();
        $('.child_menu2').hide();
        $("#cat1").show();
        $('#catList').show();
        cat1_name='';
        cat2_name='';
        cat3_name='';
        cat1_id=0;
        cat2_id=0;
        cat3_id=0;
    };

    show_location_list=function(){
        $('.shahr').hide();
        $('.area').hide();
        $("#ostan").show();
        $('#locationList').show();
        ostan_id=0;
        shahr_id=0;
        area_id=0;
        ostan_name='';
        shahr_name='';
        area_name='';
    };

    close_data_box=function () {

        $('.loading_div').hide();
    };

    show_child_menu=function (id,size,name) {
        if(cat1_id==0)
        {
            cat1_id=id;
            cat1_name=name;
        }
        else if(cat2_id==0)
        {
            cat2_id=id;
            cat2_name=name;
        }
        else if(cat3_id==0)
        {
            cat3_id=id;
            cat3_name=name;
        }

        if(size>0)
        {
            $("#cat1").hide();
            $(".child_menu1").hide();
            $("#arrow_right").show();
            $("#cat_"+id).show();
        }
        else if(size==0)
        {
            $('#catList').hide();
            cat_id=id;

            cat_text=cat1_name;
            if(cat2_name!='')
            {
                cat_text=cat_text+" > "+cat2_name;
            }
            if(cat3_name!='')
            {
                cat_text=cat_text+" > "+cat3_name;
            }
            $("#cat_list_name").html(cat_text);
            get_filter(id);
        }

    };

    show_area=function(text,id,size,name){

        $('.shahr').hide();
        $("#ostan").hide();
        $("#"+text+'_box_'+id).show();
        if(ostan_id==0)
        {
            ostan_name=name;
            ostan_id=id;
        }
        else if(shahr_id==0)
        {
            shahr_name=name;
            shahr_id=id;
        }
        else if(area_id==0)
        {
            area_name=name;
            area_id=id;
        }
        if(size==0)
        {

            location_id=ostan_id+"_"+shahr_id+"_"+area_id;
            location_text=ostan_name;
            if(shahr_name!='')
            {
                location_text=location_text+" > "+shahr_name;
            }

            if(area_name!='')
            {
                location_text=location_text+" > "+area_name;
            }
            $("#area_name").html(location_text);
            close_data_box();

        }
    };

    back_cat_list=function () {
        if(cat3_id>0)
        {
            cat3_id=0;
            $('.child_menu2').hide();
            $("#cat_"+cat2_id).show();
        }
        else if(cat2_id>0)
        {
            $('.child_menu1').hide();
            $("#cat1").show();
            $("#arrow_right").hide();
        }
    };

    var row_count=0;
    var row_id=1;
    var filter_array_value=new Map();
    var filter_array_text=new Map();
    var filter_array_validate=new Map();
    get_filter=function (id) {
        $.ajaxSetup(
            {
                'headers':{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
            url:site_url+"get_filter",
            type:"POST",
            data:"catId="+id,
            success:function (data) {
                var json=$.parseJSON(data);
                $("#filter_box").html('');
                for (var i=0;i<json.length;i++)
                {
                    filter_array_text.set('filter_text_'+json[i].id,json[i].filter_text);
                    filter_array_value.set('filter_'+json[i].id,'');
                    filter_array_validate.set('filter_'+json[i].id,json[i].validateType);
                    if(json[i].get_child.length>0)
                    {

                        var html='<div id="filter_text_'+json[i].id+'"  class="col-6" style="padding-top:20px">' +
                            '<div class="select_box form-control" onclick="show_filter_box('+json[i].id+')">' +
                            '<span id="filter_span_'+json[i].id+'">'+json[i].filter_text+'</span>' +
                            '<span class="fa fa-angle-down"></span>' +
                            '</div>' +
                            '<p class="has_error"></p>' +
                            '</div>';
                        $("#filter_box").append(html);

                        var box='<div class="loading_div" id="filter_box_'+json[i].id+'">' +
                            '<div class="data_box"><div style="text-align:center">' +
                            '<span class="title">'+json[i].filter_text+'</span></div>' +
                            '<div style="width:100%;float:right;margin-top: -22px;padding-bottom:10px">\n' +

                            '<span class="fa fa-close" onclick="close_data_box()"></span>' +
                            '</div>' +
                            '<ul class="list-inline">';
                        for (var j=0;j<json[i].get_child.length;j++)
                        {
                            var item_name="'"+json[i].get_child[j].item_name+"'";
                            const k=json[i].id+"_"+json[i].get_child[j].id;

                            var li='<li class="item_ads" id="ads_item_'+json[i].id+'_'+json[i].get_child[j].id+'" >' +
                                '<span>'+json[i].get_child[j].item_name+'</span>' +
                                '</li>';
                            box=box+li;


                        }
                        box=box+'</ul></div></div>';
                        $("#filter_div_box").append(box);
                    }
                    else
                    {
                        if(json[i].filter_type==0 || json[i].filter_type==1)
                        {

                            var html='<div id="filter_text_'+json[i].id+'" class="col-6" style="padding-top:20px">' +
                                '<input type="text" id="filter_'+json[i].id+'"  class="form-control" placeholder="'+json[i].filter_text+'">' +
                                '<p class="has_error"></p>' +
                                '</div>';

                            $("#filter_box").append(html);
                        }
                    }
                }

                $("#filter_box").append('<div class="col-6" style="padding-top:20px">' +
                    '<div class="select_box form-control" onclick="show_location_list()">' +
                    '<span id="area_name">انتخاب مکان</span>' +
                    '<span class="fa fa-angle-down"></span>' +
                    '</div>' +
                    ' </div>');

                if(location_text!='')
                {
                    $("#area_name").html(location_text);
                }
                setAdsFilterEvent();
            }


        });


    };

    show_filter_box=function (id) {
        $("#filter_box_"+id).show();
    };

    set_filter=function (id,child_id,item_name) {
        $("#filter_text_"+id+" .has_error").text('');
        filter_array_value.set('filter_'+id,child_id);
        close_data_box();
        $("#filter_span_"+id).text(item_name);
    };

    $("#add_ads_btn").on("click",function () {

        if(cat_id!=0)
        {
            var send=true;
            var filter_text_keys=filter_array_text.keys();
            for(var i=0;i<filter_array_value.size;i++)
            {
                var k=filter_text_keys.next().value;
                var a=k.replace('filter_text_','');
                var k2='filter_'+a;
                if(filter_array_value.get(k2)=='')
                {
                    var input=document.getElementById(k2);
                    if(input)
                    {
                        if(filter_array_validate.get(k2)==1 || filter_array_validate.get(k2)==3)
                        {
                            if(input.value.trim()=='')
                            {
                                send=false;
                                var text='لطفا '+filter_array_text.get(k)+' را وارد نمایید';
                                $("#"+k+" .has_error").text(text);
                            }
                            else
                            {
                                $("#"+k+" .has_error").text('');
                            }
                        }

                    }
                    else
                    {
                        send=false;
                        var text='لطفا '+filter_array_text.get(k)+' را انتخاب نمایید';
                        $("#"+k+" .has_error").text(text);
                    }
                }
                else
                {
                    $("#"+k+" .has_error").text('');
                }
            }

            const validate=validate_ads_form();
            if(send && validate)
            {
                send_ads_form();
            }
        }
    });

    $(".pic_div_span").click(function () {

        document.getElementById('file_input1').click();
    });

    loadImage=function (event) {
        var form_data=new FormData();
        form_data.append("pic",event.target.files[0]);
        $.ajaxSetup(
            {
                'headers':{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
            url:site_url+"ads_image_upload",
            data:form_data,
            type:'POST',
            contentType:false,
            processData:false,
            cache:false,
            success:function (data)
            {
                images_count++;
                $(".pic_div2").first().remove();
                const url=site_url+"thumbnails/"+data;
                var img=' <div class="ads_img">' +
                    '<span class="fa fa-trash"></span>' +
                    '<img src="'+url+'">' +
                    '</div>';
                $("#image_box").append(img);
                image_url=image_url+data+"@#!";
                $('img[src="'+url+'"]').parent().find('.fa-trash').click(function () {

                    remove_pic($(this).parent().find('img').attr('src'));
                });
                if(images_count==5)
                {
                    $(".pic_div").remove();
                }
            }
        })
    };

    remove_pic=function (src) {
        const url=site_url+"del_ads_img";
        $.ajaxSetup(
            {
                'headers':{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url:url,
            type:'POST',
            data:'src='+src,
            success:function (data)
            {
                if(data=='ok')
                {
                    if(images_count==5)
                    {
                        var html='<div class="pic_div">' +
                            '<div class="pic_div_span">' +
                            '<span class="fa fa-plus"></span>' +
                            '<p>افزودن عکس</p>' +
                            '</div>'+
                            '</div>';
                        $("#image_div_box").append(html);
                        $(".pic_div_span").click(function () {

                            document.getElementById('file_input1').click();
                        });
                    }
                    else
                    {
                        var html='<div class="pic_div2">' +
                            '<div class="pic_div2_span">' +
                            '<span class="fa fa-camera"></span>' +
                            '</div>' +
                            '</div>';
                        $("#image_div_box").append(html);
                    }
                    images_count--;
                    $('img[src="'+src+'"]').parent().remove();
                    const img_name=src.replace(site_url+"thumbnails/",'');
                    image_url=image_url.replace(img_name+"@#!",'');

                }
            }
        })
    };

</script>
</body>
</html>
