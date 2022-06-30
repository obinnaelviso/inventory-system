var productsDataTable, productFormModal, productDeleteModal, currentProductId, submitRequestModal;
// Add Product
function addProduct() {
    $('#productFormModalTitle').html('Add Item')
    Livewire.emit('newproduct')
}

// Edit Product
function editProduct(id) {
    $('#productFormModalTitle').html('Update Item')
    Livewire.emit('editProduct', id)
}

function selectItem(id) {
    currentProductId = id
}

function deleteProduct() {
    Livewire.emit('deleteProduct', currentProductId)
}

function initializeTable () {
    const productsDataUrl = $('#productsTable').data('get-url');
    const isUser = $('#productsTable').data('user');
    productFormModal = new bootstrap.Modal(document.getElementById('productFormModal'))
    productDeleteModal = new bootstrap.Modal(document.getElementById('productDeleteModal'))

    let tableColumns = [
        {name: 'id', data: 'id', searchable: false, orderable: true},
        { name: 'item', data:'item' },
        { name: 'description', data:'description' },
        { name: 'category', data:'category', searchable: true, orderable: true },
        { name: 'qty', data:'qty', searchable: false, orderable: true },
        { name: 'unit', data:'unit', searchable: false, orderable: false }
    ];

    if (!isUser) {
        tableColumns.push({ name: 'action', data:'action', searchable: false, orderable: false })
    }


    productsDataTable = $('#productsTable').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: productsDataUrl,
            type: 'POST',
        },
        searchDelay: 500,
        order: [0, 'asc'],
        columns: tableColumns,
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

    window.addEventListener('initialize-table', () => {
        initializeTable();
    })
})
