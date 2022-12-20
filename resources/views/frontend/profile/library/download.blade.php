<div class="modal-header">
    <small class="text-muted" style="font-size: 12px">{{ $row->product->name }}</small>
</div>
<div class="modal-body border-0" style="max-height: 400px">
    @foreach ($row->release()->get() as $item)
        <a href="{!! $item->file_url !!}" target="_blank" class="btn btn-primary w-100 mb-2 shadow">{!! $item->name !!}</a>
    @endforeach
</div>
<div class="modal-footer footer-search">
    <div class="me-auto"><span class="text-muted" style="margin-right: 5px;"><i class="bi bi-check2-all"></i> Done</span></div>
    <small class="text-muted">Latest</small>
</div>
