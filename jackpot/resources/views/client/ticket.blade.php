@extends('client.master')
@section('pre_styles')
    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendors Styles -->
@endsection
@section('title',ucwords(__('label.my_tickets')))
@section('content')
    <div class="kt-content  kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
         id="kt_content">

        <!-- begin:: Content -->

        <!-- begin:: Section -->
        <div class="kt-container">

            <div class="row">
                <div class="col-12">
                    <p class="lead j-lead">{{ ucwords(__('label.my_tickets')) }}</p>
                    <div class="box-table p-3 pt-4" style="width: 100%;">
                        <div class="box-filter d-flex justify-content-between align-items-center mb-3">
                            <div class="box-search">
                                <span class="kt-font-bolder kt-font-dark">{{ __('label.total_tickets') }}: </span> <span class="kt-font-bold kt-font-dark">{{ $my_tickets_count }}</span>
                                {{--<div class="kt-input-icon kt-input-icon--right">
                                    <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                            <span><i class="la la-search"></i></span>
                                                        </span>
                                </div>--}}
                            </div>
                            <div class="box-action d-flex">
                                <select name="ticket_type" class="form-control">
                                    <option value="all">All types</option>
                                    <option @if(request()->type == 'standard') selected @endif value="standard">
                                        Standard
                                    </option>
                                    <option @if(request()->type == 4) selected @endif value="4">4</option>
                                    <option @if(request()->type == 3) selected @endif value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-content p-0">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{ __('label.ticket._text') }}</th>
                                        <th>{{ __('label.lottery_at') }}</th>
                                        <th>{{ __('label.buy_time') }}</th>
                                        <th class="text-center">{{ __('label.type') }}</th>
                                        <th>{{ __('label.status') }}</th>
                                        <th class="text-right">{{ __('label.price') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($my_tickets) > 0)
                                        @foreach($my_tickets as $ticket)
                                            <tr>
                                                <td>
                                                    @foreach(collect($ticket->picked)->sort() as $picked)
                                                        <span class="number">{{ $picked }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket->picked_at)->format('m') }}/{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket->picked_at)->format('d') }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $ticket->created_at->format('m') }}/{{ $ticket->created_at->format('d') }}</span>
                                                    <span>{{ $ticket->created_at->format('H') }}:{{ $ticket->created_at->format('i') }}</span>
                                                </td>
                                                <td class="text-center">
                                                    {{ ucfirst($ticket->type) }}
                                                </td>
                                                <td>
                                                        <span class="kt-font-bolder"
                                                              style="color: {{ config('constants.ticket.color')[trim($ticket->status)] }} ">{{ uf(config('constants.ticket.status_label')[trim($ticket->status)]) }}</span>
                                                </td>
                                                <td class="text-right">${{ numberFormat($ticket->price) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">{{ __('label.no_ticket') }}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="l-pagination-right">
                                {{ $my_tickets->appends(array_except(\Request::query(), 'page_w'))->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <p class="lead j-lead">{{ ucwords(__('label.my_winning_tickets')) }}</p>
                    <div class="box-table p-3 pt-4" style="width: 100%;">
                        <div class="box-filter d-flex justify-content-between align-items-center mb-3">
                            <div class="box-search">
                                <span class="kt-font-bolder kt-font-dark">{{ __('label.total_tickets') }}:</span>
                                <span class="kt-font-bold kt-font-dark">{{ $my_winning_tickets_count }}</span>
                                {{--<div class="kt-input-icon kt-input-icon--right">
                                    <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                            <span><i class="la la-search"></i></span>
                                                        </span>
                                </div>--}}
                            </div>
                            <div class="box-action d-flex">
                                <select name="ticket_type" class="form-control">
                                    <option value="all">All types</option>
                                    <option @if(request()->type == 'standard') selected @endif value="standard">
                                        Standard
                                    </option>
                                    <option @if(request()->type == 4) selected @endif value="4">4</option>
                                    <option @if(request()->type == 3) selected @endif value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-content p-0">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{ __('label.ticket._text') }}</th>
                                        <th>{{ __('label.lottery_at') }}</th>
                                        <th>{{ __('label.buy_time') }}</th>
                                        <th class="text-center">{{ __('label.type') }}</th>
                                        <th class="text-right">{{ __('label.prize') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($my_winning_tickets) > 0)
                                        @foreach($my_winning_tickets as $ticket)
                                            <tr>
                                                <td>
                                                    @foreach(collect($ticket->picked)->sort() as $picked)
                                                        @if(in_array($picked,$ticket->lottery->numbers))
                                                            <span class="number active">{{ $picked }}</span>
                                                        @else
                                                            <span class="number">{{ $picked }}</span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket->picked_at)->format('m') }}/{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket->picked_at)->format('d') }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $ticket->created_at->format('m') }}/{{ $ticket->created_at->format('d') }}</span>
                                                    <span>{{ $ticket->created_at->format('H') }}:{{ $ticket->created_at->format('i') }}</span>
                                                </td>
                                                <td class="text-center">
                                                    {{ ucfirst($ticket->type) }}
                                                </td>
                                                <td class="text-right">
                                                    {{ $ticket->prize->title }}
                                                    <small>( + {{ numberFormat($ticket->prize_value,2) }}
                                                        )</small>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">{{ __('label.no_ticket') }}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="l-pagination-right">
                                {{ $my_winning_tickets->appends(array_except(\Request::query(), 'page'))->links() }}
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
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script>


        $(document).ready(function () {

            $("[name=ticket_type]").change(function () {
                var newurl = updateQueryStringParameter(window.location.href, 'type', $(this).val());
                window.location.href = newurl;
            });

            let Date = $(".jackpot-clock").attr('data-date');
            Date = moment.utc(Date).local().format("YYYY-MM-DD HH:mm:ss");
            $('.jackpot-clock').countdown(Date).on('update.countdown', function (event) {
                var format = '%H:%M:%S';
                if (event.offset.totalDays > 0) {
                    format = '%-d day%!d ' + format;
                }
                if (event.offset.weeks > 0) {
                    format = '%-w week%!w ' + format;
                }
                $(this).html(event.strftime(format));
            })
                .on('finish.countdown', function (event) {
                    $(this).html('This offer has expired!')
                        .parent().addClass('disabled');

                });
        });
    </script>
@endsection
