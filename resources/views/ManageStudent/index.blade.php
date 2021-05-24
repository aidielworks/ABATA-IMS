@extends('layout.main')

@section('title', 'ABATA | Student')

@section('container')

<livewire:students-table>


    <div class="flashData" data-flashdata-type="{{ session('status') }}"></div>
    <!-- myScript -->
    <script src="{{ asset('plugin/myscript.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
    @endsection