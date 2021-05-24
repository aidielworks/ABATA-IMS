@extends('layout.main')

@section('title', 'ABATA | Receipt')

@section('container')


<div class="card">
    <div class="card-header">
        <h4>Receipt<a href="{{ url('/admin/receipt/create') }}" class="btn btn-sm btn-primary ml-2"><i class="far fa-plus-square mr-1"></i>New Receipt</a></h4>
    </div>
    <div class="card-body">
        <table class="table" id="table_id">
            <thead>
                <tr>
                    <th>Receipt No</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($receipt as $data)
                <tr>
                    <td>{{ $data->receipt_no }}</td>
                    <td>{{ $data->receipt_name }}</td>
                    <td>{{ $data->receipt_date }}</td>
                    <td>
                        <a href="/admin/receipt/{{$data->id}}" class="btn btn-outline-primary btn-sm"><i class="far fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>
@endsection