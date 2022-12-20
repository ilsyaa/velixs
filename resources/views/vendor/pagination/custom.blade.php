@if ($paginator->hasPages())
    <div class="section-pager-bar-wrap align-center">
        <div class="section-pager-bar">

            <h6 class="text-light mt-4 text-center">{{ request()->query('page') ? 'Page ' . request()->query('page') : 'Pagination' }}</h6>
            <div class="section-pager-controls">
                @if ($paginator->onFirstPage())
                    <div class="slider-control left disabled">
                        <svg class="slider-control-icon icon-small-arrow">
                            <use xlink:href="#svg-small-arrow"></use>
                        </svg>
                    </div>
                @else
                    <a class="slider-control left btn-pagin" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <svg class="slider-control-icon icon-small-arrow">
                            <use xlink:href="#svg-small-arrow"></use>
                        </svg>
                    </a>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a class="slider-control right btn-pagin" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <svg class="slider-control-icon icon-small-arrow">
                            <use xlink:href="#svg-small-arrow"></use>
                        </svg>
                    </a>
                @else
                    <div class="slider-control right disabled">
                        <svg class="slider-control-icon icon-small-arrow">
                            <use xlink:href="#svg-small-arrow"></use>
                        </svg>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
