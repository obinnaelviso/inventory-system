@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">@yield('title')</div>
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
                            <a href="{{ route('user.requests.index') }}" class="btn btn-secondary">
                                <i class='bx bx-message-error'></i>Requests</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('user.stocks.index') }}" class="btn btn-light">
                                <i class='bx bx-coin-stack'></i> New Stocks</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('user.purchasing.index') }}" class="btn btn-primary">
                                <i class='bx bx-extension'></i> Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
