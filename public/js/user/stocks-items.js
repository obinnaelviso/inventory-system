var stockItemsDataTable, currentStockItemId, submitRequestModal;
const stockItemCreateBtn = $('.stockItemCreateBtn')
const stockItemFormModal = new bootstrap.Modal(document.getElementById('stockItemFormModal'))
var productSearchUrl = "/products/search";
var searchTimeout = undefined;

// Add StockItem
function addStockItem() {
    $('#stockItemFormModalTitle').html('Add New Item')
    stockItemFormModal.show();
    Livewire.emit('newStockItem')
}

// Edit Stock Item
function editStockItem(id) {
    $('#stockItemFormModalTitle').html('Update Item')
    Livewire.emit('editStockItem', id)
}

function selectItem(id) {
    currentStockItemId = id
}


function selectSearchValue(item) {
    Livewire.emit('inputFromSearch', item);
    $("#search-items-card").hide();
    $('#qty').focus();
}

function initializeTable() {
    const stockItemsDataUrl = $('#stockItemsTable').data('get-url');

    stockItemsDataTable = $('#stockItemsTable').DataTable({
        serverSide: true,
        processing: true,
        retrieve: true,
        ajax: {
            url: stockItemsDataUrl,
            type: 'POST',
        },
        searchDelay: 500,
        order: [0, 'desc'],
        columns: [
            { name: 'id', data: 'id', searchable: false, orderable: true },
            { name: 'item', data: 'item' },
            { name: 'description', data: 'description', searchable: true, orderable: false },
            { name: 'qty', data: 'qty', searchable: false, orderable: false },
            { name: 'unit', data: 'unit', searchable: false, orderable: false },
            { name: 'category', data: 'category', searchable: false, orderable: false },
            { name: 'status_id', data: 'status', searchable: false, orderable: true },
            { name: 'action', data: 'action', searchable: false, orderable: false },
        ],
        buttons: ['copy', 'excel', 'pdf', 'print'],
        initComplete: function() {
            this.api().buttons().container().addClass(' mt-3')
            this.api().buttons().container().appendTo('#stockItemsTable_wrapper .col-md-6:eq(0)');
        }
    })
}
$(() => {
    initializeTable();

    stockItemCreateBtn.on('click', addStockItem);

    // Listen to livewire request item events
    Livewire.on('stockItemCreated', () => {
        stockItemsDataTable.ajax.reload()
        stockItemFormModal.hide()
        alertify.success('Item created successfully!')
    })
    Livewire.on('stockItemUpdated', () => {
        stockItemsDataTable.ajax.reload()
        stockItemFormModal.hide()
        alertify.success('Item updated successfully!')
    })
    $('input').on('click', function() {
        $("#search-items-card").hide();
    })
    $('#item-code').on('keyup', function() {
        let searchString = $(this).val();
        if(searchTimeout != undefined) {
            clearTimeout(searchTimeout);
        }
       searchTimeout = setTimeout(() => {
            if (searchString.length > 0) {
                $.ajax({
                    url: productSearchUrl,
                    data: {
                        q: searchString
                    },
                    success: function(response) {
                        if (response.data.length > 0) {
                            $("#search-items-card").show()
                            $("#search-items-body").html("")
                            response.data.forEach(element => {
                                $("#search-items-body").append(`
                                    <button class="btn w-100 text-start border-bottom search-item" type="button" onclick='selectSearchValue(${JSON.stringify(element)})'>${element.item} - ${element.description}</button>
                                `);
                            });
                        } else {
                            $("#search-items-card").hide();
                        }
                    }
                })
            } else {
                $("#search-items-card").hide();
            }
        }, 500);

    })

    window.addEventListener('initialize-table', () => {
        initializeTable();
    })
})
