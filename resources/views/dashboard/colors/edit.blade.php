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
                        {{ __("Edit color") }}
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
            <form action="{{ route('dashboard.colors.update',$color->id) }}" class="form" method="post" id="submitted-form" data-redirection-url="{{ route('dashboard.colors.index') }}">
                @csrf
                @method("PUT")

                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <div class="card-title">
                        <h3 class="fw-bolder text-dark">{{ __("Edit color") . ' : ' . $color->name }}</h3>
                    </div>
                    <div class="card-title">

                        <div class="form-check form-check-custom form-check-solid mx-4">
                            {{-- <input class="form-check-input" type="radio" value="image" name="color_type" id="image-radio-btn"  @if ( $color['image']) checked @endif />
                            <label class="form-check-label me-10" for="image-radio-btn"> {{ __("image") }} </label> --}}

                            <input class="form-check-input" type="radio" value="color" name="color_type" id="color-radio-btn"  @if ( $color['hex_code']) checked @endif />
                            <label class="form-check-label" for="color-radio-btn"> {{ __("color") }} </label>
                        </div>

                    </div>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">

                    <!-- begin :: Row -->
                    <div class="row mb-8" id="image-container" @if ( $color['hex_code']) style="display:none" @endif  >

                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row text-center">

                            <!-- begin :: Upload image component -->
                            <x-dashboard.upload-image-inp name="image" :image="$color->image" directory="Colors" placeholder="default.jpg" type="editable" ></x-dashboard.upload-image-inp>
                            <p class="invalid-feedback" id="image" ></p>
                            <!-- end   :: Upload image component -->

                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Name in arabic") }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name_ar_inp" name="name_ar" value="{{ $color->name_ar }}" placeholder="example"/>
                                <label for="name_ar_inp">{{ __("Enter the name in arabic") }}</label>
                            </div>
                            <p class="invalid-feedback" id="name_ar" ></p>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Name in english") }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name_en_inp" name="name_en" value="{{ $color->name_en }}" placeholder="example"/>
                                <label for="name_en_inp">{{ __("Enter the name in english") }}</label>
                            </div>
                            <p class="invalid-feedback" id="name_en" ></p>


                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-4" id="colors-container" @if ( $color['image']) style="display:none" @endif>

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2" for="hex_code_inp">{{ __("Color") }}</label>
                            <input type="color" name="hex_code" class="form-control" id="hex_code_inp" value="{{ $color->hex_code }}" style="height:47.5px"/>
                            <p class="invalid-feedback" id="hex_code" ></p>


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
    <script>
        let $colorInp        = $('#hex_code_inp');
        let $colorCode       = $('#color_code_inp');
        let $imageContainer  = $("#image-container");
        let $colorsContainer = $("#colors-container");
        let $colorType       = $('input[name="color_type"]');

        $(document).ready( () => {

            $colorInp.change( function () {

                $colorCode.val( $(this).val() )

            });

            $colorType.change( function () {
                if( $(this).val() === "color")
                {
                    $imageContainer.hide();
                    $colorsContainer.show();
                }else
                {
                    $imageContainer.show();
                    $colorsContainer.hide();
                }

            })

        })
    </script>
@endpush
