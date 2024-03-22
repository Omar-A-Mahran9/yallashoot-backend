@extends('partials.dashboard.master')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')

    <!-- begin :: Subheader -->
    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><a href="{{ route('dashboard.services.index') }}"
                    class="text-muted text-hover-primary">{{ __("Services") }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __("Edit service") }}
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
            <form action="{{ route('dashboard.services.update',$service->id) }}" class="form" method="post" id="submitted-form" data-redirection-url="{{ route('dashboard.services.index') }}">
            @csrf
            @method("PUT")

            <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">{{ __("Edit service") . ' : ' . $service->name }}</h3>
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
                                <x-dashboard.upload-image-inp name="image" :image="$service->image" directory="Services" placeholder="default.jpg" type="editable" ></x-dashboard.upload-image-inp>
                                <p class="invalid-feedback" id="image" ></p>
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

                            <label class="fs-5 fw-bold mb-2">{{ __("Name in arabic") }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name_ar_inp" name="name_ar" value="{{ $service['name_ar'] }}" placeholder="example"/>
                                <label for="name_ar_inp">{{ __("Enter the name in arabic") }}</label>
                            </div>
                            <p class="invalid-feedback" id="name_ar" ></p>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Name in english") }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name_en_inp" name="name_en" value="{{ $service['name_en'] }}" placeholder="example"/>
                                <label for="name_en_inp">{{ __("Enter the name in english") }}</label>
                            </div>
                            <p class="invalid-feedback" id="name_en" ></p>


                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-10">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Title in arabic") }}</label>

                            <div class="form-floating">
                                <input type="text" class="form-control" id="title_ar_inp" name="title_ar" value="{{ $service['title_ar'] }}" placeholder="example"/>
                                <label for="title_ar_inp">{{ __("Enter the title in arabic") }}</label>
                            </div>

                            <p class="invalid-feedback" id="title_ar" ></p>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Title in english") }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="title_en_inp" name="title_en" value="{{ $service['title_en'] }}" placeholder="example"/>
                                <label for="title_en_inp">{{ __("Enter the title in english") }}</label>
                            </div>

                            <p class="invalid-feedback" id="title_en" ></p>


                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-10">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Price") }}</label>
                            <div class="form-floating">
                                <input type="number" min="1" class="form-control" id="price_inp" name="price" value="{{ $service['price'] }}" placeholder="example"/>
                                <label for="price_inp">{{ __("Enter the price") }}</label>
                            </div>
                            <p class="invalid-feedback" id="price" ></p>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <div class="form-check form-switch form-check-custom form-check-solid mb-2">
                                <label class="fs-5 fw-bold">{{ __("Discount price") }}</label>
                                <input class="form-check-input mx-2" style="height: 18px;width:36px;" type="checkbox" id="discount-price-switch"  @if ( $service['discount_price'] ) checked @endif />
                                <label class="form-check-label" for="flexSwitchChecked"></label>
                            </div>

                            <div class="form-floating">
                                <input type="number" min="1" class="form-control" id="discount_price_inp" name="discount_price" value="{{ $service['discount_price'] }}" @if ( ! $service['discount_price'] ) disabled @endif placeholder="example"/>
                                <label for="discount_price_inp">{{ __("Enter the discount price") }}</label>
                            </div>
                            <p class="invalid-feedback" id="discount_price" ></p>


                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->


                    <!-- begin :: Row -->
                    <div class="row mb-10">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Description in arabic") }}</label>
                            <div id="desc_summernote_ar" data-name="description_ar" > {!!  $service['description_ar']  !!}</div>
                            <p class="text-danger invalid-feedback" id="description_ar"></p>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Description in english") }}</label>
                            <div id="desc_summernote_en" data-name="description_en" > {!!  $service['description_en']  !!}</div>
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
                    <button type="submit" class="btn btn-primary" id="submit-btn">

                        <span class="indicator-label">{{ __("Save") }}</span>

                        <!-- begin :: Indicator -->
                        <span class="indicator-progress">{{ __("Please wait ...") }}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!-- end   :: Indicator -->

                    </button>
                    <!-- end   :: Submit btn -->

                </div>
                <!-- end   :: Form footer -->
            </form>
            <!-- end   :: Form -->
        </div>
        <!-- end   :: Card body -->
    </div>

@endsection
@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>

    <script>

        let discountInp = $("#discount_price_inp");

        $(document).ready( () => {

            initSummerNotes();

            $("#discount-price-switch").change( function () {
                discountInp.prop('disabled' , ! $(this).prop('checked'))
            });

        });

    </script>
@endpush
