@extends('partials.dashboard.master')
@section('content')

    <!-- begin :: Subheader -->
    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><a href="{{ route('dashboard.offers.index') }}"
                    class="text-muted text-hover-primary">{{ __("Offers") }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __("offer data") }}
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
                <div class="card-title">
                    <h3 class="fw-bolder text-dark">{{ __("offer data") . ' : ' . $offer->title }}</h3>
                </div>
                <div class="card-title">

                    <div class="form-check form-switch form-check-custom form-check-solid mb-2">
                        <label class="fs-5 fw-bold mx-4">{{ __("status") }}</label>
                        <input class="form-check-input mx-2" style="height: 18px;width:36px;" type="checkbox" disabled @if( $offer['status'] ) checked @endif   />
                    </div>

                </div>
            </div>
            <!-- end   :: Card header -->

            <!-- begin :: Inputs wrapper -->
            <div class="inputs-wrapper">

                <!-- begin :: Row -->
                <div class="row mb-10">

                    <!-- begin :: Column -->
                    <div class="col-md-12 fv-row d-flex justify-content-center">

                        <div class="d-flex flex-column">
                            <!-- begin :: Upload image component -->
                            <label class="text-center fw-bold mb-4">{{ __("Image") }}</label>
                            <x-dashboard.upload-image-inp name="image" :image="$offer->image" directory="Offers" placeholder="default.jpg" type="show" ></x-dashboard.upload-image-inp>
                            <!-- end   :: Upload image component -->
                        </div>


                    </div>
                    <!-- end   :: Column -->

                </div>
                <!-- end   :: Row -->

                <!-- begin :: Row -->
                <div class="row mb-10">

                    <!-- begin :: Column -->
                    <div class="col-md-6 fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __("Title in arabic") }}</label>
                        <input type="text" class="form-control" id="title_ar_inp" name="title_ar" readonly value="{{ $offer['title_ar'] }}" placeholder="example"/>



                    </div>
                    <!-- end   :: Column -->

                    <!-- begin :: Column -->
                    <div class="col-md-6 fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __("Title in english") }}</label>
                        <input type="text" class="form-control" id="title_en_inp" name="title_en" readonly value="{{ $offer['title_en'] }}" />

                    </div>
                    <!-- end   :: Column -->

                </div>
                <!-- end   :: Row -->


                <!-- begin :: Row -->
                <div class="row mb-10">

                    <!-- begin :: Column -->
                    <div class="col-md-12 fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __("Cars") }}</label>

                        <select class="form-select"  name="cars[]" data-control="select2" multiple id="cars-sp" disabled data-placeholder="{{ __("Choose the car") }}" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}"  >
                            @foreach( $offer->cars as $car)
                                <option value="{{ $car['id'] }}" selected data-main-image="{{ getImagePathFromDirectory( $car['main_image'] , 'Cars') }}"> {{ $car['name'] }} </option>
                            @endforeach
                        </select>

                    </div>
                    <!-- end   :: Column -->


                </div>
                <!-- end   :: Row -->


                <!-- begin :: Row -->
                <div class="row mb-10">

                    <!-- begin :: Column -->
                    <div class="col-md-6 fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __("Description in arabic") }}</label>
                        <div id="desc_summernote_ar" data-name="description_ar" > {!! $offer['description_ar'] !!} </div>
                        <p class="text-danger invalid-feedback" id="description_ar"></p>


                    </div>
                    <!-- end   :: Column -->

                    <!-- begin :: Column -->
                    <div class="col-md-6 fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __("Description in english") }}</label>
                        <div id="desc_summernote_en" data-name="description_en" > {!! $offer['description_en'] !!} </div>
                        <p class="text-danger error-element" id="description_en"></p>


                    </div>
                    <!-- end   :: Column -->

                </div>
                <!-- end   :: Row -->


            </div>
            <!-- end   :: Inputs wrapper -->


            <!-- begin :: Form footer -->
            <div class="form-footer">

                <!-- begin :: Submit btn -->
                <a href="{{ route('dashboard.offers.index') }}" class="btn btn-primary" >

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
