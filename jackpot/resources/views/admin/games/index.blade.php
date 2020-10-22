@extends('admin.layouts.app')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-user"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        {{ __('label.game.text') }}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="dropdown dropdown-inline">
                            <a href="{{ route('admin.games.create') }}" class="btn btn-brand btn-icon-sm">
                                <i class="flaticon2-plus"></i> {{ __('label.game.add') }}
                            </a>
                        </div>
                    </div>
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
                            </div>
                        </div>

                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Search Form -->
                <div class="kt-form kt-form--label-right kt-margin-t-20-desktop">
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
    <script type="text/javascript">
        var DELETE_URL = '{{ route('api.games.destroy',':id') }}';
        var EDIT_URL = '{{ route('admin.games.edit',':id') }}';
        var KTDB_URL = '{{ route('api.games.index') }}';
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
            }, {
                field: 'name',
                title: '{{ __('label.name') }}'
            }, {
                field: 'algorithm',
                title: '{{ __('label.algorithm') }}'
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
                    // <a href="' + EDIT_URL.replace(':id', data.id) + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
                    // <i class="flaticon2-paper"></i>\
                    // </a>\
                    // }
                    return '\
                        <a href="' + EDIT_URL.replace(':id', data.id) + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
                            <i class="flaticon2-paper"></i>\
                        </a>\
						<a href="javascript:;" data-id="' + data.id + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm kt_sweetalert_delete" title="Delete">\
							<i class="flaticon2-trash"></i>\
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
            $('#ajax_data').on('click','.btn-dev',function () {
                alert('Developing');
            });
        });
    </script>
    @include('admin.partials.sweetalert.delete')
@endsection
