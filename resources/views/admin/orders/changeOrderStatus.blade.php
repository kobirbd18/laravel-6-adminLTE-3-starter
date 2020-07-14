@extends('layouts.admin')
@section('title', "Orders")
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
                    <h1 class="m-0 text-dark">Order Update</h1>
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Order Status Change Info</h3>
                        </div>
                        <div class="card-body">
                            @if($order->status <=4) <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        {!! Form::model($order,['route' => ['admin.changeOrderStatusStore',$order->id],
                                        'method'
                                        =>'post']) !!}
                                        <div class="form-group">
                                            {!! Form::label('status', 'Order Status') !!}
                                            {!! Form::select('status', [''=>'Choose an
                                            option']+$status, null,
                                            ['class'=>'form-control multi-select']) !!}
                                        </div>
                                        <div class="form-group" id="note-show" style="display:{{ $display }}">
                                            {{ Form::label("note", "Cancellation Note") }}
                                            {{Form::textarea("note", null,["class" => "form-control resize-vertical",'rows' => '5'])}}
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary"
                                            onclick="if (confirm('Are you sure you want to change status ?')){ return true;} event.returnValue = false; return false;">
                                            Submit
                                        </button>
                                        {!! Form::close() !!}
                                    </div>
                                    @if($order->status <=3) <div class="col-md-8 text-center" style="padding-top:30px;">
                                        <a class="btn btn-md text-white"
                                            style="background:{{$orderStatus ? $orderStatus->color : '#fff' }} !important"
                                            href="#"
                                            onclick="if (confirm(&quot;Are you sure you want to quick change order status ?&quot;)) { document.getElementById('statusId{{ $order->id }}').submit(); } event.returnValue = false; return false;">{{
                                        Config::get('constants.ORDER_STATUS_TEXT')[$order->status+1] }}
                                            {{ $orderStatus ? $orderStatus->label : '' }}</a>

                                        {!! Form::open(['method'=>'POST',
                                        'action'=>['Admin\OrderController@quickChangeStatus',$order->id],
                                        'id'=>'statusId'.$order->id]) !!}
                                        {!! Form::close() !!}
                                </div>
                                @endif
                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-12">
                                <p>Nothing to change</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer text-right">
                        @if(Auth::guard('admin')->user()->hasRole('admin') ||
                        Auth::guard('admin')->user()->can(['admin-orders-read']))
                        <a href="{{route('admin.orders.index')}}" type="button" class="btn btn-danger">Back</a>
                        @endif
                    </div>
                </div>

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
        bsCustomFileInput.init();
        $('.multi-select').select2({
            placeholder: "Choose an option",
        });
        
        $('#status').on('change', function () {
            if($(this).val() == 5){
                $('#note-show').show();
            }else{
                $('#note-show').hide();
            }
        });

            //end document ready
        });
</script>
@endpush
@endsection
