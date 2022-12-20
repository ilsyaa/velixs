<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))

        <div class="section-pager-bar-wrap align-center">
            <div class="section-pager-bar">

                <h6 class="text-light mt-4 text-center">Pagination</h6>
                <div class="section-pager-controls">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <div class="slider-control left disabled">
                            <svg class="slider-control-icon icon-small-arrow">
                                <use xlink:href="#svg-small-arrow"></use>
                            </svg>
                        </div>
                    @else
                        <button class="slider-control left btn-pagin" type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev">
                            <svg class="slider-control-icon icon-small-arrow">
                                <use xlink:href="#svg-small-arrow"></use>
                            </svg>
                        </button>
                    @endif
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button class="slider-control right btn-pagin" type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled">
                            <svg class="slider-control-icon icon-small-arrow">
                                <use xlink:href="#svg-small-arrow"></use>
                            </svg>
                        </button>
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
</div>
