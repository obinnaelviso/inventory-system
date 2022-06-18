var productsDataTable, productFormModal, productDeleteModal, currentproductId, submitRequestModal;
// Add Request Item
function addproduct() {
    $('#productFormModalTitle').html('Add Item')
    Livewire.emit('newproduct')
}

// Submit Request
function submitRequest() {
    Livewire.emit('submitRequest')
}

// Edit Request Item
function editproduct(id) {
    $('#productFormModalTitle').html('Update Item')
    Livewire.emit('editproduct', id)
}

function deleteproduct (id) {
    currentproductId = id
}

function confirmproductDelete() {
    Livewire.emit('deleteproduct', currentproductId)
}

function initializeTable () {
    const productsDataUrl = $('#productsTable').data('get-url');
    productFormModal = $('#productFormModal').length ? new bootstrap.Modal(document.getElementById('productFormModal')) : null
    productDeleteModal = $('#productDeleteModal').length ? new bootstrap.Modal(document.getElementById('productDeleteModal')) : null
    submitRequestModal = $('#submitRequestModal').length ? new bootstrap.Modal(document.getElementById('submitRequestModal')) : null

    productsDataTable = $('#productsTable').DataTable({
        serverSide: true,
        processing: true,
        retrieve: true,
        ajax: {
            url: productsDataUrl,
            type: 'POST',
        },
        searchDelay: 500,
        order: [0, 'asc'],
        columns: [
            {name: 'id', data: 'id', searchable: false, orderable: true},
            { name: 'item', data:'item' },
            { name: 'description', data:'description' },
            { name: 'category', data:'category', searchable: true, orderable: true },
            { name: 'qty', data:'qty', searchable: false, orderable: true },
            { name: 'unit', data:'unit', searchable: false, orderable: false },
            { name: 'action', data:'action', searchable: false, orderable: false },
        ],
        buttons: [ 'copy', 'excel', 'pdf', 'print'],
        initComplete: function() {
            this.api().buttons().container().addClass(' mt-3')
            this.api().buttons().container().appendTo('#productsTable_wrapper .col-md-6:eq(0)');
        }
    })
}
$(() => {
    initializeTable();
    // Listen to livewire request item events
    Livewire.on('productCreated', () => {
        productsDataTable.ajax.reload()
    })
    Livewire.on('productUpdated', () => {
        productsDataTable.ajax.reload()
        productFormModal.hide()
    })
    Livewire.on('productDeleted', () => {
        productsDataTable.ajax.reload()
        productDeleteModal.hide()
    })
    Livewire.on('requestStatusUpdated', () => {
        submitRequestModal.hide()
    })

    window.addEventListener('initialize-table', () => {
        initializeTable();
    })
})
