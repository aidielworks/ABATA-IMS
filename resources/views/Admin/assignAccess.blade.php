@extends('layout.main')

@section('title', 'ABATA | Assign Access')

@section('container')
<div class="card border-primary">
    <div class="card-header d-flex align-items-start">
        <h3>List of Employee</h3>
    </div>
    <div class="card-body">
        <table id="table_id" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Position</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $employees as $emp)
                <tr>
                    <td>{{ $emp->name }}</td>
                    <td>{{ $emp->phonenumber }}</td>
                    <td>{{ $emp->position }}</td>
                    <td>{{ $emp->role }}</td>
                    <td>
                        @if($emp->role == 0)
                        <form id="form" action="/assign/{{ $emp->id }}" method="post" class="d-inline">
                            @method('patch')
                            @csrf
                            <button type="submit" class="btn btn-outline-warning btn-sm" data-toggle="tooltip" title="Assigned access"><i class="fas fa-unlock"></i></button>
                        </form>
                        @else
                        <form id="form" action="/withhold/{{ $emp->id }}" method="post" class="d-inline">
                            @method('patch')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Withhold access"><i class="fas fa-lock"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>
@endsection