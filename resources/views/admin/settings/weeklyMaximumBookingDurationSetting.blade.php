@extends('layouts.admin')
@section('title', "Maximum Booking Duration Setting")
@push('css')
<style>

</style>
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
                    <h1 class="m-0 text-dark">Weekly Maximum Booking Duration Setting</h1>
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

                    {!! Form::model($setting,['route' => ['admin.weeklyMaximumBookingDurationSettingStore',$setting->id], 'method'
                    =>'patch'])
                    !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Weekly Maximum Booking Duration Setting</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    {{-- <div class="form-group">
                                        <div class="icheck-primary">
                                            {!! Form::checkbox('status', '1', null,
                                            ['id'=>'status',
                                            'class'=>'form-control'])
                                            !!}
                                            {!! Form::label('status', '&nbsp;Active') !!}
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        {!! Form::label('duration', 'Duration')
                                        !!}
                                        {!! Form::text('duration', null,
                                        ['class'=>'form-control','oninput'=>"this.value =
                                        this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])
                                        !!}
                                    </div>
                                </div>
                                <div class="col-md-8">

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
