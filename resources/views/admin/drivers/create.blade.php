@extends('layouts.admin')
@section('title', "Drivers")
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
                    <h1 class="m-0 text-dark">Driver Create</h1>
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
                    {!! Form::open(['route' => 'admin.drivers.store', 'method' =>'post', 'files'=>true]) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New Driver Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                    </div>

                                    {{-- <div class="form-group">
                                        {!! Form::label('email', 'Email') !!}
                                        {!! Form::text('email', null, ['class'=>'form-control']) !!}
                                    </div> --}}

                                    <div class="form-group">
                                        {!! Form::label('mobile', 'Mobile Number') !!}
                                        {!! Form::text('mobile', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label("address", "Address") }}
                                        {{Form::textarea("address", null,["class" => "form-control resize-vertical",'rows' => '3'])}}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label("experience", "Experience") }}
                                        {{Form::textarea("experience", null,["class" => "form-control resize-vertical",'rows' => '3'])}}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('password', 'Password') !!}
                                        {!! Form::password('password', ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('password_confirmation', 'Confirm Password') !!}
                                        {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('referral', 'Referral Code') !!}
                                        {!! Form::text('referral', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('transport_type', 'Trasport Type') !!}
                                        {!! Form::select('transport_type', [''=>'Choose an
                                        option']+Config::get('constants.TRANSPORT_TYPE'), null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('online', 'Online Status') !!}
                                        {!! Form::select('online', [''=>'Choose an
                                        option']+Config::get('constants.DRIVER_ONLINE_STATUSES'), null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('district_id', 'District') !!}
                                        {!! Form::select('district_id', [''=>'Choose an
                                        option']+$districts, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('thana_id', 'Thana') !!}
                                        {!! Form::select('thana_id', [''=>'Choose an
                                        option']+$thanas, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="photo" name="photo">
                                            <label class="custom-file-label" for="photo">Upload profile photo</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="license_file_front"
                                                name="license_file_front">
                                            <label class="custom-file-label" for="license_file_front">Upload license
                                                front
                                                file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="license_file_back"
                                                name="license_file_back">
                                            <label class="custom-file-label" for="license_file_back">Upload license back
                                                file</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="nid_file_front"
                                                name="nid_file_front">
                                            <label class="custom-file-label" for="nid_file_front">Upload NID front
                                                file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="nid_file_back"
                                                name="nid_file_back">
                                            <label class="custom-file-label" for="nid_file_back">Upload NID back
                                                file</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        {!! Form::label('reference[father][name]', 'Father Name') !!}
                                        {!! Form::text('reference[father][name]', null, ['class'=>'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('reference[father][number]', 'Father Number') !!}
                                        {!! Form::text('reference[father][number]', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('reference[mother][name]', 'Mother Name') !!}
                                        {!! Form::text('reference[mother][name]', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('reference[mother][number]', 'Mother Number') !!}
                                        {!! Form::text('reference[mother][number]', null,
                                        ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('reference[brother][name]', 'Brother Name') !!}
                                        {!! Form::text('reference[brother][name]', null, ['class'=>'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('reference[brother][number]', 'Brother Number') !!}
                                        {!! Form::text('reference[brother][number]', null, ['class'=>'form-control'])
                                        !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('reference[sister][name]', 'Sister Name') !!}
                                        {!! Form::text('reference[sister][name]', null, ['class'=>'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('reference[sister][number]', 'Sister Number') !!}
                                        {!! Form::text('reference[sister][number]', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('reference[wife][name]', 'Wife Name') !!}
                                        {!! Form::text('reference[wife][name]', null, ['class'=>'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('reference[wife][number]', 'Wife Number') !!}
                                        {!! Form::text('reference[wife][number]', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('reference[father_in_law][name]', 'Father in law Name') !!}
                                        {!! Form::text('reference[father_in_law][name]', null,
                                        ['class'=>'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('reference[father_in_law][number]', 'Father in law Number') !!}
                                        {!! Form::text('reference[father_in_law][number]', null,
                                        ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('reference[first_uncle][name]', 'First Uncle Name') !!}
                                        {!! Form::text('reference[first_uncle][name]', null, ['class'=>'form-control'])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('reference[first_uncle][number]', 'First Uncle Number') !!}
                                        {!! Form::text('reference[first_uncle][number]', null,
                                        ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('reference[second_uncle][name]', 'Second Uncle Name') !!}
                                        {!! Form::text('reference[second_uncle][name]', null, ['class'=>'form-control'])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('reference[second_uncle][number]', 'Second Uncle Number') !!}
                                        {!! Form::text('reference[second_uncle][number]', null,
                                        ['class'=>'form-control']) !!}
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
                            Auth::guard('admin')->user()->can(['admin-drivers-read']))
                            <a href="{{route('admin.drivers.index')}}" type="button" class="btn btn-danger">Cancel</a>
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
        bsCustomFileInput.init();

        //For getting associate Thana after changing District
        $('#district_id').on('change', function () {
            if ($(this).val() != '') {
                const district_id = $(this).val();
                const csrf_token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ route('admin.vehicle-owners.getThana') }}',
                    method: 'POST',
                    data: {'district_id': district_id, '_token': csrf_token},
                    //must be send csrf_token exactly to _token name otherwise not work
                    success: function (data) {
                        $('#thana_id').html(data);
                    }
                });
            } else {
                $('#thana_id').html('');
            }
        })
            //end document ready
        });
</script>
@endpush
@endsection
