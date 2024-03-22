@extends('partials.dashboard.master')
@section('content')

    <!-- begin :: Subheader -->
    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><a href="{{ route('dashboard.colors.index') }}"
                    class="text-muted text-hover-primary">{{ __("Colors") }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __("color data") }}
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
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">{{ __("color data") . ' : ' . $color->name }}</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">

                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        @if ( ! $color['hex_code'] )
                            <!-- begin :: Column -->
                            <div class="col-md-12 fv-row text-center">

                                <!-- begin :: Upload image component -->
                                <x-dashboard.upload-image-inp name="image" :image="$color->image" directory="Colors" placeholder="default.jpg" type="show" ></x-dashboard.upload-image-inp>
                                <p class="invalid-feedback" id="image" ></p>
                                <!-- end   :: Upload image component -->

                            </div>
                            <!-- end   :: Column -->
                        @endif

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Name in arabic") }}</label>
                            <input type="text" class="form-control" id="name_ar_inp" name="name_ar" value="{{ $color->name_ar }}" readonly/>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Name in english") }}</label>
                            <input type="text" class="form-control" id="name_en_inp" name="name_en" value="{{ $color->name_en }}" readonly/>

                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    @if ($color->hex_code)

                        <!-- begin :: Row -->
                            <div class="row mb-4">

                                <!-- begin :: Column -->
                                <div class="col-md-6 fv-row">

                                    <label class="fs-5 fw-bold mb-2" for="hex_code_inp">{{ __("Color") }}</label>
                                    <input type="color" name="hex_code" class="form-control" id="hex_code_inp" value="{{ $color->hex_code }}"  disabled style="height:47.5px"/>


                                </div>
                                <!-- end   :: Column -->

                                <!-- begin :: Column -->
                                <div class="col-md-6 fv-row">

                                    <label class="fs-5 fw-bold mb-2">{{ __("Color code") }}</label>
                                    <input type="text" class="form-control" name="hex_code" id="color_code_inp" value="{{ $color->hex_code }}" readonly/>

                                </div>
                                <!-- end   :: Column -->

                            </div>
                        <!-- end   :: Row -->

                    @endif



                </div>
                <!-- end   :: Inputs wrapper -->

                <!-- begin :: Form footer -->
                <div class="form-footer">

                    <!-- begin :: Submit btn -->
                    <a href="{{ route('dashboard.colors.index') }}" class="btn btn-primary" id="submit-btn">

                        <span class="indicator-label">{{ __("Back") }}</span>


                    </a>
                    <!-- end   :: Submit btn -->

                </div>
                <!-- end   :: Form footer -->
        </div>
        <!-- end   :: Card body -->
    </div>

@endsection

