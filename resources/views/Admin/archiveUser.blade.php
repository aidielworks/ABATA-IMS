@extends('layout.main')

@section('title', 'ABATA | Archive User')

@section('container')
<div class="card border-primary">
    <div class="card-header d-flex align-items-start">
        <h3>Archive Employee</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table_id">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $archiveEmployee as $emp)
                <tr>
                    <td>{{ $emp->name }}</td>
                    <td>{{ $emp->phonenumber }}</td>
                    <td>
                        <a href="{{ url('/admin/restore_user/employee/'.$emp->id) }}" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Restore User"><i class="fas fa-trash-restore"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="card border-primary">
    <div class="card-header d-flex align-items-start">
        <h3>List of Employee</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table_id">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach( $archiveTeacher as $teacher)
                <tr>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->phonenumber }}</td>
                    <td>
                        <a href="{{ url('/admin/restore_user/teacher/'.$teacher->id) }}" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Restore User"><i class="fas fa-trash-restore"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card border-primary">
    <div class="card-header d-flex align-items-start">
        <h3>Archive Teacher</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table_id">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $archiveStudent as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->phonenumber }}</td>
                    <td>
                        <a href="{{ url('/admin/restore_user/student/'.$student->id) }}" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Restore User"><i class="fas fa-trash-restore"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.table_id').DataTable();
    });
</script>
@endsection