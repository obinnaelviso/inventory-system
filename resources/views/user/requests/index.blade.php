@extends('layouts.main')
@section('title', 'Requests')
@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><i class="bx bx-message-error"></i> @yield('title')</div>
        <div class="ms-auto">
            <button class="btn btn-primary requestCreateBtn">
                <i class="bx bx-message-error"></i> New Request
            </button>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="page-class">
        <livewire:user.requests.index />
    </div>
</div>
@endsection

@push('plugins')
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css'>
@livewireStyles
@endpush

@push('js')
@livewireScripts
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js'></script>
<script src="{{ asset('js/user/requests.js') }}"></script>
<script src="{{ asset('js/user/request-items.js') }}"></script>
@endpush

@push('modals')
    <!-- New/Update Modal -->
    <div class="modal fade" id="requestFormModal" tabindex="-1" aria-labelledby="userFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="requestFormModalTitle">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <livewire:user.requests.request-form />
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="deleteRequestModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalTitle">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this request?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Not yet</button>
                    <button type="button" class="btn btn-danger btn-sm" id="modalDeleteBtn" onclick="deleteRequest();">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endpush
