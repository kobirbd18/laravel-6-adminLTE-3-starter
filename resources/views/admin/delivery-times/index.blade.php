@extends('layouts.admin')
@section('title', "Delivery Times")
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
                    <h1 class="m-0 text-dark">Delivery Times</h1>
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
                            <h3 class="card-title">Delivery Time List</h3>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Min</th>
                                    <th>Max</th>
                                    <th>Unit</th>
                                    <th>Interval</th>
                                    <th class="text-center">Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($deliveryTimes as $deliveryTime)
                                    <tr>
                                        <td>{{ $deliveryTime->id }}</td>
                                        <td>{{ $deliveryTime->min }}</td>
                                        <td>{{ $deliveryTime->max }}</td>
                                        <td class="text-center">{!! Helper::unitStatusLabel($deliveryTime->unit) !!}</td>
                                        <td>{{ $deliveryTime->time_with_unit }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($deliveryTime->status) !!}</td>
                                        <td>{{ $deliveryTime->created_at->diffForHumans() }}</td>
                                        <td>{{ $deliveryTime->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-delivery-times-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.delivery-times.edit', $deliveryTime->id)}}"
                                                data-toggle="tooltip" title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-delivery-times-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $deliveryTime->id }}').submit(); } event.returnValue = false; return false;"><i
                                                    class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\DeliveryTimeController@destroy',
                                            $deliveryTime->id], 'id'=>'deleteForm'.$deliveryTime->id]) !!}
                                            {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pb-0">
                            <ul class="pagination pagination-sm m-0 float-right">
                                Page {{ $deliveryTimes->currentPage() }} , showing
                                {{ $deliveryTimes->count() }}
                                records out of {{ $deliveryTimes->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $deliveryTimes->appends(request()->all())->links() }}
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
