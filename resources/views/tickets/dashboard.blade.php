{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-xl-4">
        <!--begin::Tiles Widget 8-->
        <div class="card card-custom gutter-b card-stretch">
            
            <!--begin::Body-->
            <div class="card-body d-flex flex-column p-0">
                <figure class="highcharts-figure">
                    <div id="container" style="height: 300px;"></div>
                  </figure>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Tiles Widget 8-->
    </div>
    <div class="col-xl-8">
        <!--begin::Advance Table Widget 10-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">New Tickets</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
                        <thead>
                            <tr class="text-left">
                                <th class="pl-0" style="min-width: 160px">Requester</th>
                                <th>Subject</th>
                                <th style="min-width: 110px">Owner</th>
                                <th style="min-width: 150px">Last message</th>
                                <th style="min-width: 110px">Status</th>
                                <th class="pr-0 text-center" style="min-width: 100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($newSubjects as $subject)
                            <tr>
                                <td class="pl-0">
                                    <div class="d-flex align-items-center">								
                                        <div class="symbol symbol-40 symbol-light-success flex-shrink-0">									
                                            <span class="symbol-label font-size-h4 font-weight-bold">{{ substr($subject['display_name'],0,1) }}</span>								
                                        </div>								
                                        <div class="ml-4">									
                                            <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">{{ $subject['display_name'] }}</div>									
                                            <a class="text-muted font-weight-bold text-hover-primary">{{ $subject['email'] }}</a>								
                                        </div>							
                                    </div>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg text-truncate max-w-180px">{{ $subject['title'] }}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $subject['owner'] }}</span>
                                </td>
                                <td>
                                    <span class="text-info font-weight-bolder d-block font-size-lg">{{ $subject['messageOne']['created_at'] }}</span>
                                </td>
                                <td>
                                    <span class="label label-lg label-light-{{ ($subject['status'] == 0) ? 'success' : 'danger' }} label-inline">{{ ($subject['status'] == 0) ? 'Open' : 'Close' }}</span>
                                </td>
                                <td class="pr-0 text-center">
                                    <a href="{{ route('tickets.show', ['id' => $subject['id']]) }}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Ticket Details">
                                        <i class="flaticon-more-1"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 10-->
    </div>
</div>
<div class="row">
    <div class="col-xxl-8 order-2 order-xxl-1">
        <!--begin::Advance Table Widget 2-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Tickets has expired</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Opened 10 days</span>
                </h3>
                <div class="card-toolbar">
                    <a href="{{ route('tickets.index') }}" class="btn btn-danger font-weight-bolder font-size-sm">Handle</a>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2 pb-0 mt-n3">
                <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-borderless table-vertical-center">
                                <thead>
                                    <tr>
                                        <th class="p-0 w-40px"></th>
                                        <th class="p-0 min-w-180px"></th>
                                        <th class="p-0 min-w-100px"></th>
                                        <th class="p-0 min-w-125px"></th>
                                        <th class="p-0 min-w-110px"></th>
                                        <th class="p-0 min-w-150px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjectsExpired as $subjectEx)
                                    <tr>
                                        <td class="pl-0 py-4">
                                            <div class="symbol symbol-40 symbol-light-success flex-shrink-0">									
                                                <span class="symbol-label font-size-h4 font-weight-bold">{{ substr($subjectEx['display_name'],0,1) }}</span>								
                                            </div>
                                        </td>
                                        <td class="pl-0">
                                            <a class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $subjectEx['display_name'] }}</a>
                                            <div>
                                                <a class="text-muted font-weight-bold text-hover-primary">{{ $subjectEx['email'] }}</a>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg text-truncate max-w-200px">{{ $subjectEx['title'] }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $subjectEx['owner'] }}</span>
                                        </td>
                                        <td class="text-right">
                                            <span class="text-info font-weight-bolder d-block font-size-lg">{{ $subjectEx['messageOne']['created_at'] }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="label label-lg label-light-{{ ($subjectEx['status'] == 0) ? 'success' : 'danger' }} label-inline">{{ ($subjectEx['status'] == 0) ? 'Open' : 'Close' }}</span>
                                        </td>
                                        <td class="text-center pr-0">
                                            <a href="{{ route('tickets.show', ['id' => $subjectEx['id']]) }}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Ticket Details">
                                                <i class="flaticon-more-1"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 2-->
    </div>
</div>

<!--end::Row-->
@endsection

{{--  Styles Section  --}}
@section('styles')
    <link href="{{ asset('css/highcharts/highcharts.css') }}" rel="stylesheet" />
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/highcharts.js') }}"></script>
    <script>
        var data_percent = parseInt("{{ $percentStatusClose }}");

        // Build the chart
        Highcharts.chart('container', {
            chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
            },
            title: {
                text: 'Tickets by status'
            },
            tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
            point: {
                valueSuffix: '%'
            }
            },
            plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                enabled: false
                },
                showInLegend: true
            }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Close',
                    y: data_percent,
                    color: "#f64e60"
                }, {
                    name: 'Open',
                    y: (100 - data_percent),
                    color: "#1bc5bd"
                }]
            }],
            
        });
    </script>
    
@endsection
