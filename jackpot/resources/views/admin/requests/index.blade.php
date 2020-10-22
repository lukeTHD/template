@extends('admin.layouts.app')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-coins"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        {{ __('label.request_withdraw.text') }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin: Search Form -->
                <div class="kt-form kt-form--label-right">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control"
                                               placeholder="{{ __('label.search') }}..." id="generalSearch">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
										    <span><i class="la la-search"></i></span>
										</span>
                                    </div>
                                </div>
                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>{{ __('label.status') }}:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control bootstrap-select" id="kt_form_status">
                                                <option value="">All</option>
                                                @if(isset(config('constants.request')['status']) && !empty(config('constants.request.status')))
                                                    @foreach(config('constants.request.status') as $key => $status)
                                                        <option value="{{ $key }}">{{ uf($status) }}</option>
                                                    @endforeach
                                                @endif
                                                {{--                                                --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{--<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>{{ __('label.mode') }}:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control bootstrap-select" id="kt_form_mode">
                                                <option value="manually">Manually</option>
                                                <option value="auto">Auto</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>--}}
                                {{--<div class="col-md-4">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>{{ __('label.type') }}:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control bootstrap-select" id="kt_form_type">
                                                <option value="">All</option>
                                                <option value="1">Online</option>
                                                <option value="2">Retail</option>
                                                <option value="3">Direct</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>--}}
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label class="mr-3">{{ __('label.mode') }}</label>
                            <form class="d-inline-block" action="{{ route('admin.requests.update-mode') }}"
                                  method="POST">
                                @method('PUT')
                                @csrf
                                <div class="btn-group btn-group">

                                        <button type="submit" name="mode" value="auto"
                                                class="btn @if(setting('withdraw_request_method')->value === 'auto')
                                                    btn-primary
                                                @elseif(setting('withdraw_request_method')->value === 'manually')
                                                    btn-secondary
                                                @endif
                                                    ">{{ __('label.auto') }}</button>
                                        <button type="submit" name="mode" value="manually"
                                                class="btn @if(setting('withdraw_request_method')->value === 'auto')
                                                    btn-secondary
                                                @elseif(setting('withdraw_request_method')->value === 'manually')
                                                    btn-primary
                                                @endif">{{ __('label.manually') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Action -->
            {{--<div class="kt-form kt-form--label-right kt-margin-t-20-desktop">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <select class="form-control bootstrap-select" id="kt_form_action">
                                    <option value="">{{ __('label.action') }}</option>
                                    <option value="delete">{{ __('label.delete') }}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="kt-form__group kt-form__group--inline">
                                    <button class="btn btn-elevate btn-secondary"
                                            id="kt_do_action">{{ __('label.do_action') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                        <a href="#" class="btn btn-default kt-hidden">
                            <i class="la la-cart-plus"></i> New Order
                        </a>
                        <div
                            class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                    </div>
                </div>
            </div>--}}
            <!--end: Action -->
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">

                <!--begin: Datatable -->
                <div class="kt-datatable" id="ajax_data"></div>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection
@section('pre_scripts')
    <script type="text/javascript">
        var USER_EDIT_URL = '{{ route('admin.users.edit',':id') }}';
        var DELETE_URL = '{{ route('api.requests.destroy',':id') }}';
        var EDIT_URL = '{{ route('admin.requests.edit',':id') }}';
        var KTDB_URL = '{{ route('api.requests.index') }}';
        var KTDB_HEADERS = {
            'Authorization': 'Bearer {{ session('token') }}'
        };
        var KTDB_PARAMS = {
            'is_pagination': true
        };
        var KTDB_COLUMNS = [
            {
                field: 'id',
                title: '#',
                width: 30,
                class: 'text-left',
                selector: {
                    class: 'kt-checkbox--solid'
                }
            },
            {
                field: 'amount',
                title: '{{ __('label.amount') }}',
            },
            {
                field: 'currency',
                title: '{{ __('label.currency') }}',
            },
            {
                field: 'status',
                title: '{{ __('label.status') }}',
                template: function (data, index) {
                    var color = "#ffb822";
                    if (data.status === 'fail') {
                        color = "#fd397a";
                    }
                    if (data.status === 'success') {
                        color = "#0abb87";
                    }
                    $("tr[data-row=" + index + "] td[data-field=id]").css("border-left", "3px solid " + color);
                    var status = data.status;
                    var color = 'warning';
                    if (status === 'fail') {
                        color = 'danger';
                    }
                    if (status === 'success') {
                        color = 'success';
                    }
                    return '<span class="kt-badge kt-badge--' + color + ' kt-badge--inline kt-badge--pill kt-badge--rounded">' + data.status + '</span>';
                }
            },
            {
                field: 'amount',
                title: '{{ __('label.amount') }}',
            },
            {
                field: 'sso_id',
                title: 'UID',
                template: function (data) {
                    return '<a class="text-primary kt-font-bold" href="' + USER_EDIT_URL.replace(':id', data.user.id) + '">' + data.sso_id + '</a>';
                }
            },
            {
                field: 'created_at',
                title: '{{ __('label.created_at') }}',
                type: 'date',
                format: 'YYYY-MM-DD HH:II:SS'
            },
            {
                field: 'actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                overflow: 'visible',
                autoHide: false,
                class: 'text-right',
                template: function (data) {
                    return '\
						<a href="' + EDIT_URL.replace(':id', data.id) + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
							<i class="flaticon2-search"></i>\
						</a>\
					';
                    // <a href="javascript:;" data-id="' + data.id + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm kt_sweetalert_delete" title="Delete">\
                    // <i class="flaticon2-trash"></i>\
                    // </a>\
                },
            }
        ];
    </script>
@endsection
@section('scripts')
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/js/pages/crud/metronic-datatable/base/data-ajax.js') }}"
            type="text/javascript"></script>
    <!--end::Page Scripts -->
    @include('admin.partials.scripts.action')
    <script type="text/javascript">

        jQuery(document).ready(function () {
            $("body").on('#transfer-mode', 'change', function () {
                console.log(123);
            });

            @if(session()->has('message'))
            toastr.success('{{ __('label.success') }} !');
            @endif

            $('#kt_form_status').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'status');
            });

            $('#kt_form_status,#kt_form_type,#kt_form_action,#kt_form_mode').selectpicker();
        });
    </script>
    @include('admin.partials.sweetalert.delete')
@endsection
