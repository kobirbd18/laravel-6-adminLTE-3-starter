@extends('layouts.adminlogin')
@section('title', "Forgot Password")
@push('css')
<!-- input partial css here -->
<style>
    input,
    button,
    .input-group,
    .input-group-text {
        border-radius: 0px !important;
    }
    .card {
        border-radius: 0
    }
</style>
@endpush
@section('content')

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-card-msg">Forgot password ? Enter your email address</p>

        @include('include.error')
        @include('include.flashMessage')

        @if(session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            <p>{{ session('status') }}</p>
        </div>
        @endif

        <form action="{{ route('admin.password.email') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" autocomplete="email" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3 float-right">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
            </div>
            <!-- /.col -->
            <div class="col-4 float-right pr-0">
                <button type="submit" class="btn btn-success btn-block btn-flat">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.login-card-body -->
    <div class="card-footer">
        @if (Route::has('admin.login'))
        <a href="{{ route('admin.login') }}">
            {{ __('Have an account ? Sign In') }}
        </a>
        @endif
    </div>
</div>

@endsection
