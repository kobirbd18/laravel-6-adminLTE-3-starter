@extends('layouts.admin')
@section('title', "Users")
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
                    <h1 class="m-0 text-dark">Users</h1>
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
                            <h3 class="card-title">User List</h3>
                        </div>
                        {!! Form::open(['method'=>'GET', 'action'=>['Admin\UserController@index']]) !!}

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
                                        {!! Form::label('mobile', 'Mobile Number') !!}
                                        {!! Form::text('mobile', request()->mobile, ['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">

                                        {!! Form::label('status', 'Status') !!}
                                        {!! Form::select('status',
                                        ['all'=>'All']+Config::get('constants.ACTIVE_STATUSES'),
                                        request()->status,
                                        ['class'=>'form-control multi-select', 'id'=>'status']) !!}
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
                                    <th>Mobile Number</th>
                                    <th>Referral Code</th>
                                    <th>Refered By</th>
                                    <th>Address Count</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td><a class="text-info" href="javascript:void(0)">{{ $user->email }}</a>
                                        </td>
                                        <td><a class="text-info" href="javascript:void(0)">{{ $user->mobile }}</a></td>
                                        <td>{{ $user->referral_code }}</td>
                                        {{-- <td>{{ $user->address }}</td> --}}
                                        <td>
                                            @if ($user->referral)
                                            <small>
                                                <a href="{{ route('admin.users.show', $user->referral_id) }} ">
                                                    {{$user->referral ? $user->referral->name : '' }}
                                                </a>
                                            </small>
                                            @endif
                                        </td>
                                        <td>{{ $user->addresses->count() }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($user->status) !!}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('admin.users.show', $user->id) }}" data-toggle="tooltip"
                                                title="Detail"> <i class="fas fa-eye"></i></a>

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->hasPermission(['admin-addresses-read']))
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('admin.addresses.index', $user->id) }}"
                                                data-toggle="tooltip" title="Addresses"> <i
                                                    class="fas fa-map-marker-alt"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->hasPermission('admin-users-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.users.edit', $user->id)}}" data-toggle="tooltip"
                                                title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            {{-- @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->hasPermission('admin-users-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $user->id }}').submit();
                                            } event.returnValue = false; return false;"><i class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\VehicleOwnerController@destroy',
                                            $user->id], 'id'=>'deleteForm'.$user->id]) !!}
                                            {!! Form::close() !!}
                                            @endif --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pb-0">
                            <ul class="pagination pagination-sm m-0 float-right">
                                Page {{ $users->currentPage() }} , showing
                                {{ $users->count() }}
                                records out of {{ $users->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $users->appends(request()->all())->links() }}
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
