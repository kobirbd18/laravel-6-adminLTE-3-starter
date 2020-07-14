@extends('layouts.admin')
@section('title', "Shops")
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
                    <h1 class="m-0 text-dark">Shops</h1>
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
                            <h3 class="card-title">Shop List</h3>
                        </div>
                        {!! Form::open(['method'=>'GET', 'action'=>['Admin\ShopController@index']]) !!}

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Shop Name') !!}
                                        {!! Form::text('name', request()->name, ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('merchant_id', 'Merchant') !!}
                                        {!! Form::select('merchant_id', ['0'=>'All']+$merchants,
                                        request()->merchant_id,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('category_id', 'Category') !!}
                                        {!! Form::select('category_id', ['0'=>'All']+$categories,
                                        request()->category_id,
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
                                    <th>Shop Name</th>
                                    <th>Shop Open Time</th>
                                    <th>Merchant</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    <th>Area</th>
                                    <th>Category</th>
                                    <th>Shop Product Count</th>
                                    <th>Delivery Area Count</th>
                                    <th>Sub Category Count</th>
                                    <th>Shop Product Category Count</th>
                                    <th class="text-center">Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center" style="min-width: 150px">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($shops as $shop)
                                    <tr>
                                        <td>{{ $shop->id }}</td>
                                        <td>{{ $shop->name }}</td>
                                        <td>{{ $shop->schedule_time }}</td>
                                        <td>{{ $shop->merchant ? $shop->merchant->name : '' }}</td>
                                        <td>{{ $shop->region ? $shop->region->name : '' }}</td>
                                        <td>{{ $shop->city ? $shop->city->name : '' }}</td>
                                        <td>{{ $shop->area ? $shop->area->name : '' }}</td>
                                        <td>{{ $shop->category ? $shop->category->name : '' }}</td>
                                        <td>{{ $shop->shopProducts->count() }}</td>
                                        <td>{{ $shop->deliveryAreas->count() }}</td>
                                        <td>{{ $shop->shopSubCategories->count() }}</td>
                                        <td>{{ $shop->shopProductCategories->count() }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($shop->status)
                                            !!}</td>
                                        <td>{{ $shop->created_at->diffForHumans() }}</td>
                                        <td>{{ $shop->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm"
                                                href="{{route('admin.shops.show', $shop->id)}}" data-toggle="tooltip"
                                                title="Detail"> <i class="fas fa-eye"></i></a>

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-shop-categories-read','admin-shop-categories-create'))
                                            <a class="btn bg-gray btn-sm"
                                                href="{{route('admin.shop-product-categories.index', $shop->id)}}"
                                                data-toggle="tooltip" title="Shop Product Category"> <i
                                                    class="fas fa-th"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-shop-products-read','admin-shop-products-create'))
                                            <a class="btn bg-maroon btn-sm"
                                                href="{{route('admin.shop-products.index', $shop->id)}}"
                                                data-toggle="tooltip" title="Shop Product"> <i
                                                    class="fas fa-cart-arrow-down"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-shop-sub-categories-read','admin-shop-sub-categories-create'))
                                            <a class="btn btn-success btn-sm"
                                                href="{{route('admin.shop-sub-categories.index', $shop->id)}}"
                                                data-toggle="tooltip" title="Assign Sub Category"> <i
                                                    class="fas fa-columns"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-delivery-areas-read','admin-delivery-areas-create'))
                                            <a class="btn btn-warning btn-sm"
                                                href="{{route('admin.delivery-areas.index', $shop->id)}}"
                                                data-toggle="tooltip" title="Delivery Area"> <i
                                                    class="fas fa-map-marker-alt"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-shops-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.shops.edit', $shop->id)}}" data-toggle="tooltip"
                                                title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-shops-delete'))
                                            @if($shop->shopProducts->count() == 0)
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $shop->id }}').submit(); } event.returnValue = false; return false;"><i
                                                    class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\ShopController@destroy',
                                            $shop->id], 'id'=>'deleteForm'.$shop->id]) !!}
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
                                Page {{ $shops->currentPage() }} , showing
                                {{ $shops->count() }}
                                records out of {{ $shops->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $shops->appends(request()->all())->links() }}
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
    //end document ready
    });
</script>
@endpush
@endsection
