@extends('layouts.admin')
@section('title', "Coupons")
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
                    <h1 class="m-0 text-dark">Coupon Create</h1>
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

                    {!! Form::open(['route' => 'admin.coupons.store', 'method' =>'post']) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New Coupon Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('code', 'Coupon Code') !!}
                                        {!! Form::text('code', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group mb-0">
                                        {!! Form::label('discount_type', 'Discount Type') !!}
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="icheck-success d-inline mr-3">
                                            {!! Form::radio('discount_type', '1', null,
                                            ['id'=>'discount_type1']) !!}
                                            <label for="discount_type1">
                                                Fixed Amount
                                            </label>
                                        </div>
                                        <div class="icheck-success d-inline">
                                            {!! Form::radio('discount_type', '2', null,
                                            ['id'=>'discount_type2']) !!}
                                            <label for="discount_type2">
                                                Parcentage
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('discount', 'Discount Amount') !!}
                                        {!! Form::text('discount', null, ['class'=>'form-control','oninput'=>"this.value
                                        = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('get_max_discount', 'Max Discount Amount (if %)') !!}
                                        {!! Form::text('get_max_discount', null,
                                        ['class'=>'form-control','oninput'=>"this.value
                                        = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('valid_at', 'Counpon Valid Upto') !!}
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            {!! Form::text('valid_at', null,
                                            ['class'=>'form-control multi-date float-right','autocomplete'=>'off'])
                                            !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('condition', 'Condition') !!}
                                        {!! Form::select('condition', [''=>'Choose an
                                        option']+Config::get('constants.DISCOUNT_CONDITION'), null,
                                        ['class'=>'form-control multi-select']) !!}
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
                            Auth::guard('admin')->user()->can(['admin-coupons-read']))
                            <a href="{{route('admin.coupons.index')}}" type="button" class="btn btn-danger">Cancel</a>
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
        $('.multi-date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $('.multi-select').select2({
            placeholder: "Choose an option",
        });
        $('.datepicker').datepicker();
            //end document ready
        });
</script>
@endpush
@endsection
