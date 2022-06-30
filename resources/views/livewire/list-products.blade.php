<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="productsTable" data-get-url="{{ route('products.index') }}" class="table" data-user={{ auth()->user()->is_user }}>
                        <thead>
                            <tr>
                                <th width="5%">SL#</th>
                                <th width="15%">Item</th>
                                <th width="25%">Description</th>
                                <th width="25%">Category</th>
                                <th width="5%">Qty</th>
                                <th>Unit</th>
                                @if(auth()->user()->is_admin)
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
