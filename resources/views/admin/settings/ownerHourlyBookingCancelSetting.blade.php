@extends('layouts.admin')
@section('title', "Booking Cancel Setting")
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
                    <h1 class="m-0 text-dark">Owner Hourly Booking Cancel Setting</h1>
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

                    {!! Form::model($setting,['route' => ['admin.ownerHourlyBookingCancelStore',$setting->id], 'method' =>'patch'])
                    !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Owner Hourly Booking Cancel Setting Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            {!! Form::checkbox('is_cancel_charge', '1', null,
                                            ['id'=>'is_cancel_charge',
                                            'class'=>'form-control'])
                                            !!}
                                            {!! Form::label('is_cancel_charge', '&nbsp;Take Cancel Charge') !!}
                                        </div>
                                    </div>
                                    <div id="cancel-show-hide" style="display:{{ $display }}">
                                        <div class="form-group mb-0">
                                            {!! Form::label('cancel_charge_type', 'Cancel Charge Type') !!}
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline mr-3">
                                                {!! Form::radio('cancel_type', '1', null,
                                                ['id'=>'cancel_type1']) !!}
                                                <label for="cancel_type1">
                                                    Fixed Amount
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                {!! Form::radio('cancel_type', '2', null,
                                                ['id'=>'cancel_type2']) !!}
                                                <label for="cancel_type2">
                                                    Parcentage
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                {!! Form::label('not_effect_duration', 'Not Effect Duration (hr)')
                                                !!}
                                                {!! Form::text('not_effect_duration', null,
                                                ['class'=>'form-control','oninput'=>"this.value =
                                                this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])
                                                !!}
                                            </div>

                                            <div class="form-group col-md-6">
                                                {!! Form::label('charge_amount', 'Cancel Charge Amount')
                                                !!}
                                                {!! Form::text('charge_amount', null,
                                                ['class'=>'form-control','oninput'=>"this.value =
                                                this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"])
                                                !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

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
        $('#is_cancel_charge').on('click', function (event) {
            if($(this).prop("checked") == true){
                $('#cancel-show-hide').show();


            }else{
                $('#cancel-show-hide').hide();

            }
        });
        //end document ready
    });
</script>
@endpush
@endsection
