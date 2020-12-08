{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom card-container" style="padding-left: 30px; padding-right: 30px;">
    <div style=" margin-top:30px;">
        @php
            $session = session()->get('profile');
            $group_id = $session['group_id'];
        @endphp
        @if($group_id && $group_id == 2)
        <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" style=" margin-left:8px;">
            <a href="{{ route('template.create') }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <i class="flaticon2-plus"></i>
                    <!--end::Svg Icon-->
                    <!-- </span>Thêm Template</a> -->
                </span>{{__('label.template.add_template')}}</a>
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif
        <div class="portfolio-content portfolio-1">
            <div id="js-grid-juicy-projects" class="cbp cbp-caption-active cbp-caption-overlayBottomReveal cbp-ready">
                <div class="cbp-wrapper-outer">
                    <div class="cbp-wrapper">
                        @php
                        $count = 0; $i = 0;
                        $session = session()->get('profile');
                        $group_id = $session['group_id'];
                        @endphp
                        @foreach($list_template as $key => $template)
                        <div class="cbp-item">
                            <div class="cbp-item-wrapper">
                                <div class="cbp-caption">
                                    <div class="cbp-caption-defaultWrap">
                                        <img src="{{ asset('upload/avatar/'.$template->avatar)}}" alt="">
                                    </div>
                                    <div class="cbp-caption-activeWrap">
                                        <div class="cbp-l-caption-alignCenter">
                                            <div class="cbp-l-caption-body">
                                                <a href="{{ route('template.detailsTemplate', ['code' => $template['id']] ) }}"
                                                    class="btn btn-danger"
                                                    style=" border-radius: 0; text-transform: uppercase; margin: 4px;"
                                                    rel="nofollow">Sử dụng</a>
                                                <a href="{{ route('template.previewTemplate', ['id' => $template['id']] ) }}"
                                                    class="btn btn-danger"
                                                    style=" border-radius: 0; text-transform: uppercase; margin: 4px;"
                                                    data-title="Dashboard&lt;br&gt;by Paul Flavius Nechita">Xem
                                                    trước</a>
                                                @if($group_id && $group_id == 2)
                                                <a href="{{ route('template.edit', ['id' => $template['id']] ) }}"
                                                    class="btn btn-danger"
                                                    style=" border-radius: 0; text-transform: uppercase; margin: 4px;"
                                                    rel="nofollow">Cập nhật</a>
                                                <a class="btn btn-danger destroy_template"
                                                    style=" border-radius: 0; text-transform: uppercase; margin: 4px;"
                                                    data-id="{{ $template['id'] }}">Xóa</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center">
                                    {{ $template->name }}</div>
                            </div>
                        </div>
                        @endforeach
                        <!-- {{ $list_template->links() }} -->
                        <div style="margin-left:8px">
                            @include('template.pagination.default', ['paginator' => $list_template ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />

<!-- BEGIN PAGE LEVEL PLUGINS ---anh truot len-->
<link href="{{ asset('MetronicAdminTheme4/cubeportfolio.css')}}" rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES-------- mau cua button -->
<!-- <link href="{{ asset('MetronicAdminTheme4/components.min.css')}}" rel="stylesheet" id="style_components"
    type="text/css"> -->
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('MetronicAdminTheme4/portfolio.min.css')}}" rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL STYLES -->
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
                success: function(data) {
                    if (data == 'success') {
                        Swal.fire({
                            title: "Bạn đã xóa thành công !",
                            icon: "success",
                        }).then((OK) => {
                            if (OK) {
                                location.reload();
                            }
                        });
                    } else if (data == 'error') {
                        Swal.fire({
                            title: "Template không thể xóa !",
                            icon: "error",
                        }).then((OK) => {});
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    errorFunction();
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
