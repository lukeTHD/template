{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<!--begin::Content-->
<div class="row">
    <div class="col-lg-8">
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header align-items-center px-4 py-3">
                <div class="text-left flex-grow-1">
                    <a href="{{ route('tickets.index') }}" class="btn btn-clean btn-icon btn-sm mr-6" data-inbox="back">
                        <i class="flaticon2-left-arrow-1"></i>
                    </a>
                </div>
                <div class="text-center flex-grow-1">
                    <div class="text-dark-75 font-weight-bold font-size-h5 text-truncate" style="max-width: 500px">{{ $subject['title'] }}</div>
                </div>
                <div class="text-right flex-grow-1">
                    <a href="{{ request()->fullUrl() }}" class="btn btn-clean btn-icon btn-sm" data-inbox="back">
                        <i class="flaticon2-refresh-arrow"></i>
                    </a>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body p-0">
                <!--begin::Messages-->
                <div class="mb-3" id="show-message" style="height:400px;overflow-y: scroll;">
                    @foreach($subject->messages as $message)
                    <div class="cursor-pointer shadow-xs inbox-message {{ $loop->last ? 'toggle-on' : 'toggle-off' }}" data-inbox="message">
                        <!--begin::Message Heading-->
                        <div class="d-flex card-spacer-x py-6 flex-column flex-md-row flex-lg-column flex-xxl-row justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40 symbol-light-{{ ($message['user_id'] == $fCode) ? 'danger' : 'success' }} flex-shrink-0">									
                                    <span class="symbol-label font-size-h4 font-weight-bold">{{ substr(($message['user_id'] == $fCode) ? 'Admin' : $subject['display_name'],0,1) }}</span>								
                                </div>
                                <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2 ml-4">
                                    <div class="d-flex align-items-center justify-content-between" data-toggle="expand">
                                        <div>
                                            <a href="#" class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2">{{ ($message['user_id'] == $fCode) ? 'Admin' : $subject['display_name'] }}</a>
                                            <span class="label label-success label-dot mr-2"></span>{{ $message['created_at'] }}
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="toggle-off-item">
                                            <span>{{ ($message['user_id'] == $fCode) ? '' : $subject['email'] }}</span>
                                        </div>
                                        <div class="text-muted font-weight-bold toggle-on-item text-truncate" style="max-width: 550px" data-toggle="expand">{!! (strpos($message['content'],'img')) ? 'Attachments file' : strip_tags($message['content']); !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Message Heading-->
                        <div class="card-spacer-x py-3 toggle-off-item">
                            {!! $message['content'] !!}
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--end::Messages-->
                <!--begin::Reply-->
                <div class="card-spacer mb-3" id="kt_inbox_reply">
                    <div class="card card-custom shadow-sm">
                        <div class="card-body p-0">
                            <div class="summernote" id="kt_summernote_1"></div>
                            <!--begin::Footer-->
                            <div class="d-flex align-items-center justify-content-between py-4 pl-5 pr-5 border-top">
                                <div class="invalid-feedback d-block"></div>
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center ml-auto">
                                    @if($user['Id'] == $fCode)
                                    <!--begin::Status-->
                                    <div class="btn-group mr-4">
                                        <button type="button" class="btn btn-outline-secondary status">{{ ($subject['status'] == 0) ? 'Open' : 'Close' }}</button>
                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                            <a class="dropdown-item {{ ($subject['status'] == 0) ? 'disabled' : '' }}" data-status="0">Open</a>
                                            <a class="dropdown-item {{ ($subject['status'] == 1) ? 'disabled' : '' }}" data-status="1">Close</a>
                                        </div>
                                    </div>
                                    <!--end::Status-->
                                    @endif
                                    <!--begin::Send-->
                                    <div class="btn-group">
                                        <span class="btn btn-primary font-weight-bold px-6" id="send-message">Send</span>
                                    </div>
                                    <!--end::Send-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Footer-->
                        </div>
                    </div>
                </div>
                <!--end::Reply-->
            </div>
            <!--end::Body-->
        </div>
    </div>
    <div class="col-lg-4">
        <!--begin::Mixed Widget 14-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
                <!--begin::Title-->
                    <div class="d-flex align-items-center mr-2 py-2">
                        <div class="font-weight-bold font-size-h3 mr-3">Ticket Detail</div>
                    </div>
                    <!--end::Title-->
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-hor"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover py-5">
                                    <li class="navi-item">
                                        <a class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon-delete-1"></i>
                                            </span>
                                            <span class="navi-text delete-ticket">Delete ticket</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                        </div>
                    </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Item-->
                <div class="mb-6">
                    <span class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Ticket ID: </span>
                    <span>{{ $subject['id'] }}</span>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="mb-6">
                    <span class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Created: </span>
                    <span>{{ $subject['created_at'] }}</span>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="mb-6">
                    <span class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Last message: </span>
                    <span>{{ $subject->messages()->latest()->first('created_at')['created_at'] }}</span>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="mb-6">
                    <span class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Status: </span>
                    <span class="label label-{{ ($subject['status'] == 0) ? 'success' : 'danger' }} font-weight-bold label-inline mr-2 status">{{ ($subject['status'] == 0) ? 'Open' : 'Close' }}</span>
                </div>
                <!--end::Item-->
                <div class="mb-6 my-10" style="border-bottom: 1px solid #EBEDF3;"></div>
                <!--begin::Item-->
                <div class="mb-6">
                    <span class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Supporter</span>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="mb-6">
                    <div class="d-flex align-items-center">								
                        <div class="symbol symbol-40 symbol-light-danger flex-shrink-0">									
                            <span class="symbol-label font-size-h4 font-weight-bold">{{ substr('Admin',0,1) }}</span>								
                        </div>								
                        <div class="ml-4">									
                            <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">Admin</div>									
                            {{--  <a class="text-muted font-weight-bold text-hover-primary">{{ $user['email'] }}</a>								  --}}
                        </div>							
                    </div>
                </div>
                <!--end::Item-->
                <div class="mb-6 my-10" style="border-bottom: 1px solid #EBEDF3;"></div>
                <!--begin::Item-->
                <div class="mb-6">
                    <span class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Requester</span>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="mb-6">
                    <div class="d-flex align-items-center">								
                        <div class="symbol symbol-40 symbol-light-success flex-shrink-0">									
                            <span class="symbol-label font-size-h4 font-weight-bold">{{ substr($subject['display_name'],0,1) }}</span>								
                        </div>								
                        <div class="ml-4">									
                            <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">{{ $subject['display_name'] }}</div>									
                            <a class="text-muted font-weight-bold text-hover-primary">{{ $subject['email'] }}</a>								
                        </div>							
                    </div>
                </div>
                <!--end::Item-->
            </div>
        </div>
        <!--end::Mixed Widget 14-->
    </div>
</div>
<!--end::Content-->
@endsection

{{--  Styles Section  --}}
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/editors/summernote.js') }}"></script>
    <script src="{{ asset('js/pages/features/miscellaneous/sweetalert2.js') }}"></script>
    @include('tickets.detailJS')
    
@endsection
