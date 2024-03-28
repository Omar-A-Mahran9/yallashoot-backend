@extends('partials.dashboard.master')
@section('content')
    <!-- begin :: Subheader -->
    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><a
                        href="{{ route('dashboard.country.index') }}"
                        class="text-muted text-hover-primary">{{ __('Countries') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Edit new country') }}
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
            <form action="{{ route('dashboard.country.store') }}" class="form" method="post" id="submitted-form"
                data-success-message="{{ __('country added successfully') }}"
                data-redirection-url="{{ route('dashboard.country.index') }}">
                @csrf
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">

                    <div class="card-title">
                        <h3 class="fw-bolder text-dark">{{ __('Add new country') }}</h3>
                    </div>



                </div>
                <!-- end   :: Card header -->

                <div class="inputs-wrapper">

                    <!-- begin :: Row -->
                    <div class="row mb-10">

                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row d-flex justify-content-evenly">

                            <div class="d-flex flex-column align-items-center">
                                <!-- begin :: Upload image component -->
                                <label class="text-center fw-bold mb-4">{{ __('Image') }}</label>
                                <div>
                                    <x-dashboard.upload-image-inp name="main_image" :image="$country['main_image']" directory="Countries"
                                        placeholder="default.jpg" type="show"></x-dashboard.upload-image-inp>
                                </div>
                                <p class="invalid-feedback" id="main_image"></p>
                                <!-- end   :: Upload image component -->
                            </div>


                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->


                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('News title in arabic') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="title_inp" name="title_ar"
                                    value="{{ $country['title_ar'] }}" placeholder="example" readonly />
                                <label for="title_inp">{{ __('Enter the country title in arabic') }}</label>
                            </div>
                            <p class="invalid-feedback" id="title_ar"></p>

                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('News title in english') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="title_inp" name="title_en"
                                    value="{{ $country['title_en'] }}" placeholder="example" readonly />
                                <label for="title_inp">{{ __('Enter the country title in english') }}</label>
                            </div>
                            <p class="invalid-feedback" id="title_en"></p>

                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->
                    <!-- begin :: Column -->
                    <div class="row mb-10">

                        <div class="col-md-12 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('continent') }}</label>
                            <select class="form-select" data-control="select2" name="continent_id" id="continent_id-sp"
                                data-placeholder="{{ __('choose continent') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}" disabled>
                                <option value="" selected></option>
                                @foreach ($continents as $continent)
                                    <option value="{{ $continent->id }}"
                                        {{ $country->continent_id == $continent->id ? 'selected' : '' }}>
                                        {{ $continent->title }} </option>
                                @endforeach
                            </select>
                            <p class="invalid-feedback" id="continent_id"></p>
                        </div>
                    </div>
                    <!-- end   :: Column -->

                </div>

                <!-- begin :: Form footer -->
                <div class="form-footer">

                    <!-- begin :: Submit btn -->
                    <a href="{{ route('dashboard.country.index') }}" class="btn btn-primary">
                        <span class="indicator-label">{{ __('Back') }}</span>
                    </a>

                </div>
                <!-- end   :: Form footer -->
            </form>
            <!-- end   :: Form -->
        </div>
        <!-- end   :: Card body -->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('dashboard-assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script>
        $(document).ready(() => {

            initTinyMc(true);

            new Tagify(document.getElementById('tags_inp'), {
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
            });


        });
    </script>
@endpush
