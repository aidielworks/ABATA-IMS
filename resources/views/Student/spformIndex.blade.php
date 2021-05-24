@extends('layout.mainStudent')

@section('title', 'ABATA Student | SP Form')

@section('container')

<div class="card">
    <div class="card-header">
        <h4>List of SP Form</h4>
    </div>
    <div class="card-body">
        <nav class="mb-3">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="true">Pending</a>
                <a class="nav-link" id="nav-approved-tab" data-toggle="tab" href="#nav-approved" role="tab" aria-controls="nav-approved" aria-selected="false">Approved</a>
                <a class="nav-link" id="nav-declined-tab" data-toggle="tab" href="#nav-declined" role="tab" aria-controls="nav-declined" aria-selected="false">Declined</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                <table id="table_spf" class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Topic</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($spformsPending as $forms)
                        <tr>
                            <td>{{ substr($forms->learning_topic, 0, 15) }}...</td>
                            <td>{{ date("d-M-Y", strtotime($forms->class_date)) }}</td>
                            <td><a href="{{ url('/students/spforms/'.$forms->id) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-approved" role="tabpanel" aria-labelledby="nav-approved-tab">
                <table id="table_spf" class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Topic</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($spformsApproved as $forms)
                        <tr>
                            <td>{{ substr($forms->learning_topic, 0, 15) }}...</td>
                            <td>{{ date("d-M-Y",strtotime($forms->class_date)) }}</td>
                            <td><a href="{{ url('/students/spforms/'.$forms->id) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-declined" role="tabpanel" aria-labelledby="nav-declined-tab">
                <table id="table_spf" class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Topic</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($spformsDeclined as $forms)
                        <tr>
                            <td>{{ substr($forms->learning_topic, 0, 15) }}...</td>
                            <td>{{ date("d-M-Y",strtotime($forms->class_date)) }}</td>
                            <td><a href="{{ url('/students/spforms/'.$forms->id) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i></a></td>
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
        $('.table').DataTable();
    });
</script>
@endsection