{{-- Subheader V1 --}}

<div class="subheader py-2 {{ Metronic::printClasses('subheader', false) }}" id="kt_subheader">
    <div
        class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

        {{-- Info --}}
        <div class="d-flex align-items-center flex-wrap mr-1">

            {{-- Page Title --}}
            <h5 class="text-dark font-weight-bold my-2 mr-5">
                {{ @$page_title }} <br>

                @if (isset($page_description) && config('layout.subheader.displayDesc'))
                <small style="color: #B5B5C3;">{{ @$page_description }}</small>
                @endif
            </h5>

            @if (!empty($page_breadcrumbs))
            {{-- Separator --}}
            <div class="subheader-separator subheader-separator-ver my-2 mr-4 d-none"></div>

            {{-- Breadcrumb --}}
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
                <li class="breadcrumb-item"><a href="#"><i class="flaticon2-shelter text-muted icon-1x"></i></a></li>
                @foreach ($page_breadcrumbs as $k => $item)
                <li class="breadcrumb-item">
                    <a href="{{ url($item['page']) }}" class="text-muted">
                        {{ $item['title'] }}
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        {{-- Toolbar --}}
        <div class="d-flex align-items-center">

            @hasSection('page_toolbar')
            @section('page_toolbar')
            @endif

            <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left">
                <a href="{{ route('template.create') }}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <i class="flaticon2-plus"></i>
                        <!--end::Svg Icon-->
                    </span>Thêm Template</a>
            </div>
        </div>

    </div>
</div>
