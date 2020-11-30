{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<!--begin::Content-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Tickets</h3>
            </div>
            @if($user['Id'] != $fCode)
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="#" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#kt_inbox_compose">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>New Ticket</a>
                <!--end::Button-->
            </div>
            @endif
        </div>
        <!--end::Header-->
        <div class="card-body">
            <!--begin::Search-->
            <div class="d-flex order-1 order-xxl-2 align-items-center justify-content-center p-0">
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
            <!--begin::Toolbar-->
            <div class="col-12 order-2 order-xxl-1 d-flex flex-wrap align-items-center p-0 justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center mr-1 my-2">
                        <span class="btn btn-clean btn-icon btn-sm mr-2" data-toggle="tooltip" title="" data-original-title="Reload list" id="kt_datatable_reload">
                            <i class="ki ki-refresh icon-1x"></i>
                        </span>
                    </div>
                    @if($user['Id'] == $fCode)
                    <div class="d-flex align-items-center mr-1 my-2">
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
                    </div>
                    @endif
                </div>
                <div class="d-flex align-items-center mr-2" data-toggle="tooltip">
                    <span class="text-muted font-weight-bold mr-2 count-subjects"></span>
                </div>
            </div>
            <!--begin: Datatable-->
            <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
            <!--end: Datatable-->
        </div>
    </div>
<!--end::Content-->
@include('tickets.new_ticket_modal')
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
            width: 160,
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
                            <div class="text-dark-75 font-weight-bold line-height-sm">' + data.display_name + '</div>\
                            <a href="#" class="font-size-sm text-dark-50 text-hover-primary">' +
                            data.email + '</a>\
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
                            <div class="symbol-label">' + data.display_name.substring(0, 1) + '</div>\
                        </div>\
                        <div class="ml-2">\
                            <div class="text-dark-75 font-weight-bold line-height-sm">' + data.display_name + '</div>\
                            <a class="font-size-sm text-dark-50 text-hover-primary">' +
                                data.email + '</a>\
                        </div>\
                    </div>';
                }

                return output;
            },
        }, {
            field: 'title',
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
            field: 'owner',
            title: 'Owner',
            width: 80,
        }, {
            field: 'messages',
            title: 'LAST MESSAGE',
            width: 150,
            sortable: false,
            template: function (data) {
                return data.message_one.created_at;
            }
        }, {
            field: 'actions',
            title: 'Actions',
            sortable: false,
            width: 80,
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

{{--  Styles Section  --}}
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/crud/ktdatatable/base/methods_other.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/editors/summernote.js') }}"></script>
    <script>

        $('#kt_summernote_1').summernote({
            height: 150
        });
        
        $('#kt_inbox_compose_form').submit(function(e){
            e.preventDefault();
            let content = $("#kt_summernote_1").summernote("code");
            if($('#kt_summernote_1').summernote('isEmpty')){
                $('.invalid-feedback').text('* Please enter your content!');
            }
            else if(content.replace(/&nbsp;|<\/?[^>]+(>|$)/g, "").trim().length < 20 && $(content).find('img').length == 0){
                $('.invalid-feedback').text('* Content must has at least 20 characters.');
            }
            else{
                $('.invalid-feedback').text('');
                let ticket = {
                    owner : "{{ $fCode }}",
                    user_id : "{{ $user['Id'] }}",
                    display_name : "{{ $user['display_name'] }}",
                    email : "{{ $user['email'] }}",
                    title : $('input[name="title"]').val(),
                    content : content.replace(/&nbsp;/g, "").trim(),
                };
                $.ajax({
                    url : "{{ route('api.tickets.send-ticket') }}",
                    method: "POST",
                    data : ticket,
                    headers : {
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}",
                    },
                    success : function(data){
                        $("#kt_summernote_1").summernote("code", "");
                        $('input[name="title"]').val("");
                        Swal.fire({
                            timer: 1000,
                            onOpen: function() {
                                Swal.showLoading()
                            }
                        }).then(function(result) {
                            if (result.dismiss === "timer") {
                                Swal.fire({
                                    title: "Success!",
                                    text: "The ticket has been sent",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "OK!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function () {
                                    $('#kt_inbox_compose').modal('hide');
                                    $('#kt_datatable').KTDatatable('reload');
                                });
                            }
                        });
                    } 
                })
            }
        });
    </script>
@endsection
