@extends('layouts.admin')
@section('title', "Admin")
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
                    <h1 class="m-0 text-dark">Admin Create</h1>
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
                    {!! Form::open(['route' => 'admin.admins.store', 'method' =>'post']) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New Admin Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('role_id', 'Role') !!}
                                        {!! Form::select('role_id', [''=>'Choose an option']+$roles, null,
                                        ['class'=>'form-control multi-select']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('email', 'Email') !!}
                                        {!! Form::text('email', null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('phone', 'Phone') !!}
                                        {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('password', 'Password') !!}
                                        {!! Form::password('password', ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('password_confirmation', 'Confirm Password') !!}
                                        {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
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
                            </div>
                        </div>
                        <div class="permission" style="display:{{ $display }}">
                            <div class="card-header pb-0 border-0">
                                <h3 class="card-title">
                                    <span class="allpermissions">Permissions</span>

                                    <div class="selectrevert icheck-primary d-inline">
                                        <input type="checkbox" id="selectAll">
                                        <label for="selectAll">Select All</label>
                                    </div>
                                    <div class="revert icheck-primary d-inline">
                                        <input type="checkbox" id="selectRevert">
                                        <label for="selectRevert">Select Revert</label>
                                    </div>

                                </h3>
                            </div>

                            <div class="card-body">
                                @foreach($permissionGroups as $permissionGroup)
                                <div class="card-header border-0 pb-0">
                                    <h3 class="card-title">
                                        <span class="permissionscategory">{{ $permissionGroup->name }}
                                        </span>
                                        <div class="selectrevertcategory icheck-primary d-inline">
                                            <input type="checkbox" id="selectCategotyAll{{ $permissionGroup->id }}"
                                                class="selectcategory">
                                            <label for="selectCategotyAll{{ $permissionGroup->id }}">Select
                                                All</label>
                                        </div>

                                    </h3>
                                </div>

                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            @foreach($permissionGroup->permissions as $permission)
                                            <div class="col-md-3">
                                                <div class="icheck-primary d-inline">
                                                    {!! Form::checkbox('permissions[]', $permission->id, null
                                                    ,['class'=>'check','id'=>'checkboxPermission' . $permission->id])
                                                    !!}
                                                    {!! Form::label('checkboxPermission' . $permission->id,
                                                    $permission->display_name,['class'=>'permissionlabel',
                                                    'style'=>'padding-left:5px;margin-top:10px;']) !!}
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->hasPermission(['admin-admins-read']))
                            <a href="{{route('admin.admins.index')}}" type="button" class="btn btn-danger">Cancel</a>
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


        //show hide
        $('#role_id').on('change', function () {
            if (this.value == '2') {
                $(".permission").show();
            } else {
                $(".permission").hide();
            }
        });

        //select permissions
        let triggeredByChild = false;

        $('#selectAll').on('click', function (event) {
            if($(this).prop("checked") == true){
                $('.check').prop("checked", true);
                $('.selectcategory').prop("checked", true);
                $('#selectRevert').prop("checked", false);
            }else{
                $('.check').prop("checked", false);
                $('.selectcategory').prop("checked", false);
            }
        });


        $('#selectRevert').on('click', function (event) {
            if($(this).prop("checked") == true){
                $('#selectAll').prop("checked", false);
                $('.selectcategory').prop("checked", false);
                $('.check').prop("checked", false);
            }else{
                $('.check').prop("checked", true);
                $('#selectAll').prop("checked", true);
                $('.selectcategory').prop("checked", true);
            }
        });

        // Removed the checked state from "All" if any checkbox is unchecked
        $('.check').on('click', function (event) {
            if ($('.check').filter(':checked').length == $('.check').length) {
                $('#selectAll').prop("checked", true);
            }else{
                $('#selectAll').prop("checked", false);
            }
        });

        // Category wise Select
        $('.selectcategory').on('click', function (event) {
            // alert($(this).parent().parent().attr('class'));
            if($(this).prop("checked") == true){
                $(this).parent().parent().parent().next().find('.check').prop("checked", true);
            }else{
                $(this).parent().parent().parent().next().find('.check').prop("checked", false);
            }
            // calculate length
            if ($('.check').filter(':checked').length == $('.check').length) {
                $('#selectAll').prop("checked", true);
            }else{
                $('#selectAll').prop("checked", false);
            }

        });
            //end document ready
        });
</script>
@endpush
@endsection
