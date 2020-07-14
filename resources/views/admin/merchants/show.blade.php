@extends('layouts.admin')
@section('title','Merchants')
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
                    <h1 class="m-0 text-dark">Merchant Info</h1>
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
                            <h3 class="card-title">Merchant Info</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 20%;">ID</th>
                                        <td style="width: 80%;">{{ $merchant->id }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Name</th>
                                        <td style="width: 80%;">{{ $merchant->name }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Email</th>
                                        <td style="width: 80%;">{{ $merchant->email }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Mobile Number</th>
                                        <td style="width: 80%;">{{ $merchant->mobile }}</td>
                                    </tr>
{{--
                                    <tr>
                                        <th style="width: 20%;">Referral Code</th>
                                        <td style="width: 80%;">{{ $merchant->referral_code }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Refered By</th>
                                        <td style="width: 80%;">
                                            @if ($merchant->referral )
                                            <small>
                                                <a href="{{ route('admin.merchants.show', $merchant->referral_id) }} ">
                                                    {{$merchant->referral ? $merchant->referral->name : '' }}
                                                </a>
                                            </small>
                                            @endif
                                        </td>
                                    </tr> --}}

                                    <tr>
                                        <th style="width: 20%;">Profile Photo</th>
                                        <td style="width: 80%;">
                                            <div style="width: 150px;">
                                                @if($merchant->photo)
                                                <a data-fancybox="gallery" data-caption="{{ $merchant->name }}"
                                                    href="{{ asset(Helper::storagePath($merchant->photo)) }}">
                                                    <img class="img-thumbnail"
                                                        src="{{ asset(Helper::storagePath($merchant->photo)) }}" alt="">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    {{--
                                    <tr>
                                        <th style="width: 20%;">Gender</th>
                                        <td style="width: 80%;">{!! Helper::gender($merchant->gender) !!}</td>
                                    </tr> --}}

                                    <tr>
                                        <th style="width: 20%;">Status</th>
                                        <td style="width: 80%;">{!! Helper::activeStatusLabel($merchant->status) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">Created At</th>
                                        <td style="width: 80%;">{{ $merchant->created_at->diffForHumans() }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">Updated At</th>
                                        <td style="width: 80%;">{{ $merchant->updated_at->diffForHumans() }}</td>
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
