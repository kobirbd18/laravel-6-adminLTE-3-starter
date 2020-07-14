@extends('layouts.admin')
@section('title','Shops')
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
                    <h1 class="m-0 text-dark">Shop Info</h1>
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
                            <h3 class="card-title">Shop Info</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 20%;">ID</th>
                                        <td style="width: 80%;">{{ $shop->id }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Name</th>
                                        <td style="width: 80%;">{{ $shop->name }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Address</th>
                                        <td style="width: 80%;">{{ $shop->address }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Contact</th>
                                        <td style="width: 80%;">{{ $shop->contact }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Merchant</th>
                                        <td style="width: 80%;">{{ $shop->merchant ? $shop->merchant->name : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Region</th>
                                        <td style="width: 80%;">{{ $shop->region ? $shop->region->name : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">City</th>
                                        <td style="width: 80%;">{{ $shop->city ? $shop->city->name : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Area</th>
                                        <td style="width: 80%;">{{ $shop->area ? $shop->area->name : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Shop Open Time</th>
                                        <td style="width: 80%;">{{ $shop->schedule_time }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Category</th>
                                        <td style="width: 80%;">{{ $shop->category ? $shop->category->name : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Shop Image</th>
                                        <td style="width: 80%;">
                                            <div style="width: 150px;">
                                                @if($shop->image)
                                                <a data-fancybox="gallery" data-caption="{{ $shop->name }}"
                                                    href="{{ asset(Helper::storagePath($shop->image)) }}">
                                                    <img class="img-thumbnail"
                                                        src="{{ asset(Helper::storagePath($shop->image)) }}" alt="">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Shop Product Count</th>
                                        <td style="width: 80%;">{{ $shop->shopProducts->count() }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Delivery Area Count</th>
                                        <td style="width: 80%;">{{ $shop->deliveryAreas->count() }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Sub Category Count</th>
                                        <td style="width: 80%;">{{ $shop->shopSubCategories->count() }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Shop Product Category Count</th>
                                        <td style="width: 80%;">{{ $shop->shopProductCategories->count() }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Shop Rating</th>
                                        <td style="width: 80%;">{{ $shop->rating }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Latitude</th>
                                        <td style="width: 80%;">{{ $shop->latitude }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Longitude</th>
                                        <td style="width: 80%;">{{ $shop->longitude }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Status</th>
                                        <td style="width: 80%;">{!! Helper::activeStatusLabel($shop->status) !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">Created At</th>
                                        <td style="width: 80%;">{{ $shop->created_at->diffForHumans() }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">Updated At</th>
                                        <td style="width: 80%;">{{ $shop->updated_at->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row (main row) -->
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">User Address List</h3>
                            @if(Auth::guard('admin')->user()->hasRole('admin') ||
                            Auth::guard('admin')->user()->can(['admin-addresses-read']))
                            <a class="btn btn-success float-right" href="{{ route('admin.addresses.index', $shop->id) }}">Addresses</a>
            @endif
        </div>
</div>
</div>
@foreach ($shop->addresses as $address)
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
</div> --}}
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
