var stockItemsDataTable, stockItemDeleteModal, markAsCompletedModal, addToProductsModal, currentStockItemId, submitRequestModal;
const stockItemCreateBtn = $('.stockItemCreateBtn')
const stockItemFormModal = new bootstrap.Modal(document.getElementById('stockItemFormModal'))

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

function deleteItem() {
    Livewire.emit('deleteStockItem', currentStockItemId)
}

function markAsCompleted() {
    Livewire.emit('markAsCompleted', currentStockItemId)
}

function addItemToProducts() {
    Livewire.emit('addItemToProducts', currentStockItemId)
}

function initializeTable() {
    const stockItemsDataUrl = $('#stockItemsTable').data('get-url');
    stockItemDeleteModal = new bootstrap.Modal(document.getElementById('stockItemDeleteModal'))
    markAsCompletedModal = new bootstrap.Modal(document.getElementById('markAsCompletedModal'))
    addToProductsModal = new bootstrap.Modal(document.getElementById('addToProductsModal'))

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
    })
    Livewire.on('stockItemUpdated', () => {
        stockItemsDataTable.ajax.reload()
        stockItemFormModal.hide()
    })
    Livewire.on('stockItemDeleted', () => {
        stockItemsDataTable.ajax.reload()
        stockItemDeleteModal.hide()
    })
    Livewire.on('stockItemCompleted', () => {
        stockItemsDataTable.ajax.reload()
        markAsCompletedModal.hide()
    })
    Livewire.on('stockItemAddedToProducts', () => {
        stockItemsDataTable.ajax.reload()
        addToProductsModal.hide()
    })


    window.addEventListener('initialize-table', () => {
        initializeTable();
    })
})
