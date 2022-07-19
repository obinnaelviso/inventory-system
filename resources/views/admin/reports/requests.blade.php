@extends('layouts.main')
@section('title', "Reports - $title")
@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">@yield('title')</div>
    </div>
    <!--end breadcrumb-->

    <div class="page-class">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div>Per department/office</div>
                        <form action="{{ Request::url() }}">
                            <select class="form-control" id="dept" name="dept" onchange="this.form.submit()">
                                <option value="" @if(Request::get('dept') == "") selected @endif>All</option>
                                @foreach ($depts as $dept)
                                    <option value="{{ $dept }}" @if(Request::get('dept') == $dept) selected @endif>{{ $dept }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>User</th>
                                    <th>Name</th>
                                    <th>Dept</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Date</th>
                                    <th>Creation Date</th>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>{{ $request->request->user->name }}</td>
                                            <td>{{ $request->request->name }}</td>
                                            <td>{{ $request->request->dept }}</td>
                                            <td>{{ $request->item }}</td>
                                            <td>{{ $request->description }}</td>
                                            <td>{{ $request->qty }}</td>
                                            <td>{{ $request->unit }}</td>
                                            <td>{{ $request->request->date }}</td>
                                            <td>{{ $request->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
