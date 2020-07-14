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
                    <h1 class="m-0 text-dark">Coupons</h1>
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
                            <h3 class="card-title">Coupon List</h3>
                        </div>
                        {!! Form::open(['method'=>'GET', 'action'=>['Admin\CouponController@index']]) !!}

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('code', 'Coupon Code') !!}
                                        {!! Form::text('code', request()->code, ['class'=>'form-control']) !!}
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
                                    <th>Code</th>
                                    <th>Discount Type</th>
                                    <th>Discount</th>
                                    <th>Max Discount Amount (if %)</th>
                                    <th>Valid Upto</th>
                                    <th>Condition</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->id }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{!! Helper::discountType($coupon->discount_type) !!}</td>
                                        <td>{{ $coupon->discount }}</td>
                                        <td>{{ $coupon->discount_type == 2 ? $coupon->get_max_discount : '' }}</td>
                                        <td>{{ $coupon->valid_at ? $coupon->valid_at->format('d-m-Y') : '' }}</td>
                                        <td class="text-center">{!! Helper::discountCondition($coupon->condition) !!}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($coupon->status) !!}</td>
                                        <td>{{ $coupon->created_at->diffForHumans() }}</td>
                                        <td>{{ $coupon->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            @if($coupon->orders->count() == 0)
                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-coupons-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.coupons.edit', $coupon->id)}}" data-toggle="tooltip"
                                                title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-coupons-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $coupon->id }}').submit(); } event.returnValue = false; return false;"><i
                                                    class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\CouponController@destroy',
                                            $coupon->id], 'id'=>'deleteForm'.$coupon->id]) !!}
                                            {!! Form::close() !!}
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pb-0">
                            <ul class="pagination pagination-sm m-0 float-right">
                                Page {{ $coupons->currentPage() }} , showing
                                {{ $coupons->count() }}
                                records out of {{ $coupons->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $coupons->appends(request()->all())->links() }}
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

        //end document ready
    });
</script>
@endpush
@endsection
