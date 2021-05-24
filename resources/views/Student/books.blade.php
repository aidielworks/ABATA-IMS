@extends('layout.mainStudent')

@section('title', 'ABATA Student | ABATA Books')

@section('container')

<div class="card">
    <div class="card-header text-center">
        <h4>ABATA BOOKS</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="info-box">
                    <div class="info-box-content">
                        <!-- Button trigger modal -->
                        <a href="#" data-toggle="modal" data-target="#book1">
                            <img src="{{ url('/images/book-cover/Langkah_1.png') }}" class="img-fluid rounded" alt="...">
                        </a>
                        <div class="mt-1 text-center">
                            <h4>Langkah 1</h4>
                            <p>Asas Baris dan Bunyi Huruf</p>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col">
                <div class="info-box">
                    <div class="info-box-content">
                        <a href="#" data-toggle="modal" data-target="#book2">
                            <img src="{{ url('/images/book-cover/Langkah_2.png') }}" class="img-fluid rounded" alt="...">
                        </a>
                        <div class="mt-1 text-center">
                            <h4>Langkah 2</h4>
                            <p>Asas Mad dan Sukun</p>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col">
                <div class="info-box">
                    <div class="info-box-content">
                        <a href="#" data-toggle="modal" data-target="#book3">
                            <img src="{{ url('/images/book-cover/Langkah_3.png') }}" class="img-fluid rounded" alt="...">
                        </a>
                        <div class="mt-1 text-center">
                            <h4>Langkah 3</h4>
                            <p>Asas Dengung dan Sabdu</p>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="book1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <h4>Langkah 1 - Asas Baris dan Bunyi Huruf</h4>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <embed id="myFrame" src="{{ url('/storage/assets/sample.pdf') }}#toolbar=0 " height="700" width="700"></embed>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="book2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <h4>Langkah 2 - Asas Mad dan Sukun</h4>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <embed id="myFrame" src="{{ url('/storage/assets/sample.pdf') }}#toolbar=0 " height="700" width="700"></embed>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="book3" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <h4>Langkah 3 - Asas Dengung dan Sabdu</h4>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <embed id="myFrame" src="{{ url('/storage/assets/sample.pdf') }}#toolbar=0 " height="700" width="700"></embed>
            </div>
        </div>
    </div>
</div>
@endsection