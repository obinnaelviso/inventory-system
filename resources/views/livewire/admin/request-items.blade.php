<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="requestItemsTable" data-get-url="{{ route('admin.requests.items-data', $request->id) }}" class="table">
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
</div>
