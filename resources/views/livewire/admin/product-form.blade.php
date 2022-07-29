<div>
    <form class="row g-3" wire:submit.prevent='submitForm'>
        <div class="col-sm-12">
            <label for="item">Item Code</label>
            <input type="text" class="form-control @error('item') is-invalid @enderror" wire:model.lazy='item'
                id="item">
            @error('item')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-12">
            <label for="description">Product Description</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror"
                wire:model.lazy='description' id="description">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-12">
            <label for="qty">QTY</label>
            <input type="text" class="form-control @error('qty') is-invalid @enderror" wire:model.lazy='qty'
                id="qty">
            @error('qty')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-12">
            <label for="unit">Unit</label>
            <select name="units" id="units" class="form-control @error('unit') is-invalid @enderror"
                wire:model="unit">
                <option value="" selected>Select Unit</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->title }}">{{ $unit->title }}</option>
                @endforeach
            </select>
            @error('unit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-12">
            <label for="category">Category</label>
            <select name="categories" id="categories" class="form-control @error('category') is-invalid @enderror"
                wire:model="category">
                <option value="" selected>Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->title }}">{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </div>
    </form>
</div>
