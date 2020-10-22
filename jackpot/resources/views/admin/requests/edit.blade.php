@extends('admin.layouts.app')
@section('content')
    <?php
    $request = api(['api.requests.show', ['id' => param('request')]]);
    $credits = [];
    $request['user']['credits'] = collect($request['user']['credits'])->map(function ($value) use (&$credits) {
        $credits[$value['currency']] = $value;
    })->toArray();
    $request['user']['user_info'] = json_decode($request['user']['user_info'], true);
    $request['user']['credits'] = $credits;
    $credit_activities = app(\App\Repositories\CreditActivity\CreditActivityInterface::class)->getCreditAcitivitesByUserId($request['user']['id']);
    ?>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-coins"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">{{ __('label.request_withdraw.text') }} </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="btn-group-margin">
                        <a href="{{ route('admin.requests.index') }}"
                           class="btn btn-secondary group-margin-right">
                            <i class="la la-arrow-left"></i>
                            <span class="kt-hidden-mobile">{{ __('label.back') }}</span>
                        </a>
                        @if($request['status'] == 'pending')
                            <form class="d-inline-block group-margin-right"
                                  action="{{route('admin.requests.update-status',['id' => param('request')])}}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="fail">
                                <button
                                    type="submit"
                                    class="btn btn-danger">
                                    <i class="la la-close"></i>
                                    <span class="kt-hidden-mobile">{{ __('label.reject') }}</span>
                                </button>
                            </form>
                            <form class="d-inline-block"
                                  action="{{ route('admin.requests.update-status',['id' => param('request')]) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="success">
                                <button
                                    type="submit"
                                    class="btn btn-success">
                                    <i class="la la-check"></i>
                                    <span class="kt-hidden-mobile">{{ __('label.accept') }}</span>
                                </button>
                            </form>

                        @endif
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                <h3 class="kt-section__title kt-section__title-lg">{{ __('label.request_withdraw.detail') }}
                                    :</h3>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.name') }}</label>
                                    <div class="col-9">
                                        <label class="col-form-label">
                                            <span class="kt-font-bolder">{{ $request['user']['name'] }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.status') }}</label>
                                    <div class="col-9">
                                        <label class="col-form-label">
                                            <?php
                                            $color = "#ffb822";
                                            if ($request['status'] === 'fail') {
                                                $color = "#fd397a";
                                            }
                                            if ($request['status'] === 'success') {
                                                $color = "#0abb87";
                                            }
                                            ?>
                                            <span style="color:{{ $color }}"
                                                  class="kt-font-bolder">{{ $request['status'] }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.amount') }}</label>
                                    <div class="col-9">
                                        <label class="col-form-label">
                                            <span class="kt-font-bolder">{{ $request['amount'] }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group form-group-last row">
                                    <label class="col-3 col-form-label">{{ __('label.currency') }}</label>
                                    <div class="col-9">
                                        <label class="col-form-label">
                                            <span class="kt-font-bolder">{{ $request['currency'] }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                        <div class="kt-section kt-section--last">
                            <div class="kt-section__body">
                                <h3 class="kt-section__title kt-section__title-lg">{{ __('label.user.detail') }}
                                    :</h3>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.name') }}</label>
                                    <div class="col-9">
                                        <label class="col-form-label">
                                            <span class="kt-font-bolder">{{ $request['user']['name'] }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.email') }}</label>
                                    <div class="col-9">
                                        <label class="col-form-label">
                                            <span class="kt-font-bolder">{{ $request['user']['email'] }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">UID</label>
                                    <div class="col-9">
                                        <label class="col-form-label">
                                            <span class="kt-font-bolder">{{ $request['user']['uid'] }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                           class="col-12 col-form-label">{{ __('label.wallet') }}</label>
                                    <div class="col-12">
                                        <div class="user-info-wrap">
                                            @foreach($request['user']['credits'] as $wallet => $credit)
                                                <div class="row-user-info">
                                                    <div class="left">
                                                        <span class="word-break">{{ $wallet }} :</span>
                                                    </div>
                                                    <div class="right">
                                                        {{--                                                    {{ number_format(auth_client()->credits()->where('currency',config('constants.currency.epoint'))->orderBy('created_at','DESC')->first()->value,2) }}--}}
                                                        <span
                                                            class="word-break">$ {{ numberFormat($credit['value']) }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                           class="col-12 mb-0">
                                        <button type="button"
                                                class="btn btn-sm btn-secondary toggle"
                                                data-toggle="toggle-user-info">{{ __('label.user.detail') }}</button>
                                    </label>
                                    <div class="col-12 mt-3" id="toggle-user-info" style="display: none;">
                                        <div class="user-info-wrap">
                                            @foreach($request['user']['user_info'] as $key => $user_info)
                                                <div class="row-user-info">
                                                    <div class="left">
                                                        <span class="word-break">{{ $key }} : </span>
                                                    </div>
                                                    <div class="right">
                                                        <span class="word-break">{{ $user_info }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                           class="col-12 mb-0">
                                        <button type="button"
                                                class="btn btn-sm btn-secondary toggle"
                                                data-toggle="toggle-ticket">{{ __('label.list_bought_ticket') }}</button>
                                    </label>
                                    <div class="col-12 mt-3" id="toggle-ticket" style="display: none;">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Ticket</th>
                                                <th>Buy time</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th class="text-right">Value</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($request['user']['tickets'] as $ticket)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('admin.tickets.edit',['id' => $ticket['id']]) }}">
                                                            @foreach($ticket['picked'] as $picked)
                                                                <span class="mr-1">{{ $picked }}</span>
                                                            @endforeach
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ $ticket['created_at'] }}
                                                    </td>
                                                    <td>
                                                        {{ $ticket['type'] }}
                                                    </td>
                                                    <td>
                                                        {{ $ticket['status'] }}
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $ticket['price'] }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group form-group-last row">
                                    <label for="example-text-input"
                                           class="col-12 mb-0">
                                        <button type="button"
                                                class="btn btn-sm btn-secondary toggle"
                                                data-toggle="toggle-activity">{{ __('label.see_activity') }}</button>
                                    </label>
                                    <div class="col-12 mt-3" id="toggle-activity" style="display: none;">
                                        <div class="user-info-wrap">
                                            @foreach($credit_activities as $key => $credit_activity)
                                                <div class="row-user-info">
                                                    <div class="left">
                                                            <span
                                                                class="word-break">{{ $credit_activity->note }} :  <small
                                                                    class="text-muted">( {{ $credit_activity->created_at }} )</small></span>
                                                    </div>
                                                    <div class="right">
                                                            <span class="word-break">
                                                                  @if($credit_activity->type == 'minus')
                                                                    <span class="mx-2"><i
                                                                            style="font-size:12px;vertical-align: middle;"
                                                                            class="la la-minus text-danger"></i>
                                                    <b class="text-dark">{{ $credit_activity->value }}</b>
</span>
                                                                @elseif($credit_activity->type == 'plus')
                                                                    <span class="mx-2"><i
                                                                            style="font-size:12px;vertical-align: middle;"
                                                                            class="la la-plus text-success"></i>
                                                    <b class="text-dark">{{ $credit_activity->value }}</b>
</span>
                                                                @endif
                                                            </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            @if(session()->has('message'))
            toastr.success('{{ session('message') }}', '{{ __('label.success') }} !');
            @endif
        });
    </script>
@endsection
