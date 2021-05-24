@extends('layout.main')

@section('title', 'ABATA | My Payroll')
@section('container')

<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-globe"></i> ABATA Resources
                <small class="float-right">Date: {{date_format($payroll->created_at,"d/m/Y")}}</small>
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <table class="table table-sm table-borderless">
                <tbody>
                    <tr>
                        <td><b>Name</b></td>
                        <td>: {{$employee->name}}</td>
                    </tr>
                    <tr>
                        <td><b>Address</b></td>
                        <td>
                            : {{$employee->address}},<br>
                            {{$employee->city}},<br>
                            {{$employee->zipcode}},<br>
                            {{$employee->state}},<br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <table class="table table-borderless table-sm">
                <tbody>
                    <tr>
                        <td><b>Position</b></td>
                        <td>: {{$employee->job->job_position}}</td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td>: {{$employee->email}}</td>
                    </tr>
                    <tr>
                        <td><b>Phone Number</b></td>
                        <td>: {{$employee->phonenumber}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Reference No. </b>{{$payroll->reference_no}}<br>
            <b>Status:</b>
            @if($payroll->status == 'Paid')
            <span class="badge badge-success">{{$payroll->status}}</span>
            @elseif($payroll->status == 'Pending')
            <span class="badge badge-warning">{{$payroll->status}}</span>
            @endif
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <h3 class="text-center">Month of Salary: {{$payroll->payroll_month}}</h3>
    <!-- Table row -->
    <div class="row">
        <div class="col-6 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Allowances Item</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                @if(empty($payroll->allowances))
                <tbody>
                    @foreach($payroll->allowances as $key => $allowance)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $allowance->allowance_item }}</td>
                        <td>{{ $allowance->allowance_amount }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-right">
                            <h5><b>Total</b></h5>
                        </td>
                        <td>{{ $payroll->total_allowances }}</td>
                    </tr>
                </tfoot>
                @else
                <tr>
                    <td colspan="3" class="text-center">No allowance.</td>
                </tr>
                @endif
            </table>
        </div>
        <!-- /.col -->
        <div class="col-6 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Deductions Item</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                @if(empty($payroll->deductions))
                <tbody>
                    @foreach($payroll->deductions as $key => $deduction)
                    <tr>
                        <td>1</td>
                        <td>Call of Duty</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-right">Total</td>
                        <td>{{ $payroll->total_deductions }}</td>
                    </tr>
                </tfoot>
                @else
                <tr>
                    <td colspan="3" class="text-center">No deduction.</td>
                </tr>
                @endif
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
                            <th style="width:50%">Basic Salary:</th>
                            <td>RM {{ $payroll->basic_salary }}</td>
                        </tr>
                        <tr>
                            <th>Tax (9.5%)</th>
                            <td>RM {{ $payroll->income_tax }}</td>
                        </tr>
                        <tr>
                            <th>Net Salary:</th>
                            <td>RM {{ $payroll->net_salary }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <hr>
    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-12">
            <a href="{{ url('payroll/'.$payroll->id.'/'.Session::get('id')).'/print' }}" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>
        </div>
    </div>
</div>

@endsection