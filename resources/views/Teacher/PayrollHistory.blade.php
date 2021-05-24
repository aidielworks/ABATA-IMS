@extends('layout.mainTeacher')

@section('title', 'ABATA Teacher | Payment History')

@section('container')

<div class="card border-success">
    <div class="card-header">
        Payroll History
    </div>
    <div class="card-body">
        <table id="table_id" class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Month</th>
                    <th scope="col">Amount (RM)</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($payrolls as $key => $payroll)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{date('F', mktime(0, 0, 0, $payroll->payroll_month, 1))  }}</td>
                    <td>{{ $payroll->net_salary }}</td>
                    <td>
                        @if($payroll->status == 'Pending')
                        <span class="badge badge-warning">{{$payroll->status}}</span>
                        @else
                        <span class="badge badge-success">{{$payroll->status}}</span>
                        @endif
                    </td>
                    <td><a href="{{ url('/teachers/payroll-history/'.$payroll->id) }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="View"><i class="fas fa-eye"></i></a></td>
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