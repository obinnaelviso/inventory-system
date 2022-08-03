@extends('layouts.main')
@section('title', 'Reports - Low Stocks')
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
                                        <a href="{{ route('admin.low-stocks.generate-report', [
                                            'mode' => 'print',
                                        ]) }}"
                                            target="_blank" class="dropdown-item">Print</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.low-stocks.generate-report', [
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
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="reportsTable">
                                    <thead>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Category</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->item }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>{{ $product->qty }}</td>
                                                <td>{{ $product->unit }}</td>
                                                <td>{{ $product->category }}</td>
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
@push('js')
    <script>
        function exportTableToExcel() {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById("reportsTable");
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            var filename = "low-stocks" + new Date().getTime() + '.xls',

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
