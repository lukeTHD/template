<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http:/www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http:/themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http:/themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->
<head>
    <base href="">
    <meta charset="utf-8"/>
    <title>E-Legend | eJackpot | @yield('title')</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
          rel="stylesheet">
    <!--end::Fonts -->

@yield('pre_styles')

<!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>

    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ asset('assets/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css"/>

    <!--end::Layout Skins -->

    <!--begin::My Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <!--end::My Styles -->

    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="index.html">
            <svg width="63" height="34" viewBox="0 0 63 34" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19.6033 28.6911H8.43188L18.2209 30.2717L17.7482 30.8105H12.5589L17.1078 31.5424L15.1612 33.7736L54.9881 33.5805L61.4531 26.1701L21.6313 26.3632L19.6033 28.6911Z"
                    fill="#EC1C24"/>
                <path
                    d="M46.541 21.0571L53.006 13.6467L13.1842 13.8399L12.0812 15.1054H0L10.587 16.8132L10.2312 17.2249H4.12704L9.47389 18.0889L6.71406 21.2502L46.541 21.0571Z"
                    fill="#EC1C24"/>
                <path
                    d="M20.6709 2.88181L20.2542 3.35957H14.6227L19.5579 4.15753L16.5439 7.60859L56.3708 7.41545L62.8358 0L23.014 0.198221L22.1042 1.24015H10.4957L20.6709 2.88181Z"
                    fill="#EC1C24"/>
            </svg>
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler">
            <span></span></button>
        <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                class="flaticon-more"></i></button>
    </div>
</div>

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <!-- begin:: Aside -->

        <!-- Uncomment this to display the close button of the panel
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
-->
        <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop"
             id="kt_aside">

            <!-- begin:: Aside -->
            <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                <div class="kt-aside__brand-logo">
                    <a href="{{ route('admin.dashboard.index') }}">
                        <div class="d-flex align-items-center">
                            <svg width="63" height="34" viewBox="0 0 63 34" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.6033 28.6911H8.43188L18.2209 30.2717L17.7482 30.8105H12.5589L17.1078 31.5424L15.1612 33.7736L54.9881 33.5805L61.4531 26.1701L21.6313 26.3632L19.6033 28.6911Z"
                                    fill="#EC1C24"/>
                                <path
                                    d="M46.541 21.0571L53.006 13.6467L13.1842 13.8399L12.0812 15.1054H0L10.587 16.8132L10.2312 17.2249H4.12704L9.47389 18.0889L6.71406 21.2502L46.541 21.0571Z"
                                    fill="#EC1C24"/>
                                <path
                                    d="M20.6709 2.88181L20.2542 3.35957H14.6227L19.5579 4.15753L16.5439 7.60859L56.3708 7.41545L62.8358 0L23.014 0.198221L22.1042 1.24015H10.4957L20.6709 2.88181Z"
                                    fill="#EC1C24"/>
                            </svg>
                            <svg class="logo-elegend" width="125" height="14" viewBox="0 0 125 14" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M118.363 0.246277C122.027 0.246277 125.001 3.21449 125.001 6.8841C125.001 8.51052 124.416 10.0099 123.43 11.1636C123.313 11.3059 123.186 11.4482 123.049 11.5804C121.85 12.79 120.193 13.5321 118.363 13.5321H112.706C112.162 13.5321 111.72 13.0899 111.72 12.5461V1.23229C111.72 0.688459 112.162 0.246277 112.706 0.246277H118.363ZM114.088 11.1636H118.368C120.721 11.1636 122.637 9.24749 122.637 6.8841C122.637 4.53087 120.721 2.61475 118.368 2.61475H114.088V11.1636Z"
                                    fill="#0F2345"/>
                                <path
                                    d="M81.1683 3.82436V5.0645H90.9472C91.491 5.0645 91.9332 5.50668 91.9332 6.05051V6.44695C91.9332 6.99079 91.491 7.43297 90.9472 7.43297H81.1683V9.94375C81.1683 10.6146 81.7172 11.1687 82.3932 11.1687H91.0996C91.6435 11.1687 92.0857 11.6108 92.0857 12.1547V12.546C92.0857 13.0899 91.6435 13.532 91.0996 13.532H82.3881C80.411 13.532 78.8049 11.926 78.8049 9.94884V3.82436C78.8049 1.84724 80.411 0.24115 82.3881 0.24115H91.0996C91.6435 0.24115 92.0857 0.683334 92.0857 1.22717V1.62361C92.0857 2.16744 91.6435 2.60962 91.0996 2.60962H82.3881C81.7121 2.60962 81.1683 3.15346 81.1683 3.82436Z"
                                    fill="#0F2345"/>
                                <path
                                    d="M47.2422 3.82436V5.0645H57.0211C57.5649 5.0645 58.0071 5.50668 58.0071 6.05051V6.44695C58.0071 6.99079 57.5649 7.43297 57.0211 7.43297H47.2422V9.94375C47.2422 10.6146 47.7912 11.1687 48.4671 11.1687H57.1736C57.7174 11.1687 58.1596 11.6108 58.1596 12.1547V12.546C58.1596 13.0899 57.7174 13.532 57.1736 13.532H48.4621C46.4849 13.532 44.8788 11.926 44.8788 9.94884V3.82436C44.8788 1.84724 46.4849 0.24115 48.4621 0.24115H57.1736C57.7174 0.24115 58.1596 0.683334 58.1596 1.22717V1.62361C58.1596 2.16744 57.7174 2.60962 57.1736 2.60962H48.4621C47.7861 2.60962 47.2422 3.15346 47.2422 3.82436Z"
                                    fill="#0F2345"/>
                                <path
                                    d="M2.65776 3.82515V5.06529H12.4366C12.9804 5.06529 13.4226 5.50747 13.4226 6.05131V6.44775C13.4226 6.99158 12.9804 7.43376 12.4366 7.43376H2.65776V9.94455C2.65776 10.6154 3.20668 11.1694 3.88266 11.1694H12.5891C13.1329 11.1694 13.5751 11.6116 13.5751 12.1555V12.5468C13.5751 13.0907 13.1329 13.5328 12.5891 13.5328H3.87757C1.90045 13.5328 0.294373 11.9267 0.294373 9.94963V3.82515C0.294373 1.84803 1.90045 0.241943 3.87757 0.241943H12.5891C13.1329 0.241943 13.5751 0.684127 13.5751 1.22796V1.6244C13.5751 2.16823 13.1329 2.61042 12.5891 2.61042H3.87757C3.20159 2.61042 2.65776 3.15425 2.65776 3.82515Z"
                                    fill="#0F2345"/>
                                <path
                                    d="M41.8499 12.1394V12.5359C41.8499 13.0797 41.4077 13.5219 40.8639 13.5219H35.1206C34.4497 13.5219 33.8195 13.3643 33.2604 13.0899C32.4167 12.6782 31.7356 12.0022 31.3341 11.1585C31.0495 10.5994 30.8919 9.96408 30.8919 9.29318V1.22717C30.8919 0.683334 31.3341 0.24115 31.8779 0.24115H32.2744C32.8182 0.24115 33.2604 0.683334 33.2604 1.22717V9.53207C33.3722 10.3758 34.0431 11.0467 34.8868 11.1585H40.869C41.4077 11.1534 41.8499 11.5956 41.8499 12.1394Z"
                                    fill="#0F2345"/>
                                <path
                                    d="M108.548 1.22722V12.1852C108.548 13.278 107.293 13.898 106.429 13.2271L106.174 13.034L97.6358 3.7075V12.541C97.6358 13.0848 97.1936 13.527 96.6497 13.527H96.2482C95.7044 13.527 95.2622 13.0848 95.2622 12.541V1.55758C95.2622 0.464828 96.5176 -0.155242 97.3816 0.515656L97.6358 0.708792L106.174 10.0353V1.22722C106.174 0.683381 106.617 0.241198 107.16 0.241198H107.562C108.106 0.241198 108.548 0.683381 108.548 1.22722Z"
                                    fill="#0F2345"/>
                                <path
                                    d="M75.7709 6.96539C75.7709 6.92981 75.776 6.89423 75.776 6.85865H75.7709V5.31864H69.4939C68.9501 5.31864 68.5079 5.76082 68.5079 6.30466V6.77225C68.5079 7.31609 68.9501 7.75827 69.4939 7.75827H73.3211C72.9145 9.69981 71.1915 11.1585 69.1331 11.1585H68.2081H67.9793C65.7024 11.1585 63.71 9.4406 63.5626 7.17378C63.3949 4.68332 65.3771 2.60456 67.832 2.60456H74.7137C75.2576 2.60456 75.6997 2.16237 75.6997 1.61854V1.2221C75.6997 0.678266 75.2576 0.236084 74.7137 0.236084H68.2081H68.02C64.4419 0.236084 61.3619 2.98575 61.1941 6.55879C61.0162 10.3758 64.0556 13.527 67.832 13.527H68.2081H68.757H69.1331C72.6655 13.527 75.5473 10.7671 75.7557 7.29068C75.7607 7.26526 75.7709 7.23985 75.7709 7.21444V6.96539Z"
                                    fill="#0F2345"/>
                                <path
                                    d="M26.3075 8.12934H18.7294C18.3686 8.12934 18.0738 7.83456 18.0738 7.47369V6.28437C18.0738 5.92351 18.3686 5.62872 18.7294 5.62872H26.3075C26.6684 5.62872 26.9632 5.92351 26.9632 6.28437V7.47369C26.9632 7.83456 26.6735 8.12934 26.3075 8.12934Z"
                                    fill="#0F2345"/>
                            </svg>
                        </div>
                    </a>
                </div>
                {{--<div class="kt-aside__brand-tools">
                    <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
								<span><svg xmlns="http:/www.w3.org/2000/svg" xmlns:xlink="http:/www.w3.org/1999/xlink"
                                           width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                           class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"/>
											<path
                                                d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
											<path
                                                d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
										</g>
									</svg></span>
                        <span><svg xmlns="http:/www.w3.org/2000/svg" xmlns:xlink="http:/www.w3.org/1999/xlink"
                                   width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"/>
											<path
                                                d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                                fill="#000000" fill-rule="nonzero"/>
											<path
                                                d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
										</g>
									</svg></span>
                    </button>

                    <!--
			<button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
			-->
                </div>--}}
            </div>

            <!-- end:: Aside -->

            <!-- begin:: Aside Menu -->
        @include('admin.partials.sidebar')
        <!-- end:: Aside Menu -->
        </div>

        <!-- end:: Aside -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

                <!-- begin:: Header Menu -->

                <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                    <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
                        <ul class="kt-menu__nav ">
                            <li class="kt-menu__item kt-menu__item--rel" >
                                <a href="{{ route('client.home.index') }}" class="btn btn-sm btn-secondary" target="_blank"><span class="kt-menu__link-text"><i class="la la-globe mr-1"></i>{{ u(__('label.web_client')) }}</span></a>
                            </li>
                            <li class="kt-menu__item kt-menu__item--rel" >
                                <a href="{{ route('cache.flush') }}" class="btn btn-sm btn-danger"><span class="kt-menu__link-text">{{ u(__('label.clear_cache')) }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Uncomment this to display the close button of the panel
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
-->
                <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                    <div id="kt_header_menu"
                         class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
                    </div>
                </div>

                <!-- end:: Header Menu -->


                <!-- begin:: Header Topbar -->
                    <div class="kt-header__topbar">

                    <!--begin: User Bar -->
                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                            <div class="kt-header__topbar-user">
                                <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                                <span class="kt-header__topbar-username kt-hidden-mobile">{{ user()->name }}</span>
                            </div>
                        </div>
                        <div
                            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                            <!--begin: Head -->
                            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                                 style="background-image: url({{ asset('assets/media/misc/bg-1.jpg')}})">
                                <div class="kt-user-card__name">
                                    {{ user()->name }}
                                </div>
                            </div>

                            <!--end: Head -->

                            <!--begin: Navigation -->
                            <div class="kt-notification">
                                <a href="{{ route('admin.auth.profile') }}"
                                   class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            {{ __('label.profile') }}
                                        </div>
                                    </div>
                                </a>
                                <div class="kt-notification__custom kt-space-between">
                                    <a href="#" target="_blank"
                                       class="btn btn-clean btn-sm btn-bold"></a>
                                    <form action="{{ route('admin.auth.logout') }}" method="POST">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="btn btn-label btn-label-brand btn-sm btn-bold">{{ __('label.logout') }}</button>
                                    </form>
                                </div>
                            </div>

                            <!--end: Navigation -->
                        </div>
                    </div>

                    <!--end: User Bar -->
                </div>

                <!-- end:: Header Topbar -->
            </div>

            <!-- end:: Header -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                <!-- begin:: Content Head -->
            {{--<div class="kt-subheader  kt-grid__item" id="kt_subheader">
                <div class="kt-container  kt-container--fluid ">
                    <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">Dashboard</h3>
                        <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                        <span class="kt-subheader__desc">#XRS-45670</span>
                        <a href="#" class="btn btn-label-warning btn-bold btn-sm btn-icon-h kt-margin-l-10">
                            Add New
                        </a>
                        <div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
                            <input type="text" class="form-control" placeholder="Search order..."
                                   id="generalSearch2">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                        <span><i class="flaticon2-search-1"></i></span>
                                    </span>
                        </div>
                    </div>
                    <div class="kt-subheader__toolbar">
                        <div class="kt-subheader__wrapper">
                            <a href="#" class="btn kt-subheader__btn-secondary">Today</a>
                            <a href="#" class="btn kt-subheader__btn-secondary">Month</a>
                            <a href="#" class="btn kt-subheader__btn-secondary">Year</a>
                            <a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker"
                               data-toggle="kt-tooltip" title="Select dashboard daterange" data-placement="left">
                                <span class="kt-subheader__btn-daterange-title"
                                      id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                                <span class="kt-subheader__btn-daterange-date"
                                      id="kt_dashboard_daterangepicker_date">Aug 16</span>
                                <i class="flaticon2-calendar-1"></i>
                            </a>
                            <div class="dropdown dropdown-inline" data-toggle-="kt-tooltip" title="Quick actions"
                                 data-placement="left">
                                <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <svg xmlns="http:/www.w3.org/2000/svg" xmlns:xlink="http:/www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                         class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path
                                                d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path
                                                d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z"
                                                fill="#000000"/>
                                        </g>
                                    </svg>

                                    <!--<i class="flaticon2-plus"></i>-->
                                </a>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">

                                    <!--begin::Nav-->
                                    <ul class="kt-nav">
                                        <li class="kt-nav__head">
                                            Add anything or jump to:
                                            <i class="flaticon2-information" data-toggle="kt-tooltip"
                                               data-placement="right" title="Click to learn more..."></i>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                <span class="kt-nav__link-text">Order</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                <span class="kt-nav__link-text">Ticket</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
                                                <span class="kt-nav__link-text">Goal</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                <span class="kt-nav__link-text">Support Case</span>
                                                <span class="kt-nav__link-badge">
                                                            <span
                                                                class="kt-badge kt-badge--brand kt-badge--rounded">5</span>
                                                        </span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__foot">
                                            <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
                                            <a class="btn btn-clean btn-bold btn-sm kt-hidden" href="#"
                                               data-toggle="kt-tooltip" data-placement="right"
                                               title="Click to learn more...">Learn more</a>
                                        </li>
                                    </ul>

                                    <!--end::Nav-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}

            <!-- end:: Content Head -->

                <!-- begin:: Content -->
            @yield('content')
            <!-- end:: Content -->
            </div>

            <!-- begin:: Footer -->
            <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                <div class="kt-container  kt-container--fluid ">
                    <div class="kt-footer__copyright">
                        2020&nbsp;&copy;&nbsp;<a href="http:/keenthemes.com/metronic" target="_blank" class="kt-link">Keenthemes</a>
                    </div>
                    <div class="kt-footer__menu">
                        <a href="http:/keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                        <a href="http:/keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                        <a href="http:/keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
                    </div>
                </div>
            </div>

            <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>

<!-- end::Global Config -->

@yield('pre_scripts')

<script type="text/javascript">
    var KTDB_PROCESSING = '{{ __('label.loading') }}';
</script>

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/lodash.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/functions.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
<script>
    axios.defaults.headers.common['Authorization'] = 'Bearer {{ session('token') }}';
</script>
<!--end::Global Theme Bundle -->

<!--begin::Scripts -->
@yield('scripts')
<!--end::Scripts -->
</body>

<!-- end::Body -->
</html>
