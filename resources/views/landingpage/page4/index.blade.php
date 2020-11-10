<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<!-- SITE TITLE -->
		<title>Kaniz - Bitcoin & Cryptocurrency HTML Template</title>
		<!-- Latest Bootstrap min CSS -->
		<link rel="stylesheet" href="{{ asset('landingpage/page4/assets/bootstrap/css/bootstrap.css')}}">
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,400i,500,500i,700,700i" rel="stylesheet">
		<!--Favicon for this site -->
		<link rel="icon" type="image/ico" href="assets/img/favicon.png"/>
		<!-- font awesome min CSS -->
		<link rel="stylesheet" href="{{ asset('landingpage/page4/assets/fonts/font-awesome.min.css')}}">
		<!--- owl carousel Css-->
		<link rel="stylesheet" href="{{ asset('landingpage/page4/assets/owlcarousel/css/owl.carousel.css')}}">
		<link rel="stylesheet" href="{{ asset('landingpage/page4/assets/owlcarousel/css/owl.theme.css')}}">
		<!-- MAGNIFIC CSS -->
		<link rel="stylesheet" href="{{ asset('landingpage/page4/assets/css/magnific-popup.css')}}">
		<!-- Style CSS -->
		<link rel="stylesheet" href="{{ asset('landingpage/page4/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{ asset('landingpage/page2/css/custom.css')}}">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

    <body data-spy="scroll" data-offset="80">

		<!-- START PRELOADER -->
		<div class="preloader">
			<div class="status">
				<div class="status-mes"></div>
			</div>
		</div>
        <!-- END PRELOADER -->

        @if(isset($listSectionDefault) && count($listSectionDefault)>0)
            @foreach($listSectionDefault as $key => $sectionDefault)
                @include('landingpage.page4.sections.section_'.$sectionDefault)
            @endforeach
        @endif

		<!-- Latest jQuery -->
			<script src="{{ asset('landingpage/page4/assets/js/jquery-1.12.4.min.js')}}"></script>
		<!-- Latest compiled and minified Bootstrap -->
			<script src="{{ asset('landingpage/page4/assets/bootstrap/js/bootstrap.min.js')}}"></script>
		<!-- modernizer JS -->
			<script src="{{ asset('landingpage/page4/assets/js/modernizr-2.8.3.min.js')}}"></script>
		<!-- owl-carousel min js  -->
			<script src="{{ asset('landingpage/page4/assets/owlcarousel/js/owl.carousel.min.js')}}"></script>
		<!-- scrolltopcontrol js -->
			<script src="{{ asset('landingpage/page4/assets/js/scrolltopcontrol.js')}}"></script>
		<!-- MAGNIFICANT JS -->
			<script src="{{ asset('landingpage/page4/assets/js/jquery.magnific-popup.min.js')}}"></script>
		<!-- PARTICLE JS -->
			<script src="{{ asset('landingpage/page4/assets/js/particles.min.js')}}"></script>
			<script src="{{ asset('landingpage/page4/assets/js/app.js')}}"></script>
		<!-- scripts js -->
			<script src="{{ asset('landingpage/page4/assets/js/scripts.js')}}"></script>
    </body>
</html>
