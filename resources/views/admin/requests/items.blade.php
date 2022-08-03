@extends('layouts.main')
@section('title', 'Request Items')
@section('content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">@yield('title')</div>
            <div class="ms-auto">
                <button class="btn btn-primary requestItemCreateBtn">
                    <i class="bx bx-coin-stack"></i>Add New Item
                </button>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="page-class">
            <livewire:admin.request-items :request="$request" />
        </div>
    </div>
@endsection

@push('plugins')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <style>
        .search-item:hover {
            background-color: ghostwhite;
            width: 200px
        }
    </style>
    @livewireStyles
@endpush

@push('js')
    @livewireScripts
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/admin/requests-items.js') }}?555"></script>
@endpush

@push('modals')
    <!-- New/Update Modal -->
    <div class="modal fade" id="requestItemFormModal" tabindex="-1" aria-labelledby="requestItemFormModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestItemFormModalTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <livewire:admin.request-items-form :request="$request" :units="$units" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="requestItemDeleteModal" tabindex="-1" aria-labelledby="requestItemDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestItemDeleteModalTitle">Delete Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Not yet</button>
                    <button type="button" class="btn btn-danger btn-sm" id="modalDeleteBtn"
                        onclick="deleteItem();">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="markAsCompletedModal" tabindex="-1" aria-labelledby="markAsCompletedModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="markAsCompletedModalTitle">Mark Item as Complete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to mark this item as complete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Not yet</button>
                    <button type="button" class="btn btn-success btn-sm" id="modalMarkAsCompleteBtn"
                        onclick="markAsCompleted();">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="processRequestItemModal" tabindex="-1" aria-labelledby="processRequestItemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="processRequestItemModalTitle">Process Request Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to process this request item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Not yet</button>
                    <button type="button" class="btn btn-success btn-sm" id="modalMarkAsCompleteBtn"
                        onclick="processRequestItem();">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endpush
