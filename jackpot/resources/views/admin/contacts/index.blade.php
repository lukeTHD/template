@extends('admin.layouts.app')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand fa fa-address-book "></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        {{ __('label.contact.text') }}
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
        var DELETE_URL = '{{ route('api.groups.destroy',':id') }}';
        var EDIT_URL = '{{ route('admin.contacts.edit',':id') }}';
        var KTDB_URL = '{{ route('api.contacts.index') }}';
        var KTDB_PARAMS = {
            'is_pagination': true
        };
        console.log(KTDB_PARAMS);
        var KTDB_HEADERS = {
            'Authorization': 'Bearer {{ session('token') }}'
        };
        var KTDB_COLUMNS = [
            {
                field: 'title',
                title: '{{ __('label.title') }}'
            },
            {
                field: 'name',
                title: '{{ __('label.name') }}'
            },
            {
                field: 'email',
                title: '{{ __('label.email') }}'
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
            // console.log(JSON.parse('["14",\'22\',34]'.replace(/('|")/g,'')));
        });
    </script>
    @include('admin.partials.sweetalert.delete')
@endsection
