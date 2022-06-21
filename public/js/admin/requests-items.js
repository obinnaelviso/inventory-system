var requestItemsDataTable, requestItemDeleteModal, markAsCompletedModal, addToProductsModal, currentrequestItemId, submitRequestModal;
const requestItemCreateBtn = $('.requestItemCreateBtn')
const requestItemFormModal = new bootstrap.Modal(document.getElementById('requestItemFormModal'))

// Add requestItem
function addrequestItem() {
    $('#requestItemFormModalTitle').html('Add New Item')
    requestItemFormModal.show();
    Livewire.emit('newrequestItem')
}

// Edit request Item
function editRequestItem(id) {
    $('#requestItemFormModalTitle').html('Update Item')
    Livewire.emit('editrequestItem', id)
}

function selectItem(id) {
    currentrequestItemId = id
}

function deleteItem() {
    Livewire.emit('deleteRequestItem', currentRequestItemId)
}

function markAsCompleted() {
    Livewire.emit('markAsCompleted', currentRequestItemId)
}

function initializeTable() {
    const requestItemsDataUrl = $('#requestItemsTable').data('get-url');
    requestItemDeleteModal = new bootstrap.Modal(document.getElementById('requestItemDeleteModal'))
    markAsCompletedModal = new bootstrap.Modal(document.getElementById('markAsCompletedModal'))
    addToProductsModal = new bootstrap.Modal(document.getElementById('addToProductsModal'))

    requestItemsDataTable = $('#requestItemsTable').DataTable({
        serverSide: true,
        processing: true,
        retrieve: true,
        ajax: {
            url: requestItemsDataUrl,
            type: 'POST',
        },
        searchDelay: 500,
        order: [0, 'asc'],
        columns: [
            {name: 'id', data: 'id', searchable: false, orderable: true},
            { name: 'item', data:'item' },
            { name: 'description', data:'description' },
            { name: 'qty', data:'qty', searchable: false, orderable: false },
            { name: 'unit', data:'unit', searchable: false, orderable: false },
            { name: 'action', data:'action', searchable: false, orderable: false },
        ],
        buttons: ['copy', 'excel', 'pdf', 'print'],
        initComplete: function() {
            this.api().buttons().container().addClass(' mt-3')
            this.api().buttons().container().appendTo('#requestItemsTable_wrapper .col-md-6:eq(0)');
        }
    })
}
$(() => {
    initializeTable();

    requestItemCreateBtn.on('click', addrequestItem);

    // Listen to livewire request item events
    Livewire.on('requestItemCreated', () => {
        requestItemsDataTable.ajax.reload()
        requestItemFormModal.hide()
    })
    Livewire.on('requestItemUpdated', () => {
        requestItemsDataTable.ajax.reload()
        requestItemFormModal.hide()
    })
    Livewire.on('requestItemDeleted', () => {
        requestItemsDataTable.ajax.reload()
        requestItemDeleteModal.hide()
    })
    Livewire.on('requestItemCompleted', () => {
        requestItemsDataTable.ajax.reload()
        markAsCompletedModal.hide()
    })
    Livewire.on('requestItemAddedToProducts', () => {
        requestItemsDataTable.ajax.reload()
        addToProductsModal.hide()
    })


    window.addEventListener('initialize-table', () => {
        initializeTable();
    })
})
