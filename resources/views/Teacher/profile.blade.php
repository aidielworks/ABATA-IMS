@extends('layout.mainTeacher')

@section('title', 'ABATA Teacher | Profile')

@section('container')

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <img src="{{ url('/images/profile_picture/teacher/'. Session::get('image')) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $teacher[0]['name'] }}</h5><br>
                <p>Join: {{ date_format($teacher[0]['created_at'], "d-M-Y") }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        IC:<h5>{{ $teacher[0]['ic'] }}</h5>

                    </li>
                    <li class=" list-group-item">
                        Phone Number:<h5>{{ $teacher[0]['phonenumber'] }}</h5>

                    </li>
                    <li class="list-group-item">
                        Email:<h5>{{ $teacher[0]['email'] }}</h5>

                    </li>
                    <li class="list-group-item">
                        Address:
                        <h5>
                            {{ $teacher[0]['houseNo'] }}
                            {{ $teacher[0]['streetName'] }}
                            {{ $teacher[0]['city'] }}
                            {{ $teacher[0]['zipcode'] }}
                            {{ $teacher[0]['state'] }}
                        </h5>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection