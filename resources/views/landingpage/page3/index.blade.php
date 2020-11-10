<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="forntEnd-Developer" content="Mamunur Rashid">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Dooplo - Gaming HTML Template</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="{{ asset('landingpage/page3/assets/images/favicon.png')}}" type="image/x-icon">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ asset('landingpage/page3/assets/css/bootstrap.min.css')}}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{ asset('landingpage/page3/assets/css/plugin.css')}}">

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{ asset('landingpage/page3/assets/css/style.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{ asset('landingpage/page3/assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('landingpage/page2/css/custom.css')}}">
</head>

<body>
	<!-- preloader area start -->
	<div class="preloader" id="preloader">
		<div class="loader loader-1">
			<div class="loader-outter"></div>
			<div class="loader-inner"></div>
		</div>
	</div>
    <!-- preloader area end -->

    @if(isset($listSectionDefault) && count($listSectionDefault)>0)
        @foreach($listSectionDefault as $key => $sectionDefault)
            @include('landingpage.page3.sections.section_'.$sectionDefault)
        @endforeach
    @endif


    <!-- jquery -->
	<script src="{{ asset('landingpage/page3/assets/js/jquery.js')}}"></script>
	<!-- popper -->
	<script src="{{ asset('landingpage/page3/assets/js/popper.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{ asset('landingpage/page3/assets/js/bootstrap.min.js')}}"></script>
	<!-- plugin js-->
	<script src="{{ asset('landingpage/page3/assets/js/plugin.js')}}"></script>

	<!-- MpusemoverParallax JS-->
	<script src="{{ asset('landingpage/page3/assets/js/TweenMax.js')}}"></script>
	<script src="{{ asset('landingpage/page3/assets/js/mousemoveparallax.js')}}"></script>
	<!-- main -->
	<script src="{{ asset('landingpage/page3/assets/js/main.js')}}"></script>
</body>

</html>
