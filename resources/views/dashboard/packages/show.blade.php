@extends('partials.dashboard.master')
@section('content')

<!-- begin :: Subheader -->
<div class="toolbar">

    <div class="container-fluid d-flex flex-stack">

        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

            <!-- begin :: Title -->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><a href="{{ route('dashboard.packages.index') }}" class="text-muted text-hover-primary">{{ __("Packages") }}</a></h1>
            <!-- end   :: Title -->

            <!-- begin :: Separator -->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!-- end   :: Separator -->

            <!-- begin :: Breadcrumb -->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!-- begin :: Item -->
                <li class="breadcrumb-item text-muted">
                    {{ __("package data") }}
                </li>
                <!-- end   :: Item -->
            </ul>
            <!-- end   :: Breadcrumb -->

        </div>

    </div>

</div>
<!-- end   :: Subheader -->

<div class="card">
    <!-- begin :: Card body -->
    <div class="card-body p-0">
        <!-- begin :: Form -->
        <!-- begin :: Card header -->
        <div class="card-header d-flex align-items-center">
            <h3 class="fw-bolder text-dark">{{ __("package data") . ' : ' . $package->name }}</h3>
        </div>
        <!-- end   :: Card header -->

        <!-- begin :: Inputs wrapper -->
        <div class="inputs-wrapper">


            <!-- begin :: Row -->
            <div class="row mb-10">

                <!-- begin :: Column -->
                <div class="col-md-3 fv-row">

                    <label class="fs-5 fw-bold mb-2">{{ __("Name in arabic") }}</label>
                    <div id="name_ar" data-name="name_ar">{{ $package->name_en }}</div>

                </div>
                <!-- end   :: Column -->

                <!-- begin :: Column -->
                <div class="col-md-3 fv-row">

                    <label class="fs-5 fw-bold mb-2">{{ __("Name in english") }}</label>
                    <div id="name_en" data-name="name_en">{{ $package->name_en }}</div>


                </div>
                <!-- end   :: Column -->
                <!-- begin :: Column -->
                <div class="col-md-3 fv-row">

                    <label class="fs-5 fw-bold mb-2">{{ __("Monthly price") }}</label>
                    <div id="monthly_price" data-name="monthly_price">{{ $package->monthly_price }}</div>

                </div>
                <!-- end   :: Column -->

                <!-- begin :: Column -->
                <div class="col-md-3 fv-row">

                    <label class="fs-5 fw-bold mb-2">{{ __("Annual price") }}</label>
                    <div id="annual_price" data-name="annual_price">{{ $package->annual_price }}</div>
                </div>
                <!-- end   :: Column -->
            </div>
            <!-- end   :: Row -->

            <!-- begin :: Row -->
            @if(isset($package->monthly_price_after_discount))
            <div class="row mb-10">

                <!-- begin :: Column -->
                <div class="col-md-3 fv-row">

                    <label class="fs-5 fw-bold mb-2">{{ __("Monthly price after discount") }}</label>
                    <div id="monthly_price_after_discount" data-name="monthly_price_after_discount">{{ $package->monthly_price_after_discount }}</div>
                </div>
                <!-- end   :: Column -->

                <!-- begin :: Column -->
                <div class="col-md-3 fv-row">

                    <label class="fs-5 fw-bold mb-2">{{ __("Annual price after discount") }}</label>
                    <div id="annual_price_after_discount" data-name="annual_price_after_discount">{{ $package->annual_price_after_discount }}</div>
                </div>
                <!-- end   :: Column -->

                <!-- begin :: Column -->
                <div class="col-md-3 fv-row">
                    <label class="fs-5 fw-bold mb-2">{{ __("Discount from date") }}</label>
                    <div id="discount_from_date" data-name="discount_from_date">{{ $package->discount_from_date }}</div>
                </div>
                <!-- end   :: Column -->

                <!-- begin :: Column -->
                <div class="col-md-3 fv-row">

                    <label class="fs-5 fw-bold mb-2">{{ __("Discount to date") }}</label>
                    <div id="discount_to_date" data-name="discount_to_date">{{ $package->discount_to_date }}</div>
                </div>
                <!-- end   :: Column -->

            </div>
            @endif
            <!-- end   :: Row -->
            <!-- begin :: Row -->
            <div class="row mb-10">

                <!-- begin :: Column -->
                <div class="col-md-6 fv-row">

                    <label class="fs-5 fw-bold mb-2">{{ __("Description in arabic") }}</label>
                    <div id="description_ar_summernote" data-name="description_ar">{!! $package->description_ar !!}</div>
                    <p class="text-danger invalid-feedback" id="description_ar"></p>

                </div>
                <!-- end   :: Column -->

                <!-- begin :: Column -->
                <div class="col-md-6 fv-row">

                    <label class="fs-5 fw-bold mb-2">{{ __("Description in english") }}</label>
                    <div id="description_en_summernote" data-name="description_ar">{!! $package->description_en !!}</div>
                    <p class="text-danger invalid-feedback" id="description_en"></p>

                </div>
                <!-- end   :: Column -->

            </div>
            <!-- end   :: Row -->
            @if (!$package->features->isEmpty())

            <!-- begin :: Datatable -->
            <table data-ordering="false" id="kt_datatable" class="table text-center table-row-dashed fs-6 gy-5">

                <thead>
                    <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th>#</th>
                        <th>{{ __("arabic name") }}</th>
                        <th>{{ __("english name") }}</th>
                        <th>{{ __("Value") }}</th>
                    </tr>
                </thead>

                <tbody class="text-gray-600 fw-bold text-center">
                    @foreach ($package->features as $feature)
                    <tr>
                        <td>{{$feature->feature->id}}</td>
                        <td>{{$feature->feature->name_ar}}</td>
                        <td>{{$feature->feature->name_en}}</td>
                        <td>{{$feature->value}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- end   :: Datatable -->
            @endif

        </div>
        <!-- end   :: Inputs wrapper -->

        <!-- begin :: Form footer -->
        <div class="form-footer">

            <!-- begin :: Submit btn -->
            <a href="{{ route('dashboard.packages.index') }}" class="btn btn-primary">

                <span class="indicator-label">{{ __("Back") }}</span>

            </a>
            <!-- end   :: Submit btn -->

        </div>
        <!-- end   :: Form footer -->
        <!-- end   :: Form -->
    </div>
    <!-- end   :: Card body -->
</div>

@endsection
