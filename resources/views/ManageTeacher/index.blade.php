@extends('layout.main')

@section('title', 'ABATA | Teacher')

@section('container')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">List of Teacher</li>
    </ol>
</nav>

<livewire:teachers-table>
    @endsection