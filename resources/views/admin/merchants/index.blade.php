@extends('layouts.admin')
@section('title', "Merchants")
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
                    <h1 class="m-0 text-dark">Merchants</h1>
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
                            <h3 class="card-title">Merchant List</h3>
                        </div>
                        {!! Form::open(['method'=>'GET', 'action'=>['Admin\MerchantController@index']]) !!}

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
                                    {{-- <th>Referral Code</th>
                                    <th>Refered By</th> --}}
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($merchants as $merchant)
                                    <tr>
                                        <td>{{ $merchant->id }}</td>
                                        <td>{{ $merchant->name }}</td>
                                        <td><a class="text-info" href="javascript:void(0)">{{ $merchant->email }}</a>
                                        </td>
                                        <td><a class="text-info" href="javascript:void(0)">{{ $merchant->mobile }}</a></td>
                                        {{-- <td>{{ $merchant->referral_code }}</td> --}}
                                        {{-- <td>
                                            @if ($merchant->referral)
                                            <small>
                                                <a href="{{ route('admin.merchants.show', $merchant->referral_id) }} ">
                                                    {{$merchant->referral ? $merchant->referral->name : '' }}
                                                </a>
                                            </small>
                                            @endif
                                        </td> --}}
                                        <td class="text-center">{!! Helper::activeStatusLabel($merchant->status) !!}</td>
                                        <td>{{ $merchant->created_at->diffForHumans() }}</td>
                                        <td>{{ $merchant->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('admin.merchants.show', $merchant->id) }}" data-toggle="tooltip"
                                                title="Detail"> <i class="fas fa-eye"></i></a>

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-merchants-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.merchants.edit', $merchant->id)}}" data-toggle="tooltip"
                                                title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            {{-- @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-merchants-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $merchant->id }}').submit();
                                            } event.returnValue = false; return false;"><i class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\MerchantController@destroy',
                                            $merchant->id], 'id'=>'deleteForm'.$merchant->id]) !!}
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
                                Page {{ $merchants->currentPage() }} , showing
                                {{ $merchants->count() }}
                                records out of {{ $merchants->total() }} total
                            </ul>
                        </div>
                        <div class="card-footer py-2">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $merchants->appends(request()->all())->links() }}
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
