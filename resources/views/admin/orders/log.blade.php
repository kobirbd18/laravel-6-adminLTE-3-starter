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
                    <h1 class="m-0 text-dark">Order Logs</h1>
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Order Info</h3>
                        </div>
                        <div class="card-body table-responsive">
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
                                    <th class="text-center">Status</th>
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
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
            <!-- Timelime example  -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Order Log Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <!-- The time line -->
                                    <div class="timeline">
                                        <!-- timeline item -->
                                        @foreach($order->orderStatusLogs as $log)
                                        <div>
                                            <i class="fas fa-info text-white"
                                                style="background:{!! Helper::orderStatusColor($log->status) !!}"></i>
                                            <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> {{ $log->created_at->format('h:i a - m-Y') }}</span>
                                                <h3 class="timeline-header"><a href="javascript:void(0)">{!!
                                                        Helper::orderStatusLabel($log->status) !!}</a> By
                                                    {{ $log->actionBy ? $log->name_with_type : '' }}</h3>

                                                <div class="timeline-body">
                                                    Note: {{ $log->note }}
                                                </div>
                                                {{-- <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-sm">Read more</a>
                                                    <a class="btn btn-danger btn-sm">Delete</a>
                                                    </div> --}}
                                            </div>
                                        </div>
                                        @endforeach
                                        <!-- END timeline item -->
                                        @if ($order->orderStatusLogs->count() > 0)
                                        <div>
                                            <i class="fas fa-history bg-gray"></i>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.col -->
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
