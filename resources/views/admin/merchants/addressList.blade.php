@extends('layouts.admin')
@section('title','User Addresses')
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
                    <h1 class="m-0 text-dark">User Info</h1>
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
                            <h3 class="card-title">User Info</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Referral Code</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td><a class="text-info" href="javascript:void(0)">{{ $user->email }}</a>
                                        </td>
                                        <td><a class="text-info" href="javascript:void(0)">{{ $user->mobile }}</a></td>
                                        <td>{{ $user->referral_code }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($user->status) !!}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row (main row) -->
            <div class="row">
                <div class="col-lg-12">
                    @include('include.error')
                    @include('include.flashMessage')
                    {!! Form::open(['route' => ['admin.addresses.store',$user->id], 'method' =>'post']) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New City Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('phone', 'Phone') !!}
                                        {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('region_id', 'Region') !!}
                                        {!! Form::select('region_id', [''=>'Choose an
                                        option']+$regions, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('city_id', 'City') !!}
                                        {!! Form::select('city_id', [''=>'Choose an
                                        option']+$cities, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('area_id', 'Area') !!}
                                        {!! Form::select('area_id', [''=>'Choose an
                                        option']+$areas, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label("address", "Address") }}
                                        {{Form::textarea("address", null,["class" => "form-control resize-vertical",'rows' => '5'])}}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('label', 'Label') !!}
                                        {!! Form::text('label', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            {!! Form::checkbox('is_default', '1', null, ['id'=>'is_default',
                                            'class'=>'form-control'])
                                            !!}
                                            {!! Form::label('is_default', '&nbsp;Save as a default address') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->can(['admin-users-read']))
                            <a href="{{route('admin.users.index')}}" type="button" class="btn btn-danger">Back</a>
                            @endif
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.card -->
            </div>

            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">User Address List</h3>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Label</th>
                                    <th>Phone</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    <th>Area</th>
                                    <th>Address</th>
                                    <th>Default Address</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($user->addresses as $address)
                                    <tr>
                                        <td>{{ $address->id }}</td>
                                        <td>{{ $address->name }}</td>
                                        <td>{{ $address->label }}</td>
                                        </td>
                                        <td><a class="text-info" href="javascript:void(0)">{{ $address->phone }}</a>
                                        </td>
                                        <td>{{ $address->region ? $address->region->name : '' }}</td>
                                        <td>{{ $address->city ? $address->city->name : '' }}</td>
                                        <td>{{ $address->area ? $address->area->name : '' }}</td>
                                        <td>{{ $address->address }}</td>
                                        <td class="text-center">{{ $address->is_default ? 'Default Address' : '' }}</td>
                                        <td>{{ $address->created_at->diffForHumans() }}</td>
                                        <td>{{ $address->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-addresses-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.addresses.edit', [$user->id, $address->id])}}"
                                                data-toggle="tooltip" title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            @if($address->is_default != 1)
                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-addresses-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete" onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $address->id }}').submit();
                                            } event.returnValue = false; return false;"><i class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\UserAddressController@destroy', $user->id, $address->id], 'id'=>'deleteForm'.$address->id]) !!}
                                            {!! Form::close() !!}
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pb-0">
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

        //For getting associate City after changing region
        $('#region_id').on('change', function () {
            $('#area_id').html('');
            if ($(this).val() != '') {
                const region_id = $(this).val();
                const csrf_token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ route('admin.getCities') }}',
                    method: 'POST',
                    data: {'region_id': region_id, '_token': csrf_token},
                    //must be send csrf_token exactly to _token name otherwise not work
                    success: function (data) {
                        $('#city_id').html(data);
                    }
                });
            } else {
                $('#city_id').html('');
            }
        })
        //For getting associate area after changing city
        $('#city_id').on('change', function () {
            if ($(this).val() != '') {
                const city_id = $(this).val();
                const csrf_token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ route('admin.getAreas') }}',
                    method: 'POST',
                    data: {'city_id': city_id, '_token': csrf_token},
                    //must be send csrf_token exactly to _token name otherwise not work
                    success: function (data) {
                        $('#area_id').html(data);
                    }
                });
            } else {
                $('#area_id').html('');
            }
        })
        //end document ready
    });
</script>
@endpush
@endsection
