<div>
    <form class="row g-3" wire:submit.prevent='submitForm'>
        <div class="col-sm-12">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.lazy='name' id="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-23">
            <label for="dept">Department</label>
            <input type="text" class="form-control @error('dept') is-invalid @enderror" wire:model.lazy='dept' id="dept">
            @error('dept')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <label for="requestDate">Date</label>
            <input type="text" class="form-control @error('date') is-invalid @enderror" wire:model='date' id="requestDate">
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </div>
    </form>
</div>
