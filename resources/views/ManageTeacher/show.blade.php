@extends('layout.main')

@section('title', 'ABATA | Teachers Details')

@section('container')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="/teacher">List of Teacher</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$teacher->name}}'s Profile</li>
    </ol>
</nav>

<h3>Teacher Details</h3>

<div class="row">
    <div class="col-3">
        <div class="card">
            <img src="{{ url('/images/avatar5.png') }}" class="card-img-top" alt="{{ $teacher->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $teacher->name }}</h5>
                <p class="card-text">Registered: {{ date_format($teacher->created_at, "d-M-Y") }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    No. of Students: {{ count($student) }}
                </li>
            </ul>

        </div>
    </div>
    <div class="col-8">
        <div class="mb-2">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-caret-square-left mr-2"></i>Back</a <div class="card">
            <div class="float-right">
                <a href="{{ $teacher->id }}/edit" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                @if(Session::get('role') == 1)
                <form id="form" action="{{ $teacher->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger delete-button"><i class="far fa-trash-alt"></i></button>
                </form>
                @endif
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <h5>Details</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item">
                        <h5>IC</h5>
                        {{ $teacher->ic }}
                    </li>
                    <li class="list-group-item">
                        <h5>Phone Number</h5>
                        {{ $teacher->phonenumber }}
                    </li>
                    <li class="list-group-item">
                        <h5>Email</h5>
                        {{ $teacher->email }}
                    </li>
                    <li class="list-group-item">
                        <h5>Address</h5>
                        {{ $teacher->houseNo }},
                        {{ $teacher->streetName }},
                        {{ $teacher->city }},
                        {{ $teacher->zipcode }},
                        {{ $teacher->state }}
                    </li>
                    <li class="list-group-item">
                        <h5><b>Bank Details </b></h5>
                        Bank Name: {{ $teacher->bank_name }} <br>
                        Bank Acc No.: {{ $teacher->bank_acc_no }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-warning">
                {{ $teacher->name }}'s Students
            </div>
            <div class="card-body">
                <table id="table_id" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student as $stud)
                        <tr class='clickable-row' data-href="{{ url('/student/' . $stud->id) }}" data-toggle="tooltip" title="Click to view profile!">
                            <td>{{ $stud->name }}</td>
                            <td>{{ $stud->phonenumber }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="flashData" data-flashdata-type="{{ session('status') }}"></div>
<!-- myScript -->
<script src="{{ asset('plugin/myscript.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();

        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    })
</script>
@endsection