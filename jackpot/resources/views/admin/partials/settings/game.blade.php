<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-settings-1"></i>
                    </span>
                <h3 class="kt-portlet__head-title">{{ __('label.gaming_setting') }}</h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="btn-group">
                    <button type="button" onclick="submit('kt_form')" class="btn btn-brand">
                        <i class="la la-check"></i>
                        <span class="kt-hidden-mobile">{{__('label.save') }}</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form class="kt-form" action="{{ route('admin.settings.update') }}" id="kt_form" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="kt-section kt-section--last">
                            <div class="kt-section__body">
                                <h3 class="kt-section__title kt-section__title-lg">{{ __('label.gaming_setting') }}
                                    :</h3>
                                <div class="form-group form-group-last row">
                                    <label class="col-3 col-form-label">{{ __('label.gaming_type') }}</label>
                                    <div class="col-9">
                                        <div class="kt-radio-inline">
                                            <label class="kt-radio">
                                                <input type="radio" @if($settings['jackpot_type'] === 'auto') checked @endif name="jackpot_type" value="auto">
                                                Auto
                                                <span></span>
                                            </label>
                                            <label class="kt-radio">
                                                <input type="radio" @if($settings['jackpot_type'] === 'manually') checked @endif name="jackpot_type" value="manually"> Manually <small class="text-muted">(01,02,03,04,05,...)</small>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                               {{-- <div class="form-group form-group-last row">
                                    <label class="col-3 col-form-label">{{ __('label.gaming_start_time') }}</label>
                                    <div class="col-9">
                                        <div class="input-group timepicker">
                                            <input class="form-control" name="start_time" id="kt_timepicker_2" readonly
                                                   placeholder="Chọn thời gian" value="{{ $settings['start_time'] }}"
                                                   type="text"/>
                                        </div>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2"></div>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js') }}"></script>
@endsection
