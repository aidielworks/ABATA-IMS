@extends('layout.main')

@section('title', 'ABATA | Topics')

@section('container')
<div class="card border-primary">
    <div class="card-header d-flex align-items-start">
        <h3>Topics</h3>
        <a href="{{ url('/topic/create') }}" class="btn btn-primary ml-3">New Topic</a>
    </div>
    <div class="card-body">
        <table id="table_id" class="table table-striped">
            <thead>
                <tr>
                    <th>Topics</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $topics as $topic)
                <tr>
                    <td>{{ $topic->topic }}</td>
                    <td>
                        <a href="{{ url('/topic/'.$topic->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i></a> |
                        <form id="form" action="{{ url('/topic/'.$topic->id)  }}" method="post" class="d-inline">
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