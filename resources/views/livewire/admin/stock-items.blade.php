<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="stockItemsTable" data-get-url="{{ route('admin.stocks.items-data', $stock) }}" class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th width="10%">Item #</th>
                                <th width="15%">Item Code</th>
                                <th width="20%">Product Description</th>
                                <th width="5%">QTY</th>
                                <th width="5%">Unit</th>
                                <th width="10%">Category</th>
                                <th width="10%">Status</th>
                                <th width="25%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
