<div class="index_search_box col-10">


    <div class="col-4">
        <input type="text" name="" class="form-control"  placeholder="جست و جو ...">
    </div>
    <div class="select_box form-control col-3" id="select_cat">
        <span class="box_title">
            @if(isset($cat_name))
                {{ $cat_name  }}
            @else
                همه گروه ها
            @endif
        </span>
        <span class="fa fa-angle-down"></span>
    </div>

    <div class="select_box form-control col-3" onclick="show_location_list()">
        <span class="box_title">همه ایران</span>
        <span class="fa fa-angle-down"></span>
    </div>

    <div class="col-2 btn_search">
        <div>
            <span class="fa fa-search"></span>
            <span>جست و جو</span>
        </div>
    </div>

    <div style="clear:both"></div>
</div>
