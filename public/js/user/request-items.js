var requestItemsDataTable, requestItemFormModal, requestItemDeleteModal, currentRequestItemId, submitRequestModal;
// Add Request Item
function addRequestItem() {
    $('#requestItemFormModalTitle').html('Add Item')
    Livewire.emit('newRequestItem')
}

// Submit Request
function submitRequest() {
    Livewire.emit('submitRequest')
}

// Edit Request Item
function editRequestItem(id) {
    $('#requestItemFormModalTitle').html('Update Item')
    Livewire.emit('editRequestItem', id)
}

function deleteRequestItem (id) {
    currentRequestItemId = id
}

function confirmRequestItemDelete() {
    Livewire.emit('deleteRequestItem', currentRequestItemId)
}

function initializeTable () {
    const requestItemsDataUrl = $('#requestItemsTable').data('get-url');
    requestItemFormModal = $('#requestItemFormModal').length ? new bootstrap.Modal(document.getElementById('requestItemFormModal')) : null
    requestItemDeleteModal = $('#requestItemDeleteModal').length ? new bootstrap.Modal(document.getElementById('requestItemDeleteModal')) : null
    submitRequestModal = $('#submitRequestModal').length ? new bootstrap.Modal(document.getElementById('submitRequestModal')) : null

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
        buttons: [ 'copy', 'excel', 'pdf', 'print'],
        initComplete: function() {
            this.api().buttons().container().addClass(' mt-3')
            this.api().buttons().container().appendTo('#requestItemsTable_wrapper .col-md-6:eq(0)');
        }
    })
}
$(() => {
    initializeTable();
    // Listen to livewire request item events
    Livewire.on('requestItemCreated', () => {
        requestItemsDataTable.ajax.reload()
    })
    Livewire.on('requestItemUpdated', () => {
        requestItemsDataTable.ajax.reload()
        requestItemFormModal.hide()
    })
    Livewire.on('requestItemDeleted', () => {
        requestItemsDataTable.ajax.reload()
        requestItemDeleteModal.hide()
    })
    Livewire.on('requestStatusUpdated', () => {
        submitRequestModal.hide()
    })

    window.addEventListener('initialize-table', () => {
        initializeTable();
        console.log('parapapa')
    })
})
