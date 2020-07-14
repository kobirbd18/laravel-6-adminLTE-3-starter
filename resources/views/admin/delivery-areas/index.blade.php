@extends('layouts.admin')
@section('title','Delivery Areas')
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
            Auth::guard('admin')->user()->can(['admin-delivery-areas-create']))
            <div class="row">
                <div class="col-lg-12">
                    @include('include.error')
                    @include('include.flashMessage')
                    {!! Form::open(['route' => ['admin.delivery-areas.store',$shop->id], 'method' =>'post',
                    'files'=>true]) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New Delivery Area Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
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

                                    <div class="form-group">
                                        {!! Form::label('area_id', 'Area') !!}
                                        {!! Form::select('area_id', [''=>'Choose an
                                        option']+$areas, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('delivery_time_id', 'Delivery Time') !!}
                                        {!! Form::select('delivery_time_id', [''=>'Choose an
                                        option']+$deliveryTimes, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            {!! Form::checkbox('status', '1', 1, ['id'=>'status',
                                            'class'=>'form-control'])
                                            !!}
                                            {!! Form::label('status', '&nbsp;Active') !!}
                                        </div>
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
                            <h3 class="card-title">Delivery Area List</h3>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    <th>Area</th>
                                    <th>Delivery Time</th>
                                    <th class="text-center">Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($shop->deliveryAreas as $dArea)
                                    <tr>
                                        <td>{{ $dArea->id }}</td>
                                        <td>{{ $dArea->region ? $dArea->region->name : '' }}</td>
                                        <td>{{ $dArea->city ? $dArea->city->name : '' }}</td>
                                        <td>{{ $dArea->area ? $dArea->area->name : '' }}</td>
                                        <td>{{ $dArea->deliveryTime ? $dArea->deliveryTime->time_with_unit : '' }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($dArea->status) !!}</td>
                                        <td>{{ $dArea->created_at->diffForHumans() }}</td>
                                        <td>{{ $dArea->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-delivery-areas-update'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.delivery-areas.edit', [$shop->id, $dArea->id])}}"
                                                data-toggle="tooltip" title="Edit"> <i class="fas fa-edit"></i></a>
                                            @endif

                                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                                            Auth::guard('admin')->user()->can('admin-delivery-areas-delete'))
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Delete" onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $dArea->id }}').submit();
                                            } event.returnValue = false; return false;"><i class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE',
                                            'action'=>['Admin\DeliveryAreaController@destroy', $shop->id,
                                            $dArea->id], 'id'=>'deleteForm'.$dArea->id]) !!}
                                            {!! Form::close() !!}
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
