<div>
    <form class="row g-3" wire:submit.prevent='submitForm'>
        <div class="col-sm-6">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" wire:model.lazy='first_name' id="first_name">
            @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-6">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" wire:model.lazy='last_name' id="last_name">
            @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <label for="email">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model='email' id="email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <label for="password">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model='password' id="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model='password_confirmation' id="password_confirmation">
        </div>
        <div class="col-12">
            <label for="role">Role</label>
            <select class="form-control @error('role') is-invalid @enderror" wire:model='role' id="role">
                <option value="" disabled>Select Role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
