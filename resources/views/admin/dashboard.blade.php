@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <h3>@yield('title')</h3>
        </div>
        <!--end breadcrumb-->

        <div class="page-class">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-12 border-bottom">
                            <h4>Quick Links</h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.requests.index') }}" class="btn btn-secondary">
                                <i class='bx bx-message-error'></i> New Requests</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.stocks.index') }}" class="btn btn-primary">
                                <i class='bx bx-coin-stack'></i> New Stocks</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.purchasing.index') }}" class="btn btn-info">
                                <i class='bx bx-extension'></i> Stock Management</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.reports.accomplished-requests') }}" class="btn btn-success"><i
                                    class="bx bx-note"></i>Report: Accomplished Requests</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.reports.pending-requests') }}" class="btn btn-warning">
                                <i class="bx bx-note"></i>Report: Pending Requests</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.reports.low-stocks') }}" class="btn btn-danger">
                                <i class="bx bx-note"></i>Report: Low Stocks</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                                <i class='bx bx-user-circle'></i> User Management</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
