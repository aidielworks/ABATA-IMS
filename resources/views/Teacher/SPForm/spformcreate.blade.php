@extends('layout.mainTeacher')

@section('title', 'ABATA Teacher | New SP Form')

@section('container')
<form action="/teachers/spform" method="POST" autocomplete="off">
    @csrf
    <div class="card border-primary">
        <div class="card-header text-white bg-primary">
            New SP Form
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="studentIC">Student ID</label>
                        <select name="studentIC" class="form-control @error('studentIC') is-invalid @enderror">
                            <option selected disabled>Choose...</option>
                            @foreach($students as $student)
                            <option value="{{ $student->ic }}">{{ $student->name }} - {{ $student->ic }}</option>
                            @endforeach
                        </select>
                        @error('studentIC')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date">Class Date</label>
                        <input type="text" class="form-control @error('datepicker') is-invalid @enderror" id="datepicker" name="datepicker" placeholder="Click to select date..." value="{{ old('datepicker') }}">
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
                <select multiple class="js-example-basic-multiple form-control" name="topic[]" id="topic">
                    @foreach($topics as $topic)
                    <option value="{{ $topic->topic }}">{{ $topic->topic }}</option>
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
                <textarea class="form-control @error('review') is-invalid @enderror" name="review" rows="5">{{ old('review') }}</textarea>
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

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
        $("#datepicker").datepicker({
            format: 'yyyy-mm-dd',
        });

        $('.js-example-basic-multiple').select2({
            placeholder: "Select topics",
            theme: "classic"
        });
    });
</script>
@endsection