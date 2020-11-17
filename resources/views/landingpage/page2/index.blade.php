<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="saas,crm,bootstrap4,template,download">
    <meta name="description"
        content="OhDearCRM is a Bootstrap4 Responsive Template for Startups,SaaS Companies and Agencies.">
    <meta name="author" content="">
    <title>SaaS & CRM App Landing Page Template - OhDearCRM</title>
    <link rel="icon" href="{{ asset('landingpage/page2/images/logo.png')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,500i|Roboto:500,700">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('landingpage/page2/css/bootstrap.min.css')}}">
    <!-- Plugins -->
    <!-- Venobox Lightbox slider {{ asset('../resources/views/landingpage/page2/')}}-->
    <link rel="stylesheet" href="{{ asset('landingpage/page2/css/venobox.css')}}">
    <!-- Slick Slider-->
    <link rel="stylesheet" href="{{ asset('landingpage/page2/js/slick/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('landingpage/page2/js/slick/slick-theme.css')}}">
    <!-- AOS Animate -->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('landingpage/page2/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('landingpage/page2/css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('landingpage/page2/css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('landingpage/src/form-product.css')}}">

</head>

<body>

    @if(isset($listSectionDefault) && count($listSectionDefault)>0)
        @foreach($listSectionDefault as $key => $sectionDefault)
            @include('landingpage.page2.sections.section_'.$sectionDefault)
        @endforeach
    @endif
    <!-- Back to Top -->
    <a href="#0" class="cd-top js-cd-top"><i class="fa fa-angle-up"></i></a>
    <!-- Back to Top ends-->

    <script src="{{ asset('landingpage/page2/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{ asset('landingpage/page2/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('landingpage/page2/js/popper.min.js')}}"></script>
    <script src="{{ asset('landingpage/page2/js/pace.min.js')}}"></script>
    <!-- Plugins -->
    <script src="{{ asset('landingpage/page2/js/back-to-top.js')}}"></script>
    <!-- Venobox Lightbox slider -->
    <script src="{{ asset('landingpage/page2/js/venobox.min.js')}}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('landingpage/page2/js/slick/slick.min.js')}}"></script>
    <!-- AOS Animate -->
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('landingpage/page2/js/main.js')}}"></script>
    <script src="{{ asset('landingpage/src/format-cart.js')}}"></script>
</body>
</html>
