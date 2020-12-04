@extends('layouts.admin')
@section('title', "Users")
@push('css')
<!-- input partial css here -->
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
                    <h1 class="m-0 text-dark">User Create</h1>
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
                    {!! Form::open(['route' => 'admin.users.store', 'method' =>'post', 'files'=>true]) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New User Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('mobile', 'Mobile Number') !!}
                                        {!! Form::text('mobile', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('email', 'Email') !!}
                                        {!! Form::text('email', null, ['class'=>'form-control']) !!}
                                    </div>


                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        {!! Form::label('gender', 'Gender') !!}
                                        {!! Form::select('gender', [''=>'Choose an
                                        option']+Config::get('constants.GENDERS'), null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('referral', 'Referral Code') !!}
                                        {!! Form::text('referral', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="photo" name="photo">
                                            <label class="custom-file-label" for="photo">Upload profile photo</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            {!! Form::checkbox('status', '1', 1, ['id'=>'status',
                                            'class'=>'form-control'])
                                            !!}
                                            {!! Form::label('status', '&nbsp;Active') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->hasPermission(['admin-users-read']))
                            <a href="{{route('admin.users.index')}}" type="button"
                                class="btn btn-danger">Cancel</a>
                            @endif
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
        $('.multi-select').select2({
            placeholder: "Choose an option",
        });
        bsCustomFileInput.init();


        //end document ready
    });
</script>
@endpush
@endsection
