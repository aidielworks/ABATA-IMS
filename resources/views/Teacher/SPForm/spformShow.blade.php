@extends('layout.mainTeacher')

@section('title', 'ABATA Teacher | View SP Form')

@section('container')
<div class="pt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">View</a>
        </li>
        @if($spform->status != 1)
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Edit</a>
        </li>
        @endif

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card mt-3">
                <div class="card-header">
                    <b>Student :</b> {{ $spform->student->name }}<br><b>Date : </b> {{ date('d M Y', strtotime($spform->class_date)) }}
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @if($spform->status == 2)
                        <li class="list-group-item list-group-item-danger">
                            <h5>Please rectify the problem as mention below. Thank you.</h5>
                            {{ $spform->remarks }}
                            <a class="btn btn-danger btn-sm" id="rectify">Rectify</a>
                        </li>
                        @endif
                        <li class="list-group-item">
                            <h5>Learning Topic</h5>
                            {{$spform->learning_topic }}
                        </li>
                        <li class="list-group-item">
                            <h5>Review</h5>
                            {{ str_replace("<br />", "\n", $spform->review) }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @if($spform->status != 1)
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form action="/teachers/spform/{{ $spform->id }}" method="POST" autocomplete="off">
                @method('patch')
                @csrf
                <div class="card border-primary mt-3">
                    <div class="card-header text-white bg-primary">
                        Edit SP Form
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="studentIC">Student ID</label>
                                    <input name="studentIC" class="form-control @error('studentIC') is-invalid @enderror" value="{{ $spform->studentIC}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Class Date</label>
                                    <input type="text" class="form-control @error('datepicker') is-invalid @enderror" id="datepicker" name="datepicker" placeholder="Click to select date..." value="{{ date('d/m/Y', strtotime($spform->class_date)) }}">
                                </div>
                                @error('datepicker')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="learningTopic">Learning Topic <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Can choose multiple topic."></i></label>
                            <br>
                            <select multiple class="js-example-basic-multiple form-control" name="learning_topic[]" id="topic" style="width: 100%">
                                @foreach($topics as $topic)
                                @if(in_array($topic->topic, $topicsinDB))
                                <option selected value="{{ $topic->topic }}">{{ $topic->topic }}</option>
                                @else
                                <option value="{{ $topic->topic }}">{{ $topic->topic }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('learningTopic')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="review">Teacher Review</label>
                            <textarea class="form-control @error('review') is-invalid @enderror" name="review" rows="5">{{ str_replace("<br />", "\n", $spform->review) }}</textarea>
                            @error('review')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        @endif
    </div>

</div>
<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });

    $("#datepicker").datepicker({
        orientation: "auto",
    });

    $("#rectify").on('click', function() {
        console.log('click');
        $("#profile-tab").tab('show');
    });

    $('.js-example-basic-multiple').select2({
        placeholder: "Select topics",
        theme: "classic",
        width: 'resolve' // need to override the changed default
    });
</script>
@endsection