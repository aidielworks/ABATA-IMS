@extends('layout.main')

@section('title', 'ABATA | New Topic')

@section('container')
<div class="card border-primary">
    <div class="card-header text-white bg-primary">
        <h3>Add Topic</h3>
    </div>
    <form method="POST" action="{{ url('/topic') }}" autocomplete="off">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <div class="col">
                    <label for="job_position">Topic</label>
                    <input type="text" class="form-control @error('topic') is-invalid @enderror" id="topic" name="topic" value="{{ old('topic') }}">
                    @error('topic')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <input class="btn btn-primary" type="submit" name="Add">
        </div>
    </form>
</div>
@endsection