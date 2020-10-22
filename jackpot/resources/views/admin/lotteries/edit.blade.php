@extends('admin.layouts.app')
@section('content')
    <?php
    $id = param('lottery');
    $response = api(['api.lotteries.show', ['id' => $id]]);
    $lottery = $response;
//    dd($lottery);
    $countTickets = collect($lottery['tickets'])->count();
    $winTickets = collect($lottery['tickets'])->filter(function ($value) {
        return $value['status'] === 'success';
    });
//    dd($winTickets);
    ?>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_3_3_tab_content"
                               role="tab">
                                <i class="flaticon2-heart-rate-monitor" aria-hidden="true"></i>Thông tin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_3_2_tab_content"
                               role="tab">
                                <i class="flaticon2-chronometer" aria-hidden="true"></i>Logs
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_portlet_base_demo_3_3_tab_content" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="kt-section kt-section--last">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Số trúng thưởng</label>
                                            <div class="col-9">
                                                <div class="tickets-preview">
                                                    <?php
                                                    $picked = $lottery['numbers'];
                                                    ?>
                                                    @foreach($picked as $pick)
                                                        <div
                                                            style="width: {{ 100 / count($picked) }}%;">
                                                            <p class="mb-0">
                                                                {{ $pick }}
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Tổng số vé</label>
                                            <div class="col-9">
                                                <label class="col-form-label text-dark kt-font-bolder">
                                                    {{ $countTickets }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Số vé trúng thưởng</label>
                                            <div class="col-9">
                                                <label class="col-form-label text-dark kt-font-bolder">
                                                    {{ $winTickets->count() }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last row">
                                            <label class="col-3 col-form-label">Tổng tiền thướng</label>
                                            <div class="col-9">
                                                <label class="col-form-label text-dark kt-font-bolder">
                                                    {{ numberFormat($winTickets->sum('prize_value')) }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_portlet_base_demo_3_2_tab_content" role="tabpanel">
                        <!--begin::Accordion-->
                        <div class="accordion accordion-light  accordion-toggle-arrow" id="accordionExample2">
                            @foreach($lottery['tickets'] as $index => $ticket)
                                @if($ticket['prize_id'])
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{ route('admin.tickets.edit',['id' => $ticket['id']]) }}" class="card-title">
                                                <i class="flaticon2-check-mark kt-font-success"></i>
                                                @foreach($ticket['picked'] as $picked)
                                                    <span class="picked-single @if(in_array($picked,$lottery['numbers'])) bg-success text-white @endif">{{ $picked }}</span>
                                                @endforeach
                                                <span class="ml-3">{{ numberFormat($ticket['prize_value']) }} {{ config('constants.currency.usdt') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{ route('admin.tickets.edit',['id' => $ticket['id']]) }}" class="card-title">
                                                <i class="flaticon2-cross kt-font-danger"></i>
                                                @foreach($ticket['picked'] as $picked)
                                                    <span class="picked-single">{{ $picked }}</span>
                                                @endforeach
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!--end::Accordion-->
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
@endsection
@section('scripts')
    <script>
        var URL_DETAIL = '{{ route('api.games.show',':id') }}';
    </script>
@endsection
