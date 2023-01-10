var requestItemsDataTable, requestItemFormModal, requestItemDeleteModal, currentRequestItemId, submitRequestModal;
var productSearchUrl = "/products/search";
var searchTimeout = undefined;

// Add Request Item
function addRequestItem() {
    $('#requestItemFormModalTitle').html('Add Item')
    Livewire.emit('newRequestItem')
}

// Submit Request
function submitRequest() {
    Livewire.emit('submitRequest')
}

function selectItem(id) {
    currentRequestItemId = id
}

// Edit Request Item
function editRequestItem(id) {
    $('#requestItemFormModalTitle').html('Update Item')
    Livewire.emit('editRequestItem', id)
}

function deleteRequestItem (id) {
    currentRequestItemId = id
}

function selectSearchValue(id) {
    Livewire.emit('inputFromSearch', id);
    $("#search-items-card").hide();
    $('#qty').focus();
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
        buttons: ['excel', 'pdf', 'print'],
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
        alertify.success('Item created successfully!')
    })
    Livewire.on('requestItemUpdated', () => {
        requestItemsDataTable.ajax.reload()
        requestItemFormModal.hide()
        alertify.success('Item updated successfully!')
    })
    Livewire.on('requestItemDeleted', () => {
        requestItemsDataTable.ajax.reload()
        requestItemDeleteModal.hide()
        alertify.success('Item deleted successfully!')
    })
    Livewire.on('requestStatusUpdated', () => {
        alertify.success('Request status updated successfully!')
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
                                    <button class="btn w-100 text-start border-bottom search-item" type="button" onclick='selectSearchValue(${element.id})'>${element.item} - ${element.description}</button>
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
})
