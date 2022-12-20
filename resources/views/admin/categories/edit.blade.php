<form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="type" value="{{ $category->type }}">
    @method('PUT')
    @csrf
    <div class="modal-body">
        <div class="mb-1">
            <label class="form-label" for="basicInput">Name</label>
            <input type="text" class="form-control title-input" id="title" name="title" value="{{ $category->title }}" placeholder="Name Category" />
        </div>
        <div class="mb-1">
            <label class="form-label" for="basicInput">Slug</label>
            <input type="text" class="form-control slug-input" name="slug" id="slug" value="{{ $category->slug }}" />
        </div>
        <div class="form-check form-check-inline mb-1">
            <input class="form-check-input" type="checkbox" id="default_image" name="default_image" />
            <label class="form-check-label" for="inlineRadio1">Default Image</label>
        </div>
        <div class="mb-1" id="immg">
            <label class="form-label" for="basicInput">Image <small>size 284x142</small></label>
            <input type="file" name="image" class="form-control" id="image" name="image" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>
<script>
    var default_image = document.getElementById('default_image');
    var image = document.getElementById('immg');
    if (default_image) {
        default_image.addEventListener('change', function() {
            if (this.checked) {
                // display none
                image.style.display = 'none';
            } else {
                // display block
                image.style.display = 'block';
            }
        });
    }
</script>
