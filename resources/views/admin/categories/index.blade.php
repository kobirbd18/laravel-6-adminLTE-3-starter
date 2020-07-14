@extends('layouts.admin')
@section('title', "Categories")
@push('css')
<!-- input partial css here -->
<link rel="stylesheet" href="{{ asset('css/backend/plugins/jQueryFancibox/css/jquery.fancybox.min.css') }}">
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
                    <h1 class="m-0 text-dark">Categories</h1>
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
                            <h3 class="card-title">Category List</h3>
                        </div>
                        {!! Form::open(['method'=>'GET', 'action'=>['Admin\CategoryController@index']]) !!}

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', request()->name, ['class'=>'form-control']) !!}
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
                                    <th>Name</th>
                                    <th>Icon Image</th>
                                    <th>Priority</th>
                                    <th>Process</th>
                                    <th class="text-center">Slider Count</th>
                                    <th class="text-center">Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td width="80">
                                            <div style="width: 80px;">
                                                @if($category->icon_image)
                                                <a data-fancybox="gallery" data-caption="{{ $category->name }}"
                                                    href="{{ asset(Helper::storagePath($category->icon_image)) }}">
                                                    <img class="img-thumbnail"
                                                        src="{{ asset(Helper::storagePath($category->icon_image)) }}" alt="">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $category->priority }}</td>
                                        <td>{!! Helper::categoryProcess($category->process) !!}</td>
                                        <td>{{ $category->categorySliders->count() }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($category->status) !!}</td>
                                        <td>{{ $category->created_at->diffForHumans() }}</td>
                                        <td>{{ $category->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can(['admin-category-sliders-read']))
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('admin.category-sliders.index', $category->id) }}"
                                                data-toggle="tooltip" title="Category Sliders"> <i
                                                    class="fas fa-camera"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-categories-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.categories.edit', $category->id)}}" data-toggle="tooltip"
                                                title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-categories-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $category->id }}').submit(); } event.returnValue = false; return false;"><i
                                                    class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\CategoryController@destroy',
                                            $category->id], 'id'=>'deleteForm'.$category->id]) !!}
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
                                Page {{ $categories->currentPage() }} , showing
                                {{ $categories->count() }}
                                records out of {{ $categories->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $categories->appends(request()->all())->links() }}
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
<script src="{{ asset('js/backend/plugins/jQueryFancibox/js/jquery.fancybox.min.js') }}"></script>
<script>
    $(document).ready(function () {

        //end document ready
    });
</script>
@endpush
@endsection
