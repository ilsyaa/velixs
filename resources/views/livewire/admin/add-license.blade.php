<div>
    <form wire:submit.prevent="store">
        <div class="modal-body">
            <div class="mb-1">
                <label class="form-label" for="basicInput">License</label>
                <div class="input-group">
                    <input type="text" class="form-control" wire:model="license" placeholder="META-NS3E-L0LS-EXAMP" />
                    <button class="btn btn-outline-primary" wire:click="generate_license" type="button">GENERATE</button>
                </div>
                @error('license')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-1">
                <label class="form-label" for="basicInput">SLUG</label>
                <div class="input-group">
                    <input type="text" class="form-control" wire:model="slug" />
                    <button class="btn btn-outline-primary" wire:click="generate_slug" type="button">GENERATE</button>
                </div>
                @error('slug')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-1" wire:ignore>
                <label class="form-label" for="select2-basic">Products</label>
                <select class="form-select" id="select2">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

@push('livewirejs')
    <script>
        $(document).ready(function() {
            $('#select2').select2();
            @this.set('itemsssid', $('#select2').val());
            $('#select2').on('change', function(e) {
                var data = $('#select2').select2("val");
                @this.set('itemsssid', data);
            });
        });
    </script>
@endpush
