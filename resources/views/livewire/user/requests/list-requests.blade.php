<div class="row">
    @forelse ( $this->requests as $request)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card radius-10 zoom cursor-pointer">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div onclick="gotoRequest({{ $request->id }})">
                            <p class="mb-0 text-secondary">Name</p>
                            <h4 class="my-1">{{ $request->name }}</h4>
                            <div class="row">
                                <div class="col-12">
                                    <p class="mb-0 font-13 text-muted"><strong>Dept:</strong> {{ $request->dept }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-{{ $request->status->colour[0] }} ms-auto">
                            @if($request->status_id == status_processing_id())
                                <i class="bx bx-check-circle font-35"></i>
                            @else
                                <i class="bx bx-message-error font-35"></i>
                            @endif
                            @if ($request->status_id == status_pending_id())
                                <div class="row">
                                    <div class="col-12 text-end mb-0 font-18">
                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Request" class="text-info" onclick="editRequest({{ $request->id }})">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Request" class="text-danger" onclick="openDeleteRequestModal({{ $request->id }})">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
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
    <div class="modal fade" id="deleteRequestModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="deleteRequestModalTitle">Delete Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this request?<br>
                    <div class="text-danger"><strong>Note:</strong> Deleting request will automatically remove all items relating to it.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Not yet</button>
                    <button type="button" class="btn btn-danger btn-sm" id="modalDeleteBtn" onclick="deleteRequest();">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
