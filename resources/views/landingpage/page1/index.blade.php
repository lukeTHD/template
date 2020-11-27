<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Travel Web Template">
    <meta name="keywords" content="Travel Template,Flight Template,Cars Template,Hotels Template,Responsive Template">
    <meta name="author" content="M.Bilal">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Gateway - Multiple Purpose Travel  Template</title>
    <!--styles files-->
    <link href="{{ asset('landingpage/page1/assets/css/font-awesome.min.css')}} " rel="stylesheet">
    <link href="{{ asset('landingpage/page1/assets/css/bootstrap.min.css')}} " rel="stylesheet">
    <link href="{{ asset('landingpage/page1/assets/js/jqwidgets/styles/jqx.base.css')}}" rel="stylesheet">
    <link href="{{ asset('landingpage/page1/assets/js/animate/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('landingpage/page1/assets/js/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('landingpage/page1/assets/css/slick.css')}}" rel="stylesheet">
    <link href="{{ asset('landingpage/page1/assets/css/style.css')}}" rel="stylesheet">
    <!--favicon-->
    <link rel="icon" href="{{ asset('landingpage/page1/favicon.ico')}}">
    <!--end here-->
</head>
<body>

<!--new home page-->

        @if(isset($listSectionDefault) && count($listSectionDefault)>0)
            @foreach($listSectionDefault as $key => $sectionDefault)
                @include('landingpage.page1.sections.section_'.$sectionDefault)
            @endforeach
        @endif

<!--page loader-->
<div id="loading section-page">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_big">
                <img src="{{ asset('landingpage/page1/assets/img/img-loader.png')}}" alt="loader">
            </div>
        </div>
    </div>
</div>
<!--end here-->

<!--script files-->
<script src="{{ asset('landingpage/page1/assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('landingpage/page1/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('landingpage/page1/assets/js/jqwidgets/scripts/date-picker.js')}}"></script>
<script src="{{ asset('landingpage/page1/assets/js/isotop/isotope-docs.min.js')}}"></script>
<script src="{{ asset('landingpage/page1/assets/js/select2/select2.js')}}"></script>
<script src="{{ asset('landingpage/page1/assets/js/slick.min.js')}}"></script>
<script src="{{ asset('landingpage/page1/assets/js/parallax/parallax.min.js')}}"></script>
<script src="{{ asset('landingpage/page1/assets/js/scrollreveal.min.js')}}"></script>
<script src="{{ asset('landingpage/page1/assets/js/custom.js')}}"></script>
<!--end script files-->
<script>
    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');

        if(value == "all")
        {
            $('.filter').show('1000');
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');

        }
    });
</script>
</body>
</html>
