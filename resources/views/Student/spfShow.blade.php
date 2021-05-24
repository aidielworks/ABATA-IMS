@extends('layout.mainStudent')

@section('title', 'ABATA Student | SP Form')

@section('container')
<div class="card">
    <div class="card-header">
        <h3>Student Perspformance spform -
            @if ($spform->status == 0)
            <i class="fas fa-clock text-warning" title="Pending"></i>
            @elseif ($spform->status == 1)
            <i class="fas fa-check-circle text-success" title="Accepted"></i>
            @else
            <i class="fas fa-times-circle text-danger" title="Decline"></i>
            @endif

        </h3>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h5 class="card-title"><b>Teacher:</b> {{ $spform->teacher->name }} -
                            <span class="card-subtitle text-muted">{{ $spform->teacher->ic }}</span>
                        </h5>
                    </li>
                    <li class="list-group-item" style="min-height: 200px;">
                        <h5><u>Learning Topic</u></h5>
                        <ul>
                            @foreach(explode(',', $spform->learning_topic) as $form)
                            <li>{{$form}}</li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="list-group-item" style="min-height: 200px;">
                        <h5><u>Teacher Review</u></h5>
                        {{ $spform->review }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection