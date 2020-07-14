@extends('layouts.admin')
@section('title', "Orders")
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
                    <h1 class="m-0 text-dark">Order Create</h1>
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
                    @include('include.flashMessage')

                    {!! Form::open(['route' => 'admin.orders.store', 'method' =>'post']) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New Order Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('user_id', 'User') !!}
                                        {!! Form::select('user_id', [''=>'Choose an
                                        option']+$users, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('address_id', 'Address') !!}
                                        {!! Form::select('address_id', [''=>'Choose an
                                        option']+$addresses, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('shop_id', 'Shop') !!}
                                        {!! Form::select('shop_id', [''=>'Choose an
                                        option']+$shops, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('payment_method', 'Payment Method') !!}
                                        {!! Form::select('payment_method', [''=>'Choose an
                                        option']+Config::get('constants.PAYMENT_METHODS'), null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="submit" value="create_single">Create
                                Single</button>
                            <button type="submit" class="btn btn-primary" name="submit" value="create_more">Create
                                More</button>

                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->can(['admin-orders-read']))
                            <a href="{{route('admin.orders.index')}}" type="button" class="btn btn-danger">Cancel</a>
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
        $('.multi-select').select2({
            placeholder: "Choose an option",
        });

        $('#user_id').select2({
            allowClear: true,
            placeholder: "Choose an user",
            minimumInputLength:5,
            ajax: {
                url: '{{ route('admin.searchUsers') }}',
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1,
                        "_token":"{{ csrf_token() }}"
                    }
                    // Query parameters will be ?search=[term]&page=[page]
                    return query;
                }
            }
        });

        //Get Addess
        $('#user_id').on("select2:select", function(e) {
            if ($(this).val() != '') {
                const user_id = $(this).val();
                const csrf_token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ route('admin.getAddresses') }}',
                    method: 'POST',
                    data: {'user_id': user_id, '_token': csrf_token},
                    //must be send csrf_token exactly to _token name otherwise not work
                    success: function (data) {
                        $('#address_id').html(data);
                    }
                });
            } else {
                $('#address_id').html('');
            }
        });

        $('#shop_id').select2({
            allowClear: true,
            placeholder: "Choose a shop",
            minimumInputLength:5,
            ajax: {
                url: '{{ route('admin.searchShops') }}',
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1,
                        "_token":"{{ csrf_token() }}"
                    }
                    // Query parameters will be ?search=[term]&page=[page]
                    return query;
                }
            }
        });
            //end document ready
        });
</script>
@endpush
@endsection
