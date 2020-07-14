@extends('layouts.admin')
@section('title', "Shop Products")
@push('css')
<!-- input partial css here -->
<style>
    .product span.select2.select2-container.select2-container--default {
        pointer-events: none;
        opacity: 0.5;
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <h1 class="m-0 text-dark">Shop Product Update</h1>
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
                                    <th>Merchant</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    <th>Area</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $shopProduct->shop->id ?? '' }}</td>
                                        <td>{{ $shopProduct->shop->name ?? '' }}</td>
                                        <td>{{ $shopProduct->shop->category ? $shopProduct->shop->category->name : '' }}
                                        </td>
                                        <td>{{ $shopProduct->shop->merchant ? $shopProduct->shop->merchant->name : '' }}
                                        </td>
                                        <td>{{ $shopProduct->shop->region ? $shopProduct->shop->region->name : '' }}
                                        </td>
                                        <td>{{ $shopProduct->shop->city ? $shopProduct->shop->city->name : '' }}</td>
                                        <td>{{ $shopProduct->shop->area ? $shopProduct->shop->area->name : '' }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($shopProduct->shop->status
                                            ?? 0) !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->

            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    @include('include.error')
                    {!! Form::model($shopProduct,
                    ['method'=>'PATCH','action'=>['Admin\ShopProductController@update', $shopId,
                    $shopProduct->id]]) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Edit Shop Product Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group product">
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

                                    <div class="form-group offerPrice" style="display: {{ $display }} ">
                                        {!! Form::label('offer_price', 'Offer Price') !!}
                                        {!! Form::text('offer_price', null,
                                        ['class'=>'form-control','oninput'=>"this.value =
                                        this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('shop_product_category', 'Shop Product Category') !!}
                                        {!! Form::select('shop_product_category[]', $shopCategories, $presentCategories,
                                        ['class'=>'form-control multi-select', 'multiple'=>true]) !!}
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="icheck-primary">
                                                    {!! Form::checkbox('status', '1', null, ['id'=>'status',
                                                    'class'=>'form-control'])
                                                    !!}
                                                    {!! Form::label('status', '&nbsp;Active') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <div class="icheck-primary">
                                                    {!! Form::checkbox('recommended', '1', null, ['id'=>'recommended',
                                                    'class'=>'form-control'])
                                                    !!}
                                                    {!! Form::label('recommended', '&nbsp;Recommended Product') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->can(['admin-shop-products-read']))
                            <a href="{{ route('admin.shop-products.index',$shopId) }}" type="button"
                                class="btn btn-danger">Cancel</a>
                            @endif
                        </div>
                    </div>
                    {!! Form::close() !!}
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
