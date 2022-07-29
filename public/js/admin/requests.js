var requestsDataTable, requestDeleteModal, markAsCompletedModal, currentRequestId, submitRequestModal;
const requestCreateBtn = $('.requestCreateBtn')
const requestFormModal = new bootstrap.Modal(document.getElementById('requestFormModal'))
const dateOptions = {
    'format': 'mm/dd/yyyy',
    'updateOnBlur': true,
}
const requestDateInput = document.getElementById('requestDate')
const requestDateDp = new Datepicker(requestDateInput, dateOptions)

function changeDate() {
    this.dispatchEvent(new Event('input'))
}

// Add Request
function addRequest() {
    $('#requestFormModalTitle').html('Make a new Request')
    requestFormModal.show();
    Livewire.emit('newRequest')
}

// Edit Request Item
function editRequest(id) {
    $('#requestFormModalTitle').html('Update Request')
    Livewire.emit('editRequest', id)
}

function selectRequest(id) {
    currentRequestId = id
}

function deleteRequest() {
    Livewire.emit('deleteRequest', currentRequestId)
}

function markAsCompleted() {
    Livewire.emit('markAsCompleted', currentRequestId)
}

function initializeTable() {
    const requestsDataUrl = $('#requestsTable').data('get-url');
    requestDeleteModal = $('#requestDeleteModal').length ? new bootstrap.Modal(document.getElementById('requestDeleteModal')) : null
    markAsCompletedModal = new bootstrap.Modal(document.getElementById('markAsCompletedModal'))

    requestsDataTable = $('#requestsTable').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: requestsDataUrl,
            type: 'POST',
        },
        searchDelay: 500,
        order: [0, 'desc'],
        columns: [
            { name: 'id', data: 'id', searchable: false, orderable: true },
            { name: 'user', data: 'user' },
            { name: 'name', data: 'name' },
            { name: 'dept', data: 'dept', searchable: true, orderable: true },
            { name: 'date', data: 'date', searchable: true, orderable: false },
            { name: 'status', data: 'status', searchable: false, orderable: false },
            { name: 'action', data: 'action', searchable: false, orderable: false },
        ],
        buttons: ['copy', 'excel', 'pdf', 'print'],
        initComplete: function() {
            this.api().buttons().container().addClass(' mt-3')
            this.api().buttons().container().appendTo('#requestsTable_wrapper .col-md-6:eq(0)');
        }
    })
}
$(() => {
    initializeTable();
    // Datepicker element for date field
    requestDateInput.addEventListener('changeDate', changeDate)

    requestCreateBtn.on('click', addRequest);

    // Listen to livewire request item events
    Livewire.on('requestCreated', () => {
        requestsDataTable.ajax.reload()
        requestFormModal.hide()
        alertify.success('Request created successfully!')
    })
    Livewire.on('requestUpdated', () => {
        requestsDataTable.ajax.reload()
        requestFormModal.hide()
        alertify.success('Request updated successfully!')
    })
    Livewire.on('requestDeleted', () => {
        requestsDataTable.ajax.reload()
        requestDeleteModal.hide()
        alertify.success('Request deleted successfully!')
    })
    Livewire.on('requestCompleted', () => {
        requestsDataTable.ajax.reload()
        markAsCompletedModal.hide()
        alertify.success('Request completed successfully!')
    })


    window.addEventListener('initialize-table', () => {
        initializeTable();
    })
})
