@extends('layouts.admin')
@section('title', "User Addresses")
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
                    <h1 class="m-0 text-dark">User Address Update</h1>
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
                    @include('include.error')
                    {!! Form::model($address,
                    ['method'=>'PATCH','action'=>['Admin\UserAddressController@update', $userId,
                    $address->id]]) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Edit User Address Info</h3>
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
                            Auth::guard('admin')->user()->can(['admin-addresses-read']))
                            <a href="{{ route('admin.addresses.index',$userId) }}" type="button"
                                class="btn btn-danger">Cancel</a>
                            @endif
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.card -->
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
