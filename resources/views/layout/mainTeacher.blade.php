<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Font-awesome -->
    <link rel="stylesheet" href="{{ asset('plugin/font-awesome/css/all.css') }}">
    <!-- my css-->
    <link rel="stylesheet" href="{{ asset('plugin/mystyle.css') }}">
    <!-- Data Tables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <!-- bootstrap-datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- sweetAlert -->
    <link rel="stylesheet" href="{{ asset('plugin/sweetAlert2/sweetalert2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('plugin/css/adminlte.min.css') }}">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- chart.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" integrity="sha512-SUJFImtiT87gVCOXl3aGC00zfDl6ggYAw5+oheJvRJ8KBXZrr/TMISSdVJ5bBarbQDRC2pR5Kto3xTR0kpZInA==" crossorigin="anonymous" />

    @livewireStyles

    <style>
        textarea {
            resize: none;
        }
    </style>

    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="hold-transition layout-top-nav">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- Font-Awesome -->
    <script src="{{ asset('plugin/font-awesome/js/all.js') }}"></script>
    <!-- Data Tables -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <!-- bootstrap-datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- sweetAlert -->
    <script src="{{ asset('plugin/sweetAlert2/sweetalert2.all.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{ url('plugin/js/adminlte.js') }}"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha512-QEiC894KVkN9Tsoi6+mKf8HaCLJvyA6QIRzY5KrfINXYuP9NxdIkRQhGq3BZi0J4I7V5SidGM3XUQ5wFiMDuWg==" crossorigin="anonymous"></script>
    <!-- jquery knob -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>

    @livewireScripts

    <div class="flashData" data-flashdata-type="{{ session('status') }}"></div>
    <div class="flashDataWrong" data-flashdata-type="{{ session('status-danger') }}"></div>
    <div class="flashDataLogin" data-flashdata-type="{{ session('status-login') }}"></div>

    <!-- myScript -->
    <script src="{{ asset('plugin/myscript.js')}}"></script>

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-lightblue">
            <div class="container">
                <div class="navbar-brand">
                    <img src="{{ url('/images/abata_logo.png') }}" alt="Abata Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">ABATA Teacher</span>
                </div>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/teachers') }}" class="nav-link ">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle {{ request()->is('teachers/spform*') ? 'active' : '' }}"><i class="fas fa-users mr-1"></i>SP Form</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a class="dropdown-item" href="{{ url('/teachers/spform') }}"><i class="fas fa-list-ul mr-1"></i>List of SP Form</a></li>
                                <li><a class="dropdown-item" href="{{ url('/teachers/spform/create') }}"><i class="far fa-plus-square mr-1"></i>New SP Form</a></li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('teachers/paymentHistory*') ? 'active' : '' }}" href="{{ url('/teachers/payroll-history') }}"><i class="fas fa-money-check mr-1"></i>Payroll History</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown pt-3">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-bell"></i>
                            <span class="badge badge-warning navbar-badge" id="noti_count">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div id="notification_item">
                                <div class="dropdown-item">No notification.</div>
                            </div>
                            <a href="{{ url('/teachers/spform') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ url('/images/profile_picture/teacher/'. Session::get('image')) }}" alt="..." class="img-thumbnail" style="height:50px; width:50px;">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/teachers/profile"><i class="far fa-id-badge mr-1"></i>Profile</a>
                                <a class="dropdown-item" href="/teachers/setting"><i class="fas fa-cog mr-1"></i>Setting</a>
                                <div class="dropdown-divider"></div>
                                <!-- Button trigger modal -->
                                <button class="dropdown-item" href="#" data-toggle="modal" data-target="#LogoutModal"><i class="fas fa-sign-out-alt mr-1"></i>Logout</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <div class="content pt-4">
                <div class="container">
                    @yield('container')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="#">ABATA Resources</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="LogoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Logout</button> -->
                    <a href="{{ url('/auth/destroy') }}" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("[data-toggle=tooltip").tooltip();

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            function notification() {

                var teacher_ic = "{!!session()->get('ic')!!}";

                $.ajax({
                    url: "{{ url('/noti_decline') }}",
                    method: "POST",
                    data: {
                        ic: teacher_ic
                    },
                    success: function(data) {
                        if (data.count > 0) {
                            $('#noti_count').html(data.count);
                            $('#notification_item').html(data.output);
                        } else {
                            $('#notification_item').html('<div class="dropdown-item">No notification.</div>');
                        }
                    }
                });
            }

            notification();

            setInterval(function() {
                notification() // this will run every 5 seconds
            }, 2000);
        })
    </script>

</body>

</html>