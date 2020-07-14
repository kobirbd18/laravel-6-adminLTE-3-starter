@extends('layouts.admin')
@section('title','Orders')
@push('css')
<!-- input partial css here -->
<style>
    .priceShow {
        margin-bottom: 0
    }

    .priceShow label {
        min-width: 30%;
        font-weight: bold !important
    }
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
                <div class="col-lg-12">
                    @include('include.error')
                    @include('include.flashMessage')
                    {!! Form::model($order,['route' => ['admin.addOrderItemStore',$order->id],
                    'method'
                    =>'post']) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Add Order Item Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('shop_product_id', 'Shop Product') !!}
                                        {!! Form::select('shop_product_id', [''=>'Choose an
                                        option']+$shopProducts, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group priceShow">
                                        <label>Normal Price: <span class="text-info"
                                                id="price">{{ $price }}</span></label>
                                        <label>Offer Price: <span class="text-warning"
                                                id="offer_price">{{ $offer_price }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('order_quantity', 'Order Quantity') !!}
                                        {!! Form::text('order_quantity', null,
                                        ['class'=>'form-control','oninput'=>"this.value =
                                        this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->can(['admin-orders-read']))
                            <a href="{{route('admin.orders.index')}}" type="button" class="btn btn-danger">Back</a>
                            @endif
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.card -->
            </div>
            {{-- Added OrderList --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-danger card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Added Order Item List</h3>
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
                                        @foreach ($order->orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->id }}</td>
                                            <td>{{ $orderItem->shopProduct ? $orderItem->shopProduct->product_name_weight : '' }}
                                            </td>
                                            <td>{{ $orderItem->quantity }}</td>
                                            <td>{{ $orderItem->order_quantity }}</td>
                                            <td class="text-center">
                                                {{ $orderItem->delivered_quantity }}
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
                            @if($order->orderItems->count() > 0 && $order->status == 0)
                            <a href="#" class="btn btn-success"
                                onclick="if (confirm(&quot;Are you sure you want to finalize the order?&quot;)) { document.getElementById('deleteForm{{ $order->id }}').submit(); } event.returnValue = false; return false;">Finalize Order</a>

                            {!! Form::open(['method'=>'POST',
                            'action'=>['Admin\OrderController@finalizedOrder',
                            $order->id], 'id'=>'deleteForm'.$order->id]) !!}
                            {!! Form::close() !!}
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

        //Get Product price
        $('#shop_product_id').on('change', function () {
            if ($(this).val() != '') {
                const shop_product_id = $(this).val();
                const csrf_token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ route('admin.getShopProductPrice') }}',
                    method: 'POST',
                    data: {'shop_product_id': shop_product_id, '_token': csrf_token},
                    //must be send csrf_token exactly to _token name otherwise not work
                    success: function (data) {
                        $('#price').html(data['price']);
                        $('#offer_price').html(data['offer_price']);
                    }
                });
            } else {
                $('#price').html('');
                $('#offer_price').html('');
            }
        })
        //end document ready
    });
</script>
@endpush
@endsection
