@extends('layouts.admin')
@section('title','Sub Categories')
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
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
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
            Auth::guard('admin')->user()->can(['admin-shop-sub-categories-create']))
            <div class="row">
                <div class="col-lg-12">
                    @include('include.error')
                    @include('include.flashMessage')
                    {!! Form::open(['route' => ['admin.shop-sub-categories.store',$shop->id], 'method' =>'post']) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New Sub Category Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('sub_category_id', 'Sub Category') !!}
                                        {!! Form::select('sub_category_id', [''=>'Choose an
                                        option']+$subCategory, null,
                                        ['class'=>'form-control multi-select']) !!}
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
                            <h3 class="card-title">Sub Category List</h3>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Sub Category</th>
                                    <th>Category</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($shop->shopSubCategories as $subCategories)
                                    <tr>
                                        <td>{{ $subCategories->id }}</td>
                                        <td>{{ $subCategories->subCategory ? $subCategories->subCategory->name : '' }}</td>
                                        <td>{{ $subCategories->category ? $subCategories->category->name : '' }}</td>
                                        <td>{{ $subCategories->created_at->diffForHumans() }}</td>
                                        <td>{{ $subCategories->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-shop-sub-categories-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete" onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $subCategories->id }}').submit();
                                            } event.returnValue = false; return false;"><i class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\ShopSubCategoryController@destroy', $shop->id,
                                            $subCategories->id], 'id'=>'deleteForm'.$subCategories->id]) !!}
                                            {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        //end document ready
    });
</script>
@endpush
@endsection
