@extends('layouts.preview-pdf')
@section('title', 'Request Items Document')
@section('content')
    <table class="mb-30">
        <tbody>
            <tr>
                <td style="padding-left: 0">Requester:</td>
                <td>{{ $request->name }}</td>
            </tr>
            <tr>
                <td style="padding-left: 0">Department:</td>
                <td>{{ $request->dept }}</td>
            </tr>
        </tbody>
    </table>
    <table border="1" class="mb-30 text-left">
        <thead>
            <tr>
                <th>SL#</th>
                <th>Item</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Unit</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requestItems as $requestItem)
                <tr>
                    <td>{{ $requestItem->id }}</td>
                    <td>{{ $requestItem->item }}</td>
                    <td>{{ $requestItem->description }}</td>
                    <td>{{ $requestItem->qty }}</td>
                    <td>{{ $requestItem->unit }}</td>
                    <td>{{ $requestItem->status->title }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mb-50"><strong>Received By</strong></div>
    <div class="signature-line mb-10"></div>
    <div class="mb-50">(print name)</div>
    <div class="signature-line mb-10"></div>
    <div class="mb-50">(signature)</div>
    <div class="signature-line mb-10"></div>
    <div class="mb-50">(date)</div>
@endsection

@push('js')
<script>
$(() => {
    window.print();
})
</script>
@endpush
