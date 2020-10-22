@extends('admin.layouts.app')
@section('pre_styles')
    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendors Styles -->
@endsection
@section('content')
    <?php
    $currency = currency();
    ?>
    <div class="kt-content  kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
         id="kt_content">

        <!-- begin:: Content -->

        <!-- begin:: Section -->
        <div class="kt-container ">
            <div class="row">
                <div class="col-lg-4">
                    <a href="{{ route('admin.users.index') }}" class="kt-portlet kt-iconbox kt-iconbox--animate-slow">
                        <div class="kt-portlet__body">
                            <div class="kt-iconbox__body">
                                <div class="kt-iconbox__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                         class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path
                                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path
                                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="kt-iconbox__desc">
                                    <h3 class="kt-iconbox__title">
                                        {{ __('label.user.text') }}
                                    </h3>
                                    <div class="kt-iconbox__content">
                                        {{ _count() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('admin.tickets.index') }}" class="kt-portlet kt-iconbox kt-iconbox--animate-slow">
                        <div class="kt-portlet__body">
                            <div class="kt-iconbox__body">
                                <div class="kt-iconbox__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                         class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M3,10.0500091 L3,8 C3,7.44771525 3.44771525,7 4,7 L9,7 L9,9 C9,9.55228475 9.44771525,10 10,10 C10.5522847,10 11,9.55228475 11,9 L11,7 L21,7 C21.5522847,7 22,7.44771525 22,8 L22,10.0500091 C20.8588798,10.2816442 20,11.290521 20,12.5 C20,13.709479 20.8588798,14.7183558 22,14.9499909 L22,17 C22,17.5522847 21.5522847,18 21,18 L11,18 L11,16 C11,15.4477153 10.5522847,15 10,15 C9.44771525,15 9,15.4477153 9,16 L9,18 L4,18 C3.44771525,18 3,17.5522847 3,17 L3,14.9499909 C4.14112016,14.7183558 5,13.709479 5,12.5 C5,11.290521 4.14112016,10.2816442 3,10.0500091 Z M10,11 C9.44771525,11 9,11.4477153 9,12 L9,13 C9,13.5522847 9.44771525,14 10,14 C10.5522847,14 11,13.5522847 11,13 L11,12 C11,11.4477153 10.5522847,11 10,11 Z"
                                                fill="#000000" opacity="0.3"
                                                transform="translate(12.500000, 12.500000) rotate(-45.000000) translate(-12.500000, -12.500000) "/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="kt-iconbox__desc">
                                    <h3 class="kt-iconbox__title">
                                        {{ __('label.count_ticket_sell') }}
                                    </h3>
                                    <div class="kt-iconbox__content">
                                        {{ _count('tickets') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('admin.games.index') }}" class="kt-portlet kt-iconbox kt-iconbox--animate-slow">
                        <div class="kt-portlet__body">
                            <div class="kt-iconbox__body">
                                <div class="kt-iconbox__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                         class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M12.9486833,9.31622777 L11.0513167,8.68377223 C11.8160243,6.38964935 13.0426772,4.95855428 14.7574644,4.5298575 C15.650287,4.30665184 17,2.86951059 17,2 L19,2 C19,3.79715607 17.0163797,6.02668149 15.2425356,6.4701425 C14.2906561,6.70811238 13.517309,7.61035065 12.9486833,9.31622777 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path
                                                d="M7.05661608,8.02781729 C7.20182559,8.00946022 7.34980802,8 7.5,8 L16.5,8 C16.650192,8 16.7981744,8.00946022 16.9433839,8.02781729 C17.1264244,8.00942131 17.312112,8 17.5,8 C20.5375661,8 23,10.4624339 23,13.5 C23,16.5375661 20.5375661,19 17.5,19 C15.7920631,19 14.2659538,18.2215033 13.2571621,17 L10.7428379,17 C9.73404624,18.2215033 8.20793694,19 6.5,19 C3.46243388,19 1,16.5375661 1,13.5 C1,10.4624339 3.46243388,8 6.5,8 C6.68788804,8 6.87357561,8.00942131 7.05661608,8.02781729 Z M5.5,10 C5.22385763,10 5,10.2238576 5,10.5 L5,11.5 C5,11.7761424 5.22385763,12 5.5,12 L6.5,12 C6.77614237,12 7,11.7761424 7,11.5 L7,10.5 C7,10.2238576 6.77614237,10 6.5,10 L5.5,10 Z M7.5,12 C7.22385763,12 7,12.2238576 7,12.5 L7,13.5 C7,13.7761424 7.22385763,14 7.5,14 L8.5,14 C8.77614237,14 9,13.7761424 9,13.5 L9,12.5 C9,12.2238576 8.77614237,12 8.5,12 L7.5,12 Z M19,12 C19.5522847,12 20,11.5522847 20,11 C20,10.4477153 19.5522847,10 19,10 C18.4477153,10 18,10.4477153 18,11 C18,11.5522847 18.4477153,12 19,12 Z M18,15 C18.5522847,15 19,14.5522847 19,14 C19,13.4477153 18.5522847,13 18,13 C17.4477153,13 17,13.4477153 17,14 C17,14.5522847 17.4477153,15 18,15 Z M5.5,14 C5.22385763,14 5,14.2238576 5,14.5 L5,15.5 C5,15.7761424 5.22385763,16 5.5,16 L6.5,16 C6.77614237,16 7,15.7761424 7,15.5 L7,14.5 C7,14.2238576 6.77614237,14 6.5,14 L5.5,14 Z M3.5,12 C3.22385763,12 3,12.2238576 3,12.5 L3,13.5 C3,13.7761424 3.22385763,14 3.5,14 L4.5,14 C4.77614237,14 5,13.7761424 5,13.5 L5,12.5 C5,12.2238576 4.77614237,12 4.5,12 L3.5,12 Z"
                                                fill="#000000"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="kt-iconbox__desc">
                                    <h3 class="kt-iconbox__title">
                                        {{ __('label.game.text') }}
                                    </h3>
                                    <div class="kt-iconbox__content">
                                        {{ _count('games') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @if($games)
                <div class="row mb-4">
                    <div class="col-12">
                        <button
                            class="btn btn-sm btn-elevated btn-primary toggle-vault">{{ __('label.show_each_crate_of_game') }}</button>
                    </div>
                </div>
                @foreach($games as $game)
                    <div class="row vaults" style="display: none;">
                        <div class="vaults-wrap col-12">
                            <div class="row">
                                <div class="col-12">
                                    <p class="lead text-center bg-white border text-dark kt-font-bolder py-2"
                                       style="border-radius: 6px;">Game: {{ $game['name'] }}</p>
                                </div>
                                @foreach($game['vaults'] as $vault)
                                    <div class="col-lg-3">
                                        <a href="#" class="kt-portlet kt-iconbox kt-iconbox--animate-slow">
                                            <div class="kt-portlet__body">
                                                <div class="kt-iconbox__body">
                                                    <div class="kt-iconbox__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                             height="24px"
                                                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path
                                                                    d="M5.84026576,8 L18.1597342,8 C19.1999115,8 20.0664437,8.79732479 20.1528258,9.83390904 L20.8194924,17.833909 C20.9112219,18.9346631 20.0932459,19.901362 18.9924919,19.9930915 C18.9372479,19.9976952 18.8818364,20 18.8264009,20 L5.1735991,20 C4.0690296,20 3.1735991,19.1045695 3.1735991,18 C3.1735991,17.9445645 3.17590391,17.889153 3.18050758,17.833909 L3.84717425,9.83390904 C3.93355627,8.79732479 4.80008849,8 5.84026576,8 Z M10.5,10 C10.2238576,10 10,10.2238576 10,10.5 L10,11.5 C10,11.7761424 10.2238576,12 10.5,12 L13.5,12 C13.7761424,12 14,11.7761424 14,11.5 L14,10.5 C14,10.2238576 13.7761424,10 13.5,10 L10.5,10 Z"
                                                                    fill="#000000"/>
                                                                <path
                                                                    d="M10,8 L8,8 L8,7 C8,5.34314575 9.34314575,4 11,4 L13,4 C14.6568542,4 16,5.34314575 16,7 L16,8 L14,8 L14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 C10.4477153,6 10,6.44771525 10,7 L10,8 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    opacity="0.3"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="kt-iconbox__desc">
                                                        <h3 class="kt-iconbox__title">
                                                            {{ $vault['game_config']['title'] }}
                                                        </h3>
                                                        <div class="kt-iconbox__content">
                                                            $ {{ numberFormat($vault['value']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="row">
                <div class="col-12">
                    <p class="lead">{{ __('label.statistic') }}</p>
                </div>
                <div class="col-lg-12">

                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title kt-font-dark">
                                    {{ __('label.count_ticket_sell') }}
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar" data-wrap-search="tickets">
                                <div>
                                    <input type="text" name="from" class="form-control datepicker_chart"
                                           value="{{ now()->startOfMonth()->format('d/m/Y') }}" readonly
                                           placeholder="Select date"/>
                                </div>
                                <div>
                                    <i class="la la-arrow-right la-3x mx-3"></i>
                                </div>
                                <div>
                                    <input type="text" name="to" class="form-control datepicker_chart"
                                           value="{{ now()->endOfMonth()->format('d/m/Y') }}" readonly
                                           placeholder="Select date"/>
                                </div>

                                <div class="kt-portlet__head-actions">
                                    <button data-search="tickets" class="btn btn-primary ml-3 btn-bold"
                                            id="statistic-tickets">
                                        {{ __('label.statistic') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="kt_amcharts_1" style="height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="kt-portlet h-100">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title kt-font-dark">
                                    {{ __('label.most_game_play') }}
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar" data-wrap-search="games">
                                <div>
                                    <input type="text" name="from" class="form-control datepicker_chart"
                                           value="{{ now()->startOfMonth()->format('d/m/Y') }}" readonly
                                           placeholder="Select date"/>
                                </div>
                                <div>
                                    <i class="la la-arrow-right la-3x mx-3"></i>
                                </div>
                                <div>
                                    <input type="text" name="to" class="form-control datepicker_chart"
                                           value="{{ now()->endOfMonth()->format('d/m/Y') }}" readonly
                                           placeholder="Select date"/>
                                </div>

                                <div class="kt-portlet__head-actions">

                                    <button class="btn btn-primary ml-3 btn-bold" data-search="games"
                                            id="statistic-games">
                                        <i class="la la-search p-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">

                            <div id="kt_amcharts_12" style="height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="kt-portlet h-100">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title kt-font-dark">
                                    {{ __('label.top_rich') }}
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                {{-- <div>
                                     <input type="text" name="from" class="form-control datepicker_chart"
                                            value="{{ now()->startOfMonth()->format('d/m/Y') }}" readonly
                                            placeholder="Select date"/>
                                 </div>
                                 <div>
                                     <i class="la la-arrow-right la-3x mx-3"></i>
                                 </div>
                                 <div>
                                     <input type="text" name="from" class="form-control datepicker_chart"
                                            value="{{ now()->endOfMonth()->format('d/m/Y') }}" readonly
                                            placeholder="Select date"/>
                                 </div>

                                 <div class="kt-portlet__head-actions">
                                     <button class="btn btn-primary ml-3 btn-bold">
                                         <i class="la la-search p-0"></i>
                                     </button>
                                 </div>--}}
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <?php
                            $response = api('api.statistic.credits');
                            ?>
                            <div class="kt-list-timeline">
                                <div class="kt-list-timeline__items">
                                    @if($response)
                                        @foreach($response as $item)
                                            <div class="kt-list-timeline__item">
                                                <span class="kt-list-timeline__badge"></span>
                                                <span class="kt-list-timeline__text">{{ $item['name'] }}</span>
                                                <span
                                                    class="kt-list-timeline__time">{{ numberFormat($item['balance']) }} {{ $item['currency'] }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: iconbox -->

        <!-- end:: Content -->
    </div>
@endsection
@section('scripts')
    <!--begin::Page Vendors(used by this page) -->
    <script src="//www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/radar.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/plugins/tools/polarScatter/polarScatter.min.js"
            type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>
    <!--end::Page Vendors -->

    <script>

        var arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        };
        $('.datepicker_chart').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: 'dd/mm/yyyy'
        });

            <?php
            $responseGames = api('api.statistic.games');
            ?>
        var gamesChart = AmCharts.makeChart("kt_amcharts_12", {
                "type": "pie",
                "theme": "light",
                "dataProvider": {!! $responseGames !!},
                "valueField": "quantity",
                "titleField": "name",
                "balloon": {
                    "fixedPosition": true
                },
                "export": {
                    "enabled": true
                }
            });
            <?php
            $responseTickets = api('api.statistic.tickets');
            ?>
        var ticketsChart = AmCharts.makeChart("kt_amcharts_1", {
                "rtl": KTUtil.isRTL(),
                "type": "serial",
                "theme": "light",
                "dataProvider": {!! $responseTickets !!},
                "gridAboveGraphs": true,
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "quantity"
                }],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "time",
                "categoryAxis": {
                    "gridPosition": "start",
                    "gridAlpha": 0,
                    "tickPosition": "start",
                    "tickLength": 20
                },
                "export": {
                    "enabled": true
                }

            });
    </script>

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/js/pages/components/charts/amcharts/charts.js') }}" type="text/javascript"></script>
    {{--    <script src="{{ asset('assets/js/pages/components/portlets/tools.js') }}" type="text/javascript"></script>--}}
    <!--end::Page Scripts -->

    <script>
        function initStatistic(elm, url, chartElm, chart) {
            $(elm).click(async function () {
                var search = $(this).data('search');
                var from = $("[data-wrap-search=" + search + "] input[name=from]").val();
                var to = $("[data-wrap-search=" + search + "] input[name=to]").val();

                axios.interceptors.request.use(function (config) {
                    KTApp.block(chartElm, {});
                    return config;
                }, function (error) {
                    // Do something with request error
                    KTApp.block(chartElm, {});
                    return Promise.reject(error);
                });

                try {
                    var response = await axios({
                        method: 'GET',
                        url: url + '?from=' + from + '&to=' + to
                    });
                    KTApp.unblock(chartElm);
                    var data = JSON.parse(response.data.data);
                    console.log(data);
                    if (data.length > 0) chart.dataProvider = data;
                    else {
                        var chartProvider = [
                            {
                                'time': '{{ __('label.no_data') }}',
                                'quantity': 0
                            }
                        ];
                        chart.dataProvider = chartProvider;
                    }
                    chart.validateData();
                } catch (errors) {
                    console.log(errors);
                }
            });
        }

        $(document).ready(function () {
            initStatistic('#statistic-tickets', '{{ route('api.statistic.tickets') }}', '#kt_amcharts_1', ticketsChart);
            initStatistic('#statistic-games', '{{ route('api.statistic.games') }}', '#kt_amcharts_12', gamesChart);
            $(".toggle-vault").click(function () {
                $(".vaults").slideToggle('fast');
            });
        });
    </script>
@endsection
