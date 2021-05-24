@extends('layout.main')

@section('title', 'ABATA | students Details')

@section('container')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="/student">List of student</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$student->name}}'s Profile</li>
    </ol>
</nav>

<h3>Student Details</h3>

<div class="row">
    <div class="col-3">
        <div class="card">
            <img src="{{ url('/images/avatar5.png') }}" class="card-img-top" alt="{{ $student->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $student->name }}</h5>
                <p class="card-text">Registered: {{ date_format($student->created_at, "d-M-Y") }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Teacher:
                    @if (sizeof($teacher) == null)
                    <!-- Button trigger modal -->
                    <a href="#" class="text-danger" data-toggle="modal" data-target="#exampleModal" id="search_teacher">
                        Not assign yet.
                    </a>
                    @else
                    @foreach($teacher as $teach)
                    <a href="{{ url('/teacher/ '.$teach->id) }}">{{$teach->name}}</a>
                    @endforeach
                    @endif

                </li>
            </ul>

        </div>
    </div>
    <div class="col-8">
        <div class="mb-2">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-caret-square-left mr-2"></i>Back</a <div class="card">
            <div class="float-right">
                <a href="{{ $student->id }}/edit" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                @if(Session::get('role') == 1)
                <form id="form" action="{{ $student->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger delete-button"><i class="far fa-trash-alt"></i></button>
                </form>
                @endif
            </div>
        </div>
        <div class="card-header">
            <h5>Details</h5>
        </div>
        <ul class="list-group list-group-flush mb-3">
            <li class="list-group-item">
                <h5>IC</h5>
                {{ $student->ic }}
            </li>
            <li class="list-group-item">
                <h5>Phone Number</h5>
                {{ $student->phonenumber }}
            </li>
            <li class="list-group-item">
                <h5>Email</h5>
                {{ $student->email }}
            </li>
            <li class="list-group-item">
                <h5>Address</h5>
                {{ $student->houseNo }},
                {{ $student->streetName }},
                {{ $student->city }},
                {{ $student->zipcode }},
                {{ $student->state }}
            </li>
            <li class="list-group-item">
                <h5><b>Bank Details </b></h5>
                Bank Name: {{ $student->bank_name }} <br>
                Bank Acc No.: {{ $student->bank_acc_no }}
            </li>
        </ul>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form method="POST" action="/student/{{ $student->id }}">
            @method('patch')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="showTeacher">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="assign_teacher">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        var houseNo = "{{ $student->houseNo }}";
        var streetName = "{{ $student->streetName }}";
        var city = "{{ $student->city }}";
        var zipcode = "{{ $student->zipcode }}";
        var state = "{{ $student->state }}";

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        function findTeacher() {

            $.ajax({
                url: "{{ url('/findTeacher') }}",
                method: "POST",
                data: {
                    houseNo: houseNo,
                    streetName: streetName,
                    city: city,
                    zipcode: zipcode,
                    state: state
                },
                success: function(data) {
                    console.log(data.success);
                    if (data.success != "") {
                        $('#showTeacher').html(data.success);
                    } else {
                        $('#showTeacher').html("<div class='alert alert-danger' role='alert'>No teacher nearby</div>");
                    }


                    $('#lat').val(data.lat);
                    $('#lng').val(data.lng);
                }
            });
        }

        $('#search_teacher').on('click', function() {
            findTeacher();
        });

    });
</script>
@endsection