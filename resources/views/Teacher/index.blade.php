@extends('layout.mainTeacher')

@section('title', 'ABATA Teacher| Dashboard')

@section('container')
<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ url('/images/profile_picture/teacher/'. Session::get('image')) }}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ session()->get('name') }}</h3>

                <p class="text-muted text-center">Teacher</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Registered: </b> <a class="float-right">{{ session()->get('registered') }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>No. of Students: </b> <a class="float-right">{{ count($student) }}</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                SP Forms Summary of {{ date("M") }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="info-box">
                            <div class="info-box-content text-center">
                                <span class="info-box-text">
                                    <input type="text" class="knob" data-readonly="true" value="{{ $submitted_spform }}" data-max="{{ count($student) * 4 }}" data-width="150" data-height="150">

                                </span>
                                <span class="info-box-number">
                                    SP Forms Submission
                                </span>
                            </div>
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col">
                        <div class="info-box">
                            <div class="info-box-content text-center">
                                <span class="info-box-text">
                                    <input type="text" class="knob" data-readonly="true" value="{{$approved_spform}}" data-max="{{ $submitted_spform }}" data-width="150" data-height="150" data-fgColor="#28a745">
                                </span>
                                <span class="info-box-number">
                                    Approved SP Form(s)
                                </span>
                            </div>
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col">
                        <div class="info-box">
                            <div class="info-box-content text-center">
                                <span class="info-box-text">
                                    <input type="text" class="knob" data-readonly="true" value="{{ $pending_spform }}" data-max="{{ count($student) * 4 }}" data-width="150" data-height="150" data-fgColor="#ffc107">

                                </span>
                                <span class="info-box-number">
                                    Pending SP Form(s)
                                </span>
                            </div>
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col">
                        <div class="info-box">
                            <div class="info-box-content text-center">
                                <span class="info-box-text">
                                    <input type="text" class="knob" data-readonly="true" value="{{$declined_spform}}" data-max="{{ $submitted_spform }}" data-width="150" data-height="150" data-fgColor="#dc3545">
                                </span>
                                <span class="info-box-number">
                                    Declined SP Form(s)
                                </span>
                            </div>
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                List of Students
            </div>
            <div class="card-body">
                <table id="table_id" class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $student as $stud)
                        <tr>
                            <td>{{ $stud->name}}</td>
                            <td>{{ $stud->phonenumber}}</td>
                            <td><a href="#" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#table_id').DataTable();

        $(".knob").knob();
    });
</script>
@endsection