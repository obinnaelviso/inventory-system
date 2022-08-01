const usersTable = $('#usersTable');
const dataUrl = usersTable.data('get-url');
const userCreateBtn = $('#userCreateBtn')
const userFormModal = new bootstrap.Modal(document.getElementById('userFormModal'))
const deleteUserModal = new bootstrap.Modal(document.getElementById('deleteUserModal'))
var currentUserId = null

const editUser = (id) => {
    $('#userFormModalTitle').html('Edit User')
    Livewire.emit('editUser', id)
    userFormModal.show();
}

const deleteUser = (id) => {
    currentUserId = id
    deleteUserModal.show();
}

const processDeleteUser = () => {
    $.ajax({
        url: `/admin/users/${currentUserId}`,
        type: 'DELETE',
        success: function (result) {
            deleteUserModal.hide()
            usersTable.DataTable().ajax.reload()
        }
    });
}

$(() => {
    userCreateBtn.on('click', () => {
        $('#userFormModalTitle').html('Create New User')
        Livewire.emit('newUser');
        userFormModal.show();
    });

    // Setup users datatable
    const usersDataTable = usersTable.DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: dataUrl,
            type: 'POST',
        },
        searchDelay: 500,
        order: [2, 'asc'],
        columns: [
            { name: 'first_name', data:'name' },
            { name: 'email', data:'email' },
            { name: 'role', data:'role', searchable: false, orderable: false },
            { name: 'created_at', data:'created_at', searchable: false },
            { name: 'action', data:'action', searchable: false, orderable: false },
        ],
        buttons: [ 'copy', 'excel', 'pdf', 'print'],
        initComplete: function() {
            this.api().buttons().container().addClass(' mt-3')
            this.api().buttons().container().appendTo('#usersTable_wrapper .col-md-6:eq(0)');
        }
    })

    // Reload table when user created,updated
    Livewire.on('userCreated', () => {
        usersDataTable.ajax.reload();
        alertify.success('New user created successfully!')
    })

    Livewire.on('userUpdated', () => {
        usersDataTable.ajax.reload();
        userFormModal.hide()
        alertify.success('User updated successfully!')
    })
})
