@extends('layouts.admin')
@section('title', "Admin Permission Group")
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
                    <h1 class="m-0 text-dark">Admin Permission Group</h1>
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
                            <h3 class="card-title">Admin Permission Group List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($adminPermissionGroups as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($permission->status) !!}</td>
                                        <td>{{$permission->created_at->diffForHumans()}}</td>
                                        <td>{{$permission->updated_at->diffForHumans()}}</td>
                                        <td class="text-center">
                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->hasPermission('admin-permission-groups-update'))
                                            <a data-toggle="tooltip" title="Edit"
                                                href="{{route('admin.admin-permission-groups.edit', $permission->id)}}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->hasPermission('admin-permission-groups-delete'))
                                            <a href="#" data-toggle="tooltip" title="Delete"
                                                class="btn btn-danger btn-sm"
                                                onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $permission->id }}').submit(); } event.returnValue = false; return false;"><i
                                                    class="fa fa-trash"></i> </a>
                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\AdminPermissionGroupController@destroy', $permission->id],
                                            'id'=>'deleteForm'.$permission->id]) !!}
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
                                Page {{ $adminPermissionGroups->currentPage() }} , showing
                                {{ $adminPermissionGroups->count() }}
                                records out of {{ $adminPermissionGroups->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $adminPermissionGroups->appends(request()->all())->links() }}
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
