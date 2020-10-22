<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-settings-1"></i>
                    </span>
                <h3 class="kt-portlet__head-title">{{ __('label.general_setting') }} </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <button type="button" onclick="submit('kt_form')" class="btn btn-brand">
                    <i class="la la-check"></i>
                    <span class="kt-hidden-mobile">{{ __('label.save') }}</span>
                </button>
            </div>
        </div>
        <div class="kt-portlet__body">
            @include('admin.partials.error',['class' =>  'rounded-0 d-block'])
            @include('admin.partials.alert')
            <form class="kt-form" action="{{ route('admin.settings.update') }}" id="kt_form" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="kt-section kt-section--last">
                            <div class="kt-section__body">
                                <h3 class="kt-section__title kt-section__title-lg">{{ __('label.general_setting') }}
                                    :</h3>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.site_title') }}</label>
                                    <div class="col-9">
                                        <input class="form-control" type="text" name="site_title" value="{{ $settings['site_title'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.tagline') }}</label>
                                    <div class="col-9">
                                        <input class="form-control" type="text" name="tagline" value="{{ $settings['tagline'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.administration_email') }}</label>
                                    <div class="col-9">
                                        <input class="form-control" name="administration_email" type="text"
                                               value="{{ $settings['administration_email'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.administration_phone') }}</label>
                                    <div class="col-9">
                                        <input class="form-control" name="administration_phone" type="text"
                                               value="{{ $settings['administration_phone'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{ __('label.timezone') }}</label>
                                    <div class="col-9">
                                        <?php echo timezone($settings['timezone']); ?>
                                    </div>
                                </div>
                                <div class="form-group form-group-last row">
                                    <label class="col-3 col-form-label">{{ __('label.site_language') }}</label>
                                    <div class="col-9">
                                        <select class="form-control selectpicker" name="site_language">
                                            <option @if($settings['site_language'] === 'vi') selected="selected" @endif value="vi">Việt Nam</option>
                                            <option @if($settings['site_language'] === 'en') selected="selected" @endif value="en">English</option>
                                        </select>
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
