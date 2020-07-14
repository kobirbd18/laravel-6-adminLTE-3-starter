@extends('layouts.admin')
@section('title', "Category Sliders")
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
                    <h1 class="m-0 text-dark">Category Slider Update</h1>
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
                    {!! Form::model($categorySlider,
                    ['method'=>'PATCH','action'=>['Admin\CategorySliderController@update', $categoryId,
                    $categorySlider->id],'files'=>true]) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Edit Category Slider Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('title', 'Title') !!}
                                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="photo">Upload Slider {{ Config::get('constants.CAT_SLIDE_WIDTH', 1000) . 'x' . Config::get('constants.CAT_SLIDE_HEIGHT', 500) }} image</label>
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
                            Auth::guard('admin')->user()->can(['admin-category-sliders-read']))
                            <a href="{{ route('admin.category-sliders.index',$categoryId) }}" type="button"
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
    //end document ready
    });
</script>
@endpush
@endsection
