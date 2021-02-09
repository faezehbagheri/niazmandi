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

    <div class="container-fluid">

        <div class="top_line"></div>

        <div class="navbar">

            <ul class="list-inline col-8" id="nab_bar_menu">
                <li><a href="/">صفحه اصلی</a></li>
                <li><a href="">پشتیبانی</a></li>




                <li class="dropdown_link">
                    <a data-toggle="dropdown">
                        <span>حساب من</span>
                        <span class="fa fa-user"></span>
                    </a>

                    <ul class="dropdown-menu dropdown_ul">
                        <li><a class="dropdown-item" href="{{ url('login') }}">ورود ثبت نام</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="">پسندیده ها</a></li>
                        <li><a class="dropdown-item" href="">آگهی های من</a></li>
                        <li><a class="dropdown-item" href="">جست و جو های من</a></li>
                    </ul>
                </li>
                <li class="add_ads_btn">
                    <div>
                        <span class="fa fa-plus"></span>
                        <a href="{{ url('ads/new') }}" id="add_new_ads">ثبت آگهی رایگان</a>
                    </div>
                </li>
            </ul>
        </div>


        @yield('content')


        <div style="clear:both"></div>

        <footer id="footer">


            <div style="margin: auto" class="col-8">
                <ul class="list-inline footer_ul">
                    <li>نیازمندی ها</li>
                    <li><a href="">
                            درباره نیازمندی های
                        </a></li>

                    <li><a href="">
                            بلاگ
                        </a></li>

                    <li><a href="">
                            نقشه سایت
                        </a></li>

                </ul>


                <ul class="list-inline footer_ul">
                    <li>راهنمای مشتریان</li>
                    <li><a href="">
                            سوالات متداول
                        </a></li>

                    <li><a href="">
                            قوانین و مقررات
                        </a></li>

                    <li><a href="">
                            سیاست حفظ حریم شخصی
                        </a>
                    </li>

                </ul>


                <ul class="list-inline footer_ul">
                    <li>خدمات مشتریان</li>
                    <li><a href="">
                            ارسال پیشنهادات
                        </a></li>

                    <li><a href="">
                            پشتیبانی ۲۴ ساعته
                        </a></li>

                </ul>

                <ul class="list-inline footer_ul left">
                    <li>
                        <a href="" class="app-badge google-play"></a>
                    </li>

                    <li>
                        <a href="" class="app-badge app-store"></a>
                    </li>

                    <li>
                        <a href="" class="app-badge myket"></a>
                    </li>
                </ul>

            </div>

        </footer>
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

    show_shahr=function (text,id,size){

        $('.shahr').hide();
        $("#ostan").hide();
        $("#"+text+'_box_'+id).show();
        if(ostan_id==0)
        {
            ostan_id=id;
            $("#arrow_right").show();
        }
        else if(shahr_id==0)
        {
            shahr_id=id;
        }
        if(size==0)
        {
            location_id=ostan_id+"_"+shahr_id+"_"+area_id;
            close_data_box();
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
            $("#arrow_right").show();
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

    back_location_list=function () {
        if(shahr_id>0)
        {
            shahr_id=0;
            $('.child_menu2').hide();
            $("#shahr_box_"+shahr_id).show();
        }
        else if(ostan_id>0)
        {
            ostan_id=0
            $('.shahr').hide();
            $("#ostan").show();
            $("#arrow_right").hide();
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

    send_ads_form=function () {

        const url=site_url+"ads/new";
        const title=document.getElementById("ads_title").value;
        const tozihat=document.getElementById("tozihat").value;
        const token=$('meta[name="csrf-token"]').attr('content');
        const form = document.createElement("form");
        form.setAttribute("method", "POST");
        form.setAttribute("action",url);
        add_form_input(form,"title",title);
        var filter_text_keys=filter_array_value.keys();
        for(var i=0;i<filter_array_value.size;i++)
        {
            var key=filter_text_keys.next().value;
            const k=key.replace('filter_','');
            const Field = document.createElement("input");
            const v='filter_id['+k+']';

            var  value=filter_array_value.get(key);
            if(value=='')
            {
                const input=document.getElementById(key);
                value=input.value.trim();
            }
            Field.setAttribute("name",v);
            Field.setAttribute("value",value);
            form.appendChild(Field);
        }
        add_form_input(form,"cat1_id",cat1_id);
        add_form_input(form,"cat2_id",cat2_id);
        add_form_input(form,"cat3_id",cat3_id);
        add_form_input(form,"tozihat",tozihat);
        add_form_input(form,"location",location_id);
        add_form_input(form,"images",image_url);
        add_form_input(form,"_token",token);
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    };

    add_form_input=function (form,name,value) {

        var TokenField = document.createElement("input");
        TokenField.setAttribute("name",name);
        TokenField.setAttribute("value",value);
        form.appendChild(TokenField);
    };

    validate_ads_form=function () {
        var  status=true;
        const ads_title=document.getElementById('ads_title');
        if(!ads_title || ads_title.value.trim()=='')
        {
            status=false;
            $("#title_error_message").html('لطفا عنوان آگهی را وارد نمایید');
        }

        const tozihat=document.getElementById('tozihat');
        if(!tozihat || tozihat.value.trim()=='')
        {
            status=false;
            $("#tozihat_error_message").html('لطفا توضیحات آگهی را وارد نمایید');
        }

        return status;
    };

    setAdsFilterEvent=function () {
        var item=document.getElementsByClassName('item_ads');
        for (var i=0;i<item.length;i++)
        {
            const id=item[i].id.replace('ads_item_','');
            const span=$("#"+item[i].id+" span").text();
            $("#"+item[i].id).click(function () {

                var data=id.split('_');
                set_filter(data[0],data[1],span);
            })
        }
    };

    $(".number").keydown(function (event) {

        const keyCode=event.keyCode;
        if((keyCode>=48 && keyCode<=57) || keyCode==8)
        {
            return true;
        }
        else
        {
            return false;
        }
    });

    $("#btn_active_code").click(function () {

        var active_code=document.getElementById('active_code').value;
        if(active_code.length==6)
        {
            $("#active_form").submit();
        }
    });

    $(".active_form_span").click(function () {

        $("#login_div").show();
        $("#active_box").hide();
        document.getElementById('active_code').value='';
    });

    $('.dropdown_link').hover(function () {

        $('.dropdown-menu').show();
    },function () {
        $('.dropdown-menu').hide();
    });

    $('#select_cat').click(function () {

        const check=document.getElementById('catListBox').style.display;
        if(check=='block')
        {
            $("#catListBox").hide();
        }
        else
        {
            $("#catListBox").show();
        }

    });

    $(".input_filter_div").focusin(function(){

        $("label",this).css('top','-11px');
    });

    $(".input_filter_div").focusout(function(){

        $("label",this).css('top','11px');

        send_filter_ads_form();
    });

    send_filter_ads_form=function () {
        const form_data=$("#filter_ads_form").serialize();
        $.ajax({
            url:site_url+"/ads_filter",
            type:"POST",
            data:form_data,
            success:function (data)
            {
                $('.ads_content').html(data);
            }
        });
    };

    $('.filter_ads_select').change(function () {

        send_filter_ads_form();
    });

    $(".filter_ul").keyup(function () {

        const input=$('.search_input',this).val();
        const li=$('li',this);
        for (var i=0;i<li.length;i++)
        {
            const span=$("span",li[i]);
            if(span.length==1)
            {
                if(span[0].innerHTML.indexOf(input)>-1)
                {
                    li[i].style.display='block';
                }
                else
                {
                    li[i].style.display='none';
                }
            }
        }
    });

    $(".filter_select_box").click(function () {

        const id=this.id.replace('filter_','');
        $("#filter_box_"+id).show();
    });


</script>
    @yield('footer')
</body>
</html>
