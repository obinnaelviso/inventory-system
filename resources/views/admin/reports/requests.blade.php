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
                        <div class="col-12">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bx bx-export"></i>Export
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('admin.requests.generate-report', [
                                            'title' => $title,
                                            'dept' => Request::get('dept'),
                                            'start_date' => Request::get('start_date'),
                                            'end_date' => Request::get('end_date'),
                                            'mode' => 'print',
                                        ]) }}"
                                            target="_blank" class="dropdown-item">Print</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.requests.generate-report', [
                                            'title' => $title,
                                            'dept' => Request::get('dept'),
                                            'start_date' => Request::get('start_date'),
                                            'end_date' => Request::get('end_date'),
                                            'mode' => 'pdf',
                                        ]) }}"
                                            target="_blank" class="dropdown-item">PDF</a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="exportTableToExcel()" class="dropdown-item">Excel</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <form class="row mb-3" action="{{ Request::url() }}">
                        <div class="col-md-3">
                            <div>Per department/office</div>
                            <select class="form-control" id="dept" name="dept" onchange="this.form.submit()">
                                <option value="" @if (Request::get('dept') == '') selected @endif>All</option>
                                @foreach ($depts as $dept)
                                    <option value="{{ $dept->title }}" @if (Request::get('dept') == $dept->title) selected @endif>
                                        {{ $dept->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div>Start Date</div>
                            <input type="text" class="form-control" id="startDate" name="start_date"
                                value="{{ Request::get('start_date') }}">
                        </div>
                        <div class="col-md-3">
                            <div>End Date</div>
                            <input type="text" class="form-control" id="endDate" name="end_date"
                                value="{{ Request::get('end_date') }}">
                        </div>
                        <div class="col-md-3">
                            <div>&nbsp;</div>
                            <button class="btn btn-primary">Apply</button>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="reportsTable">
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

@push('plugins')
    <link rel='stylesheet' href="{{ asset('assets/plugins/vanillajs-datepicker/css/datepicker.min.css') }}" />
@endpush
@push('js')
    <script src="{{ asset('assets/plugins/vanillajs-datepicker/js/datepicker-full.min.js') }}"></script>
    <script>
        const dateOptions = {
            'format': 'mm/dd/yyyy'
        }
        const startDateInput = document.getElementById('startDate')
        const endDateInput = document.getElementById('endDate')
        const startDateDp = new Datepicker(startDateInput, dateOptions)
        const endDateDp = new Datepicker(endDateInput, dateOptions)

        function exportTableToExcel() {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById("reportsTable");
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            var filename = "{{ str_replace(' ', '-', strtolower($title)) }}" + new Date().getTime() + '.xls',

                // Create download link element
                downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }
    </script>
@endpush
