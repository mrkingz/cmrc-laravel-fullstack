@if ($paginator->hasPages()  && $paginator->currentPage() <= $paginator->lastPage())
    <ul class="pagination pagination-sm" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">@lang('pagination.previous')</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ PaginateRoute::previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
            </li>
        @endif
            <li class="page-item">
                <span class="page-link disabled px-3 bg-light bold" style="color: rgba(1,1,1,.7)"> {{ $paginator->currentPage() . ' of '. $paginator->lastPage() }}</span>
            </li>
        {{-- Next Page Link --}}
        @if (PaginateRoute::hasNextPage($paginator))
            <li class="page-item">
                <a class="page-link" href="{{ PaginateRoute::nextPageUrl($paginator) }}" rel="next">@lang('pagination.next')</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">@lang('pagination.next')</span>
            </li>
        @endif
    </ul>
@endif
