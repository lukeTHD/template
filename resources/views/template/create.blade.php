{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<!--begin::Card-->
<div class="card card-custom card-transparent">
    <div class="card-body p-0">
        <!--begin::Wizard-->
        <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
            <!--begin::Card-->
            <div class="card card-custom card-shadowless rounded-top-0">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                        <div class="col-xl-12 col-xxl-10">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            <!--begin::Wizard Form-->
                            <form class="form" id="kt_form" action="{{ route('template.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-xl-9">
                                        <!--begin::Wizard Step 1-->
                                        <div class="my-5 step" data-wizard-type="step-content"
                                            data-wizard-state="current">
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-left">Avatar
                                                    Template</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="image-input image-input-outline"
                                                        id="kt_user_add_avatar">
                                                        <div class="image-input-wrapper"
                                                            style="background-image: url(template/public/media/users/100_6.jpg)">
                                                        </div>
                                                        <label
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="change" data-toggle="tooltip" title=""
                                                            data-original-title="Change avatar">
                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                            <input type="file" name="avatar"
                                                                accept=".png, .jpg, .jpeg" />
                                                            <input type="hidden" name="avatar_remove" />
                                                        </label>
                                                        <span
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="cancel" data-toggle="tooltip"
                                                            title="Cancel avatar">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Tên Template</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        name="name" value="{{ old('name') }}" type="text" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Giá Template</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        type="number" name="price" min="0" value="{{ old('price') }}" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Page</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        type="text" name="code" min="0" value="{{ old('code') }}" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Section</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="form-group">
                                                        <div class="checkbox-inline">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                        </div>
                                        <!--end::Wizard Step 1-->
                                        <!--begin::Wizard Actions-->
                                        <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                            <div class="mr-2">
                                            </div>
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-primary font-weight-bolder px-9 py-4">Lưu</button>
                                            </div>
                                        </div>
                                        <!--end::Wizard Actions-->
                                    </div>
                                </div>
                            </form>
                            <!--end::Wizard Form-->
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Wizard-->
    </div>
</div>
<!--end::Card-->

@endsection

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/pages/wizard/wizard-4.css ')}}" rel="stylesheet" type="text/css" />
@endsection


{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

{{-- page scripts --}}
<script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/profile.js') }}" type="text/javascript"></script>
<script>
    $( document ).ready(function () {
        getSection();
        $('input[name=code]').keyup(function() { 
            $( ".checkbox-inline" ).empty();
            getSection();
        }); 
    });
    function getSection(){
        let code = $( "input[name='code']" ).val();
        if(code!='') {
            $.ajax({
                url: "{{ route('template.getSection') }}/" + code,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                method: "GET",
                contentType: false,
                processData: false,
                success: function(data) {
                    for (let index = 1; index <= data; index++) {
                        if(index != 14 && index != 16) {
                            $( ".checkbox-inline" ).append(`<label class="checkbox checkbox-primary" style="width: 130px;">
                                                        <input type="checkbox" name="section[]" value="`+index+`">
                                                        <span></span>Section `+index+`</label>`);
                        }
                    }
                    $( ".checkbox-inline" ).append(`<label class="checkbox checkbox-primary" style="width: 130px;">
                                                        <input type="checkbox" name="section[]" value="14" checked="checked" disabled="disabled">
                                                        <span></span>Section 14</label>`);
                    $( ".checkbox-inline" ).append(`<label class="checkbox checkbox-primary" style="width: 130px;">
                                                    <input type="checkbox" name="section[]" value="16" checked="checked" disabled="disabled">
                                                    <span></span>Section 16</label>`);
                }
            })
        }
    }
</script>
@endsection
<!--  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/pages/custom/user/add-user.js')}}"></script>


