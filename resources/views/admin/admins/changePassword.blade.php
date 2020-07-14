@extends('layouts.admin')
@section('title', "Password Change")
@push('css')
<!-- input partial css here -->
<style>

</style>
<style>

</style>
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <h1 class="m-0 text-dark">Admin Password Change</h1>
                </div><!-- /.col -->
                <div class="col-md-6">

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    @include('include.error')
                    @include('include.flashMessage')

                    {!! Form::open(['method'=>'POST', 'action'=>['Admin\AdminController@changePasswordStore']]) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Admin Password Change Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('old_password', 'Current Password') !!}
                                    {!! Form::password('old_password', ['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('password', 'New Password') !!}
                                    {!! Form::password('password', ['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('password_confirmation', 'Confirm Password') !!}
                                    {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.card -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@push('js')
<!-- input partial scripts here -->
<script>
    $(document).ready(function () {

            //end document ready
        });
</script>
@endpush
@endsection
