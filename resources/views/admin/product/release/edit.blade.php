<form action="{{ route('release.update', $release->id) }}" method="post">
    @method('PUT')
    @csrf
    <div class="modal-body">
        <div class="mb-1">
            <label class="form-label" for="basicInput">Name</label>
            <input type="text" class="form-control title-input" name="name" value="{{ $release->name }}" />
        </div>
        <div class="mb-1">
            <label class="form-label" for="basicInput">Version</label>
            <input type="text" class="form-control slug-input" name="version" value="{{ $release->version }}" />
        </div>
        <div class="mb-1">
            <label class="form-label" for="basicInput">File Url</label>
            <input type="text" class="form-control slug-input" name="file_url" value="{{ $release->file_url }}" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>
