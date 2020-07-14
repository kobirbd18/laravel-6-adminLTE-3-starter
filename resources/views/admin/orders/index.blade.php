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
                    <h1 class="m-0 text-dark">Orders</h1>
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
                    @include('include.flashMessage')
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Order List</h3>
                        </div>
                        {!! Form::open(['method'=>'GET', 'action'=>['Admin\OrderController@index']]) !!}

                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('order_number', 'Order Number') !!}
                                        {!! Form::text('order_number', request()->order_number, ['class'=>'form-control']) !!}
                                    </div>
                                </div> --}}
                                <!-- /.col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('user_id', 'User') !!}
                                        {!! Form::select('user_id', ['0'=>'All']+$users,
                                        request()->user_id,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('shop_id', 'Shop') !!}
                                        {!! Form::select('shop_id', ['0'=>'All']+$shops,
                                        request()->shop_id,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <button type="submit" class="btn btn-primary"> Filter </button>
                        </div>
                        {!! Form::close() !!}

                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Shop</th>
                                    <th>Order Item</th>
                                    <th>Grant Total</th>
                                    <th>Delivered Grant Total</th>
                                    <th>Discount</th>
                                    <th>Final Amount</th>
                                    <th class="text-center">Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user ? $order->user->name : '' }}</td>
                                        <td>{{ $order->shop ? $order->shop->name : '' }}</td>
                                        <td>{{ $order->total_order_item }}</td>
                                        <td>{{ $order->grant_total }}</td>
                                        <td>{{ $order->delivered_grant_total }}</td>
                                        <td>{{ $order->discount }}</td>
                                        <td>{{ $order->final_amount }}</td>
                                        <td class="text-center">{!! Helper::orderStatusLabel($order->status) !!}</td>
                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                        <td>{{ $order->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a class="btn bg-gray btn-sm"
                                                href="{{ route('admin.orderLog',$order->id) }}" data-toggle="tooltip"
                                                title="Logs"> <i class="fas fa-history"></i></a>

                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('admin.orders.show',$order->id) }}" data-toggle="tooltip"
                                                title="Detail"> <i class="fas fa-eye"></i></a>

                                            @if($order->status == 0)
                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can(['admin-order-items-create']))
                                            <a class="btn bg-pink btn-sm"
                                                href="{{route('admin.order-items.index',$order->id)}}"
                                                data-toggle="tooltip" title="Add Order Item"> <i
                                                    class="fas fa-plus-square"></i></a>
                                            @endif
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-orders-update'))
                                            @if($order->status != 0)
                                            <a class="btn btn-success btn-sm"
                                                href="{{route('admin.changeOrderStatus',$order->id)}}"
                                                data-toggle="tooltip" title="Order Status"> <i
                                                    class="fas fa-cart-plus"></i></a>
                                            @endif
                                            <a class="btn btn-warning btn-sm"
                                                href="{{route('admin.processOrder',$order->id)}}" data-toggle="tooltip"
                                                title="Processing Order"> <i class="fas fa-baby-carriage"></i></a>

                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.orders.edit',$order->id)}}" data-toggle="tooltip"
                                                title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pb-0">
                            <ul class="pagination pagination-sm m-0 float-right">
                                Page {{  $orders->currentPage() }} , showing
                                {{  $orders->count() }}
                                records out of {{  $orders->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{  $orders->appends(request()->all())->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
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

        $('#user_id').select2({
            allowClear: true,
            placeholder: "All",
            minimumInputLength:5,
            ajax: {
                url: '{{ route('admin.searchUsers') }}',
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1,
                        "_token":"{{ csrf_token() }}"
                    }
                    // Query parameters will be ?search=[term]&page=[page]
                    return query;
                }
            }
        });

        $('#shop_id').select2({
            allowClear: true,
            placeholder: "All",
            minimumInputLength:5,
            ajax: {
                url: '{{ route('admin.searchShops') }}',
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1,
                        "_token":"{{ csrf_token() }}"
                    }
                    // Query parameters will be ?search=[term]&page=[page]
                    return query;
                }
            }
        });
        //end document ready
    });
</script>
@endpush
@endsection
