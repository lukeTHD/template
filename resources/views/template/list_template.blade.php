{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <!-- <h3 class="card-label">HTML Table
                <div class="text-muted pt-2 font-size-sm">Datatable initialized from HTML table</div>
            </h3> -->
        </div>
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="{{ route('template.create') }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <i class="flaticon2-plus"></i>
                    <!--end::Svg Icon-->
                </span>Thêm Template</a>
            <!--end::Button-->
        </div>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            @foreach($list_template as $key => $template)
            <div class="col-4" id="template">
                <div class="template">
                    <img src="{{ asset('upload/avatar/'.$template->avatar)}}">
                    <div class="theme-actions">
                        <button type="button"><a href="{{ route('template.details', ['id' => $template['id']] ) }}" >Sử dụng</button>
                        <button type="button"><a href="{{ route('template.details', ['id' => $template['id']] ) }}" >Xem trước</a></button> <br>
                        <button type="button" class="destroy_template" data-id="{{ $template['id'] }}">Xóa</button>
                        <button type="button"><a href="{{ route('template.edit', ['id' => $template['id']] ) }}" >Cập nhật</a></button>
                    </div>

                </div>
                <div>
                    <h3 class="name-template">{{ $template->name }}</h3>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
@endsection


{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

{{-- page scripts --}}
<script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script>

    $('.destroy_template').on('click', function(e){
        let id = $(this).data('id');
        swal.fire({
            title: ' Bạn có chắc ? ',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: ' OK ',
            cancelButtonText: ' Hủy ',
        }).then(async function (result) {
            if (result.value) {
                $.ajax({
                    url: "{{ route('template.destroy') }}/" + id,
                    method: "GET",
                    success: function(){
                        Swal.fire({
                            title: "Bạn đã xóa thành công !",
                            icon: "success",
                        }).then((OK) => {
                            if (OK) {
                                location.reload();
                            }
                        });
                    }
                })
            }
        });
    })


</script>


@endsection
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.js') }}"></script> -->


