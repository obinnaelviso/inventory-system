var requestItemsDataTable, requestItemDeleteModal, markAsCompletedModal, processRequestItemModal, currentRequestItemId, submitRequestModal;
const requestItemCreateBtn = $('.requestItemCreateBtn')
const requestItemFormModal = new bootstrap.Modal(document.getElementById('requestItemFormModal'))
var productSearchUrl;
var printUrl;
var exportPdfUrl;
var searchTimeout = undefined;
// Add requestItem
function addRequestItem() {
    $('#requestItemFormModalTitle').html('Add New Item')
    requestItemFormModal.show();
    Livewire.emit('newRequestItem')
}

// Edit request Item
function editRequestItem(id) {
    $('#requestItemFormModalTitle').html('Update Item')
    Livewire.emit('editRequestItem', id)
}

function selectSearchValue(id) {
    Livewire.emit('inputFromSearch', id);
    $("#search-items-card").hide();
    $('#qty').focus();
}

function selectItem(id) {
    currentRequestItemId = id
}

function deleteItem() {
    Livewire.emit('deleteRequestItem', currentRequestItemId)
}

function processRequestItem() {
    Livewire.emit('processRequestItem', currentRequestItemId)
}

function initializeTable() {
    const requestItemsDataUrl = $('#requestItemsTable').data('get-url');
    requestItemDeleteModal = new bootstrap.Modal(document.getElementById('requestItemDeleteModal'))
    markAsCompletedModal = new bootstrap.Modal(document.getElementById('markAsCompletedModal'))
    processRequestItemModal = new bootstrap.Modal(document.getElementById('processRequestItemModal'))
    productSearchUrl = $('#requestItemsTable').data('search-url');
    printUrl = $('#requestItemsTable').data('print-url')
    exportPdfUrl = $('#requestItemsTable').data('export-pdf-url')

    requestItemsDataTable = $('#requestItemsTable').DataTable({
        serverSide: true,
        processing: true,
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
            { name: 'status', data:'status', searchable: false, orderable: false },
            { name: 'action', data:'action', searchable: false, orderable: false },
        ],
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(.notexport)'
                }
            },
            {
                text: 'PDF',
                action: function(e, dt, node, config) {
                    window.location.href = exportPdfUrl
                }
            },
            {
                text: 'Print',
                action: function(e, dt, node, config) {
                    window.open(printUrl, "_blank").focus()
                }
            }
        ],
        initComplete: function() {
            this.api().buttons().container().addClass(' mt-3')
            this.api().buttons().container().appendTo('#requestItemsTable_wrapper .col-md-6:eq(0)');
        }
    })
}
$(() => {
    initializeTable();

    requestItemCreateBtn.on('click', addRequestItem);

    // Listen to livewire request item events
    Livewire.on('requestItemCreated', () => {
        requestItemsDataTable.ajax.reload()
        requestItemFormModal.hide()
        alertify.success('Item created successfully')
    })
    Livewire.on('requestItemUpdated', () => {
        requestItemsDataTable.ajax.reload()
        requestItemFormModal.hide()
        alertify.success('Item updated successfully')
    })
    Livewire.on('requestItemDeleted', () => {
        requestItemsDataTable.ajax.reload()
        requestItemDeleteModal.hide()
        alertify.success("Item deleted successfully!")
    })
    Livewire.on('requestItemProcessed', () => {
        requestItemsDataTable.ajax.reload()
        processRequestItemModal.hide()
        alertify.success("Item processed successfully!")
    })
    Livewire.on('requestItemNotAvailable', () => {
        requestItemsDataTable.ajax.reload()
        processRequestItemModal.hide()
        alertify.error('Item is not available!')
    })
    window.addEventListener('initialize-table', () => {
        initializeTable();
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
