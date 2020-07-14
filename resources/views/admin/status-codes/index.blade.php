@extends('layouts.admin')
@section('title', "Status Codes")
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
                    <h1 class="m-0 text-dark">Status Code</h1>
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
                            <h3 class="card-title">Status Code List</h3>
                        </div>
                        {!! Form::open(['method'=>'GET', 'action'=>['Admin\StatusCodeController@index']]) !!}

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('code', 'Status Code') !!}
                                        {!! Form::text('code', request()->code, ['class'=>'form-control','oninput'=>"this.value =
                                        this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('message_en', 'English Message') !!}
                                        {!! Form::text('message_en', request()->message_en, ['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('message_bn', 'Bangla Message') !!}
                                        {!! Form::text('message_bn', request()->message_bn, ['class'=>'form-control']) !!}
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
                                    <th>English Message</th>
                                    <th>Bangla Message</th>
                                    <th class="text-center">Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($statusCodes as $statusCode)
                                    <tr>
                                        <td>{{ $statusCode->id }}</td>
                                        <td>{{ $statusCode->code }}</td>
                                        <td>{{ $statusCode->message_en }}</td>
                                        <td>{{ $statusCode->message_bn }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($statusCode->status) !!}</td>
                                        <td>{{ $statusCode->created_at->diffForHumans() }}</td>
                                        <td>{{ $statusCode->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-status-codes-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.status-codes.edit', $statusCode->id)}}" data-toggle="tooltip"
                                                title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-status-codes-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $statusCode->id }}').submit(); } event.returnValue = false; return false;"><i
                                                    class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\StatusCodeController@destroy',
                                            $statusCode->id], 'id'=>'deleteForm'.$statusCode->id]) !!}
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
                                Page {{ $statusCodes->currentPage() }} , showing
                                {{ $statusCodes->count() }}
                                records out of {{ $statusCodes->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $statusCodes->appends(request()->all())->links() }}
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
