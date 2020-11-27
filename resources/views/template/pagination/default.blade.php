@if ($paginator->lastPage() > 1)
<div class="d-flex justify-content-between align-items-center flex-wrap">
    <div class="d-flex flex-wrap py-2 mr-3">
        <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled" disabled><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
        <a href="{{ $paginator->url($paginator->currentPage()-1) }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <i class="ki ki-bold-arrow-back icon-xs"></i>
        </a>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <a href="{{ $paginator->url($i) }}" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1 {{ ($paginator->currentPage() == $i) ? ' active' : '' }}" >{{ $i }}</a>
        @endfor
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <i class="ki ki-bold-arrow-next icon-xs"></i>
        </a>
        <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled" disabled><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
    </div>
</div>
@endif
