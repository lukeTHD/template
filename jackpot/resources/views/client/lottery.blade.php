@extends('client.master')
@section('pre_styles')
    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendors Styles -->
@endsection
@section('title',ucwords(__('label.lottery_history')))
@section('content')
    <div class="kt-content  kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
         id="kt_content">

        <!-- begin:: Content -->

        <!-- begin:: Section -->
        <div class="kt-container ">
            <div class="row">
                <div class="col-lg-12">
                    <p class="lead j-lead">{{ ucwords(__('label.lottery_history')) }}</p>
                    <div class="box-table" style="width: 100%;">
                        <div class="box-content">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th>{{ __('label.numbers') }}</th>
                                        <th>{{ __('label.total_winning_tickets')  }}</th>
                                        <th>{{ __('label.my_winning_tickets')  }}</th>
                                        <th>{{ __('label.total_jackpot')  }}</th>
                                        <th class="text-right">{{ __('label.lottery_at') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--                                        @dd($win_tickets);--}}
                                    @if($lotteries)
                                        @foreach($lotteries as $lottery)
                                            <tr>
                                                <td>
                                                    @if($lottery->numbers)
                                                        @foreach(collect($lottery->numbers)->sort() as $number)
                                                            <span class="number">{{ $number }}</span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <?php
                                                    $total_winners = $lottery->tickets->filter(function ($value) {
                                                        return $value['status'] === config('constants.ticket.status.success');
                                                    })->count();
                                                    ?>
                                                    {{ $total_winners }}
                                                </td>
                                                <td>
                                                    <?php
                                                    $filterCollection = $lottery->tickets->filter(function ($value) {
                                                        return $value['status'] === config('constants.ticket.status.success') && $value['uid'] === auth_client()['id'];
                                                    });
                                                    $total_winning_tickets = $filterCollection->count();
                                                    ?>
                                                    {{ $total_winning_tickets }}
                                                </td>
                                                <td>
                                                    {{ numberFormat($lottery->total_jackpot) }}
                                                </td>
                                                {{--                                                <td class="text-right">--}}
                                                {{--                                                    {{ $win_ticket['count_prize'] }}--}}
                                                {{--                                                </td>--}}
                                                <td class="text-right">
                                                    {{ $lottery->created_at }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="l-pagination-right">
                                {{ $lotteries->links() }}
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
