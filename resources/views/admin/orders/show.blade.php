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

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- form start -->
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title">Order Info</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 20%;">ID</th>
                                        <td style="width: 80%;">{{ $order->id }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">User</th>
                                        <td style="width: 80%;">{{ $order->user ? $order->user->name : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Delivery Address</th>
                                        <td style="width: 80%;">
                                            {{ $order->address ? $order->address->full_address : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Shop Detail</th>
                                        <td style="width: 80%;">{{ $order->shop ? $order->shop->full_address : '' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Total Order Item</th>
                                        <td style="width: 80%;">{{ $order->total_order_item }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Sub Total</th>
                                        <td style="width: 80%;">{{ $order->sub_total }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Delivery Charge</th>
                                        <td style="width: 80%;">{{ $order->delivery_charge }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Coupon Code</th>
                                        <td style="width: 80%; color:green; font-weight:700">{{ $order->coupon ? $order->coupon->code : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Discount Amount</th>
                                        <td style="width: 80%;">{{ $order->discount }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Grant Total</th>
                                        <td style="width: 80%;">{{ $order->grant_total }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Delivered Grant Total</th>
                                        <td style="width: 80%;">{{ $order->delivered_grant_total }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Final Amount</th>
                                        <td style="width: 80%;">{{ $order->final_amount }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Payment Method</th>
                                        <td style="width: 80%;">{!! Helper::paymentStatusLabel($order->payment_method)
                                            !!}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Rating</th>
                                        <td style="width: 80%;">{{ $order->rating }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Status</th>
                                        <td style="width: 80%;">{!! Helper::orderStatusLabel($order->status) !!}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Order At</th>
                                        <td style="width: 80%;">
                                            {{ $order->order_at ?$order->order_at->format('H:i - d-m-Y') : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Delivered At</th>
                                        <td style="width: 80%;">
                                            {{ $order->delivered_at ? $order->delivered_at->format('H:i - d-m-Y') : '' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Created At</th>
                                        <td style="width: 80%;">{{ $order->created_at->diffForHumans() }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">Updated At</th>
                                        <td style="width: 80%;">{{ $order->updated_at->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row (main row) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Order Item List</h3>
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
                                        <th class="text-center">Offer Status</th>
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
                                                <small
                                                    class="d-block text-info">{{ $orderItem->processingBy ?  $orderItem->name_with_type : '' }}</small>
                                            </td>
                                            <td>{{ $orderItem->general_price }}</td>
                                            <td>{{ $orderItem->offer_price }}</td>
                                            <td>{{ $orderItem->order_amount }}</td>
                                            <td>{{ $orderItem->delivered_amount }}</td>
                                            <td class="text-center">{!! Helper::offerStatusLabel($orderItem->is_offer)
                                                !!}</td>
                                            <td>{{ $orderItem->created_at->diffForHumans() }}</td>
                                            <td>{{ $orderItem->updated_at->diffForHumans() }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">Grant Total</td>
                                            <td>{{ $order->orderItems->sum('order_amount') }}</td>
                                            <td>{{ $order->orderItems->sum('delivered_amount') }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        //end document ready
    });
</script>
@endpush
@endsection
