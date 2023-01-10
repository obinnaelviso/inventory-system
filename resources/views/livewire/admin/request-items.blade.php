<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3 pb-3 border-bottom">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 border-end">
                            <strong>Name: </strong> {{ $request->name }}
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 border-end">
                            <strong>Department: </strong> {{ $request->dept }}
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 border-end">
                            <strong>Date: </strong> {{ $request->date }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table id="requestItemsTable" data-export-pdf-url="{{ route('admin.requests.items-export-pdf', $request->id) }}" data-print-url="{{ route('admin.requests.items-print', $request->id) }}" data-search-url="{{ route('products.search') }}" data-get-url="{{ route('admin.requests.items-data', $request->id) }}" class="table">
                                <thead>
                                    <tr>
                                        <th width="5%">SL#</th>
                                        <th width="15%">Item</th>
                                        <th width="30%">Description</th>
                                        <th width="5%">Qty</th>
                                        <th width="5%">Unit</th>
                                        <th width="10%">Status</th>
                                        <th width="30%" class="notexport">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
