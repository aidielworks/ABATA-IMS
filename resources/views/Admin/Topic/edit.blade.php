@extends('layout.main')

@section('title', 'ABATA | Edit Topic')

@section('container')
<div class="card border-primary">
    <div class="card-header text-white bg-primary">
        <h3>Edit Topic</h3>
    </div>
    <form method="POST" action="/topic/{{ $topic->id }}" autocomplete="off">
        @method('patch')
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <div class="col">
                    <label for="topic">Topic</label>
                    <input type="text" class="form-control @error('topic') is-invalid @enderror" id="topic" name="topic" value="{{ $topic->topic }}">
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