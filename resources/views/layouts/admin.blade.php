<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت</title>
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/admin.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container-fluid">
        <div class="page_sidebar">
            <span class="fa fa-bars" id="sidebarToggle"></span>
            <ul class="list-inline" id="sidebar_menu">
                <li>
                    <a>
                        <i class="fa fa-shopping-cart"></i>
                        <span class="sidebar_menu_span">آگهی ها</span>
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <div class="child_menu">
                        <a href="{{ url('admin/ads/verified') }}">آگهی های در انتظار تایید</a>
                        <a href="">آگهی های تایید شده</a>
                        <a href="{{ url('admin/ads/filter') }}">مدیریت فیلتر های آگهی</a>
                    </div>
                </li>
                <li>
                    <a>
                        <i class="fa fa-list"></i>
                        <span class="sidebar_menu_span">دسته بندی ها</span>
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <div class="child_menu">
                        <a href="{{ url('admin/category') }}">مدیریت دسته ها</a>
                        <a href="{{ url('admin/category/create') }}">افزودن دسته جدید</a>
                    </div>
                </li>
                <li>
                    <a>
                        <i class="fa fa-location-arrow"></i>
                        <span class="sidebar_menu_span">منطقه ها</span>
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <div class="child_menu">
                        <a href="{{ url('admin/location/ostan') }}">مدیریت استان ها</a>
                        <a href="{{ url('admin/location/shahr') }}">مدیریت شهر ها</a>
                        <a href="{{ url('admin/location/area') }}">مدیریت منطقه ها</a>
                    </div>
                </li>
                <li>
                    <a>
                        <i class="fa fa-users"></i>
                        <span class="sidebar_menu_span">کاربران</span>
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <div class="child_menu">
                        <a href="{{ url('admin/users') }}">مدیریت کاربران</a>
                        <a href="">اضافه کردن کاربر جدید</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="page_content">

            <div class="content_box">
                @yield('content')
            </div>

        </div>
        <div class="message_div">
            <div class="message_box">
                <p id="msg"></p>

                <a class="alert alert-success" onclick="delete_row()">بله</a>
                <a class="alert alert-danger" onclick="hide_box()">خیر</a>
            </div>
        </div>
    </div>

<script type="text/javascript" src="{{ url('js/app.js') }}"></script>
<!-- <script type="text/javascript" src="{{ url('js/admin.js') }}"></script> -->
<script>
    var Toggle = false;
    $("#sidebar_menu li").click(function(){
        var display=$(".child_menu",this).css('display');
        $(".child_menu").slideUp(500);
        $(".fa-angle-down").removeClass("fa-angle-down");
        $("#sidebar_menu li").removeClass("active");
        if(display == 'none'){
            if(!Toggle){
                $(".child_menu",this).slideDown(500);
            }
            else{
                $(".child_menu",this).show();
            }
            $(".fa-angle-left",this).addClass("fa-angle-down");
            $(this).addClass("active");
        }
    });

    $("#sidebarToggle").click(function(){
        if($("div").hasClass("toggled")){
            Toggle=false;
            $(".page_sidebar").removeClass('toggled');
            $(".page_content").css("padding-right",'225px');
        }else{
            Toggle=true;
            $(".page_sidebar").addClass('toggled');
            $(".page_content").css("padding-right",'50px');
            $(".child_menu").hide();
        }
    });

    $(window).resize(function(){
        var w = document.body.offsetWidth;
        if(w<850){
            $(".page_sidebar").addClass("toggled");
            $(".page_content").css('padding-right','50px');
            $(".child_menu").hide();
        }else{
            if(Toggle==false){
                $(".page_sidebar").removeClass("toggled");
                $(".page_content").css('padding-right','225px');
            }
        }
    });

    $(document).ready(function(event){
        var w = document.body.offsetWidth;
        if(w<850){
            $(".page_sidebar").addClass("toggled");
            $(".page_content").css('padding-right','50px');
            $(".child_menu").hide();
        }else{
            if(Toggle==false){
                $(".page_sidebar").removeClass("toggled");
                $(".page_content").css('padding-right','225px');
            }
        }

        var url=window.location.href.split('?')[0];
        $('#sidebar_menu a[href="'+url+'"]').parent().parent().addClass('active');
        $('#sidebar_menu a[href="'+url+'"]').parent().parent().find("a .fa-angle-left").addClass("fa-angle-down");

    });

    var delete_url;
    var token='';
    del_row=function(url,t,mssage_text){
        delete_url=url;
        token=t;
        $("#msg").text(mssage_text);
        $(".message_div").show();
    };

    delete_row=function(){
        // alert(token);
        var form = document.createElement("form");
        form.setAttribute("method","POST");
        form.setAttribute("action",delete_url);
        var hiddenField1 = document.createElement("input");
        hiddenField1.setAttribute("name","_method");
        hiddenField1.setAttribute("value", 'DELETE');
        form.appendChild(hiddenField1);
        var hiddenField2 = document.createElement("input");
        hiddenField2.setAttribute("name","_token");
        hiddenField2.setAttribute("value", token);
        form.appendChild(hiddenField2);
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    };

    hide_box=function(){
        delete_url='';
        token='';
        $(".message_div").hide();
    };

    add_filter_item=function (){
        $('.add_item_btn').show();
        var count=document.getElementsByClassName('filter_item').length +1;
        var html='<div style="width: 100%; float: right; margin-top: 10px"> '+
            '<input type="text" name="item['+-count+']" class="form-control filter_item" placeholder="عنوان آیتم">' +
            '</div>';
        $('#item_box').append(html);
    };
    $('.ads_gallery_img').click(function ()
    {
        const src=$(this).attr('src');
        $("#ad_img").attr('src',src);
    });
    $("#ads_status").change(function () {

        $("#statusForm").submit();

    });
</script>

</body>
</html>
