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

</head>

<body>
    @if(isset($listSectionDefault) && count($listSectionDefault)>0)
        @foreach($listSectionDefault as $key => $sectionDefault)
            @if($key == count($listSectionDefault)-1 )
                @include('template.list_product')
            @endif
            @include('landingpage.page2.sections.section_'.$sectionDefault)
        @endforeach
    @endif

    <!-- Signin Modal -->
    <div class="modal cs-modal" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content custom-modal-content">
                <div class="   ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sign-form m-0 p-5">
                                <div class="show-sm modal-fixed-close" data-dismiss="modal" aria-label="Close"><i
                                        class="fa fa-times-circle"></i></div>
                                <h2 class="sign-form-head text-center">LOGIN</h2>
                                <form>

                                    <div class="form-group  uiIcon">
                                        <input type="text" class="input form-control" placeholder="Email Address"
                                            required>
                                        <svg class="svgIcon fill-smoke--d" width="30" height="30" viewBox="0 -6 30 30"
                                            enable-background="new 0 -6 30 30">
                                            <path
                                                d="M15 11.9c-.9 0-1.7-.2-2.3-.7l-5.7-4.4v8.1c0 .1 0 .3.1.4.1.1.2.2.3.2 2.5.4 5 .5 7.5.5s5-.2 7.5-.5c.1 0 .3-.1.4-.2.2-.1.2-.3.2-.4v-8.1l-5.7 4.4c-.6.5-1.4.7-2.3.7zm-1.3-2.3c.3.3.8.4 1.3.4s1-.1 1.3-.4l6.1-4.7c.3-.3.5-.6.6-1v-.8c0-.1 0-.3-.1-.4-.1-.1-.2-.2-.4-.2-2.5-.3-5-.5-7.5-.5s-5 .2-7.5.5c-.1 0-.2.1-.3.2-.2.1-.2.3-.2.4v.9c.1.3.3.6.6 1l6.1 4.6z">
                                            </path>
                                        </svg>
                                    </div>

                                    <div class="form-group  uiIcon">
                                        <input type="text" class="input form-control" placeholder="Password" required>
                                        <svg class="svgIcon fill-smoke--d" width="30" height="30" viewBox="0 -6 30 30"
                                            enable-background="new 0 -6 30 30">
                                            <path
                                                d="M21.6 8.3c-.2-.2-.5-.3-.9-.3h-.7v-2.6c0-1.3-.5-2.4-1.4-3.2-.9-.8-2.1-1.2-3.6-1.2s-2.7.4-3.6 1.2c-.9.8-1.4 1.9-1.4 3.2v2.6h-.7c-.3 0-.7.1-.9.4-.3.2-.4.5-.4.8v6.1c0 .3.1.5.3.7.2.2.4.3.7.4 1.9.4 3.9.6 6 .6 2 0 4-.2 5.9-.6.3-.1.5-.2.7-.4.2-.2.3-.4.3-.7v-6.1c.1-.3 0-.6-.3-.9zm-8.6-2.4c0-1.3.7-1.9 2-1.9s2 .6 2 1.9v2.1h-4v-2.1z">
                                            </path>
                                        </svg>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block edit-text edit-text-double-click" data-number-text="162" data-content="Login" data-type="button">Login</button>
                                    </div>
                                </form>
                                <div class="sign-form-text">
                                    <p><a href="#" class="text-primary edit-text edit-text-double-click" data-number-text="163" data-content="Create Account" data-type="button"> Create Account</a> <a href="#"
                                            class="float-right text-primary edit-text edit-text-double-click" data-number-text="164" data-content="Forgot Password" data-type="button">Forgot Password <i
                                                class="fa fa-question-circle ml-1"></i></a></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->

    <!-- Signup Modal -->
    <div class="modal cs-modal" id="signup-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-full" role="document">
            <div class="modal-content custom-modal-content">
                <div class="  bg-gray  ">
                    <div class="row">
                        <div class="col-lg-6 pr-0 h-100 hide-sm">
                            <div class="">
                                <div class="sign-left-box">
                                    <h2 class="text-center edit-text" data-number-text="147" data-content="CRM"
                                        data-type="text">CRM</h2>
                                    <p class="text-center edit-text" data-number-text="148"
                                        data-content="With CRM, your team can now use AI-based lead scoring email, activity capture and more.AI Driven CRM for your Sales Force"
                                        data-type="text">With CRM, your team can now use AI-based lead scoring email,
                                        activity capture and more.</p>
                                    <ul class="list-unstyled mt-5">
                                        <li class="media">
                                            <img class="mr-3 edit-image" data-number-text="149"
                                                data-content="icn-1-white.svg" data-type="image" data-height="24"  data-width="234.98"
                                                src="{{ asset('landingpage/page2/images/icn6.svg')}}"
                                                alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h4 class="text-white edit-text" data-number-text="150"
                                                    data-content="Service Cloud" data-type="text">Service Cloud</h4>
                                                <p class="text-white edit-text" data-number-text="151"
                                                    data-content="Sell smarter and faster with the world’s #1 CRM solution."
                                                    data-type="text">Sell smarter and faster with the world’s #1 CRM
                                                    solution.</p>
                                            </div>
                                        </li>
                                        <li class="media my-4">
                                            <img class="mr-3 edit-image" data-number-text="152"
                                                data-content="icn-2-white.svg" data-type="image" data-height="24"  data-width="234.98"
                                                src="{{ asset('landingpage/page2/images/icn6.svg')}}"
                                                alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h4 class="text-white edit-text" data-number-text="153"
                                                    data-content="Sales Cloud" data-type="text">Sales Cloud</h4>
                                                <p class="text-white edit-text" data-number-text="154"
                                                    data-content="Support every customer.<br> Anytime. Anywhere."
                                                    data-type="text">Support every customer.<br> Anytime. Anywhere.</p>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <img class="mr-3 edit-image" data-number-text="155"
                                                data-content="icn-3-white.svg" data-type="image" data-height="24"  data-width="234.98"
                                                src="{{ asset('landingpage/page2/images/icn6.svg')}}"
                                                alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h4 class="text-white edit-text" data-number-text="156"
                                                    data-content="Marketing Cloud" data-type="text">Marketing Cloud</h4>
                                                <p class="text-white edit-text" data-number-text="157"
                                                    data-content="The future of marketing is 1-to-1 customer journeys."
                                                    data-type="text">The future of marketing is 1-to-1 customer
                                                    journeys. </p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="close-modal cs-fade-in-up" data-dismiss="modal" aria-label="Close">
                                        <svg class="arrow-icon-svg" width="23" height="16"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 23 16">
                                            <path fillRule="evenodd"
                                                d="M 7.75 0.53C 8.04 0.22 8.53 0.22 8.84 0.53 9.13 0.83 9.3 1.7 9 2 9 2 4 7 4 7 4 7 22 7 22 7 22.43 7 22.35 7.56 22.35 7.99 22.35 8.42 22.43 9 22 9 22 9 4 9 4 9 4 9 9 14 9 14 9.3 14.31 9.13 15.16 8.84 15.46 8.53 15.77 8.04 15.77 7.75 15.46 7.75 15.46 0.89 8.54 0.89 8.54 0.59 8.24 0.59 7.75 0.89 7.45 0.89 7.45 7.75 0.53 7.75 0.53Z"
                                                fill="rgb(255,255,255)" />
                                        </svg> &nbsp; Back to Home
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 cpl-0 h-100 ">
                            <div class="sign-form">
                                <div class="show-sm modal-fixed-close" data-dismiss="modal" aria-label="Close"><i
                                        class="fa fa-times-circle"></i></div>
                                    <h4 class="sign-form-head text-center edit-text" data-number-text="158"
                                    data-content="Signup and Start your Trail" data-type="text">Signup and Start your
                                    Trail</h4>
                                <form>
                                    <div class="form-group  uiIcon">
                                        <input type="text" class="input form-control" placeholder="Full Name" required>
                                        <svg class="svgIcon fill-smoke--d" width="30" height="30" viewBox="0 -6 30 30"
                                            enable-background="new 0 -6 30 30">
                                            <path
                                                d="M22.9 16.2c.1-.1.1-.3.1-.4-.2-.8-.5-1.4-.9-1.9s-1-1-1.7-1.4c-.2-.1-.6-.3-1.3-.6-.6-.2-1.1-.4-1.4-.6-.3-.2-.6-.4-.7-.7-.1-.4.1-1 .5-1.7 1.5-2.3 1.8-4.3.8-5.9-.3-.6-.7-1.1-1.3-1.5-.6-.3-1.3-.5-2-.5s-1.4.2-2 .5c-.6.4-1.1.8-1.5 1.5-1 1.6-.7 3.6.8 5.9.5.7.7 1.3.5 1.7-.1.2-.2.4-.5.6-.2.2-.5.3-.7.4-.2.1-.5.2-.9.4-.6.3-1.1.4-1.3.6-.7.4-1.3.9-1.7 1.4-.2.4-.5 1-.7 1.8 0 .1 0 .3.1.4l.3.3c1.6.3 4.1.5 7.6.5 2.3 0 4.2-.1 5.8-.3.2 0 .4 0 .6-.1.2 0 .4-.1.5-.1l.3-.1h.30000000000000004c.2 0 .3-.1.4-.2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="form-group  uiIcon">
                                        <input type="text" class="input form-control" placeholder="Email Address"
                                            required>
                                        <svg class="svgIcon fill-smoke--d" width="30" height="30" viewBox="0 -6 30 30"
                                            enable-background="new 0 -6 30 30">
                                            <path
                                                d="M15 11.9c-.9 0-1.7-.2-2.3-.7l-5.7-4.4v8.1c0 .1 0 .3.1.4.1.1.2.2.3.2 2.5.4 5 .5 7.5.5s5-.2 7.5-.5c.1 0 .3-.1.4-.2.2-.1.2-.3.2-.4v-8.1l-5.7 4.4c-.6.5-1.4.7-2.3.7zm-1.3-2.3c.3.3.8.4 1.3.4s1-.1 1.3-.4l6.1-4.7c.3-.3.5-.6.6-1v-.8c0-.1 0-.3-.1-.4-.1-.1-.2-.2-.4-.2-2.5-.3-5-.5-7.5-.5s-5 .2-7.5.5c-.1 0-.2.1-.3.2-.2.1-.2.3-.2.4v.9c.1.3.3.6.6 1l6.1 4.6z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="form-group  uiIcon">
                                        <input type="text" class="input form-control" placeholder="Company Name"
                                            required>
                                        <svg class="svgIcon fill-smoke--d" width="30" height="30" viewBox="0 0 30 30">
                                            <path
                                                d="M17,20v4h6q0-9-.46-13.55A15.6,15.6,0,0,0,22,7.29a1.1,1.1,0,0,0-1-.8A36.33,36.33,0,0,0,15,6a36.43,36.43,0,0,0-6,.48,1.15,1.15,0,0,0-1.07.84,15.29,15.29,0,0,0-.49,3.11Q7,15.15,7,24h6V20ZM19,9v3H16V9Zm0,5v3H16V14ZM14,9v3H11V9Zm0,5v3H11V14Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="form-group  uiIcon">
                                        <input type="text" class="input form-control" placeholder="Password" required>
                                        <svg class="svgIcon fill-smoke--d" width="30" height="30" viewBox="0 -6 30 30"
                                            enable-background="new 0 -6 30 30">
                                            <path
                                                d="M21.6 8.3c-.2-.2-.5-.3-.9-.3h-.7v-2.6c0-1.3-.5-2.4-1.4-3.2-.9-.8-2.1-1.2-3.6-1.2s-2.7.4-3.6 1.2c-.9.8-1.4 1.9-1.4 3.2v2.6h-.7c-.3 0-.7.1-.9.4-.3.2-.4.5-.4.8v6.1c0 .3.1.5.3.7.2.2.4.3.7.4 1.9.4 3.9.6 6 .6 2 0 4-.2 5.9-.6.3-.1.5-.2.7-.4.2-.2.3-.4.3-.7v-6.1c.1-.3 0-.6-.3-.9zm-8.6-2.4c0-1.3.7-1.9 2-1.9s2 .6 2 1.9v2.1h-4v-2.1z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="form-group ">
                                        <div class="input-group mb-3  uiIcon">
                                            <input type="text" class="input form-control" placeholder="CRM Name"
                                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <svg class="svgIcon fill-smoke--d" xmlns="http://www.w3.org/2000/svg"
                                                width="30" height="30" viewBox="0 0 30 30">
                                                <path
                                                    d="M7 15c0-4.4 3.6-8 8-8s8 3.6 8 8-3.6 8-8 8-8-3.6-8-8zm4.3 1.1h-2.4c.3 2.1 1.6 3.8 3.5 4.6-.6-1.2-1-3-1.1-4.6zm0-2.2c.1-1.6.5-3.3 1-4.5-1.8.9-3.1 2.4-3.5 4.5h2.5zm5.6 2.2h-3.9c.2 3.2 1.6 5.2 1.9 5.2.5 0 1.8-2 2-5.2zm-1.9-7.5c-.3 0-1.7 1.6-1.9 5.3h3.8c-.2-3.7-1.5-5.3-1.9-5.3zm2.7.8c.6 1.2.9 2.9 1 4.5h2.4c-.3-2.1-1.6-3.7-3.4-4.5zm3.4 6.7h-2.4c-.1 1.6-.5 3.4-1 4.6 1.8-.9 3.1-2.5 3.4-4.6z">
                                                </path>
                                            </svg>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">.crm.com</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block edit-text edit-text-double-click" data-number-text="161" data-content="Signup for Free" data-type="button">Signup for Free</button>
                                    </div>
                                </form>
                                <div class="sign-form-text">
                                    By signing up, you agree to our <a href="#">T&C</a> and <a href="#">Privacy
                                        Policy</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->

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

    <script>

    </script>
</body>
</html>
