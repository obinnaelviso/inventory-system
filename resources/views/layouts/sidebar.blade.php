<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="m-auto">
            {{-- <h5 class="logo-text">{{ config('app.name') }}</h5> --}}
            <img class="img-fluid" src="{{ asset('assets/images/logo.jpg') }}" width="80" />
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if (auth()->user()->is_admin)
            @include('layouts.sidebar.admin')
        @else
            @include('layouts.sidebar.user')
        @endif
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
