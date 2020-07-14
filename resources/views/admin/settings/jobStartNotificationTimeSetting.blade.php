@extends('layouts.admin')
@section('title', "Job Start Notification Time Setting")
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
                <div class="col-md-12">
                    <h1 class="m-0 text-dark">Upcoming Job Start Notification Time Setting</h1>
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

                    {!! Form::model($setting,['route' => ['admin.jobStartNotificationTimeSettingStore',$setting->id], 'method'
                    =>'patch'])
                    !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Upcoming Job Start Notification Time Setting Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            {!! Form::checkbox('status', '1', null,
                                            ['id'=>'status',
                                            'class'=>'form-control'])
                                            !!}
                                            {!! Form::label('status', '&nbsp;Yes') !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('not_effect_duration', 'Duration(In Minute)')
                                        !!}
                                        {!! Form::text('not_effect_duration', null,
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
