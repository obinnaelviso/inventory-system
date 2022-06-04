<div class="row">
    @forelse ( $this->requests as $request)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card radius-10 zoom cursor-pointer" onclick="gotoRequest({{ $request->id }})">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Name</p>
                            <h4 class="my-1">{{ $request->name }}</h4>
                            <p class="mb-0 font-13 text-muted">{{ $request->dept }}</p>
                        </div>
                        <div class="text-primary ms-auto font-35"><i class="bx bx-message-error"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card radius-2">
                <div class="card-body text-center py-5">
                    <p class="my-5">No requests record found. <br>Click the button below to <a href="javascript:void(0);" class="requestCreateBtn">create a new one.</a></p>
                </div>
            </div>
        </div>
    @endforelse
</div>
