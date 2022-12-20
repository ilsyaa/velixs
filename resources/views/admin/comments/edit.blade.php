<div class="modal-body">
    <div class="mb-1">
        <label class="form-label" for="basicInput">User</label>
        <input type="text" class="form-control" value="{{ $item->user->name }}" disabled>
    </div>
    <div class="mb-1">
        <label class="form-label" for="basicInput">Comments</label>
        <textarea class="form-control" rows="5" disabled>{{ $item->comment }}</textarea>
    </div>
</div>
@if ($item->status == 'pending')
    <div class="modal-footer p-0">
        <a href="javascript:void(0)" onclick="acc('{{ $item->id }}')" class="btn btn-primary">Accept</a>
    </div>
@endif
