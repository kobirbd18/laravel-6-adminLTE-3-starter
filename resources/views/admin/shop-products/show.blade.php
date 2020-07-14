@extends('layouts.admin')
@section('title','Shop Products')
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
                    <h1 class="m-0 text-dark">Shop Product Info</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- form start -->
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title">Shop Info</h3>
                        </div>
                        <div class="card-body p-1">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Merchant</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    <th>Area</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $shopProduct->shop->id ?? '' }}</td>
                                        <td>{{ $shopProduct->shop->name ?? '' }}</td>
                                        <td>{{ $shopProduct->shop->category ? $shopProduct->shop->category->name : '' }}</td>
                                        <td>{{ $shopProduct->shop->merchant ? $shopProduct->shop->merchant->name : '' }}</td>
                                        <td>{{ $shopProduct->shop->region ? $shopProduct->shop->region->name : '' }}</td>
                                        <td>{{ $shopProduct->shop->city ? $shopProduct->shop->city->name : '' }}</td>
                                        <td>{{ $shopProduct->shop->area ? $shopProduct->shop->area->name : '' }}</td>
                                        <td class="text-center">{!! Helper::activeStatusLabel($shopProduct->shop->status ?? 0) !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- form start -->
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title">Shop Product Info</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 20%;">ID</th>
                                        <td style="width: 80%;">{{ $shopProduct->id }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Name</th>
                                        <td style="width: 80%;">{{ $shopProduct->product_name_weight ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Price</th>
                                        <td style="width: 80%;">{{ $shopProduct->price }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Offfer Status</th>
                                        <td style="width: 80%;">{!! Helper::offerStatusLabel($shopProduct->is_offer) !!}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Offer Price</th>
                                        <td style="width: 80%;">{{ $shopProduct->offer_price }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Shop Image</th>
                                        <td style="width: 80%;">
                                            <div style="width: 150px;">
                                                @if($shopProduct->product)
                                                <a data-fancybox="gallery" data-caption="{{ $shopProduct->product->name ?? '' }}"
                                                    href="{{ asset(Helper::storagePath($shopProduct->product->image ?? '')) }}">
                                                    <img class="img-thumbnail"
                                                        src="{{ asset(Helper::storagePath($shopProduct->product->image ?? '')) }}" alt="">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Shop Category</th>
                                        <td style="width: 80%;">{{ 'Working next' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Recommended Status</th>
                                        <td style="width: 80%;">{!! Helper::recommendedStatusLabel($shopProduct->recommended) !!}</td>
                                    </tr>

                                    <tr>
                                        <th style="width: 20%;">Status</th>
                                        <td style="width: 80%;">{!! Helper::activeStatusLabel($shopProduct->status) !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">Created At</th>
                                        <td style="width: 80%;">{{ $shopProduct->created_at->diffForHumans() }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">Updated At</th>
                                        <td style="width: 80%;">{{ $shopProduct->updated_at->diffForHumans() }}</td>
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
