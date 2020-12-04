@extends('layouts.admin')
@section('title', "Admin")
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
                    <h1 class="m-0 text-dark">Admin</h1>
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
                            <h3 class="card-title">Admin List</h3>
                        </div>
                        {!! Form::open(['method'=>'GET', 'action'=>['Admin\AdminController@index']]) !!}

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', request()->name, ['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email') !!}
                                        {!! Form::text('email', request()->email, ['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">

                                        {!! Form::label('role_id', 'Role') !!}
                                        {!! Form::select('role_id', ['0'=>'All']+$roles, request()->role_id,
                                        ['class'=>'form-control multi-select', 'id'=>'role_id']) !!}
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td><a class="text-info" href="javascript:void(0)">{{$admin->email}}</a></td>
                                        <td><a class="text-info" href="javascript:void(0)">{{$admin->phone}}</a></td>
                                        <td>{{ $admin->role ? $admin->role->name : '' }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($admin->status) !!}</td>
                                        <td>{{ $admin->created_at->diffForHumans() }}</td>
                                        <td>{{ $admin->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->hasPermission('admin-admins-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.admins.edit', $admin->id)}}" data-toggle="tooltip"
                                                title="Edit"> <i class="fas fa-edit"></i></a>

                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('admin.admins.resetPassword', $admin->id) }}"
                                            data-toggle="tooltip" title="Update Password"> <i
                                                class="fas fa-lock"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->hasPermission('admin-admins-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $admin->id }}').submit(); } event.returnValue = false; return false;"><i
                                                    class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\AdminController@destroy',
                                            $admin->id], 'id'=>'deleteForm'.$admin->id]) !!}
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
                                Page {{ $admins->currentPage() }} , showing
                                {{ $admins->count() }}
                                records out of {{ $admins->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $admins->appends(request()->all())->links() }}
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
