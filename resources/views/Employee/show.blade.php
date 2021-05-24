@extends('layout.main')

@section('title', 'ABATA | Employees Details')

@section('container')

<h3>Employee Details</h3>

<div class="row">
    <div class="col-3">
        <div class="card">
            <img src="{{ url('/images/avatar5.png') }}" class="card-img-top" alt="{{ $employee->name }}">
            <div class="card-body">
                <h5 class="card-title"><b>{{ $employee->name }}</b></h5>
                <p class="card-text">{{ $employee->job->job_position }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h5>Remark</h5>
                </li>
                <li class="list-group-item">
                    {{ ($employee->remark != '') ? $employee->remark : 'None'}}
                </li>
            </ul>
        </div>
    </div>
    <div class="col-8">
        <div class="mb-2">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-caret-square-left mr-2"></i>Back</a <div class="card">
            <div class="float-right">
                <a href="{{ $employee->id }}/edit" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                <form id="form" action="{{ $employee->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger delete-button"><i class="far fa-trash-alt"></i></button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Details</h5>
            </div>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item">
                    <h5><b>IC </b></h5>
                    {{ $employee->ic }}
                </li>
                <li class="list-group-item">
                    <h5><b>Phone Number </b></h5>
                    {{ $employee->phonenumber }}
                </li>
                <li class="list-group-item">
                    <h5><b>Email </b></h5>
                    {{ $employee->email }}
                </li>
                <li class="list-group-item">
                    <h5><b>Address </b></h5>
                    {{ $employee->address }},
                    {{ $employee->city }},
                    {{ $employee->zipcode }},
                    {{ $employee->state }}
                </li>
                <li class="list-group-item">
                    <h5><b>Bank Details </b></h5>
                    Bank Name: {{ $employee->bank_name }} <br>
                    Bank Acc No.: {{ $employee->bank_acc_no }}
                </li>
            </ul>

        </div>
    </div>
</div>
@endsection