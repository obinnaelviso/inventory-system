var unitsDataTable, unitDeleteModal, currentUnitId, submitUnitModal;
const unitCreateBtn = $('.unitCreateBtn')
const unitFormModal = new bootstrap.Modal(document.getElementById('unitFormModal'))

// Add Unit
function addUnit() {
    $('#unitFormModalTitle').html('Add a new Unit')
    unitFormModal.show();
    Livewire.emit('newUnit')
}

// Edit Unit Item
function editUnit(id) {
    $('#unitFormModalTitle').html('Update Unit')
    Livewire.emit('editUnit', id)
}

function selectUnit(id) {
    currentUnitId = id
}

function deleteUnit() {
    Livewire.emit('deleteUnit', currentUnitId)
}

function initializeTable() {
    const unitsDataUrl = $('#unitsTable').data('get-url');
    unitDeleteModal = $('#unitDeleteModal').length ? new bootstrap.Modal(document.getElementById('unitDeleteModal')) : null

    unitsDataTable = $('#unitsTable').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: unitsDataUrl,
            type: 'POST',
        },
        order: [0, 'desc'],
        columns: [
            { name: 'title', data: 'title' },
            { name: 'action', data: 'action', searchable: false, orderable: false },
        ]
    })
}
$(() => {
    initializeTable();

    unitCreateBtn.on('click', addUnit);

    // Listen to livewire unit item events
    Livewire.on('unitCreated', () => {
        unitsDataTable.ajax.reload()
        unitFormModal.hide()
        alertify.success('Unit created successfully!')
    })
    Livewire.on('unitUpdated', () => {
        unitsDataTable.ajax.reload()
        unitFormModal.hide()
        alertify.success('Unit updated successfully!')
    })
    Livewire.on('unitDeleted', () => {
        unitsDataTable.ajax.reload()
        unitDeleteModal.hide()
        alertify.success('Unit deleted successfully!')
    })

    window.addEventListener('initialize-table', () => {
        initializeTable();
    })
})
