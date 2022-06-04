const dateOptions = {
    'format' : 'mm/dd/yyyy'
}
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

$(() => {
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
    })
    Livewire.on('requestUpdated', () => {
        requestFormModal.hide()
    })
})
