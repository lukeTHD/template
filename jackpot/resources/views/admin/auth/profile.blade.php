@extends('admin.layouts.app')
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::Row-->
        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-6">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile"
                     id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
							    <i class="kt-font-brand flaticon2-user-1"></i>
							</span>
                            <h3 class="kt-portlet__head-title">
                                {{ __('label.profile') }}
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <button type="button" onclick="submit('form')" class="btn btn-brand">
                                <i class="la la-check"></i>
                                <span class="kt-hidden-mobile">{{ __('label.save') }}</span>
                            </button>
                        </div>
                    </div>

                @include('admin.partials.error',['class' =>  'rounded-0 d-block mb-0'])
                @include('admin.partials.alert')
                <!--begin::Form-->
                    <form class="kt-form kt-form--label-left" action="{{ route('admin.auth.update_profile') }}"
                          id="form"
                          method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-2 col-form-label">{{ __('label.name') }}</label>
                                <div class="col-10">
                                    <input class="form-control" name="name" value="{{ user()->name }}" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-2 col-form-label">{{ __('label.email') }}</label>
                                <div class="col-10">
                                    <input class="form-control" name="email" value="{{ user()->email }}" type="text">
                                </div>
                            </div>
                            <button type="button" class="kt-font-bold btn btn-secondary text-center toggle"
                                    data-toggle="password">{{ __('label.change_password') }}</button>
                            <div id="password" class="mt-3" style="display: none;">
                                <div class="form-group row">
                                    <label for="example-text-input"
                                           class="col-2 col-form-label">{{ __('label.current_password') }}</label>
                                    <div class="col-10">
                                        <input class="form-control" name="current_password" value="" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                           class="col-2 col-form-label">{{ __('label.password') }}</label>
                                    <div class="col-10">
                                        <input class="form-control" name="password" value="" type="text">
                                    </div>
                                </div>
                                <div class="form-group form-group-last row">
                                    <label for="example-text-input"
                                           class="col-2 col-form-label">{{ __('label.password_confirmation') }}</label>
                                    <div class="col-10">
                                        <input class="form-control" name="password_confirmation" value="" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-xl-3"></div>
        </div>
        <!--End::Row-->

    </div>
@endsection
@section('scripts')
@endsection
