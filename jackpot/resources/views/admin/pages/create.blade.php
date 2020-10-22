@extends('admin.layouts.app')
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-plus"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">{{ __('label.page.add') }} </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <button type="button" onclick="submit('kt_form')" class="btn btn-brand">
                        <i class="la la-check"></i>
                        <span class="kt-hidden-mobile">{{ __('label.save') }}</span>
                    </button>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form class="kt-form" action="{{ route('admin.pages.store') }}" method="POST" id="kt_form">
                    @include('admin.partials.error',['class' =>  'rounded-0 d-block'])
                    @include('admin.partials.alert')
                    @csrf
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="kt-section kt-section--last">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">{{ __('label.page.info') }}
                                        :</h3>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.name') }}</label>
                                        <div class="col-9">
                                            <input class="form-control" name="name" type="text"
                                                   value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.description') }}</label>
                                        <div class="col-9">
                                            <textarea class="form-control" rows="4"
                                                      name="description">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
                                        <label class="col-3 col-form-label">{{ __('label.content') }}</label>
                                        <div class="col-9">
                                            <textarea name="kt-ckeditor-4" id="kt-ckeditor-3">
                    <h1>Quick and simple CKEditor 5 Integration</h1>
                    <figure class="image"><img src="{{ asset('assets/media/blog/blog3.jpg') }}" alt="Metronic CKEditor Demo"/></figure>
                    Here goes the <a href="#">Minitial content of the editor</a>. Lorem Ipsum is simply dummy text of the <em>printing and typesetting</em> industry.
				</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}" type="text/javascript"></script>

    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/js/pages/crud/forms/editors/ckeditor-classic.js') }}" type="text/javascript"></script>

    <!--end::Page Scripts -->

@endsection
