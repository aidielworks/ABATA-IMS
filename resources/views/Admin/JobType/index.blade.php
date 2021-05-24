@extends('layout.main')

@section('title', 'ABATA | Job Types')

@section('container')
<div class="card border-primary">
    <div class="card-header d-flex align-items-start">
        <h3>Job Types</h3>
        <a href="/admin/job_types/create" class="btn btn-primary ml-3">New Job Type</a>
    </div>
    <div class="card-body">
        <table id="table_id" class="table table-striped">
            <thead>
                <tr>
                    <th>Job Types</th>
                    <th>Basic Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $jobs as $job)
                <tr>
                    <td>{{ $job->job_position }}</td>
                    <td>{{ $job->basic_salary }}</td>
                    <td>
                        <a href="/admin/job_types/{{ $job->id }}/edit" class="btn btn-primary"><i class="fas fa-edit"></i></a> |
                        <form id="form" action="/admin/job_types/{{ $job->id }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger delete-button"><i class="far fa-trash-alt"></i></button>
                        </form>
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