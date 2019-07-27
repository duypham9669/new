<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <base href="{{asset('')}}">
    <!-- Bootstrap Core CSS -->
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
<body>
@include('layout.header')
@yield('content')
@include('layout.footer')
<!-- jQuery -->
<script src="pages_asset/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="pages_asset/js/bootstrap.min.js"></script>
<script src="pages_asset/js/my.js"></script>

</body>
</html>
@yield('script')
