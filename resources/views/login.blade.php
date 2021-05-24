<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABATA</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- my css-->
    <link rel="stylesheet" href="{{ asset('plugin/login.css') }}">
    <!-- Font-awesome -->
    <link rel="stylesheet" href="{{ asset('plugin/font-awesome/css/all.css') }}">

    <link rel="stylesheet" href="{{ asset('plugin/css/adminlte.min.css') }}">

    <!-- sweetAlert -->
    <link rel="stylesheet" href="{{ asset('plugin/sweetAlert2/sweetalert2.min.css') }}">
</head>

<body class="hold-transition login-page">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- Font-Awesome -->
    <script src="{{ asset('plugin/font-awesome/js/all.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('plugin/js/adminlte.min.js') }}"></script>

    <!-- sweetAlert -->
    <script src="{{ asset('plugin/sweetAlert2/sweetalert2.all.min.js')}}"></script>

    <div class="login-logo">
        <b>ABATA</b> IMS
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <form method="post" action="{{ url('/auth') }}" autocomplete="off">
            @csrf
            <div class="card-body login-card-body">
                <p class="login-box-msg">Select one to login</p>
                <ul>
                    <li>
                        <input type="radio" name="radio" value="1" id="myCheckbox1" {{ old('radio')=="1" ? 'checked=' .'"checked"' : '' }}>
                        <label for="myCheckbox1"><img src="{{ asset('images/tie.png') }}" />
                            <p class="text-center">EMPLOYEE</p>
                        </label>
                    </li>
                    <li>

                        <input type="radio" name="radio" value="2" id="myCheckbox2" {{ old('radio')=="2" ? 'checked=' .'"checked"' : '' }}>
                        <label for="myCheckbox2"><img src="{{ asset('images/knowledge.png') }}" />
                            <p class="text-center">TEACHER</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="radio" value="3" id="myCheckbox3" {{ old('radio')=="3" ? 'checked=' .'"checked"' : '' }}>
                        <label for="myCheckbox3"><img src="{{ asset('images/mortarboard.png') }}">
                            <p class="text-center">STUDENT</p>
                        </label>
                </ul>
                @error('radio')
                <p class="text-red">
                    {{ $message }}
                </p>
                @enderror
                <div class="input-group mb-3">
                    <input type="text" name="ic" id="ic" class="form-control @error('ic') is-invalid @enderror" placeholder="IC" maxlength="12" autofocus value="{{ old('ic') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-id-card"></span>
                        </div>
                    </div>
                    @error('ic')
                    <div class=" invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
                <p class="mt-5 mb-3 text-muted text-center"><strong>Copyright &copy; 2020 ABATA.</strong> All rights reserved.</p>

            </div>
            <!-- /.login-card-body -->
        </form>
    </div>

    <div class="flashDataWrong" data-flashdata-type="{{ session('status') }}"></div>
    <!-- myScript -->
    <script src="{{ asset('plugin/myscript.js')}}"></script>

</body>

</html>