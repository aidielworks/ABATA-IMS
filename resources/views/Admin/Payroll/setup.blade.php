@extends('layout.main')

@section('title', 'ABATA | Payroll')
@section('container')
<div class="row justify-content-center">
    <div class="col-12 col-sm-6 col-md-4">
        <div class="card bg-light">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b>{{ $employee->name }}</b></h2>
                        <p class="text-muted text-sm"><b>Position: </b> {{ $employee->job->job_position }}</p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{ $employee->address }},
                                {{ $employee->city }},
                                {{ $employee->zipcode }},
                                {{ $employee->state }}
                            </li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: {{ $employee->phonenumber }}</li>
                        </ul>
                    </div>
                    <div class="col-5 text-center">
                        <img src="{{ url('images/avatar5.png') }}" alt="" class="img-circle img-fluid" style="max-height: 150px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<livewire:payroll-employee-setup :employee="$employee">

    @endsection