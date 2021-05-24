@extends('layout.mainStudent')

@section('title', 'ABATA Student | Receipt ')

@section('container')

<div class="card ">
    <div class="card-header bg-warning text-white">
        Payment History
    </div>
    <div class="card-body">
        <table id="table_receipt" class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Receipt No</th>
                    <th scope="col">Receipt Total (RM)</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($receipts as $receipt)
                <tr>

                    <td>{{ $receipt->receipt_no }}</td>
                    <td>{{ $receipt->receipt_total }}</td>
                    <td>{{ $receipt->receipt_date }}</td>
                    <td><a href="/students/receipt/{{$receipt->id}}" class="btn btn-outline-primary"><i class="fa fa-eye"></i></a></td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table_receipt').DataTable();
    });
</script>
@endsection