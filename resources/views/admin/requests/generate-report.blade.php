@extends('layouts.print')
@section('title', 'Request Items')
@section('content')

<div class="page-content" style="font-size: 18px">
    <div class="row mb-3 border-bottom">
        <div class="col-6 mt-5 p-3">
            <h1>
                Request Report
            </h1>
        </div>
        <div class="col-6 text-end pt-5">
            DATE: <strong>{{ $request->created_at->toDateString() }}</strong>
        </div>
    </div>
    <div class="row g-3 mb-3 border-bottom pb-3">
        <div class="col-12 text-primary">
            NAME: <strong class="text-dark">{{ $request->name }}</strong>
        </div>
        <div class="col-12 text-primary">
            DEPARTMENT: <strong class="text-dark">{{ $request->dept }}</strong>
        </div>
        <div class="col-12 text-primary">
            DATE: <strong class="text-dark">{{ $request->date }}</strong>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12p-2">
            <table class="table table-bordered w-100">
                <thead>
                    <tr>
                        <th>SL#</th>
                        <th>ITEM CODE</th>
                        <th>DESCRIPTION</th>
                        <th>QUANTITY</th>
                        <th>UNIT</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->item }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->status->title }}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
