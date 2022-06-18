<div>
    <form class="row g-3" wire:submit.prevent='submitForm'>
        <div class="col-sm-12">
            <label for="name">Purchaser Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.lazy='name' id="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-23">
            <label for="receipt_no">Receipt Number</label>
            <input type="text" class="form-control @error('receipt_no') is-invalid @enderror" wire:model.lazy='receipt_no' id="receipt_no">
            @error('receipt_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-23">
            <label for="receipt_upload">Receipt Upload</label>
            <input type="file" class="form-control @error('receipt_upload') is-invalid @enderror" wire:model='receipt_upload' id="receipt_upload">
            @error('receipt_upload')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </div>
    </form>
</div>
