@extends('layouts.admin')
@section('title','Users')
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
                    <h1 class="m-0 text-dark">Users Info</h1>
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
                            <h3 class="card-title">Users Info</h3>
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
                                        <th style="width: 20%;">Email</th>
                                        <td style="width: 80%;">{{ $user->email }}</td>
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
                                        <th style="width: 20%;">Refered By</th>
                                        <td style="width: 80%;">
                                            @if ($user->referral )
                                            <small>
                                                <a href="{{ route('admin.users.show', $user->referral_id) }} ">
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
                                        <th style="width: 20%;">Gender</th>
                                        <td style="width: 80%;">{!! Helper::gender($user->gender) !!}</td>
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
                    </div>
                </div>

            </div>
            <!-- /.row (main row) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">User Address List</h3>
                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->hasPermission(['admin-addresses-read']))
                            <a class="btn btn-success float-right" href="{{ route('admin.addresses.index', $user->id) }}">Addresses</a>
                            @endif
                        </div>
                    </div>
                </div>
                @foreach ($user->addresses as $address)
                <div class="col-md-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-map"></i></span>
                        <div class="info-box-content">
                            <span
                                class="info-box-text float-right text-uppercase text-info">{{ $address->is_default ? 'Default Address' : '' }}</span>
                            <span class="info-box-text text-bold">{{ $address->name }} </span>
                            <span class="info-box-text">{{ $address->address }}, {{ $address->area->name ?? '' }},
                                {{ $address->city->name ?? '' }}, {{ $address->region->name ?? '' }}.</span>
                            <span class="info-box-text">{{ $address->phone }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                @endforeach
            </div>
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
