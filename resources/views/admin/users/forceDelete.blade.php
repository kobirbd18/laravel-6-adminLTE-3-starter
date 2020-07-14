@extends('layouts.admin')
@section('title','Vehicle Owners')
@push('css')
<!-- input partial css here -->
<link rel="stylesheet" href="{{ asset('css/backend/plugins/jQueryFancibox/css/jquery.fancybox.min.css') }}">
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
                    <h1 class="m-0 text-dark">Vehicle Owner Force Delete</h1>
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
                    @include('include.flashMessage')
                    <!-- form start -->
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title">Vehicle Owner Force Delete Info</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 20%;">ID</th>
                                        <td style="width: 80%;">{{ $user->id }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Name</th>
                                        <td style="width: 80%;">{{ $user->name }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Mobile Number</th>
                                        <td style="width: 80%;">{{ $user->mobile }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Referral Code</th>
                                        <td style="width: 80%;">{{ $user->referral_code }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">District</th>
                                        <td style="width: 80%;">{{ $user->district ? $user->district->name_en : '' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Thana</th>
                                        <td style="width: 80%;">{{ $user->thana ? $user->thana->name_en : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Address</th>
                                        <td style="width: 80%;">{{ $user->address }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Refered By</th>
                                        <td style="width: 80%;">
                                            @if ($user->referral )
                                            <small>
                                                <a href="{{ route('admin.vehicle-owners.show', $user->referral_id) }} ">
                                                    {{$user->referral ? $user->referral->name : '' }}
                                                </a>
                                            </small>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Profile Photo</th>
                                        <td style="width: 80%;">
                                            <div style="width: 150px;">
                                                @if($user->photo)
                                                <a data-fancybox="gallery" data-caption="{{ $user->name }}"
                                                    href="{{ asset(Helper::storagePath($user->photo)) }}">
                                                    <img class="img-thumbnail"
                                                        src="{{ asset(Helper::storagePath($user->photo)) }}" alt="">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <th style="width: 20%;">Status</th>
                                        <td style="width: 80%;">{!! Helper::activeStatusLabel($user->status) !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">Created At</th>
                                        <td style="width: 80%;">{{ $user->created_at->diffForHumans() }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">Updated At</th>
                                        <td style="width: 80%;">{{ $user->updated_at->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            @if(Auth::guard('admin')->user()->hasRole('admin'))
                            <a href="#" class="btn btn-danger" data-toggle="tooltip" title="Force Delete" onclick="if (confirm(&quot;Are you sure you want to force delete all information of this owner?&quot;)) { document.getElementById('deleteForm{{ $user->id }}').submit();
                                            } event.returnValue = false; return false;">Force Delete All Owner Info</a>

                            {!! Form::open(['method'=>'POST',
                            'action'=>['Admin\VehicleOwnerController@forceDeletePost',
                            $user->id], 'id'=>'deleteForm'.$user->id, 'style'=>"display:inline-block"]) !!}
                            {!! Form::close() !!}

                            <a href="{{route('admin.vehicle-owners.index')}}" type="button"
                                class="btn btn-info">Cancel</a>
                            @endif
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
<script src="{{ asset('js/backend/plugins/jQueryFancibox/js/jquery.fancybox.min.js') }}"></script>
<script>
    $(document).ready(function() {

        //end document ready
    });
</script>
@endpush
@endsection
