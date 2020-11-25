{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<!--begin::Content-->
    <div class="card card-custom">
        <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
            <!--begin::Toolbar-->
            <div class="col-12 col-sm-6 col-xxl-4 order-2 order-xxl-1 d-flex flex-wrap align-items-center">
                <div class="d-flex align-items-center mr-1 my-2">
                    <span class="btn btn-clean btn-icon btn-sm mr-2" data-toggle="tooltip" title="" data-original-title="Reload list" id="kt_datatable_reload">
                        <i class="ki ki-refresh icon-1x"></i>
                    </span>
                </div>
                <div class="d-flex align-items-center mr-1 my-2">
                    <span class="btn btn-default btn-icon btn-sm mr-2 d-none" data-toggle="tooltip" title="" data-original-title="Spam">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Code/Warning-1-circle.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                                    <rect fill="#000000" x="11" y="7" width="2" height="8" rx="1"></rect>
                                    <rect fill="#000000" x="11" y="16" width="2" height="2" rx="1"></rect>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </span>
                    <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="" data-original-title="Delete" id="kt_datatable_remove_row">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                    <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </span>
                    {{--  <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="" data-original-title="Set status" id="kt_datatable_set_status_row">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                                <title>Stockholm-icons / General / Update</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Stockholm-icons-/-General-/-Update" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                    <path d="M8.43296491,7.17429118 L9.40782327,7.85689436 C9.49616631,7.91875282 9.56214077,8.00751728 9.5959027,8.10994332 C9.68235021,8.37220548 9.53982427,8.65489052 9.27756211,8.74133803 L5.89079566,9.85769242 C5.84469033,9.87288977 5.79661753,9.8812917 5.74809064,9.88263369 C5.4720538,9.8902674 5.24209339,9.67268366 5.23445968,9.39664682 L5.13610134,5.83998177 C5.13313425,5.73269078 5.16477113,5.62729274 5.22633424,5.53937151 C5.384723,5.31316892 5.69649589,5.25819495 5.92269848,5.4165837 L6.72910242,5.98123382 C8.16546398,4.72182424 10.0239806,4 12,4 C16.418278,4 20,7.581722 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 L6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C10.6885336,6 9.44767246,6.42282109 8.43296491,7.17429118 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </span>  --}}
                </div>
            </div>
            <!--end::Toolbar-->
            <!--begin::Search-->
            <div class="col-xxl-3 d-flex order-1 order-xxl-2 align-items-center justify-content-center">
                <div class="input-group input-group-lg input-group-solid my-2">
                    <input type="text" class="form-control pl-4" placeholder="Search in all tickets..." id="generalSearch">
                    <div class="input-group-append">
                        <span class="input-group-text pr-3">
                            <span class="svg-icon svg-icon-lg">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Search.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <!--end::Search-->
            <!--begin::Pagination-->
            <div class="col-12 col-sm-6 col-xxl-4 order-2 order-xxl-3 d-flex align-items-center justify-content-sm-end text-right my-2">
                <!--begin::Per Page Dropdown-->
                <div class="d-flex align-items-center mr-2" data-toggle="tooltip">
                    <span class="text-muted font-weight-bold mr-2 count-subjects">{{ $countSubjects}} {{ ($countSubjects > 1) ? 'tickets' : 'ticket' }}</span>
                </div>
                <!--end::Per Page Dropdown-->
            </div>
            <!--end::Pagination-->
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
            <!--end: Datatable-->
        </div>
    </div>
<!--end::Content-->
@endsection

@section('pre_scripts')
<script type="text/javascript">
    var DETAIL_URL = '{{ route('tickets.show',':id') }}';
    var KTDB_URL = '{{ route('api.tickets.index') }}';
    var REMOVE_ROWS_URL= "{{ route('api.tickets.update-rows-status') }}";
    var KTDB_PARAMS = {
        'is_pagination': true
    };
    var KTDB_COLUMNS = [
        {
            field: 'id',
            title: '#',
            sortable: false,
            width: 30,
            class: 'text-left',
            selector: {
                class: 'kt-checkbox--solid',
            },
        }, {
            field: 'user',
            title: 'REQUESTER',
            sortable: false,
            template: function(data) {
                var number = KTUtil.getRandomInt(1, 14);
                var user_img = 'background-image:url(\'assets/media/users/100_' + number + '.jpg\')';

                var output = '';
                if (number > 8) {
                    output = '<div class="d-flex align-items-center">\
                        <div class="symbol symbol-40 flex-shrink-0">\
                            <div class="symbol-label" style="' + user_img + '"></div>\
                        </div>\
                        <div class="ml-2">\
                            <div class="text-dark-75 font-weight-bold line-height-sm">' + data.user.name + '</div>\
                            <a href="#" class="font-size-sm text-dark-50 text-hover-primary">' +
                            data.user.email + '</a>\
                        </div>\
                    </div>';
                }
                else {
                    var stateNo = KTUtil.getRandomInt(0, 7);
                    var states = [
                        'success',
                        'primary',
                        'danger',
                        'success',
                        'warning',
                        'dark',
                        'primary',
                        'info'];
                    var state = states[stateNo];

                    output = '<div class="d-flex align-items-center">\
                        <div class="symbol symbol-40 symbol-'+state+' flex-shrink-0">\
                            <div class="symbol-label">' + data.user.name.substring(0, 1) + '</div>\
                        </div>\
                        <div class="ml-2">\
                            <div class="text-dark-75 font-weight-bold line-height-sm">' + data.user.name + '</div>\
                            <a class="font-size-sm text-dark-50 text-hover-primary">' +
                                data.user.email + '</a>\
                        </div>\
                    </div>';
                }

                return output;
            },
        }, {
            field: 'content',
            title: 'SUBJECT',
            width: 200,
            class: 'text-truncate',
        }, {
            field: 'status',
            title: 'Status',
            width: 80,
            class: 'text-center',
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    0: {'title': 'Open', 'class': ' label-success'},
                    1: {'title': 'Close', 'class': ' label-danger'},
                    
                };
                return '<span class="label ' + status[row.status].class + ' label-inline font-weight-bold label-lg">' + status[row.status].title + '</span>';
            },
        }, {
            field: 'messages',
            title: 'LAST MESSAGE',
            width: 160,
            sortable: false,
            template: function (data) {
                let length = data.messages.length;
                if(length > 0) {
                    return data.messages[length-1].created_at;
                }
                
            }
        }, {
            field: 'actions',
            title: 'Actions',
            sortable: false,
            width: 100,
            overflow: 'visible',
            autoHide: false,
            class: 'text-center',
            template: function (data) {
                return '\
                    <a href="' + DETAIL_URL.replace(':id', data.id) + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Ticket Details">\
                        <i class="flaticon-more-1"></i>\
                    </a>\
                ';
            },
        }
    ];
</script>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/crud/ktdatatable/base/methods_other.js') }}"></script>
@endsection
