@extends('client.master')
@section('pre_styles')
    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendors Styles -->
@endsection
@section('title',ucwords(__('label.my_commissions')))
@section('content')
    {{--    @dd($my_request);--}}

    <div class="kt-content  kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
         id="kt_content">

        <!-- begin:: Content -->

        <!-- begin:: Section -->
        <div class="kt-container ">
            <div class="row">
                <div class="col-lg-12">
                    <p class="lead j-lead">{{ __('label.manage_your_network') }}</p>
                    <div class="box-table" style="width: 100%;">
                        <div class="box-filter d-flex justify-content-between">
                        </div>
                        <div class="box-content">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{ __('label.username') }}</th>
                                        <th>{{ __('label.created_at') }}</th>
                                        <th>{{ __('label.level') }}</th>
                                        <th>{{ __('label.jackpot_prize') }}</th>
                                        <th class="text-right">{{ __('label.com_earned') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($my_commissions) > 0)
                                        @foreach($my_commissions as $my_commission)
                                            <?php $data = json_decode($my_commission['note'], true);
                                            ?>
                                            <tr>
                                                <td>
                                                    {{ $my_commission->from->uid }}
                                                </td>
                                                <td>
                                                    <span>{{ $my_commission->created_at }}</span>
                                                </td>
                                                <td>
                                                    F{{ $data['level'] }}
                                                </td>
                                                <td>
                                                    {{ numberFormat($my_commission['ticket']['lottery']['total_jackpot']) }}
                                                </td>
                                                <td class="text-right">
                                                    {{ numberFormat($my_commission->amount) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">{{ __('label.no_data') }}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="j-pagination">
                                {{ $my_commissions->links() }}
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
