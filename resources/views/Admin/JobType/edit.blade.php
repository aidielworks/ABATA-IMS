@extends('layout.main')

@section('title', 'ABATA | Edit Job Position')

@section('container')
<div class="card border-primary">
    <div class="card-header text-white bg-primary">
        <h3>Edit Job Position</h3>
    </div>
    <form method="POST" action="/admin/job_types/{{ $job->id }}" autocomplete="off">
        @method('patch')
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <div class="col">
                    <label for="job_position">Job Position</label>
                    <input type="text" class="form-control @error('job_position') is-invalid @enderror" id="job_position" name="job_position" value="{{ $job->job_position }}">
                    @error('job_position')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col">
                    <label for="basic_salary">Basic Salary</label>
                    <input type="number" class="form-control @error('basic_salary') is-invalid @enderror" id="basic_salary" name="basic_salary" min="1" placeholder="3000" value="{{ $job->basic_salary }}">
                    @error('basic_salary')
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