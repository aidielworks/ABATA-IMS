@extends('layout.main')

@section('title', 'ABATA | Login Logout History')

@section('container')

<div class="card">
    <div class="card-header">
        Login Logout History
    </div>
    <div class="card-body">
        <table class="table" id="table_id">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>IC</th>
                    <th>Type</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                </tr>
            </thead>
            <tbody>

                @foreach($auth as $loginlogout)
                <tr>
                    <td>{{$loginlogout->name}}</td>
                    <td>{{$loginlogout->ic}}</td>
                    <td>{{$loginlogout->type}}</td>
                    <td>{{$loginlogout->login}}</td>
                    <td>{{$loginlogout->logout}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#table_id').DataTable({
            "order": [
                [3, "asc"]
            ]
        });
    });
</script>
@endsection