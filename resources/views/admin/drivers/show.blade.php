@extends('layouts.admin')
@section('title','Drivers')
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
                    <h1 class="m-0 text-dark">Driver Info</h1>
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
                            <h3 class="card-title">Driver Info</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 20%;">ID</th>
                                        <td style="width: 80%;">{{ $driver->id }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Name</th>
                                        <td style="width: 80%;">{{ $driver->name }}</td>
                                    </tr>

                                    {{-- <tr>
                                        <th style="width: 20%;">Email</th>
                                        <td style="width: 80%;">{{ $driver->email }}</td>
                                    </tr> --}}

                                    <tr>
                                        <th style="width: 20%;">Mobile Number</th>
                                        <td style="width: 80%;">{{ $driver->mobile }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Address</th>
                                        <td style="width: 80%;">{{ $driver->address }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Experience</th>
                                        <td style="width: 80%;">{{ $driver->experience }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Referral Code</th>
                                        <td style="width: 80%;">{{ $driver->referral_code }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Refered By</th>
                                        <td style="width: 80%;">
                                            @if ($driver->referral )
                                            <small>
                                                <a href="{{ route('admin.drivers.show', $driver->referral_id) }} ">
                                                    {{$driver->referral ? $driver->referral->name : '' }}
                                                </a>
                                            </small>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Profile Photo</th>
                                        <td style="width: 80%;">
                                            <div style="width: 150px;">
                                                @if($driver->photo)
                                                <a data-fancybox="gallery" data-caption="{{ $driver->name }}"
                                                    href="{{ asset(Helper::storagePath($driver->photo)) }}">
                                                    <img class="img-thumbnail"
                                                        src="{{ asset(Helper::storagePath($driver->photo)) }}"
                                                        alt="Show">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">License File Front</th>
                                        <td style="width: 80%;">
                                            <div style="width: 150px;">
                                                @if($driver->license_file_front)
                                                <a data-fancybox="gallery" data-caption="{{ $driver->name }}"
                                                    href="{{ asset(Helper::storagePath($driver->license_file_front)) }}">
                                                    <img class="img-thumbnail"
                                                        src="{{ asset(Helper::storagePath($driver->license_file_front)) }}"
                                                        alt="Show">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">License File Back</th>
                                        <td style="width: 80%;">
                                            <div style="width: 150px;">
                                                @if($driver->license_file_back)
                                                <a data-fancybox="gallery" data-caption="{{ $driver->name }}"
                                                    href="{{ asset(Helper::storagePath($driver->license_file_back)) }}">
                                                    <img class="img-thumbnail"
                                                        src="{{ asset(Helper::storagePath($driver->license_file_back)) }}"
                                                        alt="Show">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">NID File Front</th>
                                        <td style="width: 80%;">
                                            <div style="width: 150px;">
                                                @if($driver->nid_file_front)
                                                <a data-fancybox="gallery" data-caption="{{ $driver->name }}"
                                                    href="{{ asset(Helper::storagePath($driver->nid_file_front)) }}">
                                                    <img class="img-thumbnail"
                                                        src="{{ asset(Helper::storagePath($driver->nid_file_front)) }}"
                                                        alt="Show">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">NID File Back</th>
                                        <td style="width: 80%;">
                                            <div style="width: 150px;">
                                                @if($driver->nid_file_back)
                                                <a data-fancybox="gallery" data-caption="{{ $driver->name }}"
                                                    href="{{ asset(Helper::storagePath($driver->nid_file_back)) }}">
                                                    <img class="img-thumbnail"
                                                        src="{{ asset(Helper::storagePath($driver->nid_file_back)) }}"
                                                        alt="Show">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Trasport Type</th>
                                        <td style="width: 80%;">{!! Helper::driverTransportType($driver->transport_type)
                                            !!}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">District</th>
                                        <td style="width: 80%;">
                                            {{ $driver->district ? $driver->district->name_en : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Thana</th>
                                        <td style="width: 80%;">{{ $driver->thana ? $driver->thana->name_en : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Online Status</th>
                                        <td style="width: 80%;">{!! Helper::driverOnlineStatusLabel($driver->online) !!}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Status</th>
                                        <td style="width: 80%;">{!! Helper::activeStatusLabel($driver->status) !!}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Total Earning</th>
                                        <td style="width: 80%;">{{ $driver->total_earning }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Total Fee</th>
                                        <td style="width: 80%;">{{ $driver->total_fee }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Total Fee Paid</th>
                                        <td style="width: 80%;">{{ $driver->total_fee_paid }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Total Credit</th>
                                        <td style="width: 80%;">{{ $driver->driver_credit }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Driver Points</th>
                                        <td style="width: 80%;">{{ $driver->point }}</td>
                                    </tr>

                                    <tr>
                                        <th colspan="2" class="bg-info" style="width: 100%; text-align:center;">All
                                            References Info</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">Father Name</th>
                                        <td style="width: 80%;">{{ $driver->father_name }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Father Number</th>
                                        <td style="width: 80%;">{{ $driver->father_number }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Mother Name</th>
                                        <td style="width: 80%;">{{ $driver->mother_name }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Mother Number</th>
                                        <td style="width: 80%;">{{ $driver->mother_number }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Brother Name</th>
                                        <td style="width: 80%;">{{ $driver->brother_name }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Brother Number</th>
                                        <td style="width: 80%;">{{ $driver->brother_number }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Sister Name</th>
                                        <td style="width: 80%;">{{ $driver->sister_name }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Sister Number</th>
                                        <td style="width: 80%;">{{ $driver->sister_number }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Wife Name</th>
                                        <td style="width: 80%;">{{ $driver->wife_name }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Wife Number</th>
                                        <td style="width: 80%;">{{ $driver->wife_number }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Father in law Name</th>
                                        <td style="width: 80%;">{{ $driver->father_in_law_name }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Father in law Number</th>
                                        <td style="width: 80%;">{{ $driver->father_in_law_number }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">First Uncle Name</th>
                                        <td style="width: 80%;">{{ $driver->first_uncle_name }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">First Uncle Number</th>
                                        <td style="width: 80%;">{{ $driver->first_uncle_number }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Second Uncle Name</th>
                                        <td style="width: 80%;">{{ $driver->second_uncle_name }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Second Uncle Number</th>
                                        <td style="width: 80%;">{{ $driver->second_uncle_number }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Created At</th>
                                        <td style="width: 80%;">{{ $driver->created_at->diffForHumans() }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">Updated At</th>
                                        <td style="width: 80%;">{{ $driver->updated_at->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
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
