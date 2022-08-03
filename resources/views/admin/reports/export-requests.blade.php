@extends('layouts.print')
@section('title', $title)
@section('content')

    <div class="page-content" id="page-content" style="font-size: 18px">
        <div class="row mb-3 border-bottom">
            <div class="col-6 mt-5 p-3">
                <h4>
                    {{ $title }}
                </h4>
            </div>
            <div class="col-6 text-end pt-5">
                DATE: <strong>{{ now()->toDateString() }}</strong>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 p-2">
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style type="text/css" media="print">
        @page {
            size: landscape;
            margin: 20px;
        }
    </style>
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            exportDocument("{{ Request::get('mode') }}");
        });

        function exportDocument(mode) {
            if (mode == 'pdf') {
                generatePdf();
            } else if (mode == 'print') {
                window.print();
            }
        }

        function generatePdf() {
            var element = document.getElementById('page-content');
            element.style.width = '100%';
            element.style.height = '100%';

            var opt = {
                margin: 0.1,
                filename: "{{ str_replace(' ', '-', strtolower($title)) }}" + new Date().getTime() + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A4',
                    orientation: 'landscape'
                }
            }

            html2pdf().set(opt).from(element).save();
        }
    </script>
@endpush
