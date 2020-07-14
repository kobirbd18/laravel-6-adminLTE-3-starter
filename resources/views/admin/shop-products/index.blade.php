@extends('layouts.admin')
@section('title','Shop Products')
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
                    <h1 class="m-0 text-dark">Shop Info</h1>
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
                            <h3 class="card-title">Shop Info</h3>
                        </div>
                        <div class="card-body p-1">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    <th>Area</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $shop->id }}</td>
                                        <td>{{ $shop->name }}</td>
                                        <td>{{ $shop->category ? $shop->category->name : '' }}</td>
                                        <td>{{ $shop->region ? $shop->region->name : '' }}</td>
                                        <td>{{ $shop->city ? $shop->city->name : '' }}</td>
                                        <td>{{ $shop->area ? $shop->area->name : '' }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($shop->status) !!}
                                        </td>
                                        <td>{{ $shop->created_at->diffForHumans() }}</td>
                                        <td>{{ $shop->updated_at->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
            @if(Auth::guard('admin')->user()->hasRole('admin') ||
            Auth::guard('admin')->user()->can(['admin-shop-products-create']))
            <div class="row">
                <div class="col-lg-12">
                    @include('include.error')
                    @include('include.flashMessage')
                    {!! Form::open(['route' => ['admin.shop-products.store',$shop->id], 'method' =>'post']) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New Shop Product Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('product_id', 'Product') !!}
                                        {!! Form::select('product_id', [''=>'Choose an
                                        option']+$products, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('price', 'Price') !!}
                                        {!! Form::text('price', null, ['class'=>'form-control','oninput'=>"this.value =
                                        this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            {!! Form::checkbox('is_offer', '1', null,
                                            ['id'=>'is_offer',
                                            'class'=>'form-control'])
                                            !!}
                                            {!! Form::label('is_offer', '&nbsp;Have Offer') !!}
                                        </div>
                                    </div>

                                    <div class="form-group offerPrice" style="display: {{ $display }}">
                                        {!! Form::label('offer_price', 'Offer Price') !!}
                                        {!! Form::text('offer_price', null,
                                        ['class'=>'form-control','oninput'=>"this.value =
                                        this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('shop_product_category', 'Shop Product Category') !!}
                                        {!! Form::select('shop_product_category[]', $shopCategories, null,
                                        ['class'=>'form-control multi-select', 'multiple'=>true]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->can(['admin-shops-read']))
                            <a href="{{route('admin.shops.index')}}" type="button" class="btn btn-danger">Back</a>
                            @endif
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.card -->
            </div>
            @endif
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Shop Product List</h3>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Shop Product</th>
                                    <th>Price per Unit</th>
                                    <th>Offfer Status</th>
                                    <th>Offfer Price</th>
                                    <th>Recommended Status</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($shop->shopProducts as $shopProduct)
                                    <tr>
                                        <td>{{ $shopProduct->id }}</td>
                                        <td>{{ $shopProduct->product_name_weight ?? '' }}
                                        </td>
                                        <td>{{ $shopProduct->price }}</td>
                                        <td class="text-center">{!! Helper::offerStatusLabel($shopProduct->is_offer) !!}
                                        </td>
                                        <td>{{ $shopProduct->offer_price }}</td>
                                        <td class="text-center">{!! Helper::recommendedStatusLabel($shopProduct->recommended) !!}
                                        <td class="text-center">{!! Helper::activeStatusLabel($shopProduct->status) !!}
                                        </td>
                                        <td>{{ $shopProduct->created_at->diffForHumans() }}</td>
                                        <td>{{ $shopProduct->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm"
                                                href="{{route('admin.shop-products.show',[$shop->id,$shopProduct->id])}}"
                                                data-toggle="tooltip" title="Detail"> <i class="fas fa-eye"></i></a>
                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-shop-products-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.shop-products.edit',[$shop->id,$shopProduct->id])}}"
                                                data-toggle="tooltip" title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-shop-products-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete" onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $shopProduct->id }}').submit();
                                            } event.returnValue = false; return false;"><i class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\ShopProductController@destroy', $shop->id,
                                            $shopProduct->id], 'id'=>'deleteForm'.$shopProduct->id]) !!}
                                            {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pb-0">
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
    $(document).ready(function() {
        $('.multi-select').select2({
            placeholder: "Choose an option",
        });

        $('#is_offer').on('click', function (event) {
            if($(this).prop("checked") == true){
                $('.offerPrice').show();
            }else{
                $('.offerPrice').hide();
            }
        });

        //Get Product price
        $('#product_id').on('change', function () {
            if ($(this).val() != '') {
                const product_id = $(this).val();
                const csrf_token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ route('admin.getProductPrice') }}',
                    method: 'POST',
                    data: {'product_id': product_id, '_token': csrf_token},
                    //must be send csrf_token exactly to _token name otherwise not work
                    success: function (data) {
                        $('#price').val(data);
                    }
                });
            } else {
                $('#price').val('');
            }
        })
        //end document ready
    });
</script>
@endpush
@endsection
