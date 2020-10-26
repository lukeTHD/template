{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Mobile Toggle-->
                <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Mobile Toggle-->
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Inbox</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Apps</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Inbox</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm">Actions</a>
                <!--end::Actions-->
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-success svg-icon-2x">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
                        <!--begin::Navigation-->
                        <ul class="navi navi-hover">
                            <li class="navi-header font-weight-bold py-4">
                                <span class="font-size-lg">Choose Label:</span>
                                <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                            </li>
                            <li class="navi-separator mb-3 opacity-70"></li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-success">Customer</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-danger">Partner</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-primary">Member</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-dark">Staff</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-separator mt-3 opacity-70"></li>
                            <li class="navi-footer py-4">
                                <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                <i class="ki ki-plus icon-sm"></i>Add new</a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Inbox-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_inbox_aside">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body px-5">
                            <!--begin::Compose-->
                            <div class="px-4 mt-4 mb-10">
                               
                            </div>
                            <!--end::Compose-->
                            <!--begin::Navigations-->
                            <div class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
                                <!--begin::Item-->
                                <div class="navi-item my-2">
                                    <a href="#" class="navi-link active">
                                        <span class="navi-icon mr-4">
                                            <span class="svg-icon svg-icon-lg">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-heart.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M13.8,4 C13.1562,4 12.4033,4.72985286 12,5.2 C11.5967,4.72985286 10.8438,4 10.2,4 C9.0604,4 8.4,4.88887193 8.4,6.02016349 C8.4,7.27338783 9.6,8.6 12,10 C14.4,8.6 15.6,7.3 15.6,6.1 C15.6,4.96870845 14.9396,4 13.8,4 Z" fill="#000000" opacity="0.3" />
                                                        <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="navi-text font-weight-bolder font-size-lg">Inbox</span>
                                        <span class="navi-label">
                                            <span class="label label-rounded label-light-success font-weight-bolder">3</span>
                                        </span>
                                    </a>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="navi-item my-2">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon mr-4">
                                            <span class="svg-icon svg-icon-lg">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="navi-text font-weight-bolder font-size-lg">Trash</span>
                                    </a>
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Navigations-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Aside-->
                <!--begin::List-->
                <div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
                            <!--begin::Toolbar-->
                            <div class="col-12 col-sm-6 col-xxl-4 order-2 order-xxl-1 d-flex flex-wrap align-items-center">
                                <div class="d-flex align-items-center mr-1 my-2">
                                    <label data-inbox="group-select" class="checkbox checkbox-inline checkbox-primary mr-3">
                                        <input type="checkbox" />
                                        <span class="symbol-label"></span>
                                    </label>
                                    <span class="btn btn-clean btn-icon btn-sm mr-2" data-toggle="tooltip" title="Remove">
                                        <span style="cursor: pointer" class="svg-icon svg-icon-md" title="Remove">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
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
                                    <span class="btn btn-clean btn-icon btn-sm mr-2" data-toggle="tooltip" title="Reload list">
                                        <i class="ki ki-refresh icon-1x"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Search-->
                            <div class="col-xxl-3 d-flex order-1 order-xxl-2 align-items-center justify-content-center">
                                <div class="input-group input-group-lg input-group-solid my-2">
                                    <input type="text" class="form-control pl-4" placeholder="Search..." />
                                    <div class="input-group-append">
                                        <span class="input-group-text pr-3">
                                            <span class="svg-icon svg-icon-lg">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
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
                                <div class="d-flex align-items-center mr-2" data-toggle="tooltip" title="Records per page">
                                    <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                                        <ul class="navi py-3">
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-text">20 per page</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link active">
                                                    <span class="navi-text">50 par page</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-text">100 per page</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Per Page Dropdown-->
                                <!--begin::Arrow Buttons-->
                                <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Previose page">
                                    <i class="ki ki-bold-arrow-back icon-sm"></i>
                                </span>
                                <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Next page">
                                    <i class="ki ki-bold-arrow-next icon-sm"></i>
                                </span>
                                <!--end::Arrow Buttons-->
                                <!--begin::Sort Dropdown-->
                                <div class="dropdown mr-2" data-toggle="tooltip" title="Sort">
                                    <span class="btn btn-default btn-icon btn-sm" data-toggle="dropdown">
                                        <i class="flaticon2-console icon-1x"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                                        <ul class="navi py-3">
                                            <li class="navi-item">
                                                <a href="#" class="navi-link active">
                                                    <span class="navi-text">Newest</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-text">Olders</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-text">Unread</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Sort Dropdown-->
                            </div>
                            <!--end::Pagination-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body table-responsive px-0">
                            <!--begin::Items-->
                            <div class="list list-hover min-w-500px" data-inbox="list">
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <span class="symbol symbol-35 mr-3">
                                                <span class="symbol-label" style="background-image: url('assets/media/users/100_13.jpg')"></span>
                                            </span>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Sean Paul</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Digital PPV Customer Confirmation -</span>
                                            <span class="text-muted">Thank you for ordering UFC 240 Holloway vs Edgar Alternate camera angles...</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-bolder w-50px text-right" data-toggle="view">8:30 PM</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <div class="symbol symbol-light-danger symbol-35 mr-3">
                                                <span class="symbol-label font-weight-bolder">OJ</span>
                                            </div>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Oliver Jake</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Your iBuy.com grocery shopping confirmation -</span>
                                            <span class="text-muted">Please make sure that you have one of the following cards with you when we deliver your order...</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-bolder w-100px text-right" data-toggle="view">day ago</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <div class="symbol symbol-light-primary symbol-35 mr-3">
                                                <span class="symbol-label font-weight-bolder">EF</span>
                                            </div>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Enrico Fermi</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Your Order #224820998666029 has been Confirmed -</span>
                                            <span class="text-muted">Your Order #224820998666029 has been placed on Saturday, 29 June</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">11:20PM</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <span class="symbol symbol-35 mr-3">
                                                <span class="symbol-label" style="background-image: url('assets/media/users/100_2.jpg')"></span>
                                            </span>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Jane Goodall</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Payment Notification DLOP2329KD -</span>
                                            <span class="text-muted">Your payment of 4500USD to AirCar has been authorized and confirmed, thank you your account. This...</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">2 days ago</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <div class="symbol symbol-light-success symbol-35 mr-3">
                                                <span class="symbol-label font-weight-bolder">MP</span>
                                            </div>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Max O'Brien Planck</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Congratulations on your iRun Coach subscription -</span>
                                            <span class="text-muted">Congratulations on your iRun Coach subscription. You made no space for excuses and you</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">July 25</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <span class="symbol symbol-35 mr-3">
                                                <span class="symbol-label" style="background-image: url('assets/media/users/100_4.jpg')"></span>
                                            </span>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Rita Levi-Montalcini</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Pay bills &amp; win up to 600$ Cashback! -</span>
                                            <span class="text-muted">Congratulations on your iRun Coach subscription. You made no space for excuses and you decided on a healthier and happier life...</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">July 24</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <span class="symbol symbol-35 mr-3">
                                                <span class="symbol-label" style="background-image: url('assets/media/users/100_5.jpg')"></span>
                                            </span>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Stephen Hawking</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Activate your LIPO Account today -</span>
                                            <span class="text-muted">Thank you for creating a LIPO Account. Please click the link below to activate your account.</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">July 13</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <div class="symbol symbol-light symbol-35 mr-3">
                                                <span class="symbol-label text-dark-75 font-weight-bolder">WE</span>
                                            </div>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Wolfgang Ernst Pauli</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">About your request for PalmLake -</span>
                                            <span class="text-muted">What you requested can't be arranged ahead of time but PalmLake said they'll do their best to accommodate you upon arrival....</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-bold text-muted w-100px text-right" data-toggle="view">25 May</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <span class="symbol symbol-35 mr-3">
                                                <span class="symbol-label" style="background-image: url('assets/media/users/100_6.jpg')"></span>
                                            </span>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Patty Jo Watson</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Welcome, Patty -</span>
                                            <span class="text-muted">Discover interesting ideas and unique perspectives. Read, explore and follow your interests. Get personalized recommendations delivered to you....</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">July 24</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <span class="symbol symbol-35 mr-3">
                                                <span class="symbol-label" style="background-image: url('assets/media/users/100_8.jpg')"></span>
                                            </span>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Blaise Pascal</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Free Video Marketing Guide -</span>
                                            <span class="text-muted">Video has rolled into every marketing platform or channel, leaving...</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">July 13</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <div class="symbol symbol-light-warning symbol-35 mr-3">
                                                <span class="symbol-label font-weight-bolder">RO</span>
                                            </div>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Roberts O'Neill Wilson</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Your iBuy.com grocery shopping confirmation -</span>
                                            <span class="text-muted">Please make sure that you have one of the following cards with you when we deliver your order...</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-bolder w-100px text-right" data-toggle="view">day ago</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <div class="symbol symbol-light-primary symbol-35 mr-3">
                                                <span class="symbol-label font-weight-bolder">EF</span>
                                            </div>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Enrico Fermi</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Your Order #224820998666029 has been Confirmed -</span>
                                            <span class="text-muted">Your Order #224820998666029 has been placed on Saturday, 29 June</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">11:20PM</div>
                                    <!--end::Datetime-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" >
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                            <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                                <input type="checkbox" />
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                            <span class="symbol symbol-35 mr-3">
                                                <span class="symbol-label" style="background-image: url('assets/media/users/100_10.jpg')"></span>
                                            </span>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Jane Goodall</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            <span class="font-weight-bolder font-size-lg mr-2">Payment Notification DLOP2329KD -</span>
                                            <span class="text-muted">Your payment of 4500USD to AirCar has been authorized and confirmed, thank you your account. This...</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">2 days ago</div>
                                    <!--end::Datetime-->
                                </div>
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::List-->
            </div>
            <!--end::Inbox-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection

{{-- Styles Section --}}
@section('styles')
  <link rel="stylesheet" href="{{ asset('css/client/client.css') }}">
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/custom/inbox/inbox.js') }}" type="text/javascript"></script>
   
@endsection
