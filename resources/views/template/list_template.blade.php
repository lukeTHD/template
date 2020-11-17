{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom card-container"
    style="padding-left: 30px; padding-right: 30px;">
    <div style=" margin-top:30px;">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif
        <div>
            <div class="row">
                @foreach($list_template as $key => $template)
                <div class="col-md-4 temp">
                    <div class="card mb-8 box-shadow">
                        <img class="card-img-top" style="height: 225px; width: 100%; display: block;"
                            src="{{ asset('upload/avatar/'.$template->avatar)}}" data-holder-rendered="true">
                        <div class="theme-actions">
                            <button type="button">
                                <a href="{{ route('template.detailsTemplate', ['code' => $template['id']] ) }}">Sử dụng
                            </button>
                            <button type="button">
                                <a href="{{ route('template.previewTemplate', ['id' => $template['id']] ) }}">Xem
                                    trước</a>
                            </button><br>
                            <button type="button" class="destroy_template" data-id="{{ $template['id'] }}">Xóa</button>
                            <button type="button">
                                <a href="{{ route('template.edit', ['id' => $template['id']] ) }}">Cập nhật</a>
                            </button>
                        </div>
                        <div class="card-body" style="padding: 14px;">
                            <p class="card-text" style="font-size: 14px;">{{ $template->name }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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
    $('.destroy_template').on('click', function(e) {
        let id = $(this).data('id');
        swal.fire({
            title: ' Bạn có chắc ? ',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: ' OK ',
            cancelButtonText: ' Hủy ',
        }).then(async function(result) {
            if (result.value) {
                $.ajax({
                    url: "{{ route('template.destroy') }}/" + id,
                    method: "GET",
                    success: function() {
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
