<div>
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 border-bottom pb-2 mb-3">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <strong>Name: </strong> {{ $request->name }}
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <strong>Department: </strong> {{ $request->dept }}
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <strong>Date: </strong> {{ $request->date }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#requestItemFormModal" onclick="addRequestItem()">
                                <i class="bx bx-plus-circle"></i> Add New Item
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="requestItemsTable" data-get-url="{{ route('user.requests.items.index', $request->id) }}" class="table">
                        <thead>
                            <tr>
                                <th width="5%">SL#</th>
                                <th width="15%">Item</th>
                                <th width="35%">Description</th>
                                <th width="5%">Qty</th>
                                <th width="10%">Unit</th>
                                <th width="30%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- New/Update Modal -->
    <div class="modal fade" id="requestItemFormModal" tabindex="-1" aria-labelledby="userFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestItemFormModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <livewire:user.requests.list-request-items-form :request="$request" />
                </div>
            </div>
        </div>
    </div>

    {{-- Delete --}}
    <div class="modal fade" id="deleteRequestModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalTitle">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this request?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Not yet</button>
                    <button type="button" class="btn btn-danger btn-sm" id="modalDeleteBtn" onclick="processDeleteUser();">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

