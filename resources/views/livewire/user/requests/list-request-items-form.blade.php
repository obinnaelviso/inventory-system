<div>
    <form class="row g-2" wire:submit.prevent="submitForm">
        <div class="col-12 col-md-6">
            <label for="item">Item</label>
            <input type="text" class="form-control @error('item') is-invalid @enderror" wire:model.lazy='item' id="item">
            @error('item')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12 col-md-6">
            <label for="description">Description</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" wire:model.lazy='description' id="description">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12 col-md-6">
            <label for="qty">Quantity</label>
            <input type="number" class="form-control @error('qty') is-invalid @enderror" wire:model.lazy='qty' id="qty">
            @error('qty')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12 col-md-6">
            <label for="unit">Unit</label>
            <input type="text" class="form-control @error('unit') is-invalid @enderror" wire:model.lazy='unit' id="unit">
            @error('unit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <button class="btn btn-primary w-100">
                {{ $requestItem ? 'Update' : 'Add' }}
            </button>
        </div>
    </form>
</div>
