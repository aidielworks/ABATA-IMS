<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('plugin/font-awesome/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('plugin/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- chart.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" integrity="sha512-SUJFImtiT87gVCOXl3aGC00zfDl6ggYAw5+oheJvRJ8KBXZrr/TMISSdVJ5bBarbQDRC2pR5Kto3xTR0kpZInA==" crossorigin="anonymous" />
    <!-- sweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @livewireStyles
</head>

<body class="hold-transition sidebar-mini">
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Boostrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha512-QEiC894KVkN9Tsoi6+mKf8HaCLJvyA6QIRzY5KrfINXYuP9NxdIkRQhGq3BZi0J4I7V5SidGM3XUQ5wFiMDuWg==" crossorigin="anonymous"></script>
    <!-- sweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.js"></script>
    <!-- bootstrap-datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Datatable -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- AdminLTE -->
    <script src="{{ url('plugin/js/adminlte.js') }}"></script>

    @livewireScripts

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/home') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li>
                    <button class="dropdown-item" href="#" data-toggle="modal" data-target="#LogoutModal"><i class="fas fa-sign-out-alt mr-1"></i>Logout</button>
                </li>
                <!-- Button trigger modal -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <div class="brand-link">
                <img src="{{ url('/images/abata_logo.png') }}" alt="Abata Logo" class="brand-image img-circle" style="opacity: .8">
                <span class="brand-text font-weight-light">ABATA IMS</span>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ url('/images/profile_picture/employee/'. Session::get('image')) }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ url('/profile') }}" class="d-block">{{ Session::get('name')}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        @if(Session::get('role') == 1)
                        <li class="nav-item has-treeview {{ (request()->is('admin*')) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('admin*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-cog mr-1"></i>
                                <p>
                                    Administrator
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/admin/payroll') }}" class="nav-link {{ request()->is('admin/payroll*') ? 'active' : '' }}">
                                        <i class="fas fa-dollar-sign nav-icon"></i>
                                        <p>
                                            Payroll
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-receipt nav-icon"></i>
                                        <p>
                                            Receipt
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <li class="nav-item">
                                            <a href="{{ url('admin/receipt') }}" class="nav-link">
                                                <i class="fas fa-list-ul nav-icon"></i>
                                                <p>List of receipt</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('admin/receipt/create') }}" class="nav-link">
                                                <i class="fas fa-plus-square nav-icon"></i>
                                                <p>Create receipt</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/topic') }}" class="nav-link {{ request()->is('topic*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>
                                            Learning Topic
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/accessTimestamp') }}" class="nav-link {{ request()->is('admin/accessTimestamp') ? 'active' : '' }}">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Access history</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/assignAccess') }}" class="nav-link {{ request()->is('admin/assignAccess') ? 'active' : '' }}">
                                        <i class="fas fa-user-lock nav-icon"></i>
                                        <p>Assign admin</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/archive_user') }}" class="nav-link {{ request()->is('admin/archive_user') ? 'active' : '' }}">
                                        <i class="fas fa-user nav-icon"></i>
                                        <p>Archive User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/job_types') }}" class="nav-link {{ request()->is('admin/job_types') ? 'active' : '' }}">
                                        <i class="fas fa-id-badge nav-icon"></i>
                                        <p>Add Job</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview {{ (request()->is('employee*')) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('employee*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users mr-1"></i>
                                <p>
                                    Manage Employee
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/employee') }}" class="nav-link {{ request()->is('employee') ? 'active' : '' }}">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>List of employee</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/employee/create') }}" class="nav-link {{ request()->is('employee/create') ? 'active' : '' }}">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Add new employee</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item has-treeview {{ (request()->is('teacher*')) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('teacher*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Manage Teacher
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/teacher' ) }}" class="nav-link {{ request()->is('teacher') ? 'active' : '' }}">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>List of teachers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/teacher/create') }}" class="nav-link {{ request()->is('teacher/create') ? 'active' : '' }}">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Add new teacher</p>
                                    </a>
                                </li>
                                @if(Session::get('role') == 1)
                                <li class="nav-item">
                                    <a href="{{ url('/teacher/payroll') }}" class="nav-link {{ request()->is('teacher/payroll') ? 'active' : '' }}">
                                        <i class="fas fa-dollar-sign nav-icon"></i>
                                        <p>Teacher Payroll</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/spform') }}" class="nav-link {{ request()->is('spform') ? 'active' : '' }}">
                                <i class="nav-icon far fa-file-alt"></i>
                                <p>
                                    SP Form
                                    <span class="right badge badge-warning" id="noti_count2">0</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview {{ (request()->is('student*')) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('student*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>
                                    Manage Student
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/student') }}" class="nav-link {{ request()->is('student') ? 'active' : '' }}">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>List of students</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/student/create') }}" class="nav-link {{ request()->is('student/create') ? 'active' : '' }}">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Add new student</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="mb-2 ml-1 text-dark">@yield('title')</h1>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.container-header -->
            <div class="content">
                <div class="container-fluid">
                    @yield('container')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020 <a href="#">ABATA</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="LogoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
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

                    <a href="{{ url('/auth/destroy') }}" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="flashData" data-flashdata-type="{{ session('status') }}"></div>
    <div class="flashDataWrong" data-flashdata-type="{{ session('status-danger') }}"></div>
    <div class="flashDataLogin" data-flashdata-type="{{ session('login') }}"></div>

    <!-- myScript -->
    <script src="{{ asset('plugin/myscript.js')}}"></script>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            function notification() {

                $.ajax({
                    url: "{{ url('/noti_pending') }}",
                    method: "get",
                    success: function(data) {
                        $('#noti_count').text(data)
                        $('#noti_count2').text(data)
                    }
                });
            }

            notification();

            setInterval(function() {
                notification() // this will run after every 5 seconds
            }, 5000);

            $("[data-toggle=tooltip").tooltip();
        })
    </script>
</body>


</html>