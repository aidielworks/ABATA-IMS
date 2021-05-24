@extends('layout.mainStudent')

@section('title', 'ABATA Student | Dashboard')

@section('container')
<div class="card card-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-info">
        <h3 class="widget-user-username">{{ $student->name }}</h3>
        <h5 class="widget-user-desc">Student</h5>
    </div>
    <div class="widget-user-image">
        <img class="img-circle elevation-2" src="{{ url('/images/profile_picture/student/'. Session::get('image')) }}" alt="User Avatar">
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col border-right">
                <div class="description-block">
                    <h5 class="description-header">Date Join</h5>
                    <span class="description-text">{{ date("d M Y", strtotime($student->created_at)) }}</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col">
                <div class="description-block">
                    <h5 class="description-header">Teacher</h5>
                    <span class="description-text">{{ $student->teachers->name }}</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</div>
<div class="container">
    <div class="row text-center">
        <div class="col">
            <a href="{{ url('/students/books') }}" class="btn btn-outline-primary mr-4">
                <i class="fas fa-book " style="font-size: 15em;"></i>
                <div class="mt-2 text-center">Module ABATA</div>
            </a>
        </div>
        <div class="col">
            <a href="{{ url('/students/spforms') }}" class="btn btn-outline-secondary mr-4">
                <i class="fas fa-sticky-note" style="font-size: 15em;"></i>
                <div class="mt-2 text-center">Performance Form</div>
            </a>
        </div>
        <div class="col">
            <a href="{{ url('/students/receipt') }}" class="btn btn-outline-success mr-4">
                <i class="fas fa-file-invoice" style="font-size: 15em;"></i>
                <div class="mt-2 text-center">Receipt History</div>
            </a>
        </div>
    </div>
</div>

@endsection