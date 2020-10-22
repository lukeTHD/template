@extends('admin.layouts.app')
@section('content')
    <?php
    $id = param('user');
    $user = api(['api.users.show', ['id' => $id]], 'GET', [], true, 'query');
    $credits = [];
    $user['credits'] = collect($user['credits'])->map(function ($value) use (&$credits) {
        $credits[$value['currency']] = $value;
    })->toArray();
    $user['user_info'] = json_decode($user['user_info'], true);
    $user['credits'] = $credits;
    $groups = api('api.groups.index');
    $groups = collect($groups)->filter(function ($value) {
        return $value['type'] !== 'user' && $value['type'] !== 'super_admin';
    })->reverse();
    ?>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::Row-->
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile"
                     id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand flaticon2-edit"></i>
							</span>
                            <h3 class="kt-portlet__head-title">
                                {{ __('label.user.edit') }}
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            @if($user['group_id'] == config('constants.group.user'))
                                <button type="button" data-toggle="modal" data-target="#kt_modal_44"
                                        class="btn btn-secondary">
                                    <i class="la la-file-text"></i>
                                    <span class="kt-hidden-mobile">{{ __('label.see_activity') }}</span>
                                </button>
                            @else
                                <button type="button" onclick="submit('form')" class="btn btn-brand">
                                    <i class="la la-check"></i>
                                    <span class="kt-hidden-mobile">{{ __('label.save') }}</span>
                                </button>
                            @endif

                        </div>
                    </div>

                @include('admin.partials.error',['class' =>  'rounded-0 d-block mb-0'])
                @include('admin.partials.alert')
                <!--begin::Form-->
                    @if($user['group_id'] != config('constants.group.user'))

                        <form class="kt-form kt-form--label-left" id="form"
                              action="{{ route('admin.users.update',['id' => $id]) }}"
                              method="POST">
                            @method('PUT')
                            @csrf
                            @endif
                            <div class="kt-portlet__body">
                                <div class="form-group row">
                                    <label for="example-text-input"
                                           class="col-2 col-form-label">{{ __('label.name') }}</label>
                                    <div class="col-10">
                                        @if($user['group_id'] == config('constants.group.user'))
                                            <span class="kt-font-bolder">{{ $user['name'] }}</span>
                                        @else
                                            <input class="form-control" name="name" value="{{ $user['name'] }}"
                                                   type="text">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                           class="col-2 col-form-label">{{ __('label.email') }}</label>
                                    <div class="col-10">
                                        @if($user['group_id'] == config('constants.group.user'))
                                            <span class="kt-font-bolder">{{ $user['email'] }}</span>
                                        @else
                                            <input class="form-control" name="email" value="{{ $user['email'] }}"
                                                   type="text">
                                        @endif
                                    </div>
                                </div>
                                @if($user['group_id'] != config('constants.group.user'))
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                               class="col-2 col-form-label">{{ __('label.password') }}</label>
                                        <div class="col-10">
                                            <input class="form-control" name="password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                               class="col-2 col-form-label">{{ __('label.password_confirmation') }}</label>
                                        <div class="col-10">
                                            <input class="form-control" name="password_confirmation" type="password">
                                        </div>
                                    </div>
                                @endif
                                <div
                                    class="form-group @if($user['group_id'] != config('constants.group.user')) form-group-last @endif row">
                                    <label for="example-text-input"
                                           class="col-2 col-form-label">{{ __('label.group._text') }}</label>
                                    <div class="col-10">
                                        @if($user['group_id'] == config('constants.group.user'))
                                            <span class="kt-font-bolder">{{ $user['group']['name'] }}</span>
                                        @else
                                            <select name="group_id" data-live-search="true"
                                                    class="form-control selectpicker">
                                                @foreach($groups as $group)
                                                    <option @if($user['group_id'] == $group['id'] ) selected
                                                            @endif value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                @if($user['group_id'] == config('constants.group.user'))
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                               class="col-12 col-form-label">{{ __('label.wallet') }}</label>
                                        <div class="col-12">
                                            <div class="user-info-wrap">
                                                @foreach($user['credits'] as $wallet => $credit)
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
                                                @foreach($user['user_info'] as $key => $user_info)
                                                    <div class="row-user-info">
                                                        <div class="left">
                                                            <span class="word-break">{{ $key }} :</span>
                                                        </div>
                                                        <div class="right">
                                                            <span class="word-break">{{ $user_info }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
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
                                                @foreach($user['tickets'] as $ticket)
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
                                @endif
                            </div>
                            @if($user['group_id'] != config('constants.group.user'))
                        </form>
                    @endif
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-xl-2"></div>
        </div>
        <!--End::Row-->

    </div>
    @if($user['group_id'] == config('constants.group.user'))
        <!--begin::Modal-->
        <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <!--begin::Portlet-->
                        <div class="kt-portlet kt-portlet--tabs mb-0">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-toolbar">
                                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab"
                                               href="#kt_portlet_base_demo_3_3_tab_content" role="tab">
                                                <i class="flaticon-list-2" aria-hidden="true"></i>{{ __('label.all') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab"
                                               href="#kt_portlet_base_demo_3_2_tab_content" role="tab">
                                                <i class="flaticon2-paper"
                                                   aria-hidden="true"></i>Mua vé
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab"
                                               href="#kt_portlet_base_demo_3_3_tab_content_2" role="tab">
                                                <i class="flaticon2-chronometer" aria-hidden="true"></i>Trúng giải
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="kt_portlet_base_demo_3_3_tab_content"
                                         role="tabpanel">
                                        <!--begin::Timeline 1-->
                                        <div class="kt-list-timeline">
                                            <div class="kt-list-timeline__items">
                                                <div class="kt-list-timeline__item">
                                                    <span class="kt-list-timeline__badge"></span>
                                                    <span class="kt-list-timeline__text">$credit_activity['note'] <span
                                                            class="kt-badge kt-badge--brand kt-badge--inline ml-2">$credit_activity['reason']</span></span>
                                                    <span
                                                        class="kt-list-timeline__time">$credit_activity['created_at']</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--end::Timeline 1-->
                                    </div>
                                    <div class="tab-pane" id="kt_portlet_base_demo_3_2_tab_content" role="tabpanel">
                                        <div class="kt-list-timeline">
                                            <div class="kt-list-timeline__items">
                                                <div class="kt-list-timeline__item">
                                                    <span class="kt-list-timeline__badge"></span>
                                                    <span
                                                        class="kt-list-timeline__text">$credit_activity['note']</span>
                                                    <span
                                                        class="kt-list-timeline__time">$credit_activity['created_at']</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="kt_portlet_base_demo_3_3_tab_content_2" role="tabpanel">
                                        <div class="kt-list-timeline">
                                            <div class="kt-list-timeline__items">
                                                <div class="kt-list-timeline__item">
                                                    <span class="kt-list-timeline__badge"></span>
                                                    <span
                                                        class="kt-list-timeline__text">$credit_activity['note']</span>
                                                    <span
                                                        class="kt-list-timeline__time">$credit_activity['created_at']</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end::Portlet-->
                    </div>
                </div>
            </div>
        </div>

        <!--end::Modal-->

        <!--begin::Modal-->
        <div class="modal fade" id="kt_modal_44" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('label.see_activity') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-info-wrap">
                            @foreach($credit_activities as $key => $credit_activity)
                                <div class="row-user-info">
                                    <div class="left">
                                        <span class="word-break">{{ $credit_activity->note }} :
                                            <small
                                                class="text-muted">( {{ $credit_activity->created_at }} )</small>
                                        </span>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('label.close') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Modal-->
    @endif
@endsection
@section('scripts')
@endsection
