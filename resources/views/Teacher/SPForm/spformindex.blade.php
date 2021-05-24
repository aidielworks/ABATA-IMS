@extends('layout.mainTeacher')

@section('title', 'ABATA Teacher | SP Form')

@section('container')

<livewire:teacher-s-p-form-table>
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
            $('#table_id2').DataTable();
            $('#table_id3').DataTable();
        });
    </script>
    @endsection