@extends('layouts.admin')
@section('title', "Shops")
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
                    <h1 class="m-0 text-dark">Shop Create</h1>
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
                    {!! Form::open(['route' => 'admin.shops.store', 'method' =>'post', 'files'=>true]) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Create Shop Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('merchant_id', 'Merchant') !!}
                                        {!! Form::select('merchant_id', [''=>'Choose an
                                        option']+$merchants, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('category_id', 'Category') !!}
                                        {!! Form::select('category_id', [''=>'Choose an
                                        option']+$categories, null,
                                        ['class'=>'form-control multi-select']) !!}
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

                                    <div class="form-group">
                                        {!! Form::label('area_id', 'Area') !!}
                                        {!! Form::select('area_id', [''=>'Choose an
                                        option']+$areas, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            {!! Form::checkbox('schedule_open_time', '1', null,
                                            ['id'=>'schedule_open_time',
                                            'class'=>'form-control'])
                                            !!}
                                            {!! Form::label('schedule_open_time', '&nbsp;Schedule Open') !!}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    {!! Form::label('open_time', 'Shop Open Time') !!}
                                                    <div class="input-group date" id="open_time" data-target-input="nearest">
                                                            {!! Form::text('open_time', null,['class'=>'form-control datetimepicker-input', 'data-target' => '#open_time']) !!}
                                                        <div class="input-group-append" data-target="#open_time"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                <!-- /.form group -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    {!! Form::label('close_time', 'Shop Close Time') !!}
                                                    <div class="input-group date" id="close_time" data-target-input="nearest">
                                                        {!! Form::text('close_time', null,['class'=>'form-control datetimepicker-input', 'data-target' => '#close_time']) !!}
                                                        <div class="input-group-append" data-target="#close_time"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                <!-- /.form group -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label("address", "Address") }}
                                        {{Form::textarea("address", null,["class" => "form-control resize-vertical",'rows' => '5'])}}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('latitude', 'Latitude') !!}
                                        {!! Form::text('latitude', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('longitude', 'Longitude') !!}
                                        {!! Form::text('longitude', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('contact', 'Contact') !!}
                                        {!! Form::text('contact', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="photo">Upload Shop
                                                {{ Config::get('constants.SHOP_WIDTH',1000).'x'.Config::get('constants.SHOP_HEIGHT',500) }}
                                                image</label>
                                        </div>
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
                            <a href="{{ route('admin.shops.index') }}" type="button" class="btn btn-danger">Cancel</a>
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
        bsCustomFileInput.init();

        //Timepicker
        $('#open_time').datetimepicker({
            format: 'LT'
        })
        $('#close_time').datetimepicker({
            format: 'LT'
        })

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
