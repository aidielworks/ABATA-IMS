@extends('layout.mainTeacher')

@section('title', 'ABATA Teacher | Payment History')

@section('container')

<div class="card border-success">
    <div class="card-header text-white">
        Payroll Details
    </div>
    <div class="card-body">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> ABATA Resources
                        <small class="float-right">Date: {{date_format($payrolls->created_at,"d/m/Y")}}</small>
                        @if($payrolls->status == 'Pending')
                        <span class="badge badge-warning">{{$payrolls->status}}</span>
                        @else
                        <span class="badge badge-success">{{$payrolls->status}}</span>
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
                        <strong>{{$payrolls->teacher[0]['name']}}</strong><br>
                        {{$payrolls->teacher[0]['houseNo']}}, {{$payrolls->teacher[0]['streetName']}}<br>
                        {{$payrolls->teacher[0]['city']}}, {{$payrolls->teacher[0]['zipcode']}}, {{$payrolls->teacher[0]['state']}}<br>
                        <b>Phone:</b> {{$payrolls->teacher[0]['phonenumber']}}<br>
                        <b>Email:</b> {{$payrolls->teacher[0]['email']}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Reference No:</b> {{$payrolls->reference_no}}<br>
                    <b>Bank Account:</b> {{$payrolls->teacher[0]['bank_acc_no']}}<br>
                    <b>Month of Salary:</b> {{date('F', mktime(0, 0, 0, $payrolls->payroll_month, 1))}}
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
                                <td>{{ $payrolls->no_of_student }}</td>
                                <td>RM80</td>
                                <td>RM{{ $payrolls->no_of_student * $payrolls->rate_per_student }}</td>
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
                                    <td>RM {{$payrolls->net_salary}}</td>
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
                    <a href="{{ url('/teachers/payroll-history') }}" class="btn btn-default"><i class="fas fa-chevron-circle-left"></i> Back</a>
                    @if($payrolls->status != 'Pending')
                    <a href="{{ url('/teacher/payroll/'.$payrolls->id.'/download') }}" class="btn btn-primary float-right"><i class="fas fa-download"></i> Generate PDF</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>
@endsection