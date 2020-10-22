@extends('admin.layouts.app')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand la la-ticket"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        {{ __('label.ticket.text') }}
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
                                                <option value="create">{{ __('label.ticket.status.create') }}</option>
                                                <option value="failed">{{ __('label.ticket.status.failed') }}</option>
                                                <option value="success">{{ __('label.ticket.status.success') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
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
                </div>
                <!--end: Search Form -->
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
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    <script type="text/javascript">
        var DELETE_URL = '{{ route('api.groups.destroy',':id') }}';
        var EDIT_URL = '{{ route('admin.tickets.edit',':id') }}';
        var KTDB_URL = '{{ route('api.tickets.index') }}';
        var KTDB_PARAMS = {
            'is_pagination': true
        };
        console.log(KTDB_PARAMS);
        var KTDB_HEADERS = {
            'Authorization': 'Bearer {{ session('token') }}'
        };
        var KTDB_COLUMNS = [
            {
                field: 'picked',
                title: '{{ __('label.choose_number') }}',
                template: function (data, index) {
                    var color = "#ffb822";
                    if (data.status === 'failed') {
                        color = "#fd397a";
                    }
                    if (data.status === 'success') {
                        color = "#0abb87";
                    }
                    $("tr[data-row=" + index + "] td[data-field=picked]").css("border-left", "3px solid " + color);
                    return data.picked;
                }
            },
            {
                field: 'id',
                title: '{{ __('label.name') }}',
                template: function (data) {
                    return data.user.name;
                }
            },
            {
                field: 'status',
                title: '{{ __('label.status') }}',
                template: function (data) {
                    var status = data.status;
                    var color = 'warning';
                    var text = '{{ __('label.ticket.status.create') }}';
                    if (status === 'failed') {
                        color = 'danger';
                        var text = '{{ __('label.ticket.status.failed') }}';
                    }
                    if (status === 'success') {
                        color = 'success';
                        var text = '{{ __('label.ticket.status.success') }}';
                    }
                    return '<span class="kt-badge kt-badge--' + color + ' kt-badge--inline kt-badge--pill kt-badge--rounded">' + text + '</span>';
                }
            },
            {
                field: 'picked_at',
                title: '{{ __('label.picked_at') }}',
                type: 'date',
                format: 'YYYY-MM-DD HH:II:SS',
                template: function (data) {
                    return moment(data.picked_at, "YYYY-MM-DD hh:mm:ss").format('YYYY-MM-DD');
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
            $('#kt_form_action').selectpicker();

            $('#kt_form_status').selectpicker();

            $('#kt_form_status').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'status');
            });
            // console.log(JSON.parse('["14",\'22\',34]'.replace(/('|")/g,'')));
        });
    </script>
    @include('admin.partials.sweetalert.delete')
@endsection
