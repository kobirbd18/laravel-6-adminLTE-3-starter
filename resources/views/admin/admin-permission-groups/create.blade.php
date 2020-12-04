@extends('layouts.admin')
@section('title', "Admin Permission Group")
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
                    <h1 class="m-0 text-dark">Admin Permission Group Create</h1>
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
                    {!! Form::open(['route' => ['admin.admin-permission-groups.store'],
                    'method' =>'post']) !!}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New Admin Permission Group Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label("name", "Permission Group Name") }}
                                    {{Form::text("name", null,["class" => "form-control"])}}
                                </div>
                                <div class="form-group">
                                    <div class="icheck-primary">
                                        {!! Form::checkbox('status', '1', 1, ['id'=>'status', 'class'=>'form-control'])
                                        !!}
                                        {!! Form::label('status', '&nbsp;Active') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 mt-3">
                                <div class="col-lg-12">
                                    <h4 class="d-inline-block mr-5">Select Permissions</h4>
                                    <div class="icheck-primary d-inline-block">
                                        <input type="checkbox" id="checkAll" />
                                        <label for="checkAll">Select All</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($permissions as $permissionId => $permission)
                                <div class="col-md-3">
                                    <div class="icheck-primary">
                                        <input type="checkbox" class="checkBoxClass" id="{{$permissionId}}"
                                            name="permissions[]" value="{{$permissionId}}" />
                                        <label for="{{$permissionId}}">{{$permission}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->hasPermission(['admin-permission-groups-read']))
                            <a href="{{route('admin.admin-permission-groups.index')}}" type="button"
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
            $("#checkAll").click(function () {
                $(".checkBoxClass").prop('checked', $(this).prop('checked'));
            });

            $(".checkBoxClass").change(function(){
                if (!$(this).prop("checked")){
                    $("#checkAll").prop("checked",false);
                }
            });
            //end document ready
        });
</script>
@endpush
@endsection
