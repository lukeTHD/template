<div class="kt-pagination  kt-pagination--brand">
    <ul class="kt-pagination__links">
        <li class="kt-pagination__link--first">
            <a href="{{ $first_page_url }}"><i class="fa fa-angle-double-left kt-font-brand"></i></a>
        </li>
        <li class="kt-pagination__link--next">
            <a href="{{ $prev_page_url }}"><i class="fa fa-angle-left kt-font-brand"></i></a>
        </li>
        @for($i = 1; $i <= $last_page; $i++)
        <li class="@if($current_page === $i) kt-pagination__link--active @endif">
            <a href="{{ add_query_to_url(['page' => $i]) }}">{{ $i }}</a>
        </li>
        @endfor
        <li class="kt-pagination__link--prev">
            <a href="{{ $next_page_url }}"><i class="fa fa-angle-right kt-font-brand"></i></a>
        </li>
        <li class="kt-pagination__link--last">
            <a href="{{ $last_page_url }}"><i class="fa fa-angle-double-right kt-font-brand"></i></a>
        </li>
    </ul>
    <div class="kt-pagination__toolbar">
        <select class="form-control kt-font-brand" style="width: 60px;">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span class="pagination__desc">
		Displaying {{ $per_page }} of {{ $total }} records
		</span>
    </div>
</div>
