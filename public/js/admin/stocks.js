var stocksDataTable, stockDeleteModal, currentstockId, submitRequestModal;
const stockCreateBtn = $('.stockCreateBtn')
const stockFormModal = new bootstrap.Modal(document.getElementById('stockFormModal'))

// Add Stock
function addStock() {
    $('#stockFormModalTitle').html('Create New Stock')
    stockFormModal.show();
    Livewire.emit('newStock')
}

// Edit stock Item
function editStock(id) {
    $('#stockFormModalTitle').html('Update Stock')
    Livewire.emit('editStock', id)
}

function deleteStock(id) {
    currentStockId = id
}

function confirmStockDelete() {
    Livewire.emit('deleteStock', currentStockId)
}

function initializeTable() {
    const stocksDataUrl = $('#stocksTable').data('get-url');
    stockDeleteModal = $('#stockDeleteModal').length ? new bootstrap.Modal(document.getElementById('stockDeleteModal')) : null
    submitRequestModal = $('#submitRequestModal').length ? new bootstrap.Modal(document.getElementById('submitRequestModal')) : null

    stocksDataTable = $('#stocksTable').DataTable({
        serverSide: true,
        processing: true,
        retrieve: true,
        ajax: {
            url: stocksDataUrl,
            type: 'POST',
        },
        searchDelay: 500,
        order: [0, 'asc'],
        columns: [
            { name: 'id', data: 'id', searchable: false, orderable: true },
            { name: 'user', data: 'user' },
            { name: 'name', data: 'name' },
            { name: 'receipt_no', data: 'receipt_no', searchable: true, orderable: false },
            { name: 'receipt_url', data: 'receipt_url', searchable: false, orderable: false },
            { name: 'action', data: 'action', searchable: false, orderable: false },
        ],
        columnDefs: [{
            targets: 4,
            render: function(data, type, row, meta) {
                return `<a href="${data}" class="btn btn-primary btn-sm" download>
                            <i class="bx bx-download me-0"></i>
                        </a>
                        <a href="${data}" class="btn btn-info btn-sm" target="_blank" title="View">
                            <i class="bx bx-show me-0"></i>
                        </a>`
            }
        }],
        buttons: ['copy', 'excel', 'pdf', 'print'],
        initComplete: function() {
            this.api().buttons().container().addClass(' mt-3')
            this.api().buttons().container().appendTo('#stocksTable_wrapper .col-md-6:eq(0)');
        }
    })
}
$(() => {
    initializeTable();

    stockCreateBtn.on('click', addStock);

    // Listen to livewire request item events
    Livewire.on('stockCreated', () => {
        stocksDataTable.ajax.reload()
        stockFormModal.hide()
    })
    Livewire.on('stockUpdated', () => {
        stocksDataTable.ajax.reload()
        stockFormModal.hide()
    })
    Livewire.on('stockDeleted', () => {
        stocksDataTable.ajax.reload()
        stockDeleteModal.hide()
    })


    window.addEventListener('initialize-table', () => {
        initializeTable();
    })
})
