@extends('layouts.admin')
@section('title', "Offers")
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
                    <h1 class="m-0 text-dark">Offer Update</h1>
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
                    {!! Form::model($offer,['route' => ['admin.offers.update',$offer->id ], 'method'
                    =>'patch', 'files'=>true]) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Edit Offer Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label("description", "Description") }}
                                        {{Form::textarea("description", null,["class" => "form-control resize-vertical",'rows' => '5'])}}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('valid_at', 'Offer Valid Upto') !!}
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            {!! Form::text('valid_at', $offer->valid_at ? $offer->valid_at->format('Y-m-d') : null,
                                            ['class'=>'form-control multi-date float-right','autocomplete'=>'off'])
                                            !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="photo">Upload Slider {{ Config::get('constants.OFFER_WIDTH', 1000) . 'x' . Config::get('constants.OFFER_HEIGHT', 500) }} image</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('priority', 'Priority') !!}
                                        {!! Form::text('priority', null, ['class'=>'form-control','oninput'=>"this.value
                                        = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            {!! Form::checkbox('status', '1', null, ['id'=>'status',
                                            'class'=>'form-control'])
                                            !!}
                                            {!! Form::label('status', '&nbsp;Active') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->can(['admin-offers-read']))
                            <a href="{{route('admin.offers.index')}}" type="button"
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
        bsCustomFileInput.init();
        $('.multi-date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $('.datepicker').datepicker();
            //end document ready
        });
</script>
@endpush
@endsection
