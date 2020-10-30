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

<!--start top-bar-->
<div class="top_bar_travel hidden-xs text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <ul class="list-unstyled list-inline top_contact">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <img src="{{ asset('landingpage/page1/assets/img/r-flag.png')}}" alt="flag">English
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><img src="{{ asset('landingpage/page1/assets/img/frence-flag.ico')}}" alt="flag">Fransh</a></li>
                            <li><a href="#"><img src="{{ asset('landingpage/page1/assets/img/turkey-flag.ico')}}" alt="flag">Spanish </a></li>
                            <li><a href="#"><img src="{{ asset('landingpage/page1/assets/img/russia-flag.ico')}}" alt="flag">Russian</a></li>
                            <li><a href="#"><img src="{{ asset('landingpage/page1/assets/img/garmen-flg.png')}}" alt="flag">German</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-usd"></i> USD
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-usd"></i> ERU</a></li>
                            <li><a href="#"><i class="fa fa-gbp"></i> PR</a></li>
                            <li><a href="#"><i class="fa fa-eur"></i> ERU</a></li>
                            <li><a href="#"><i class="fa fa-inr"></i> RS</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-md-5 hidden-sm">
                <div class="top_search">
                    <form>
                        <input type="text" placeholder="Search here...">
                        <button class="email-btn"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="top_email">
                    <ul class="list-unstyled list-inline">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>
<!--end top-bar-->

<!--start navigation bar-->
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"><img src="{{ asset('landingpage/page1/assets/img/logo-v2.png')}}" alt="logo"></a>
        </div>
        <!--navbar-collapse-->
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <!--Home-->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"> <i class="fa fa-home"></i>Home
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;"> Home
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/home/inner-home/home_flight.html"><i class="fa fa-certificate"></i> Home Flight</a></li>
                                <li><a href="html/home/inner-home/home_hotel.html"><i class="fa fa-certificate "></i> Home Hotel</a></li>
                                <li><a href="html/home/inner-home/home-travel.html"><i class="fa fa-certificate"></i> Home Travel</a></li>
                            </ul>
                        </li>
                        <li><a href="html/home/layout_one.html">  Home version-1</a></li>
                        <li><a href="html/home/layout_two.html">  Home version-2</a></li>
                        <li ><a href="html/home/layout_three.html">  Home version-3</a></li>
                        <li ><a href="index.html" class="no-border">  Home version-4</a></li>
                    </ul>
                </li>
                <!--Flights-->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"><i class="fa fa-plane"></i>Flights
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu mega-dropdown-menu row">
                        <li class="col-md-3 col-sm-12">
                            <ul>
                                <li><a href="html/flight/home-flight.html">Home Flight</a></li>
                                <!--<li class="divider"></li>-->

                                <li class="dropdown-header">Flights list one</li>
                                <li><a href="html/flight/flights_list_one/left_sidebar.html">Left Side bar</a></li>
                                <li><a href="html/flight/flights_list_one/right_sidebar.html">Right Side bar</a></li>
                                <li><a href="html/flight/flights_list_one/full_width.html">Full Width</a></li>
                                <!--<li class="divider"></li>-->
                                <li class="dropdown-header">Flights list Two</li>
                                <li><a href="html/flight/flights_list_two/left_sidebar.html">Left Side bar</a></li>
                                <li><a href="html/flight/flights_list_two/right_sidebar.html">Right Side bar</a></li>
                                <li><a href="html/flight/flights_list_two/full_width.html">Full Width</a></li>

                            </ul>
                        </li>
                        <li class="col-md-3 col-sm-12">
                            <ul>
                                <!--<li class="divider"></li>-->

                                <li class="dropdown-header">Flights Detail one</li>
                                <li><a href="html/flight/flights_details_one/left_sidebar.html">Left Side bar</a></li>
                                <li><a href="html/flight/flights_details_one/right_sidebar.html">Right Side bar</a></li>
                                <li><a href="html/flight/flights_details_one/full_width.html">Full Width</a></li>
                                <!--<li class="divider"></li>-->

                                <li class="dropdown-header">Flights Detail Two</li>
                                <li><a href="html/flight/flights_details_two/left_sidebar.html">Left Side bar</a></li>
                                <li><a href="html/flight/flights_details_two/right_sidebar.html">Right Side bar</a></li>
                                <li><a href="html/flight/flights_details_one/full_width.html">Full Width</a></li>

                            </ul>
                        </li>
                        <li class="col-md-3 col-sm-12">
                            <ul>
                                <!--<li class="divider"></li>-->

                                <li class="dropdown-header">Flights Booking one</li>
                                <li><a href="html/flight/flights_booking_one/left_sidebar.html">Left Side bar</a></li>
                                <li><a href="html/flight/flights_booking_one/right_sidebar.html">Right Side bar</a></li>
                                <li><a href="html/flight/flights_booking_one/full_width.html">Full Width</a></li>
                                <!--<li class="divider"></li>-->

                                <li class="dropdown-header">Flights Booking Two</li>
                                <li><a href="html/flight/flights_booking_two/left_sidebar.html">Left Side bar</a></li>
                                <li><a href="html/flight/flights_booking_two/right_sidebar.html">Right Side bar</a></li>
                                <li><a href="html/flight/flights_booking_two/full_width.html">Full Width</a></li>

                            </ul>
                        </li>
                        <li class="col-md-3 col-sm-12">
                            <ul>
                                <!--<li class="divider"></li>-->

                                <li class="dropdown-header">Maps</li>
                                <li><a href="html/flight/maps/map_style_one.html">Map Style One</a></li>
                                <li><a href="html/flight/maps/map_style_two.html">Map Style Two</a></li>
                                <li><a href="html/flight/maps/half_map.html">Half Map</a></li>
                                <!--<li class="divider"></li>-->

                                <li class="dropdown-header">Confirm Booking</li>
                                <li><a href="html/flight/confirm_booking/layout_one.html">Layout One</a></li>
                                <li><a href="html/flight/confirm_booking/layout_two.html">Layout two</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!--Hotels-->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"><i class="fa fa-hotel"></i>Hotels
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="html/hotel/home_hotel.html">  Home Hotel</a></li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Hotels Lists One
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/hotel/hotels_list_one/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/hotel/hotels_list_one/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/hotel/hotels_list_one/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Hotels Lists Two
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/hotel/hotels_list_two/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/hotel/hotels_list_two/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/hotel/hotels_list_two/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Hotels Details One
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/hotel/hotels_details_one/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/hotel/hotels_details_one/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/hotel/hotels_details_one/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Hotels Details Two
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/hotel/hotels_details_two/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/hotel/hotels_details_two/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/hotel/hotels_details_two/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Hotels Booking One
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/hotel/hotels_booking_one/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/hotel/hotels_booking_one/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/hotel/hotels_booking_one/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Hotels Booking Two
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/hotel/hotels_booking_two/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/hotel/hotels_booking_two/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/hotel/hotels_booking_two/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Maps
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/hotel/maps/map_style_one.html"><i class="fa fa-certificate "></i>Map Style One</a></li>
                                <li><a href="html/hotel/maps/map_style_two.html"><i class="fa fa-certificate "></i>Map Style Two</a></li>
                                <li><a href="html/hotel/maps/half_map.html"><i class="fa fa-certificate "></i>Half Map</a></li>
                                <li><a href="html/hotel/maps/full_map.html"><i class="fa fa-certificate "></i>FUll Map</a></li>
                            </ul>
                        </li>

                        <li class=" dropdown-submenu">
                            <a class="test no-border"  data-toggle="dropdown" href="javascript:;" >  Confirm Booking
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/hotel/confirm_booking/layout_one.html"><i class="fa fa-certificate "></i>Layout One</a></li>
                                <li><a href="html/hotel/confirm_booking/layout_two.html"><i class="fa fa-certificate "></i>Layout Two</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!--Travels-->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"><i class="fa fa-car"></i>Travels
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="html/travel/home-travel.html">  Home Travel</a></li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Travels Lists One
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/travel/travels_list_one/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/travel/travels_list_one/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/travel/travels_list_one/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Travels Lists Two
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/travel/travels_list_two/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/travel/travels_list_two/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/travel/travels_list_two/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Travels Details One
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/travel/travels_details_one/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/travel/travels_details_one/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/travel/travels_details_one/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Travels Details Two
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/travel/travels_details_two/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/travel/travels_details_two/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/travel/travels_details_two/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Travels Booking One
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/travel/travels_booking_one/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/travel/travels_booking_one/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/travel/travels_booking_one/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Travels Booking Two
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/travel/travels_booking_two/left_sidebar.html"><i class="fa fa-certificate "></i>Left Sidebar</a></li>
                                <li><a href="html/travel/travels_booking_two/right_sidebar.html"><i class="fa fa-certificate "></i>Right Sidebar</a></li>
                                <li><a href="html/travel/travels_booking_two/full_width.html"><i class="fa fa-certificate "></i>Full width</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Maps
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/travel/maps/map_style_one.html"><i class="fa fa-certificate "></i>Map Style One</a></li>
                                <li><a href="html/travel/maps/map_style_two.html"><i class="fa fa-certificate "></i>Map Style Two</a></li>
                                <li><a href="html/travel/maps/half_map.html"><i class="fa fa-certificate "></i>Half Map</a></li>
                                <li><a href="html/travel/maps/full_map.html"><i class="fa fa-certificate "></i>FUll Map</a></li>
                            </ul>
                        </li>

                        <li class="dropdown-submenu">
                            <a class="test no-border"  data-toggle="dropdown" href="javascript:;">  Confirm Booking
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop1">
                                <li><a href="html/travel/confirm_booking/layout_one.html"><i class="fa fa-certificate "></i>Layout One</a></li>
                                <li><a href="html/travel/confirm_booking/layout_two.html"><i class="fa fa-certificate "></i>Layout Two</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!--ShortCodes-->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"> <i class="fa fa-th-list"></i>ShortCodes
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="html/shortcodes/typography.html">  Typography</a></li>
                        <li><a href="html/shortcodes/forms.html">  Form</a></li>
                        <li><a href="html/shortcodes/icons.html">  Icons</a></li>
                        <li><a href="html/shortcodes/buttons.html">  Buttons</a></li>
                        <li><a href="html/shortcodes/animation.html">  Animation</a></li>
                        <li><a href="html/shortcodes/toggles.html">  Toggles</a></li>
                        <li><a href="html/shortcodes/alerts.html">  Alerts</a></li>
                        <li><a href="html/shortcodes/tabs.html">  Tabs</a></li>
                        <li><a href="html/shortcodes/tables.html" class="no-border">  tables</a></li>
                    </ul>
                </li>
                <!--Pages-->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"> <i class="fa fa-briefcase"></i>Pages
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Headers
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop2">
                                <li><a href="html/pages/headers/header_one.html"><i class="fa fa-certificate"></i>Header One</a></li>
                                <li><a href="html/pages/headers/header_two.html"><i class="fa fa-certificate"></i>Header Two</a></li>
                                <li><a href="html/pages/headers/header_three.html"><i class="fa fa-certificate"></i>Header Three</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Footers
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop2">
                                <li><a href="html/pages/footers/footer_one.html"><i class="fa fa-certificate "></i>Footers One</a></li>
                                <li><a href="html/pages/footers/footer_two.html"><i class="fa fa-certificate "></i>Footers Two</a></li>
                                <li><a href="html/pages/footers/footer_three.html"><i class="fa fa-certificate "></i>Footers Three</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;">  Search Styles
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop2">
                                <li><a href="html/pages/search-styles/search_one.html"><i class="fa fa-certificate "></i>Search One</a></li>
                                <li><a href="html/pages/search-styles/search_two.html"><i class="fa fa-certificate "></i>Search Two</a></li>
                                <li><a href="html/pages/search-styles/search_three.html"><i class="fa fa-certificate "></i>Search Three</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="test"  data-toggle="dropdown" href="javascript:;"> Contact Us
                                <span class="fa fa-caret-right pull-right"></span></a>
                            <ul class="dropdown-menu drop2">
                                <li><a href="html/pages/contact_us.html"><i class="fa fa-certificate "></i>Contact One</a></li>
                                <li><a href="html/pages/contact_us_two.html"><i class="fa fa-certificate "></i>Contact Two</a></li>
                            </ul>
                        </li>
                        <li><a href="html/pages/log_in.html">  Log In</a></li>
                        <li><a href="html/pages/sign_up.html">  Sign Up</a></li>
                        <li><a href="html/pages/about_us.html">  About Us</a></li>
                        <li><a href="html/pages/coming_soon.html">  Coming Soon</a></li>
                        <li><a href="html/pages/FAQ.html">  FAQ</a></li>
                        <li><a href="html/pages/404.html" class="no-border">  404</a></li>
                    </ul>
                </li>
                <!--Find My Flight-->
                <li class="visible-lg"><span><a href="html/flight/flights_list_two/left_sidebar.html" class="btn btn_order_now">Find My Flight</a></span></li>
            </ul>
        </div>
    </div>
</nav>
<!--navigation end here-->


<div class="index-new">
    <header class="clearfix">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">


                <div class="item active">
                    <img class="first-slide" src="{{ asset('landingpage/page1/assets/img/index3-home-image.jpg')}}" alt="First slide">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="new-slider-content">
                                        <h1>Travel the world you never seen</h1>
                                        <p class="visible-lg text-slider"> Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Phasellus at dignissim tellus. </p>
                                        <p class="text-slider">  Sed molestie urna et cursus congue. Vivamus est mauris,</p>
                                        <div class="slider-btn wow zoomInDown">
                                            <a href="#" class="btn btn-new-1 hidden-xs">View our tours <i class="fa fa-plane"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="item">
                    <img class="first-slide" src="{{ asset('landingpage/page1/assets/img/new-img011.png')}}" alt="First slide">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="new-slider-content">
                                        <h1>Travel the world you never seen</h1>
                                        <p class="visible-lg text-slider"> Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Phasellus at dignissim tellus. </p>
                                        <p class="text-slider">  Sed molestie urna et cursus congue. Vivamus est mauris,</p>
                                        <div class="slider-btn wow zoomInDown">
                                            <a href="#" class="btn btn-new-1 hidden-xs">View our tours <i class="fa fa-plane"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>

            <a class="left carousel-control new-carousel-control hidden-xs" href="#myCarousel" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control new-carousel-control hidden-xs " href="#myCarousel" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="new-fill">
            <!--tabs-->
            <div class="panel">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tabtravel" data-toggle="tab"> Flight</a></li>
                    <li><a href="#tabhotel" data-toggle="tab">  Hotel</a></li>
                    <li><a href="#tabtour" data-toggle="tab"> Travel</a></li>
                </ul>
                <!--panel-body-->
                <div class="panel-body">
                    <!--tab-content-->
                    <div class="container">
                        <div class="tab-content">
                            <!--tabtravel-->
                            <div class="tab-pane fade in active" id="tabtravel">
                                <h3>Come Fly With Us</h3>
                                <ul class="list-inline list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Departing from?" required/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Your destination?" required/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Check In" id="new-datepicker" required/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Check Off" id="new-datepicker-2" required/>
                                        </div>
                                    <li>
                                        <select class="select-one">
                                            <option selected="selected">Select Class</option>
                                            <option>Economy Class</option>
                                            <option>Business  Class</option>

                                        </select>
                                    </li>

                                    <li>
                                        <select class="select-one">
                                            <option selected="selected">1 Adult</option>
                                            <option>1 Adult</option>
                                            <option> 2 Adult</option>
                                            <option>3 Adult</option>

                                        </select>
                                    </li>
                                    <li>
                                        <select class="select-one">
                                            <option selected="selected">1 Children</option>
                                            <option>1 Children</option>
                                            <option>2 Children</option>
                                            <option>3 Children</option>

                                        </select>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Max budget">
                                        </div>
                                    </li>

                                    <li>
                                        <select class="select-one">
                                            <option selected="selected">Trip Type</option>
                                            <option>One Way</option>
                                            <option>Round</option>
                                            <option>Multi City</option>

                                        </select>
                                    </li>
                                    <li>
                                        <a href="html/flight/flights_list_one/left_sidebar.html" target="_blank" class="btn btn-new-search-travel">SEARCH NOW <i class="fa fa-sign-in hidden-sm hidden-xs"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!--tabhotel-->
                            <div class="tab-pane fade in" id="tabhotel">
                                <h3>Search and Book Hotels</h3>
                                <ul class="list-inline list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Enter Your Hotel Name?" required>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Check In" id="new-datepicker-3" required/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Check Off" id="new-datepicker-4" required/>
                                        </div>
                                    <li>
                                        <select class="select-one">
                                            <option selected="selected">1 Room</option>
                                            <option>2 Room</option>
                                            <option>3 Room</option>
                                            <option>4 Room</option>

                                        </select>
                                    </li>

                                    <li>
                                        <select class="select-one">
                                            <option selected="selected">1 Guest</option>
                                            <option>1 Guest</option>
                                            <option> 2 Guest</option>
                                            <option>No One</option>

                                        </select>
                                    </li>
                                    <li>
                                        <select class="select-one">
                                            <option selected="selected">1 Children</option>
                                            <option>1 Children</option>
                                            <option>2 Children</option>
                                            <option>3 Children</option>
                                            <option>No One</option>

                                        </select>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Max budget (Optional)">
                                        </div>
                                    </li>
                                    <li>
                                        <a href="html/flight/flights_list_one/left_sidebar.html" target="_blank" class="btn btn-new-search-travel">SEARCH NOW <i class="fa fa-sign-in hidden-sm hidden-xs"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!--tabtour-->
                            <div class="tab-pane fade in" id="tabtour">
                                <h3>Where do you want to go (Searching For Car)?</h3>
                                <ul class="list-inline list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Picking up?" required>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Dropping Off?" required>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Pick Up Date" id="new-datepicker-5" required/>
                                        </div>
                                    </li>

                                    <li>
                                        <select class="select-one">
                                            <option selected="selected">Pick Up Time</option>
                                            <option>11.30 PM</option>
                                            <option>12.00 PM</option>
                                            <option>01.30 PM</option>
                                            <option>02.00 PM</option>
                                            <option>03.30 PM</option>
                                            <option>04.00 PM</option>
                                            <option>04.30 PM</option>
                                            <option>05.00 PM</option>

                                        </select>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Drop Off Date" id="new-datepicker-6" required/>
                                        </div>
                                    </li>
                                    <li>
                                        <select class="select-one">
                                            <option selected="selected">Drop Off Time</option>
                                            <option>11.30 PM</option>
                                            <option>12.00 PM</option>
                                            <option>01.30 PM</option>
                                            <option>02.00 PM</option>
                                            <option>03.30 PM</option>
                                            <option>04.00 PM</option>
                                            <option>04.30 PM</option>
                                            <option>05.00 PM</option>

                                        </select>
                                    </li>
                                    <li>
                                        <select class="select-one">
                                            <option selected="selected">1 Car</option>
                                            <option>1 Car</option>
                                            <option>2 Car</option>
                                            <option>3 Car</option>

                                        </select>
                                    </li>
                                    <li>
                                        <select class="select-one">
                                            <option selected="selected">1 Children</option>
                                            <option>1 Children</option>
                                            <option>2 Children</option>
                                            <option>3 Children</option>

                                        </select>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Max budget">
                                        </div>
                                    </li>

                                    <li>
                                        <a href="html/flight/flights_list_one/left_sidebar.html" target="_blank" class="btn btn-new-search-travel">SEARCH NOW <i class="fa fa-sign-in hidden-sm hidden-xs"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end panel body-->
            </div>
            <!--end tabs-->
        </div>
    </header>
</div>


<div class="container">
    <div class="new-heading-box">
        <h4 class="title">Featured tour package</h4>
        <h2 class="subtitle">we'll take care of the rest</h2>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="new-package">
                <a href="#">
                    <img src="{{ asset('landingpage/page1/assets/img/new-pack-img1.png')}}" alt="alt" class="img-responsive">
                    <div class="city"><span>Florida</span></div>
                    <div class="price"><span>$64.00</span></div>
                </a>

            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="new-package">
                <a href="#">
                    <img src="{{ asset('landingpage/page1/assets/img/new-pack-img2.png')}}" alt="alt" class="img-responsive">
                    <div class="city"><span>south africa</span></div>
                    <div class="price"><span>$344.00</span></div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="new-package">
                <a href="#">
                    <img src="{{ asset('landingpage/page1/assets/img/new-pack-img3.png')}}" alt="alt" class="img-responsive">
                    <div class="city"><span>orlando</span></div>
                    <div class="price"><span>$3424.00</span></div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="new-package">
                <a href="#">
                    <img src="{{ asset('landingpage/page1/assets/img/new-pack-img4.png')}}" alt="alt" class="img-responsive">
                    <div class="city"><span>Florida</span></div>
                    <div class="price"><span>$324.00</span></div>
                </a>
            </div>
        </div>
    </div>
    <br>

    <div class="text-center">
        <a href="#" class="btn-new-search-travel">View ALL packages</a>
    </div>
    <br>
</div>



<div class="new-gallery-section">
    <div class="container">
        <div class="text-center">
            <h3 class="title">NEED INSPIRATION FOR YOUR NEXT TOUR?</h3>
            <p>Nunc Cursus Libero Purusac Congue Arcu Cursus Utsed Vitae Pulvinar Massa Idporta Neque <br>
                Purusaongue Aae Pulvinar Mas Pulvinar Massa Idporta Neque Purusaongue Aae Pulvinar Massa Idporta
            </p>
        </div>
        <div class="row">
            <h3 class="title text-center">GALLERY IMAGES</h3>
            <div class="new-gallery-filter">
                <div class="col-md-12">
                    <div class="filter-button-group pull-left">
                        <div><button class="filter-button btn" data-filter="all">All</button><button class="filter-button btn" data-filter="hotels">Hotels</button><button class="filter-button btn" data-filter="flights">Flights </button><button class="filter-button btn" data-filter="travel">Travel </button></div>
                    </div>
                </div>
                <!---->

                <div class="col-md-3 col-sm-6 filter  all hotels">
                    <div class="new-gallery-box">
                        <img src="{{ asset('landingpage/page1/assets/img/new-gallery-img7.jpg')}}" alt="gallery" class="img-responsive">

                        <div class="overflow-outer">
                            <div class="overflow-inner">
                                <p class="title">The Edelweis Hotel Yogyakarta</p>
                                <p class="des"><i class="fa fa-map-marker"></i>ji. malioboro yogyakarta</p>
                                <p class="des"><i class="fa fa-briefcase"></i>13 runga meeting</p>
                            </div>

                            <div class="buttons">
                                <a href="#" class="btn btn-details">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 filter  all flights">
                    <div class="new-gallery-box">
                        <img src="{{ asset('landingpage/page1/assets/img/new-gallery-img1.jpg')}}" alt="gallery" class="img-responsive">

                        <div class="overflow-outer">
                            <div class="overflow-inner">
                                <p class="title">The Edelweis Hotel Yogyakarta</p>
                                <p class="des"><i class="fa fa-map-marker"></i>ji. malioboro yogyakarta</p>
                                <p class="des"><i class="fa fa-briefcase"></i>13 runga meeting</p>
                            </div>

                            <div class="buttons">
                                <a href="#" class="btn btn-details">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6  filter  all travel">
                    <div class="new-gallery-box">
                        <img src="{{ asset('landingpage/page1/assets/img/new-gallery-img2.jpg')}}" alt="gallery" class="img-responsive">

                        <div class="overflow-outer">
                            <div class="overflow-inner">
                                <p class="title">The Edelweis Hotel Yogyakarta</p>
                                <p class="des"><i class="fa fa-map-marker"></i>ji. malioboro yogyakarta</p>
                                <p class="des"><i class="fa fa-briefcase"></i>13 runga meeting</p>
                            </div>

                            <div class="buttons">
                                <a href="#" class="btn btn-details">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6  filter  all flights hotels">
                    <div class="new-gallery-box">
                        <img src="{{ asset('landingpage/page1/assets/img/new-gallery-img3.jpg')}}" alt="gallery" class="img-responsive">

                        <div class="overflow-outer">
                            <div class="overflow-inner">
                                <p class="title">The Edelweis Hotel Yogyakarta</p>
                                <p class="des"><i class="fa fa-map-marker"></i>ji. malioboro yogyakarta</p>
                                <p class="des"><i class="fa fa-briefcase"></i>13 runga meeting</p>
                            </div>

                            <div class="buttons">
                                <a href="#" class="btn btn-details">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6  filter  all travel hotels">
                    <div class="new-gallery-box">
                        <img src="{{ asset('landingpage/page1/assets/img/new-gallery-img4.jpg')}}" alt="gallery" class="img-responsive">

                        <div class="overflow-outer">
                            <div class="overflow-inner">
                                <p class="title">The Edelweis Hotel Yogyakarta</p>
                                <p class="des"><i class="fa fa-map-marker"></i>ji. malioboro yogyakarta</p>
                                <p class="des"><i class="fa fa-briefcase"></i>13 runga meeting</p>
                            </div>

                            <div class="buttons">
                                <a href="#" class="btn btn-details">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6  filter  all travel flights hotels">
                    <div class="new-gallery-box">
                        <img src="{{ asset('landingpage/page1/assets/img/new-gallery-img5.jpg')}}" alt="gallery" class="img-responsive">

                        <div class="overflow-outer">
                            <div class="overflow-inner">
                                <p class="title">The Edelweis Hotel Yogyakarta</p>
                                <p class="des"><i class="fa fa-map-marker"></i>ji. malioboro yogyakarta</p>
                                <p class="des"><i class="fa fa-briefcase"></i>13 runga meeting</p>
                            </div>

                            <div class="buttons">
                                <a href="#" class="btn btn-details">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6  filter  all hotels travel">
                    <div class="new-gallery-box">
                        <img src="{{ asset('landingpage/page1/assets/img/new-gallery-img6.jpg')}}" alt="gallery" class="img-responsive">

                        <div class="overflow-outer">
                            <div class="overflow-inner">
                                <p class="title">The Edelweis Hotel Yogyakarta</p>
                                <p class="des"><i class="fa fa-map-marker"></i>ji. malioboro yogyakarta</p>
                                <p class="des"><i class="fa fa-briefcase"></i>13 runga meeting</p>
                            </div>

                            <div class="buttons">
                                <a href="#" class="btn btn-details">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6  filter  all hotels">
                    <div class="new-gallery-box">
                        <img src="{{ asset('landingpage/page1/assets/img/new-gallery-img1.jpg')}}" alt="gallery" class="img-responsive">

                        <div class="overflow-outer">
                            <div class="overflow-inner">
                                <p class="title">The Edelweis Hotel Yogyakarta</p>
                                <p class="des"><i class="fa fa-map-marker"></i>ji. malioboro yogyakarta</p>
                                <p class="des"><i class="fa fa-briefcase"></i>13 runga meeting</p>
                            </div>

                            <div class="buttons">
                                <a href="#" class="btn btn-details">Details</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="new-heading-box">
        <h4 class="title">Rental cars for travel</h4>
        <h2 class="subtitle">we'll take care of the rest</h2>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="new_car_box">
                <div class="img-car">
                    <img src="{{ asset('landingpage/page1/assets/img/new-care-packge-2.jpg')}}" alt="car" class=" rotate_img img-responsive">
                </div>
                <div class="detail-car">
                    <div class="car-name"><span class="pull-left"><a href="#" class="link">AUDI</a></span> <span class="pull-right days">1-3 days</span></div>
                    <p class="content">Lorem ipsum dolor sit amet elit. Fusce leo massa blandit elit, auctor. </p>
                    <a href="#" class="btn btn-new-book-car">BOOK NOW</a>
                    <div class="new-car-info">
                        <span>2015</span>
                        <span>diesel</span>
                        <span>auto</span>
                    </div>
                    <div class="price"><span>$654.00</span></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="new_car_box">
                <div class="img-car">
                    <img src="{{ asset('landingpage/page1/assets/img/new-rent-car.jpg')}}" alt="car" class=" rotate_img img-responsive">
                </div>
                <div class="detail-car">

                    <div class="car-name"><span class="pull-left"><a href="#" class="link">lamborghini</a></span> <span class="pull-right days">2-3 days</span></div>
                    <p class="content">Lorem ipsum dolor sit amet elit. Fusce leo massa blandit elit, auctor. </p>

                    <a href="#" class="btn btn-new-book-car">BOOK NOW</a>

                    <div class="new-car-info">
                        <span>2016</span>
                        <span>diesel</span>
                        <span>auto</span>
                    </div>

                    <div class="price"><span>$264.00</span></div>

                </div>


            </div>

        </div>
        <div class="col-md-4">
            <div class="new_car_box">
                <div class="img-car">
                    <img src="{{ asset('landingpage/page1/assets/img/new-care-packge-3.jpg')}}" alt="car" class=" rotate_img img-responsive">
                </div>
                <div class="detail-car">

                    <div class="car-name"><span class="pull-left"><a href="#" class="link">BMW Q3</a></span> <span class="pull-right days">3-5 days</span></div>
                    <p class="content">Lorem ipsum dolor sit amet elit. Fusce leo massa blandit elit, auctor. </p>

                    <a href="#" class="btn btn-new-book-car">BOOK NOW</a>

                    <div class="new-car-info">
                        <span>2018</span>
                        <span>diesel</span>
                        <span>auto</span>
                    </div>

                    <div class="price"><span>$84.00</span></div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="new-location-section">
    <div class="container">
        <h4 class="h4 text-center">POPULAR HOTELS</h4>
        <div class="slider_new_hotels">

            <div class="row">
                <div class="col-md-4 hidden-sm hidden-xs">
                    <img src="{{ asset('landingpage/page1/assets/img/new-img05.jpg')}}" alt="alt" class="img-responsive">
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="hotel_bg">
                        <a href="#"><h3 class="city-name">Florence Da</h3></a>
                        <p class="description">Nunc et venenatis nibh, sed accumsan libero Quisque augue neque,
                            <br>augue neque, pretium</p>
                        <div class="location"><i class="fa fa-map-marker"></i>  Sabi sand- south Africa <span class="price">$400</span></div>
                        <a href="#" class="btn btn-new-book-car2">BOOK NOW</a>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <img src="{{ asset('landingpage/page1/assets/img/new-img07.jpg')}}" class="img-responsive" alt="img">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <img src="{{ asset('landingpage/page1/assets/img/new-img013.png')}}" class="img-responsive" alt="img">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <img src="{{ asset('landingpage/page1/assets/img/new-img014.png')}}" class="img-responsive" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 hidden-sm hidden-xs">
                    <img src="{{ asset('landingpage/page1/assets/img/new-img012.png')}}" alt="alt" class="img-responsive">
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="hotel_bg">
                        <a href="#"><h3 class="city-name">Garvaish Luxury Hotel</h3></a>
                        <p class="description"> libero Quisque augue neque,
                            <br>augue neque, an pretiumNunc et venenatis nibh, sed accums</p>
                        <div class="location"><i class="fa fa-map-marker"></i>  Sabi sand- south Africa <span class="price">$500</span></div>
                        <a href="#" class="btn btn-new-book-car2">BOOK NOW</a>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <img src="{{asset('landingpage/page1/assets/img/new-img07.jpg')}}" class="img-responsive" alt="img">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <img src="{{ asset('landingpage/page1/assets/img/new-img013.png')}}" class="img-responsive" alt="img">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <img src="{{ asset('landingpage/page1/assets/img/new-img014.png')}}" class="img-responsive" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="new-heading-box">
        <h4 class="title">FIND A FLIGHT FOR TOUR</h4>
        <h2 class="subtitle">we'll take care of the rest</h2>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="slider-new">
                <a href="#" class="img-box">
                    <img src="{{ asset('landingpage/page1/assets/img/new-img03.jpg')}}" class="img-responsive" alt="alt">
                    <p class="text-center">London - Return From $287</p>
                </a>
                <a href="#" class="img-box">
                    <img src="{{ asset('landingpage/page1/assets/img/new-img015.png')}}" class="img-responsive" alt="alt">
                    <p class="text-center">London - Return From $287</p>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="new-tour">
                        <a href="#">
                            <img src="{{ asset('landingpage/page1/assets/img/new-img04.jpg')}}" class="img-responsive" alt="alt">
                            <div class="inner-text">
                                <p class="text-center">London - Return From $287</p>
                                <span class="icon"></span>
                                <i class="fa fa-angle-double-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="new-tour">
                        <a href="#">
                            <img src="{{ asset('landingpage/page1/assets/img/new-img09.jpg')}}" class="img-responsive" alt="alt">
                            <div class="inner-text">
                                <p class="text-center">London - Return From $287</p>
                                <span class="icon"></span>
                                <i class="fa fa-angle-double-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<!--support section-->

<div class="new-support-section">

    <div class="triangle-left"></div>
    <div class="triangle-right"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="box">
                    <i class="fa fa-map-signs"></i>
                    <h3>route selection</h3>
                    <p>Mauris fermentum tortor non enim aliquet
                        condimentum. Nam aliquam pretium duis sem feugiat.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="box">
                    <i class="fa fa-circle-o-notch"></i>
                    <h3>24/7 Support</h3>
                    <p>Mauris fermentum tortor non enim aliquet
                        condimentum. Nam aliquam pretium duis sem feugiat.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="box">
                    <i class="fa fa-map"></i>
                    <h3>wide choice</h3>
                    <p>Mauris fermentum tortor non enim aliquet
                        condimentum. Nam aliquam pretium duis sem feugiat.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="box">
                    <i class="fa fa-plane"></i>
                    <h3>buy tickets</h3>
                    <p>Mauris fermentum tortor non enim aliquet
                        condimentum. Nam aliquam pretium duis sem feugiat.</p>
                </div>
            </div>
        </div>
    </div>
</div>



<!--footer start here-->
<footer class="new-main-footer">
    <!--end button here-->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="inner-footer">
                    <h3 class="footer-title">Newsletter </h3>
                    <p class="news-des">Duis autem vel eum iriure dolor in
                        hendrerit in vulputate velit esse molestie consequat, vel illum dolore.</p>
                    <form action="">
                        <input type="text" placeholder="Subscribe"><button type="submit">GO</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="inner-footer">
                    <h3 class="footer-title">Page </h3>
                    <ul class="list-unstyled list">
                        <li><a href="#"> <i class="fa fa-hand-o-right"></i> Home page</a></li>
                        <li><a href="#"><i class="fa fa-hand-o-right"></i> About Us</a></li>
                        <li><a href="#"><i class="fa fa-hand-o-right"></i> Hotels</a></li>
                        <li><a href="#"><i class="fa fa-hand-o-right"></i> Contact us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="inner-footer">
                    <h3 class="footer-title">Tags </h3>
                    <a href="#" class="new-tags">Agent Login</a>
                    <a href="#" class="new-tags">Customer Login</a>
                    <a href="#" class="new-tags">Not a Member?</a>
                    <a href="#" class="new-tags">Tags</a>
                    <a href="#" class="new-tags">Contact Us</a>
                    <a href="#" class="new-tags">Customer Login</a>
                    <a href="#" class="new-tags">Not a Member?</a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="inner-footer">
                    <h3 class="footer-title">Contact us </h3>
                    <p class="news-des"> <span >Address:</span> DieSachbearbeiter Schönhauser Allee 167c,10435 Berlin Germany</p>
                    <p class="news-des"> <span>E-mail:</span> moin@blindtextgenerator.de</p>
                    <ul class="list-unstyled list list-inline">
                        <li><a href="#"> <i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"> <i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"> <i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"> <i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <p class="footer-bottom text-center">&copy; copyright 2017 by <a href="http://teamworktec.com/">Teamwork</a></p>

</footer>
<!--footer end here-->

<!--page loader-->
<div id="loading">
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
