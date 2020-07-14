@extends('layouts.adminlogin')
@section('title', "Reset Password")
@push('css')
<!-- input partial css here -->
<style>
    input,
    button,
    .input-group,
    .input-group-text {
        border-radius: 0px !important;
    }
</style>
@endpush
@section('content')
<div class="card">
    <div class="card-body login-card-body">

        <p class="login-box-msg">Reset Password Info</p>

        @include('include.login_error')
        @include('include.flashMessage')

        @if(session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            <p>{{ session('status') }}</p>
        </div>
        @endif

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\ResetPasswordController@reset']) !!}

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="input-group mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" autocomplete="email" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" autocomplete="current-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input id="password_confirmation" type="password"
                class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                autocomplete="current-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
        </div>

        {!! Form::close() !!}

    </div>
</div>
@endsection
