const dateOptions = {
    'format' : 'mm/dd/yyyy'
}
var currentRequestId, requestsDataTable;
const requestCreateBtn = $('.requestCreateBtn')
const requestDateInput = document.getElementById('requestDate')
const requestDateDp = new Datepicker(requestDateInput, dateOptions)
const requestFormModal = new bootstrap.Modal(document.getElementById('requestFormModal'))
const deleteRequestModal = new bootstrap.Modal(document.getElementById('deleteRequestModal'))

function changeDate() {
    this.dispatchEvent(new Event('input'))
}

function gotoRequest(id) {
    Livewire.emit('selectedRequest', id)
}

function openDeleteRequestModal(id) {
    currentRequestId = id
    deleteRequestModal.show()
}

function editRequest(id) {
    $('#requestFormModalTitle').html('Update Request')
    Livewire.emit('editRequest', id)
    requestFormModal.show()
}

function deleteRequest() {
    Livewire.emit('deleteRequest', currentRequestId)
}

function initializeRequestTable() {
    const requestsDataUrl = $('#requestsTable').data('get-url');
    requestDeleteModal = $('#requestDeleteModal').length ? new bootstrap.Modal(document.getElementById('requestDeleteModal')) : null

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
            { name: 'name', data: 'name' },
            { name: 'dept', data: 'dept', searchable: true, orderable: true },
            { name: 'date', data: 'date', searchable: true, orderable: true },
            { name: 'status_id', data: 'status_styled', searchable: false, orderable: true },
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
    initializeRequestTable();
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    requestCreateBtn.on('click', () => {
        $('#requestFormModalTitle').html('Create New Request')
        requestFormModal.show();
        Livewire.emit('newRequest');
    })

    // Datepicker element for date field
    requestDateInput.addEventListener('changeDate', changeDate)

    // Listen to livewire event
    Livewire.on('requestCreated', () => {
        requestFormModal.hide()
        requestsDataTable.ajax.reload()
        alertify.success('Request created successfully!')
    })
    Livewire.on('requestUpdated', () => {
        requestFormModal.hide();
        requestsDataTable.ajax.reload()
        alertify.success('Request updated successfully!')
    })
    Livewire.on('requestDeleted', () => {
        deleteRequestModal.hide()
        requestsDataTable.ajax.reload()
        alertify.success('Request deleted successfully!')
    })
})
