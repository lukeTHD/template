@extends('admin.layouts.app')
@section('content')
    <?php
    $id = param('contact');
    $contact = api(['api.contacts.show', ['id' => $id]]);
    ?>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-search"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">{{ __('label.contact.detail') }} </h3>
                </div>
            </div>
            <div class="kt-portlet__body" id="app">
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="kt-section kt-section--last">
                            <div class="kt-section__body">
                                <h3 class="kt-section__title kt-section__title-lg">{{ __('label.contact.detail') }}:</h3>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.name') }}</label>
                                    <div class="col-9">
                                        <label class="col-form-label kt-font-bolder">{{ $contact['name'] }}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.email') }}</label>
                                    <div class="col-9">
                                        <label class="col-form-label kt-font-bolder">{{ $contact['email'] }}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.title') }}</label>
                                    <div class="col-9">
                                        <label class="col-form-label kt-font-bolder">{{ $contact['title'] }}</label>
                                    </div>
                                </div>
                                <div class="form-group form-group-last row">
                                    <label class="col-3 col-form-label">{{ __('label.content') }}</label>
                                    <div class="col-9">
                                        <label class="col-form-label kt-font-bolder">{!! nl2br($contact['content']) !!}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/pages/custom/user/profile.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    @include('admin.partials.scripts.game')
@endsection
