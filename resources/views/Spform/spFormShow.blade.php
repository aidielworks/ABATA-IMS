@extends('layout.main')

@section('title', 'ABATA | SP Form')

@section('container')
<div class="card">
    @foreach ($studForm as $form)
    <div class="card-header">
        <h3>Student Performance Form -
            @if ($form->status == 0)
            <i class="fas fa-clock text-warning"></i>
            @elseif ($form->status == 1)
            <i class="fas fa-check-circle text-success"></i>
            @else
            <i class="fas fa-times-circle text-danger"></i>
            @endif

        </h3>
    </div>

    <form method="POST" action="/spform/{{ $form->id }}" autocomplete="off">
        @method('patch')
        @csrf
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <h5>Student: {{ $form->studentName }} -
                        <span class="card-subtitle mb-2 text-muted">{{ $form->studentIC }}</span>
                    </h5>
                    <h5>Teacher: {{ $form->teacherName }} -
                        <span class="card-subtitle mb-2 text-muted">{{ $form->teacherIC }}</span>
                    </h5>
                    <hr>
                    <p class="card-text"><b><u>Learning Topic</u></b><br>{{ $form->learning_topic }}</p>
                    <p class="card-text"><b><u>Teacher Review</u></b><br>{{ $form->review }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if($form->status == 0)
            <button type="submit" name="approve" value="1" class="btn btn-primary">Approve</button>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declined_modal">
                Decline
            </button>
            @endif
        </div>

        <!-- Modal -->
        <div class="modal fade" id="declined_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Declining SP Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Remarks</label>
                            <textarea class="form-control" name="remarks" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="decline" value="1" class="btn btn-danger">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endforeach

    @error('remarks')
    <script>
        $(document).ready(function() {
            $('#declined_modal').modal('show')
        });
    </script>
    @enderror
</div>

@endsection