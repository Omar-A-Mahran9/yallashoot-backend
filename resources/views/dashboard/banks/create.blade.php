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
                        href="{{ route('dashboard.banks.index') }}"
                        class="text-muted text-hover-primary">{{ __('Add new Financing institutions') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Add new Financing institutions') }}

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
            {{-- <form action="{{ route('dashboard.banks.store') }}" class="form" method="post" data-redirection-url="{{ route('dashboard.banks.index') }}"> --}}
            <form action="{{ route('dashboard.banks.store') }}" class="form" method="post" id="submitted-form"
                data-redirection-url="{{ route('dashboard.banks.index') }}">
                @csrf
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">{{ __('Add new Financing institutions') }}</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">


                    <!-- begin :: Row -->
                    <div class="row mb-20">

                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row d-flex justify-content-evenly">

                            <div class="d-flex flex-column align-items-center">
                                <!-- begin :: Upload image component -->
                                <label class="text-center fw-bold mb-4">{{ __('Image') }}</label>
                                <div>
                                    <x-dashboard.upload-image-inp name="image" :image="null" :directory="null"
                                        placeholder="default.jpg" type="editable"></x-dashboard.upload-image-inp>
                                </div>
                                <p class="invalid-feedback" id="image"></p>
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
                            <label class="fs-5 fw-bold mb-2">{{ __('Name in arabic') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name_ar_inp" name="name_ar"
                                    placeholder="example" />
                                <label for="name_ar_inp">{{ __('Enter the name in arabic') }}</label>
                            </div>
                            <p class="invalid-feedback" id="name_ar"></p>
                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Name in english') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name_en_inp" name="name_en"
                                    placeholder="example" />
                                <label for="name_en_inp">{{ __('Enter the name in english') }}</label>
                            </div>
                            <p class="invalid-feedback" id="name_en"></p>
                        </div>
                        <!-- end   :: Column -->
                    </div>
                    <!-- end   :: Row -->
                    <div class="row">


                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row">
                            <div class="form-group row">
                                <label class="col-3 col-form-label fs-5 fw-bold"><i
                                        class="bi bi-dash-lg fs-8 mx-3"></i>{{ __('Chosse type financing institute') }}</label>
                                <div class="col-8 col-form-label">
                                    <div class="radio-inline  d-flex justify-content-start">
                                        <div class="form-check form-check-custom form-check-solid mx-4">
                                            <input onclick="showradio()" class="form-check-input" type="radio"
                                                value="bank" name="type" id="type_bank"
                                                wtx-context="6ABBB073-FB69-4058-8A50-6B4FFD240797">
                                            <label class="form-check-label" for="type_bank">
                                                {{ __('Bank') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid mx-4">
                                            <input onclick="hideradio()" class="form-check-input" type="radio"
                                                value="company" name="type" id="type_finance"
                                                wtx-context="01DAA9FF-73CC-4456-8B56-E4272344A5D0">
                                            <label class="form-check-label" for="type_finance">
                                                {{ __('Financing company') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger invalid-feedback" id="type"></p>
                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row" id="acceptFromAnotherBank" style="display: none;">
                            <div class="form-group row">
                                <label class="col-3 col-form-label fs-5 fw-bold"><i
                                        class="bi bi-dash-lg fs-8 mx-3"></i>{{ __('Accept clients from other banks') }}</label>
                                <div class="col-8 col-form-label">
                                    <div class="radio-inline  d-flex justify-content-start">
                                        <div class="form-check form-check-custom form-check-solid mx-4">
                                            <input class="form-check-input" type="radio" value="1"
                                                name="accept_from_other_banks" id="accept_from_other_banks_yes"
                                                wtx-context="6ABBB073-FB69-4058-8A50-6B4FFD240797">
                                            <label class="form-check-label" for="accept_from_other_banks_yes">
                                                {{ __('Yes') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid mx-4">
                                            <input class="form-check-input" type="radio" value="0"
                                                name="accept_from_other_banks" id="accept_from_other_banks_no"
                                                wtx-context="01DAA9FF-73CC-4456-8B56-E4272344A5D0">
                                            <label class="form-check-label" for="accept_from_other_banks_no">
                                                {{ __('No') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger invalid-feedback" id="accept_from_other_banks"></p>
                        </div>
                        <!-- end   :: Column -->


                    </div>
                    <div class="separator separator-content border-dark my-10"><span
                            class="w-250px fw-bold">{{ __('Bank Actions With Sectors') }}</span></div>
                    @foreach ($sectors as $sector)
                        <span class="badge badge-info mb-9">{{ $sector->name }}</span>
                        <!-- begin :: Row -->

                        <div class="row mb-8">
                            <!-- begin :: Column -->
                            <div class="col-md-3 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('Enter the benefit') }}%</label>
                                <div class="form-floating">
                                    <input style="direction: {{ isArabic() ? 'rtl' : '' }}" type="number"
                                        min="0" value="0" class="form-control"
                                        id="{{ $sector->slug }}_benefit" name="{{ $sector->slug }}[benefit]"
                                        placeholder="example" />
                                    <label for="_benefit">{{ __('Enter the benefit') }}</label>
                                </div>
                                <p class="invalid-feedback" id="{{ $sector->slug }}_benefit"></p>
                            </div>
                            <!-- end   :: Column -->

                            <!-- begin :: Column -->
                            <div class="col-md-3 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('Transferred client profit') }}%</label>
                                <div class="form-floating">
                                    <input style="direction: {{ isArabic() ? 'rtl' : '' }}" type="number"
                                        min="0" value="0" class="form-control"
                                        id="{{ $sector->slug }}_transferred_benefit"
                                        name="{{ $sector->slug }}[transferred_benefit]" placeholder="example" />
                                    <label
                                        for="_transferred_benefit">{{ __('Enter the transferred client profit') }}</label>
                                </div>
                                <p class="invalid-feedback" id="{{ $sector->slug }}_transferred_benefit"></p>
                            </div>
                            <!-- end   :: Column -->

                            <!-- begin :: Column -->
                            <div class="col-md-3 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('Support') }}%</label>
                                <div class="form-floating">
                                    <input style="direction: {{ isArabic() ? 'rtl' : '' }}" type="number"
                                        value="0" class="form-control" id="{{ $sector->slug }}_support_inp"
                                        name="{{ $sector->slug }}[support]" placeholder="example" />
                                    <label for="support_inp">{{ __('Enter the support') }}</label>
                                </div>
                                <p class="invalid-feedback" id="{{ $sector->slug }}_support"></p>
                            </div>
                            <!-- end :: Column -->

                            <!-- begin :: Column -->
                            <div class="col-md-3 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('administrative fees') }} %</label>
                                <div class="form-floating">
                                    <input style="direction: {{ isArabic() ? 'rtl' : '' }}" type="number"
                                        value="0" class="form-control"
                                        id="{{ $sector->slug }}_administrative_fees_inp"
                                        name="{{ $sector->slug }}[administrative_fees]" placeholder="example" />
                                    <label for="installment_inp">{{ __('Enter the administrative fees') }}</label>
                                </div>
                                <p class="invalid-feedback" id="{{ $sector->slug }}_administrative_fees"></p>
                            </div>
                            <!-- end   :: Column -->
                        </div>
                        <!-- end   :: Row -->
                    @endforeach

                </div>
                <!-- end   :: Inputs wrapper -->

                <!-- begin :: Form footer -->
                <div class="form-footer">

                    <!-- begin :: Submit btn -->
                    <button type="submit" class="btn btn-primary" id="submit-btn">

                        <span class="indicator-label">{{ __('Save') }}</span>

                        <!-- begin :: Indicator -->
                        <span class="indicator-progress">{{ __('Please wait ...') }}
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
        var x = document.getElementById("acceptFromAnotherBank");

        function showradio() {
            x.style.display = 'block';
        }

        function hideradio() {
            x.style.display = 'none';
        }
    </script>
@endpush
