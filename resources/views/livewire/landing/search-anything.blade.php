<div>
    <div class="modal-content modal-dark">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control form-search" wire:model="search" placeholder="Search Anything..." autocomplete="off">
        </div>
        <div class="modal-body p-0" style="max-height: 400px">
            {!! $results !!}
        </div>
        <div class="modal-footer footer-search">
            <div class="me-auto">
                <span class="text-muted" style="margin-right: 5px;"><i class="bi bi-arrow-down-up"></i> navigate</span>
                <span class="text-muted" style="margin-right: 5px;"><i class="bi bi-arrow-return-left"></i> enter</span>
                <span class="text-muted" style="margin-right: 5px;"><span class="fw-bold">esc</span> exit</span>
            </div>
            <div wire:loading class="spinner-grow" style="height: 10px; width: 10px" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        var buttonSearch = document.getElementById('button-search');
        buttonSearch.addEventListener('click', function() {
            @this.clear()
            setTimeout(function() {
                document.querySelector('.form-search').focus()
            }, 500)
        });
    </script>
@endpush
