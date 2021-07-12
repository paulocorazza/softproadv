<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="bootstrap 5, premium, multipurpose, sass, scss, saas, software"/>
    <meta name="description" content="HTML5 Template"/>
    <meta name="author" content="www.themeht.com"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Softpro - Advogados</title>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="assets/images/icon-adv.ico"/>

    <!-- inject css start -->

    <!--== bootstrap -->

    <link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/site/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!--== animate -->
    <link href="assets/site/css/animate.css" rel="stylesheet" type="text/css"/>

    <!--== fontawesome -->
    <link href="assets/site/css/fontawesome-all.css" rel="stylesheet" type="text/css"/>

    <!--== line-awesome -->
    <link href="assets/site/css/line-awesome.min.css" rel="stylesheet" type="text/css"/>

    <!--== magnific-popup -->
    <link href="assets/site/css/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css"/>

    <!--== owl-carousel -->
    <link href="assets/site/css/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>

    <!--== base -->
    <link href="assets/site/css/base.css" rel="stylesheet" type="text/css"/>

    <!--== shortcodes -->
    <link href="assets/site/css/shortcodes.css" rel="stylesheet" type="text/css"/>

    <!--== default-theme -->
    <link href="assets/site/css/style.css" rel="stylesheet" type="text/css"/>

    <!--== responsive -->
    <link href="assets/site/css/responsive.css" rel="stylesheet" type="text/css"/>

    <!--== responsive -->
    <link href="assets/site/css/responsive.css" rel="stylesheet" type="text/css"/>

    <!--== color-customizer -->
    <link href="assets/site/css/theme-color/color-5.css" data-style="styles" rel="stylesheet">

    <!-- inject css end -->

</head>

<body class="home-5">

<!-- page wrapper start -->

<div class="page-wrapper">

    <!--header start-->

       @yield('header')

    <!--header end-->


    <!--hero section start-->
        @yield('hero')
    <!--hero section end-->


    <!--body content start-->

      @yield('content')

    <!--body content end-->


    <!--footer start-->
    @yield('footer')
    <!--footer end-->
</div>

<!-- page wrapper end -->


<!--back-to-top start-->

<div class="scroll-top"><a class="smoothscroll" href="#top"><i class="flaticon-go-up-in-web"></i></a></div>

<!--back-to-top end-->


<!-- inject js start -->

<!--== jquery -->
<script src="assets/site/js/theme.js"></script>

<!--== owl-carousel -->
<script src="assets/site/js/owl-carousel/owl.carousel.min.js"></script>

<!--== magnific-popup -->
<script src="assets/site/js/magnific-popup/jquery.magnific-popup.min.js"></script>

<!--== counter -->
<script src="assets/site/js/counter/counter.js"></script>

<!--== countdown -->
<script src="assets/site/js/countdown/jquery.countdown.min.js"></script>

<!--== canvas -->
<script src="assets/site/js/canvas.js"></script>

<!--== confetti -->
<script src="assets/site/js/confetti.js"></script>

<!--== step animation -->
<script src="assets/site/js/snap.svg.js"></script>
<script src="assets/site/js/step.js"></script>

<!--== wow -->
<script src="assets/site/js/wow.min.js"></script>

<!--== theme-script -->
<script src="assets/site/js/theme-script.js"></script>

@yield('java-script')

</body>

</html>




