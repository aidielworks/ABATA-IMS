@extends('layout.main')

@section('title', 'ABATA | Edit Teacher Payroll')

@section('container')

<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-globe"></i> ABATA Resources
                <small class="float-right">Date: {{date_format($teacherPayroll->created_at,"d/m/Y")}}</small>
                @if($teacherPayroll->status == 'Pending')
                <span class="badge badge-warning">{{$teacherPayroll->status}}</span>
                @else
                <span class="badge badge-success">{{$teacherPayroll->status}}</span>
                @endif
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>ABATA Resources</strong><br>
                8-1, Jln Sg Rasau E 32/E, <br>
                Berjaya Park, 40460 Shah Alam, Selangor<br>
                <b>Phone:</b> 03 9543 5533<br>
                <b>Email:</b> abataresouces@abata.com
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>{{$teacherPayroll->teacher[0]['name']}}</strong><br>
                {{$teacherPayroll->teacher[0]['houseNo']}}, {{$teacherPayroll->teacher[0]['streetName']}}<br>
                {{$teacherPayroll->teacher[0]['city']}}, {{$teacherPayroll->teacher[0]['zipcode']}}, {{$teacherPayroll->teacher[0]['state']}}<br>
                <b>Phone:</b> {{$teacherPayroll->teacher[0]['phonenumber']}}<br>
                <b>Email:</b> {{$teacherPayroll->teacher[0]['email']}}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Reference No:</b> {{$teacherPayroll->reference_no}}<br>
            <b>Bank Account:</b> {{$teacherPayroll->teacher[0]['bank_acc_no']}}<br>
            <b>Month of Salary:</b> {{date('F', mktime(0, 0, 0, $teacherPayroll->payroll_month, 1))}}
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th>No of Student</th>
                        <th>Rate per Student</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{$student_count}}</td>
                        <td>RM80</td>
                        <td>RM{{ $student_count * 80 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
        </div>
        <!-- /.col -->
        <div class="col-6">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Net Salary:</th>
                            <td>RM {{$teacherPayroll->net_salary}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-12">
            <a href="{{ url('/teacher/payroll') }}" class="btn btn-default"><i class="fas fa-chevron-circle-left"></i> Back</a>
            @if($teacherPayroll->status != 'Pending')
            <a href="{{ url('/teacher/payroll/'.$teacherPayroll->id.'/download') }}" class="btn btn-primary float-right"><i class="fas fa-download"></i> Generate PDF</a>
            @else
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-default float-right" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-edit"></i> Update Status</a>
            </button>
            @endif
        </div>
    </div>
</div>

@if($teacherPayroll->status == 'Pending')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ url('/teacher/payroll/'.$teacherPayroll->id) }}" method="POST">
                @method('patch')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>
                        Are you sure to approve this payroll?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection