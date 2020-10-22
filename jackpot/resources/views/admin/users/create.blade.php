@extends('admin.layouts.app')
@section('content')
    <?php
    $groups = api('api.groups.index');
    $groups = collect($groups)->filter(function ($value) {
        return $value['type'] !== 'user' && $value['type'] !== 'super_admin';
    })->reverse(); 
    ?>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::Row-->
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile"
                     id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
							    <i class="kt-font-brand flaticon2-add-1"></i>
							</span>
                            <h3 class="kt-portlet__head-title">
                                {{ __('label.user.add') }}
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

                <!--begin::Form-->
                    <form class="kt-form kt-form--label-left" action="{{ route('admin.users.store') }}" id="form"
                          method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-2 col-form-label">{{ __('label.name') }}</label>
                                <div class="col-10">
                                    <input class="form-control" name="name" value="{{ old('name') }}" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-2 col-form-label">{{ __('label.email') }}</label>
                                <div class="col-10">
                                    <input class="form-control" name="email" value="{{ old('email') }}" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-2 col-form-label">{{ __('label.password') }}</label>
                                <div class="col-10">
                                    <input class="form-control" name="password" type="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-2 col-form-label">{{ __('label.password_confirmation') }}</label>
                                <div class="col-10">
                                    <input class="form-control" name="password_confirmation" type="password">
                                </div>
                            </div>
                            <div class="form-group form-group-last row">
                                <label for="example-text-input"
                                       class="col-2 col-form-label">{{ __('label.group._text') }}</label>
                                <div class="col-10">
                                    <select name="group_id" data-live-search="true" class="form-control selectpicker">
                                        @foreach($groups as $group)
                                            <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-xl-2"></div>
        </div>
        <!--End::Row-->

    </div>
@endsection
@section('scripts')
@endsection
