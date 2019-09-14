<!DOCTYPE html>
<html>
<head>
    <title>@yield("title")</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Wedding Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />

    <link href="{{ asset("/") }}front/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom Theme files -->
    <!--theme style-->

    <script src="{{ asset("/") }}front/js/jquery.min.js"></script>

    <!--//theme style-->
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <!-- start menu -->
    <script src="{{ asset("/") }}front/js/simpleCart.min.js"> </script>
    <!-- start menu -->

    <link href="{{ asset("/") }}front/css/memenu.css" rel="stylesheet" type="text/css" media="all" />

    <script type="text/javascript" src="{{ asset("/") }}front/js/memenu.js"></script>

    <script>$(document).ready(function(){$(".memenu").memenu();});</script>
    <!-- /start menu -->
    <link href="{{ asset("/") }}front/css/style.css" rel="stylesheet" type="text/css" media="all" />

    @yield("extra-css")
</head>
<body>
<!--header-->
<script src="{{ asset("/") }}front/js/responsiveslides.min.js"></script>
<script>
    $(function () {
        $("#slider").responsiveSlides({
            auto: true,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            pager: false,
        });
    });
</script>

@include("front.includes.header")

<!---->
<script src="{{ asset("/") }}front/js/bootstrap.js"> </script>

@yield("content")

<!---->
@include("front.includes.footer")
<!---->
</body>
</html>