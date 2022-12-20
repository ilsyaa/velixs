<form action="{{ route('tags.update', $tag->id) }}" method="post">
    <input type="hidden" name="type" value="{{ $tag->type }}">
    @method('PUT')
    @csrf
    <div class="modal-body">
        <div class="mb-1">
            <label class="form-label" for="basicInput">Name</label>
            <input type="text" class="form-control title-input" id="title" name="name" value="{{ $tag->name }}" />
        </div>
        <div class="mb-1">
            <label class="form-label" for="basicInput">Slug</label>
            <input type="text" class="form-control slug-input" name="slug" id="slug" value="{{ $tag->slug }}" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>
