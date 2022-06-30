<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3 pb-3 border-bottom">
                        @if(auth()->user()->is_admin)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 border-end">
                                <strong>User: </strong> {{ $stock->user->name }}
                            </div>
                        @endif
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 border-end">
                            <strong>Purchase Number: </strong> {{ $stock->id }}
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 border-end">
                            <strong>Purchaser Name: </strong> {{ $stock->name }}
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 {{ auth()->user()->is_user ? 'border-end' : '' }}">
                            <strong>Receipt Number: </strong> {{ $stock->receipt_no }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table id="stockItemsTable" data-get-url="{{ auth()->user()->is_admin ? route('admin.stocks.items-data', $stock) : route('user.stocks.items-data', $stock) }}" class="table table-hover w-100">
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
    </div>
</div>
