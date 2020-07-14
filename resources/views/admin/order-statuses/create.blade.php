@extends('layouts.admin')
@section('title', "Order Statuses")
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
                    <h1 class="m-0 text-dark">Order Status Create</h1>
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

                    {!! Form::open(['route' => 'admin.order-statuses.store', 'method' =>'post']) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Order Status Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('label', 'Label') !!}
                                        {!! Form::text('label', null, ['class'=>'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('sort', 'Sort') !!}
                                        {!! Form::text('sort', null, ['class'=>'form-control','oninput'=>"this.value =
                                        this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('color', 'Color') !!}
                                        <div class="input-group my-colorpicker2">
                                            {!! Form::text('color', null, ['class'=>'form-control']) !!}
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"></i></span>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="icheck-primary">
                                                    {!! Form::checkbox('cancellation', '1', null, ['id'=>'cancellation',
                                                    'class'=>'form-control'])
                                                    !!}
                                                    {!! Form::label('cancellation', '&nbsp;Cancellation') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
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
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->can(['admin-order-statuses-read']))
                            <a href="{{route('admin.order-statuses.index')}}" type="button"
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
        //color picker with addon
        $('.my-colorpicker2').colorpicker({
            format: 'auto'
        });

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });
    //end document ready
    });
</script>
@endpush
@endsection
