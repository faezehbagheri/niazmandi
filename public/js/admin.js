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

    var url=window.location;
    $('#sidebar_menu a[href="'+url+'"]').parent().parent().addClass('active');
    $('#sidebar_menu a[href="'+url+'"]').parent().parent().find("a .fa-angle-left").addClass("fa-angle-down");

});

var delete_id;
var token='';
del_row=function(id,t){
    delete_id=id;
    token=t;
    $("#msg").text("آیا از حذف این دسته مطمئن هستید؟");
    $(".message_div").show();
};

delete_row=function(){
    alert(delete_id);
}

hide_box=function(){
    delete_id='';
    token='';
    $(".message_box").hide();
}