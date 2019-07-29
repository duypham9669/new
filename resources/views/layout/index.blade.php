<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <base href="{{asset('')}}">
    <!-- Bootstrap Core CSS -->
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}

    <link href="pages_asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="pages_asset/css/shop-homepage.css" rel="stylesheet">
    <link href="pages_asset/css/my.css" rel="stylesheet">
    <link href="pages_asset/css/blackthem.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>

    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>

    <![endif]-->

</head>
<body id="content">
<div class="container" id="content">
    <?php
    $fontColor = "black";
    ?>



@include('layout.header')
@yield('content')
@include('layout.footer')
</div>
<!-- jQuery -->
<script src="pages_asset/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="pages_asset/js/bootstrap.min.js"></script>
<script src="pages_asset/js/my.js"></script>
<script>
    var button1 = document.getElementById("btn1");
    var button2 = document.getElementById("btn2");
    var div = document.getElementById('content');

    button1.onclick = function () {
        // div.style.color= "black";
        div.style.background = "white";

    };

    // Thiết lập click cho button 2
    button2.onclick = function () {
        // div.style.background = "#181a1b";
        // div.style.color= "white";
        div.style.background= "#212121";
        <?php
        $fontColor = "black";
        ?>

    };
</script>
</body>
</html>
@yield('script')
