@extends('layouts.admin')
@section('title', "Thanas")
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
                    <h1 class="m-0 text-dark">Thanas</h1>
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
                            <h3 class="card-title">Thana List</h3>
                        </div>
                        {!! Form::open(['method'=>'GET', 'action'=>['Admin\ThanaController@index']]) !!}

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('name_en', 'English Name') !!}
                                        {!! Form::text('name_en', request()->name_en, ['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('name_bn', 'Bangla Name') !!}
                                        {!! Form::text('name_bn', request()->name_bn, ['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('district_id', 'District') !!}
                                        {!! Form::select('district_id',
                                        ['0'=>'All']+$districts,
                                        request()->district_id,
                                        ['class'=>'form-control multi-select', 'id'=>'district_id']) !!}
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
                                    <th>English Name</th>
                                    <th>Bangla Name</th>
                                    <th>District</th>
                                    <th class="text-center">Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($thanas as $thana)
                                    <tr>
                                        <td>{{ $thana->id }}</td>
                                        <td>{{ $thana->name_en }}</td>
                                        <td>{{ $thana->name_bn }}</td>
                                        <td>{{ $thana->district ? $thana->district->name_en : '' }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($thana->status) !!}</td>
                                        <td>{{ $thana->created_at->diffForHumans() }}</td>
                                        <td>{{ $thana->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-thanas-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.thanas.edit', $thana->id)}}" data-toggle="tooltip"
                                                title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-thanas-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $thana->id }}').submit(); } event.returnValue = false; return false;"><i
                                                    class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\ThanaController@destroy',
                                            $thana->id], 'id'=>'deleteForm'.$thana->id]) !!}
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
                                Page {{ $thanas->currentPage() }} , showing
                                {{ $thanas->count() }}
                                records out of {{ $thanas->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $thanas->appends(request()->all())->links() }}
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
