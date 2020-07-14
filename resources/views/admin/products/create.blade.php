@extends('layouts.admin')
@section('title', "Products")
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
                    <h1 class="m-0 text-dark">Product Create</h1>
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
                    @include('include.error')
                    @include('include.flashMessage')

                    {!! Form::open(['route' => 'admin.products.store', 'method' =>'post', 'files'=>true]) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New Product Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('category_id', 'Category') !!}
                                        {!! Form::select('category_id', [''=>'Choose an
                                        option']+$categories, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('unit_id', 'Unit') !!}
                                        {!! Form::select('unit_id', [''=>'Choose an
                                        option']+$units, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('weight', 'Weight') !!}
                                        {!! Form::text('weight', null, ['class'=>'form-control','oninput'=>"this.value =
                                        this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('price', 'Price') !!}
                                        {!! Form::text('price', null, ['class'=>'form-control','oninput'=>"this.value =
                                        this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image"
                                                name="image">
                                            <label class="custom-file-label" for="image">Upload {{ Config::get('constants.PRODUCT_WIDTH',320).'x'.Config::get('constants.PRODUCT_HEIGHT',320) }}
                                                product image</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="icheck-primary">
                                                    {!! Form::checkbox('status', '1', 1, ['id'=>'status',
                                                    'class'=>'form-control'])
                                                    !!}
                                                    {!! Form::label('status', '&nbsp;Active') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="icheck-primary">
                                                    {!! Form::checkbox('take_fraction_qnt', '1', null, ['id'=>'take_fraction_qnt',
                                                    'class'=>'form-control'])
                                                    !!}
                                                    {!! Form::label('take_fraction_qnt', '&nbsp;Take Fractional Quantity') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="submit" value="create_single">Create
                                Single</button>
                            <button type="submit" class="btn btn-primary" name="submit" value="create_more">Create
                                More</button>

                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->can(['admin-products-read']))
                            <a href="{{route('admin.products.index')}}" type="button" class="btn btn-danger">Cancel</a>
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
        bsCustomFileInput.init();
        $('.multi-select').select2({
            placeholder: "Choose an option",
        });
            //end document ready
        });
</script>
@endpush
@endsection
