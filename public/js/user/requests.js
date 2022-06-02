
const requestCreateBtn = $('#requestCreateBtn')
const requestFormModal = new bootstrap.Modal(document.getElementById('requestFormModal'))
const deleteRequestModal = new bootstrap.Modal(document.getElementById('deleteRequestModal'))

$(() => {
    requestCreateBtn.on('click', () => {
        $('#requestFormModalTitle').html('Create New Request')
        Livewire.emit('newRequest');
        requestFormModal.show();
    })
})
