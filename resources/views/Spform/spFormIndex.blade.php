@extends('layout.main')

@section('title', 'ABATA | SP Form')

@section('container')
<div class="ajax_content">
    <div class="card">
        <div class="card border-primary">
            <div class="card-header text-white bg-primary">
                <h3 class="card-title">List of Student Performance Form</h3>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-header bg-warning">
                        Pending
                    </div>
                    <div class="card-body">
                        <table class="table" id="table_id">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">L. Topic</th>
                                    <th scope="col">Student</th>
                                    <th scope="col">Teacher</th>
                                    <th scope="col">Submitted At</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $spformsPending as $index => $form)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ substr($form->learning_topic, 0, 10) }}...</td>
                                    <td>{{ $form->studentName}}</td>
                                    <td>{{ $form->teacherName }}</td>
                                    <td>{{date("d-m-Y", strtotime($form->created_at))}}</td>
                                    <td>@if ($form->status == 0)
                                        <i class="fas fa-clock text-warning"></i>
                                        <span class="text-white">0</span>
                                        @elseif ($form->status == 1)
                                        <i class="fas fa-check-circle text-success"></i>
                                        <span class="text-white">1</span>
                                        @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                        <span class="text-white">2</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/spform/{{ $form->id }}" class="btn btn-outline-primary btn-sm"><i class="far fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr>

                <div class="card">
                    <div class="card-header">
                        Approved | Declined
                    </div>
                    <div class="card-body">
                        <table class="table" id="table_id2">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">L. Topic</th>
                                    <th scope="col">Student</th>
                                    <th scope="col">Teacher</th>
                                    <th scope="col">Submitted At</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $spforms as $index => $form)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ substr($form->learning_topic, 0, 10) }}...</td>
                                    <td>{{ $form->studentName}}</td>
                                    <td>{{ $form->teacherName }}</td>
                                    <td>{{date("d-m-Y", strtotime($form->created_at))}}</td>
                                    <td>@if ($form->status == 0)
                                        <i class="fas fa-clock text-warning"></i>
                                        <span class="text-white">0</span>
                                        @elseif ($form->status == 1)
                                        <i class="fas fa-check-circle text-success"></i>
                                        <span class="text-white">1</span>
                                        @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                        <span class="text-white">2</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/spform/{{ $form->id }}" class="btn btn-outline-primary btn-sm"><i class="far fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
        $('#table_id2').DataTable();
    });
</script>


@endsection