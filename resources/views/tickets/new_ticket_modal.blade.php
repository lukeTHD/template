<!--begin::Compose-->
<div class="modal modal-sticky modal-sticky-lg modal-sticky-bottom-right" id="kt_inbox_compose" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--begin::Form-->
            <form id="kt_inbox_compose_form">
                <!--begin::Header-->
                <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-bottom">
                    <h5 class="font-weight-bold m-0">New Ticket</h5>
                    <div class="d-flex ml-2">
                        {{--  <span class="btn btn-clean btn-sm btn-icon mr-2">
                            <i class="flaticon2-arrow-1 icon-1x"></i>
                        </span>  --}}
                        <span class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
                            <i class="ki ki-close icon-1x"></i>
                        </span>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="d-block">
                    <!--begin::Subject-->
                    <div class="border-bottom">
                        <input class="form-control border-0 px-8 min-h-45px" name="title" placeholder="Subject" required/>
                    </div>
                    <!--end::Subject-->
                    <!--begin::Message-->
                    <div class="summernote" id="kt_summernote_1"></div>
                    <!--end::Message-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="d-flex align-items-center justify-content-between py-4 pl-5 pr-5 border-top">
                    <div class="invalid-feedback d-block"></div>
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center ml-auto">
                        <!--begin::Send-->
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary font-weight-bold px-6">Send</button>
                        </div>
                        <!--end::Send-->
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Compose-->