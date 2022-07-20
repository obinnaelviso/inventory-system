@extends('layouts.main')
@section('title', 'Departments')
@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">@yield('title')</div>
        <div class="ms-auto">
            <button class="btn btn-primary departmentCreateBtn">
                <i class="bx bx-list-ol"></i>Add New Department
            </button>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="page-class">
        <livewire:admin.departments-list />
    </div>
</div>
@endsection

@push('plugins')
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@livewireStyles
@endpush

@push('js')
@livewireScripts
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('js/admin/departments.js') }}"></script>
@endpush

@push('modals')
    <!-- New/Update Modal -->
    <div class="modal fade" id="departmentFormModal" tabindex="-1" aria-labelledby="departmentFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="departmentFormModalTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <livewire:admin.department-form />
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="departmentDeleteModal" tabindex="-1" aria-labelledby="departmentDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="departmentDeleteModalTitle">Delete Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this department?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Not yet</button>
                    <button type="button" class="btn btn-danger btn-sm" id="modalDeleteBtn" onclick="deleteDepartment();">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endpush
