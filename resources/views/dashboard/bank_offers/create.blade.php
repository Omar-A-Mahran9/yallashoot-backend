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
                        class="text-muted text-hover-primary">{{ __('Banks') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Add new offer for the bank') }}

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
            {{-- <form action="{{ route('dashboard.bank-offers.store') }}" class="form" method="post" data-redirection-url="{{ route('dashboard.banks.index') }}"> --}}
            <form action="{{ route('dashboard.bank-offers.store') }}" class="form" method="post" id="submitted-form"
                data-redirection-url="{{ route('dashboard.banks.index') }}">
                @csrf
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">{{ __('Add new offer for the bank') }}</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">


                    <!-- begin :: Row -->
                    <div class="row mb-20">

                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row d-flex justify-content-evenly">

                            <div class="d-flex flex-column">
                                <!-- begin :: Upload image component -->
                                <label class="text-center fw-bold mb-4">{{ __('Image') }}</label>
                                <x-dashboard.upload-image-inp name="image" :image="null" :directory="null"
                                    placeholder="default.jpg" type="editable"></x-dashboard.upload-image-inp>
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
                            <label class="fs-5 fw-bold mb-2">{{ __('Title in arabic') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="title_ar_inp" name="title_ar"
                                    placeholder="example" />
                                <label for="title_ar_inp">{{ __('Enter the title in arabic') }}</label>
                            </div>
                            <p class="invalid-feedback" id="title_ar"></p>
                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Title in english') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="title_en_inp" name="title_en"
                                    placeholder="example" />
                                <label for="title_en_inp">{{ __('Enter the title in english') }}</label>
                            </div>
                            <p class="invalid-feedback" id="title_en"></p>
                        </div>
                        <!-- end   :: Column -->
                    </div>
                    <!-- end   :: Row -->
                    <!-- begin :: Row -->
                    <div class="row mb-10">



                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Description in arabic') }}</label>
                            <textarea class="form-control" rows="4" name="description_ar" id="meta_tag_description_ar_inp"></textarea>
                            <p class="text-danger invalid-feedback" id="description_ar"></p>

                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Description in english') }}</label>
                            <textarea class="form-control" rows="4" name="description_en" id="meta_tag_description_en_inp"></textarea>
                            <p class="text-danger invalid-feedback" id="description_en"></p>

                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- begin :: Row -->
                    <div class="row mb-10">
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Date from') }}</label>
                            <input name="from"
                                class="form-control form-control-solid ms-4 datepicker border-gray-300 border-1 filter-datatable-inp me-4"
                                readonly placeholder="{{ __('Choose the date') }}" data-filter-index="6" />
                            <p class="invalid-feedback" id="from"></p>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Date to') }}</label>
                            <input name="to"
                                class="form-control form-control-solid ms-4 datepicker border-gray-300 border-1 filter-datatable-inp me-4"
                                readonly placeholder="{{ __('Choose the date') }}" data-filter-index="6" />
                            <p class="invalid-feedback" id="to"></p>
                        </div>
                    </div>
                    <!-- End :: Row -->
                    <!-- begin :: Row -->
                    <div class="row mb-10">
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Bank') }}</label>
                            <select class="form-select" data-control="select2" name="bank_id" id="bank-sp"
                                data-placeholder="{{ __('Choose the bank') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option selected></option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}"> {{ $bank->name }} </option>
                                @endforeach
                            </select>
                            <p class="invalid-feedback" id="bank_id"></p>

                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Brand') }}</label>
                            <select class="form-select" multiple data-control="select2" name="brand_id[]" id="brand-sp"
                                data-placeholder="{{ __('Choose the brand') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
                                @endforeach
                            </select>
                            <p class="invalid-feedback" id="brand_id"></p>

                        </div>
                        <!-- end   :: Column -->
                    </div>
                    <!-- end :: Row -->
                    <!-- end   :: Row -->
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
                                        id="{{ $sector->slug }}__benefit" name="{{ $sector->slug }}[benefit]"
                                        placeholder="example" />
                                    <label for="_benefit">{{ __('Enter the benefit') }}</label>
                                </div>
                                <p class="invalid-feedback" id="{{ $sector->slug }}_benefit"></p>
                            </div>
                            <!-- end   :: Column -->

                            <!-- begin :: Column -->
                            <div class="col-md-2 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('Enter the installment') }}</label>

                                <div class="form-floating" style="padding: 2px">
                                    <select class="form-select" data-control="select2"
                                        name="{{ $sector->slug }}[installment]" id="{{ $sector->slug }}_installment"
                                        data-placeholder="{{ __('Enter the installment') }}"
                                        data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                        <option value="1"> 1</option>
                                        <option value="2"> 2</option>
                                        <option value="3"> 3</option>
                                        <option value="4"> 4</option>
                                        <option value="5"> 5</option>
                                    </select>
                                </div>
                                {{-- <label class="fs-5 fw-bold mb-2">{{ __('Enter the installment') }}</label>
                                <div class="form-floating">
                                    <input style="direction: {{ isArabic() ? 'rtl' : '' }}" type="text"
                                        min="0" value="0" class="form-control"
                                        id="{{ $sector->slug }}_installment" name="{{ $sector->slug }}[installment]"
                                        placeholder="example" />
                                    <label for="installment">{{ __('Enter the installment') }}</label>
                                </div> --}}
                                <p class="invalid-feedback" id="{{ $sector->slug }}_installment"></p>
                            </div>
                            <!-- end   :: Column -->


                            <!-- begin :: Column -->
                            <div class="col-md-2 fv-row">
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
                            <div class="col-md-2 fv-row">
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
                            <!-- begin :: Column -->
                            <div class="col-md-3 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('Enter the advance') }}%</label>
                                <div class="form-floating">
                                    <input style="direction: {{ isArabic() ? 'rtl' : '' }}" type="number"
                                        min="0" value="0" class="form-control"
                                        id="{{ $sector->slug }}_advance" name="{{ $sector->slug }}[advance]"
                                        placeholder="example" />
                                    <label for="advance">{{ __('Enter the advance') }}</label>
                                </div>
                                <p class="invalid-feedback" id="{{ $sector->slug }}_advance"></p>
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
    <script src="{{ asset('dashboard-assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script>
        $(document).ready(() => {
            initTinyMc();
        })
    </script>
@endpush
