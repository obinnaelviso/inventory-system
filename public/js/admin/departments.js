var departmentsDataTable, departmentDeleteModal, currentDepartmentId, submitDepartmentModal;
const departmentCreateBtn = $('.departmentCreateBtn')
const departmentFormModal = new bootstrap.Modal(document.getElementById('departmentFormModal'))

// Add Department
function addDepartment() {
    $('#departmentFormModalTitle').html('Add a new Department')
    departmentFormModal.show();
    Livewire.emit('newDepartment')
}

// Edit Department Item
function editDepartment(id) {
    $('#departmentFormModalTitle').html('Update Department')
    Livewire.emit('editDepartment', id)
}

function selectDepartment(id) {
    currentDepartmentId = id
}

function deleteDepartment() {
    Livewire.emit('deleteDepartment', currentDepartmentId)
}

function initializeTable() {
    const departmentsDataUrl = $('#departmentsTable').data('get-url');
    departmentDeleteModal = $('#departmentDeleteModal').length ? new bootstrap.Modal(document.getElementById('departmentDeleteModal')) : null

    departmentsDataTable = $('#departmentsTable').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: departmentsDataUrl,
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

    departmentCreateBtn.on('click', addDepartment);

    // Listen to livewire Department item events
    Livewire.on('departmentCreated', () => {
        departmentsDataTable.ajax.reload()
        departmentFormModal.hide()
        alertify.success('Department created successfully!')
    })
    Livewire.on('departmentUpdated', () => {
        departmentsDataTable.ajax.reload()
        departmentFormModal.hide()
        alertify.success('Department updated successfully!')
    })
    Livewire.on('departmentDeleted', () => {
        departmentsDataTable.ajax.reload()
        departmentDeleteModal.hide()
        alertify.success('Department deleted successfully!')
    })

    window.addEventListener('initialize-table', () => {
        initializeTable();
    })
})
