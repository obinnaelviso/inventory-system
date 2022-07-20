<div>
    <form class="row g-3" wire:submit.prevent='submitForm'>
        <div class="col-sm-12 position-relative">
            <label for="item-code">Item Code</label>
            <input id="item-code" type="text" class="form-control @error('item') is-invalid @enderror" wire:model='item' id="item" autocomplete="off">
            <div class="card position-absolute w-100" id="search-items-card" style="display: none; max-width: 450px; overflow-y: auto">
                <div class="card-body" id="search-items-body"></div>
            </div>
            @error('item')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-12">
            <label for="description">Product Description</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" wire:model.lazy='description' id="description">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-12">
            <label for="qty">QTY</label>
            <input type="text" class="form-control @error('qty') is-invalid @enderror" wire:model.lazy='qty' id="qty">
            @error('qty')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-12">
            <label for="unit">Unit</label>
            <select name="units" id="units" class="form-control @error('unit') is-invalid @enderror" wire:model="unit">
                <option value="" selected>Select Unit</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->title }}">{{ $unit->title }}</option>
                @endforeach
            </select>
            @error('unit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </div>
    </form>
</div>
