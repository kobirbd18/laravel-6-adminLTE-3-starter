@extends('layouts.admin')
@section('title','Orders')
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
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order Info</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Order Info</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Shop</th>
                                    <th>Order Item</th>
                                    <th>Grant Total</th>
                                    <th>Delivered Grant Total</th>
                                    <th>Discount</th>
                                    <th>Final Amount</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user ? $order->user->name : '' }}</td>
                                        <td>{{ $order->shop ? $order->shop->name : '' }}</td>
                                        <td>{{ $order->total_order_item }}</td>
                                        <td>{{ $order->grant_total }}</td>
                                        <td>{{ $order->delivered_grant_total }}</td>
                                        <td>{{ $order->discount }}</td>
                                        <td>{{ $order->final_amount }}</td>
                                        <td class="text-center">{!! Helper::orderStatusLabel($order->status) !!}
                                        </td>
                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                        <td>{{ $order->updated_at->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.card -->
            </div>
            <!-- /.row (main row) -->
            <div class="row">
                <div class="col-md-12">
                    @include('include.error')
                    @include('include.flashMessage')
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Current Order Item List</h3>
                            @if($order->status == 2)
                            <a class="btn btn-info float-right" href="#"
                                onclick="if (confirm(&quot;Are you sure you want to quick change order status ?&quot;)) { document.getElementById('statusId{{ $order->id }}').submit(); } event.returnValue = false; return false;">Shipped</a>

                            {!! Form::open(['method'=>'POST',
                            'action'=>['Admin\OrderController@quickChangeStatus',$order->id],
                            'id'=>'statusId'.$order->id]) !!}
                            {!! Form::close() !!}
                            @endif
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <th>ID</th>
                                        <th>Shop Product</th>
                                        <th>Quantity</th>
                                        <th>Order Quantity</th>
                                        <th>Delivered Quantity</th>
                                        <th>Normal Price</th>
                                        <th>Offer Price</th>
                                        <th>Order Amount</th>
                                        <th>Delivered Amount</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->id }}</td>
                                            <td>{{ $orderItem->shopProduct ? $orderItem->shopProduct->product_name_weight : '' }}
                                            </td>
                                            <td>{{ $orderItem->quantity }}</td>
                                            <td>{{ $orderItem->order_quantity }}</td>
                                            <td class="text-center">
                                                {{ $orderItem->delivered_quantity }}
                                                <small
                                                    class="d-block text-info">{{ ($orderItem->processingBy && $orderItem->delivered_quantity > 0) ?  $orderItem->name_with_type : '' }}</small>
                                            </td>
                                            <td>{{ $orderItem->general_price }}</td>
                                            <td>{{ $orderItem->offer_price }}</td>
                                            <td>{{ $orderItem->order_amount }}</td>
                                            <td>{{ $orderItem->delivered_amount }}</td>
                                            <td>{{ $orderItem->created_at->diffForHumans() }}</td>
                                            <td>{{ $orderItem->updated_at->diffForHumans() }}</td>
                                            <td class="text-center">
                                                @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                                Auth::guard('admin')->user()->can('admin-order-items-delete'))
                                                @if($order->status <= 2) <a href="#" class="btn btn-danger btn-sm"
                                                    data-toggle="tooltip" title="Delete"
                                                    onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $orderItem->id }}').submit(); } event.returnValue = false; return false;">
                                                    <i class="fa fa-trash"></i></a>

                                                    {!! Form::open(['method'=>'DELETE',
                                                    'action'=>['Admin\OrderItemController@destroy',
                                                    $orderItem->order_id,$orderItem->id],
                                                    'id'=>'deleteForm'.$orderItem->id]) !!}
                                                    {!! Form::close() !!}
                                                    @endif
                                                    @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($order->status <= 2) <!-- /.row (main row) -->
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::model($order,['route' => ['admin.processOrderStore',$order->id],
                        'method'
                        =>'post']) !!}
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Delivering Order Item List</h3>
                                @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                Auth::guard('admin')->user()->can(['admin-order-items-create']))
                                <a href="{{route('admin.order-items.create',$order->id)}}"
                                    class="btn btn-success float-right">Add Extra Order Item</a>
                                @endif
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <th>ID</th>
                                            <th>Shop Product</th>
                                            <th>Quantity</th>
                                            <th>Order Quantity</th>
                                            @if($order->status == 2)
                                            <th>Delivered Quantity</th>
                                            @endif
                                            <th>{{ $order->status <= 2 ? 'Delivery Quantity' : 'Delivered Quantity' }}
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderItems as $orderItem)
                                            <tr>
                                                <td>{{ $orderItem->id }}</td>
                                                <td>{{ $orderItem->shopProduct ? $orderItem->shopProduct->product_name_weight : '' }}
                                                </td>
                                                <td>{{ $orderItem->quantity }}</td>
                                                <td>{{ $orderItem->order_quantity }}</td>
                                                @if($order->status == 2)
                                                <td>{{ $orderItem->delivered_quantity }}</td>
                                                @endif
                                                <td class="text-center">
                                                    @if($order->status == 2)
                                                    <div class="form-group mb-0">
                                                        {!! Form::text("delivered_quantity[$orderItem->id]",
                                                        $orderItem->delivered_quantity == 0 ? $orderItem->order_quantity
                                                        :
                                                        $orderItem->delivered_quantity,
                                                        ['class'=>'form-control','oninput'=>"this.value =
                                                        this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g,
                                                        '$1');"])
                                                        !!}
                                                    </div>
                                                    @else
                                                    {{ $orderItem->delivered_quantity }}
                                                    <small
                                                        class="d-block text-info">{{ $orderItem->processingBy ?  $orderItem->name_with_type : '' }}</small>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                @if($order->status == 2)
                                <button type="submit" class="btn btn-primary">Submit</button>

                                {!! Form::open(['method'=>'POST',
                                'action'=>['Admin\OrderController@quickChangeStatus',$order->id],
                                'id'=>'statusId'.$order->id,'style' =>'display:inline-block']) !!}
                                {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                @endif
                <!-- /.row (main row) -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Removed Order Item List</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <th>ID</th>
                                            <th>Shop Product</th>
                                            <th>Quantity</th>
                                            <th>Order Quantity</th>
                                            <th>Delivered Quantity</th>
                                            <th>Normal Price</th>
                                            <th>Offer Price</th>
                                            <th>Order Amount</th>
                                            <th>Delivered Amount</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->trashedOrderItems as $orderItem)
                                            <tr>
                                                <td>{{ $orderItem->id }}</td>
                                                <td>{{ $orderItem->shopProduct ? $orderItem->shopProduct->product_name_weight : '' }}
                                                </td>
                                                <td>{{ $orderItem->quantity }}</td>
                                                <td>{{ $orderItem->order_quantity }}</td>
                                                <td class="text-center">
                                                    {{ $orderItem->delivered_quantity }}
                                                    <small
                                                        class="d-block text-info">{{ $orderItem->processingBy ?  $orderItem->name_with_type : '' }}</small>
                                                </td>
                                                <td>{{ $orderItem->general_price }}</td>
                                                <td>{{ $orderItem->offer_price }}</td>
                                                <td>{{ $orderItem->order_amount }}</td>
                                                <td>{{ $orderItem->delivered_amount }}</td>
                                                <td>{{ $orderItem->created_at->diffForHumans() }}</td>
                                                <td>{{ $orderItem->updated_at->diffForHumans() }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                Auth::guard('admin')->user()->can(['admin-orders-read']))
                                <a href="{{route('admin.orders.index')}}" type="button" class="btn btn-danger">Back</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@push('js')
<!-- input partial scripts here -->
<script>
    $(document).ready(function() {
        $('.multi-select').select2({
            placeholder: "Choose an option",
        });
        //end document ready
    });
</script>
@endpush
@endsection
