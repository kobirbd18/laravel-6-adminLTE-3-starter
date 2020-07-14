<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name', "Driver Vara")}} | @yield('title','Log in') </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link href="{{ URL::to('/image') }}/favicon.png" type="image/x-icon" rel="icon" />
    <link href="{{ URL::to('/image') }}/favicon.png" type="image/x-icon" rel="shortcut icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('css/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/backend/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .login-logo {
            margin-bottom: 5px;
        }

        .input-group-append {
            background: #e9ecef;
        }

        .avatar-logo {
            width: 100px;
            margin: 0 auto;
        }

        .avatar-logo img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
    @stack('css')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <div class="avatar-logo">
                {{-- <img src="{{ asset('image/logo.png') }}" alt="logo"> --}}
            </div>
            <a href="{{ route('admin.dashboard') }} "><b>Admin</b> @yield('title','Login')</a>

        </div>
        <!-- /.login-logo -->
        @yield('content')
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('js/backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/backend/adminlte.js') }}"></script>
    @stack('js')
</body>

</html>
