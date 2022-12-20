@if ($paginator->hasPages())
    <div class="pagination">
        <div class="pagination-content">
            @if ($paginator->onFirstPage())
                <a href="javascript:void(0)" class="pagin-items text-muted"><i class=" bi bi-chevron-left"></i></a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="pagin-item"><i class=" bi bi-chevron-left"></i></a>
            @endif
            <h6 class="m-0" id="pagin-title">{!! request()->query('page') ? 'Page ' . e(request()->query('page')) : '<i class="bi bi-activity"></i>' !!}</h6>
            <div class="m-0" id="pagin-loading" title="7" style="display:none;">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                    <rect class="svg-loanjing" x="0" y="10" width="4" height="10" fill="#333" opacity="0.2">
                        <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0s" dur="0.6s" repeatCount="indefinite" />
                        <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0s" dur="0.6s" repeatCount="indefinite" />
                        <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.6s" repeatCount="indefinite" />
                    </rect>
                    <rect class="svg-loanjing" x="8" y="10" width="4" height="10" fill="#333" opacity="0.2">
                        <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                        <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                        <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                    </rect>
                    <rect class="svg-loanjing" x="16" y="10" width="4" height="10" fill="#333" opacity="0.2">
                        <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                        <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                        <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                    </rect>
                </svg>
            </div>
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="pagin-item"><i class=" bi bi-chevron-right"></i></a>
            @else
                <a href="javascript:void(0)" class="pagin-items text-muted"><i class=" bi bi-chevron-right"></i></a>
            @endif
        </div>
    </div>
@endif
