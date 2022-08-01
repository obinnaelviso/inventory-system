const dateOptions = {
    'format' : 'mm/dd/yyyy'
}
var currentRequestId;
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

$(() => {
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
        alertify.success('Request created successfully!')
    })
    Livewire.on('requestUpdated', () => {
        requestFormModal.hide()
        alertify.success('Request updated successfully!')
    })
    Livewire.on('requestDeleted', () => {
        deleteRequestModal.hide()
        alertify.success('Request deleted successfully!')
    })
})
