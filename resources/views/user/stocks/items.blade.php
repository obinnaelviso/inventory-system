@extends('layouts.main')
@section('title', 'Stock Items')
@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">@yield('title')</div>
        <div class="ms-auto">
            <button class="btn btn-primary stockItemCreateBtn">
                <i class="bx bx-coin-stack"></i>Add New Item
            </button>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="page-class">
        <livewire:admin.stock-items :stock="$stock"/>
    </div>
</div>
@endsection

@push('plugins')
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<style>
    .search-item:hover {
        background-color: ghostwhite;
    }
</style>
@livewireStyles
@endpush

@push('js')
@livewireScripts
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('js/user/stocks-items.js') }}"></script>
@endpush

@push('modals')
    <!-- New/Update Modal -->
    <div class="modal fade" id="stockItemFormModal" tabindex="-1" aria-labelledby="stockItemFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="stockItemFormModalTitle">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <livewire:admin.stock-items-form :stock="$stock" :units="$units" :categories="$categories" />
            </div>
        </div>
        </div>
    </div>
@endpush
