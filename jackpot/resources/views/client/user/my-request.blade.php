@extends('client.master')
@section('pre_styles')
    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendors Styles -->
@endsection
@section('title',ucwords(__('label.wallet')))
@section('content')
    {{--    @dd($my_request);--}}

    <div class="kt-content  kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
         id="kt_content">

        <!-- begin:: Content -->

        <!-- begin:: Section -->
        <div class="kt-container ">
            <div class="row mb-5">
                <div class="col-12">
                    <p class="lead j-lead">
                        eJackpot Wallet
                    </p>
                </div>
                <div class="col-xl-4 mb-3 mb-xl-0 col-lg-12">
                    <div class="box-wallet">
                        <div class="box-wallet-content d-flex justify-content-between">
                            <div class="d-flex box-wallet-50">
                                <div class="d-flex align-items-center">
                                    <div class="box-wallet-currency">
                                        <svg width="70" height="71" viewBox="0 0 70 71" fill="none"
                                             xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect y="0.129883" width="70" height="70" fill="url(#pattern10)"/>
                                            <defs>
                                                <pattern id="pattern10" patternContentUnits="objectBoundingBox"
                                                         width="1"
                                                         height="1">
                                                    <use xlink:href="#image10" transform="scale(0.00333333)"/>
                                                </pattern>
                                                <image id="image10" width="300" height="300"
                                                       xlink:href="data:image/png;base64,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"/>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="pl-3">
                                        <div class="d-flex">
                                            <span class="box-wallet-name-currency">Tether</span>
                                            <span class="box-wallet-code-currency">USDT</span>
                                        </div>
                                        <div>
                                        <span class="box-wallet-amount">
                                            {{ numberFormat(credit('usdt')) }}
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex box-wallet-50 align-items-center">
                                <span class="box-wallet-balance">${{ numberFormat(credit('usdt')) }}</span>
                            </div>
                        </div>
                        <div class="box-wallet-footer d-flex justify-content-between align-items-center">
                            <a href="https://wallet.elegend.io/wallet/balance" class="btn-wallet-deposit">
                                {{ __('label.deposit') }}
                            </a>
                            <a href="javascript:void(0);" class="open-transfer-modal" data-currency="EUSDT" data-toggle="modal" data-target="#modal_transfer">
                                {{ __('label.transfer') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-3 mb-xl-0 col-lg-12">
                    <div class="box-wallet">
                        <div class="box-wallet-content d-flex justify-content-between">
                            <div class="d-flex box-wallet-50">
                                <div class="d-flex align-items-center">
                                    <div class="box-wallet-currency">
                                        <img src="{{ asset('assets/media/epo.svg') }}" alt="">
                                    </div>
                                    <div class="pl-3">
                                        <div class="d-flex">
                                            <span class="box-wallet-name-currency">EPoint</span>
                                            <span class="box-wallet-code-currency">EPO</span>
                                        </div>
                                        <div>
                                        <span class="box-wallet-amount">
                                            {{ numberFormat(credit('epoint')) }}
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex box-wallet-50 align-items-center">
                                <span class="box-wallet-balance">${{ numberFormat(credit('epoint')) }}</span>
                            </div>
                        </div>
                        <div class="box-wallet-footer d-flex justify-content-between align-items-center">
                            <a href="https://wallet.elegend.io/wallet/balance" class="btn-wallet-deposit">
                                {{ __('label.deposit') }}
                            </a>
                            <a href="javascript:void(0);" class="open-transfer-modal" data-currency="EPO" data-toggle="modal" data-target="#modal_transfer">
                                {{ __('label.transfer') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="box-wallet">
                        <div class="box-wallet-content d-flex justify-content-between">
                            <div class="d-flex box-wallet-50">
                                <div class="d-flex align-items-center">
                                    <div class="box-wallet-currency">
                                        <img src="{{ asset('assets/media/eti.svg') }}" alt="">
                                    </div>
                                    <div class="pl-3">
                                        <div class="d-flex">
                                            <span class="box-wallet-name-currency">ETicket</span>
                                            <span class="box-wallet-code-currency">ETI</span>
                                        </div>
                                        <div>
                                        <span class="box-wallet-amount">
                                            {{ numberFormat(credit('eticket')) }}
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex box-wallet-50 align-items-center">
                                <span class="box-wallet-balance">${{ numberFormat(credit('eticket')) }}</span>
                            </div>
                        </div>
                        <div class="box-wallet-footer d-flex justify-content-between align-items-center">
                            <a href="https://wallet.elegend.io/wallet/balance" class="btn-wallet-deposit">
                                {{ __('label.deposit') }}
                            </a>
                            <a href="javascript:void(0);" class="open-transfer-modal" data-currency="ETI" data-toggle="modal" data-target="#modal_transfer">
                                {{ __('label.transfer') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="lead j-lead">{{ __('label.history') }}</p>
                    <div class="box-table" style="width: 100%;">
                        <div class="box-filter d-flex justify-content-between">
                        </div>
                        <div class="box-content">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-3">
                                    <thead>
                                    <tr>
                                        <th>{{ __('label.date') }}</th>
                                        <th>{{ __('label.asset') }}</th>
                                        <th>{{ __('label.type') }}</th>
                                        <th>{{ __('label.amount') }}</th>
                                        <th>{{ __('label.from') }}</th>
                                        <th>{{ __('label.to') }}</th>
                                        <th class="text-right">{{ __('label.status') }}</th>
                                        {{--                                    <th class="text-center">#</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($history) > 0)
                                        @foreach($history as $_history)
                                            <tr>
                                                <td>{{ $_history->created_at }}</td>
                                                <td>{{ $_history->credit->currency }}</td>
                                                <td>
                                                    @if($_history->type === 'minus')
                                                        <span>{{ __('label.transfer') }}</span>
                                                    @else
                                                        <span style="color: #2197F9;">{{ __('label.deposit') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ numberFormat($_history->value) }}</td>
                                                <td>
                                                    @if($_history->type === 'minus')
                                                        <span>eJackpot</span>
                                                    @else
                                                        <span>eWallet</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($_history->type === 'minus')
                                                        <span>eWallet</span>
                                                    @else
                                                        <span>eJackpot</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <span style="color:#20BE72;">{{ __('label.completed') }}</span>
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
                            <div class="l-pagination-right">
                                {{ $history->links() }}
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
    <script>
        $(".show-time-requets").each(function () {
            let dataTime = $(this).attr("data-time");
            // $(this).find("i").html(moment.utc(dataTime).local().format("MM/DD/YYYY HH:MM"))
            // console.log()
        });
    </script>
@endsection
