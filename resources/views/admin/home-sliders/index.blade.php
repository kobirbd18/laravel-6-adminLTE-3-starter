@extends('layouts.admin')
@section('title', "Home Sliders")
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
                    <h1 class="m-0 text-dark">Home Sliders</h1>
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
                            <h3 class="card-title">Home Slider List</h3>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Slider Image</th>
                                    <th>Priority</th>
                                    <th class="text-center">Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($homeSliders as $slider)
                                    <tr>
                                        <td>{{ $slider->id }}</td>
                                        <td>{{ $slider->title }}</td>
                                        <td width="80">
                                            <div style="width: 80px;">
                                                @if($slider->image)
                                                <a data-fancybox="gallery" data-caption="{{ $slider->title }}"
                                                    href="{{ asset(Helper::storagePath($slider->image)) }}">
                                                    <img class="img-thumbnail"
                                                        src="{{ asset(Helper::storagePath($slider->image)) }}" alt="">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $slider->priority }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($slider->status) !!}</td>
                                        <td>{{ $slider->created_at->diffForHumans() }}</td>
                                        <td>{{ $slider->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-home-sliders-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.home-sliders.edit', $slider->id)}}"
                                                data-toggle="tooltip" title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-home-sliders-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $slider->id }}').submit(); } event.returnValue = false; return false;"><i
                                                    class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\HomeSliderController@destroy',
                                            $slider->id], 'id'=>'deleteForm'.$slider->id]) !!}
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
                                Page {{ $homeSliders->currentPage() }} , showing
                                {{ $homeSliders->count() }}
                                records out of {{ $homeSliders->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $homeSliders->appends(request()->all())->links() }}
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
