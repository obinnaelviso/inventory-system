var categoriesDataTable, categoryDeleteModal, currentCategoryId, submitCategoryModal;
const categoryCreateBtn = $('.categoryCreateBtn')
const categoryFormModal = new bootstrap.Modal(document.getElementById('categoryFormModal'))

// Add Category
function addCategory() {
    $('#categoryFormModalTitle').html('Add a new Category')
    categoryFormModal.show();
    Livewire.emit('newCategory')
}

// Edit Category Item
function editCategory(id) {
    $('#categoryFormModalTitle').html('Update Category')
    Livewire.emit('editCategory', id)
}

function selectCategory(id) {
    currentCategoryId = id
}

function deleteCategory() {
    Livewire.emit('deleteCategory', currentCategoryId)
}

function initializeTable() {
    const categoriesDataUrl = $('#categoriesTable').data('get-url');
    categoryDeleteModal = $('#categoryDeleteModal').length ? new bootstrap.Modal(document.getElementById('categoryDeleteModal')) : null

    categoriesDataTable = $('#categoriesTable').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: categoriesDataUrl,
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

    categoryCreateBtn.on('click', addCategory);

    // Listen to livewire category item events
    Livewire.on('categoryCreated', () => {
        categoriesDataTable.ajax.reload()
        categoryFormModal.hide()
        alertify.success('Category created successfully!')
    })
    Livewire.on('categoryUpdated', () => {
        categoriesDataTable.ajax.reload()
        categoryFormModal.hide()
        alertify.success('Category updated successfully!')
    })
    Livewire.on('categoryDeleted', () => {
        categoriesDataTable.ajax.reload()
        categoryDeleteModal.hide()
        alertify.success('Category deleted successfully!')
    })

    window.addEventListener('initialize-table', () => {
        initializeTable();
    })
})
