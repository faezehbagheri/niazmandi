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
        <ul class="list-inline" id="sidebar_menu">
            <li><a>
                <i class="fa fa-shopping-cart"></i>
                <span class="sidebar_menu_span">آگهی ها</span>
                <i class="fa fa-angle-left"></i>
            </a></li>
        </ul>
    </div>
    <div class="page_content"></div>
    </div>

<script type="text/javascript" src="{{ url('js/app.js') }}"></script>
</body>
</html>