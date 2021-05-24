@extends('layout.main')

@section('title', 'ABATA | Profile')

@section('container')

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <img src="{{ url('/images/profile_picture/employee/'. Session::get('image')) }}" class="card-img-top" alt="...">
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$employee['name'] }}</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h5>Position : {{$employee->job->job_position }}</h5>
                </li>
                <li id="remarks-area" class="list-group-item">
                    <h5>Remarks : </h5>{{$employee['remarks'] }}
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline">Details </h3>
                <a href="{{ url('/setting') }}" class="btn btn-secondary btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Setting"><i class="fa fa-cog"></i></a>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="payroll-tab" data-toggle="tab" href="#payroll" role="tab" aria-controls="payroll" aria-selected="false">Payroll History</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    IC:<h5>{{$employee['ic'] }}</h5>

                                </li>
                                <li class="list-group-item">
                                    Phone Number:<h5>{{$employee['phonenumber'] }}</h5>

                                </li>
                                <li class="list-group-item">
                                    Email:<h5>{{$employee['email'] }}</h5>

                                </li>
                                <li class="list-group-item">
                                    Address:<h5>{{$employee['address'] }}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane" id="payroll" role="tabpanel" aria-labelledby="payroll-tab">
                        <div class="card-body">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Net Salary</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($payrolls->isNotEmpty())
                                    @foreach($payrolls as $payroll)
                                    <tr>
                                        <td>{{$payroll->payroll_month}}</td>
                                        <td>{{$payroll->net_salary}}</td>
                                        <td><span class="badge badge-secondary">{{$payroll->status}}</span></td>
                                        <td>
                                            <a href="{{ url('payroll/'.$payroll->id.'/'.Session::get('id')).'/view' }}" data-toggle="tooltip" data-placement="top" title="View" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                            @if($payroll->status != 'Pending')
                                            <a href="{{ url('payroll/'.$payroll->id.'/'.Session::get('id')).'/download' }}" data-toggle="tooltip" data-placement="top" title="Download" class="btn btn-danger btn-sm"><i class="fa fa-download"></i></a>
                                            <a href="{{ url('payroll/'.$payroll->id.'/'.Session::get('id')).'/print' }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Print" class="btn btn-default"><i class="fas fa-print"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="4" class="text-center">No record.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#myTable').DataTable();
    });
</script>
@endsection