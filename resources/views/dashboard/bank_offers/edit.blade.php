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
                        {{ __('Edit the bank offer data') }}

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
            {{-- <form action="{{ route('dashboard.bank-offers.update',$bankOffer->id) }}" class="form" method="post" data-redirection-url="{{ route('dashboard.banks.index') }}"> --}}
            <form action="{{ route('dashboard.bank-offers.update', $bankOffer->id) }}" class="form" method="post"
                id="submitted-form" data-redirection-url="{{ route('dashboard.banks.index') }}">
                @csrf
                @method('PUT')
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">{{ __('Edit the bank offer data') }}</h3>
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
                                <x-dashboard.upload-image-inp name="image" :image="$bankOffer->image" directory="BankOffers"
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
                                    value="{{ $bankOffer->title_ar ?? '' }}" placeholder="example" />
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
                                    value="{{ $bankOffer->title_en ?? '' }}" placeholder="example" />
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
                            <textarea class="form-control" rows="4" name="description_ar" id="meta_tag_description_ar_inp">{!! $bankOffer->description_ar ?? '' !!}</textarea>
                            <p class="text-danger invalid-feedback" id="description_ar"></p>
                        </div>

                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Description in english') }}</label>
                            <textarea class="form-control" rows="4" name="description_en" id="meta_tag_description_en_inp">{!! $bankOffer->description_en ?? '' !!}</textarea>
                            <p class="text-danger invalid-feedback" id="description_en"></p>

                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- begin :: Row -->
                    <div class="row mb-10">
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Date from') }}</label>
                            <input name="from" value="{{ $bankOffer->from }}"
                                class="form-control form-control-solid ms-4 datepicker border-gray-300 border-1 filter-datatable-inp me-4"
                                readonly placeholder="{{ __('Choose the date') }}" data-filter-index="6" />
                            <p class="invalid-feedback" id="from"></p>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Date to') }}</label>
                            <input name="to" value="{{ $bankOffer->to }}"
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
                            <select class="form-select" name="bank_id" id="bank-sp"
                                data-placeholder="{{ __('Choose the bank') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                @foreach ($banks as $bank)
                                    @if ($bankOffer->bank_id == $bank->id)
                                        <option selected value="{{ $bank->id }}"> {{ $bank->name }} </option>
                                    @endif
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
                                    <option @if (in_array($brand->id, $selectedBrandIds)) selected @endif value="{{ $brand->id }}">
                                        {{ $brand->name }} </option>
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

                    @foreach ($bankOffer->sectors as $bankSector)
                        @php
                            $pivot = $bankSector->pivot;
                        @endphp
                        <span class="badge badge-info mb-9">{{ $bankSector->name }}</span>
                        <!-- begin :: Row -->
                        <div class="row mb-8">
                            <!-- begin :: Column -->
                            <div class="col-md-3 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('Enter the benefit') }}%</label>
                                <div class="form-floating">
                                    <input style="direction: {{ isArabic() ? 'rtl' : '' }}" type="number"
                                        class="form-control" id="{{ $bankSector->slug }}_benefit_inp"
                                        name="{{ $bankSector->slug }}[benefit]"
                                        value="{{ $bankSector['pivot']['benefit'] }}" placeholder="example" />
                                    <label for="_benefit">{{ __('Enter the benefit') }}</label>

                                </div>
                                <p class="invalid-feedback" id="{{ $bankSector->slug }}_benefit"></p>
                            </div>
                            <!-- end   :: Column -->

                            {{-- <!-- begin :: Column -->
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __("Non transferred client profit") }}</label>
                            <div class="form-floating">
                                <input style="direction: {{ isArabic() ? 'rtl' : '' }}" type="text" class="form-control" id="{{$bankSector->slug}}_non_transferred_benefit_inp" name="{{$bankSector->slug}}[non_transferred_benefit]"  value="{{$bankSector['pivot']['non_transferred_benefit']}}" placeholder="example"/>
                                <label for="non_transferred_benefit_inp">{{ __("Enter the non transferred client profit") }}</label>
                            </div>
                            <p class="invalid-feedback" id="{{$bankSector->slug}}_non_transferred_benefit" ></p>
                        </div>
                        <!-- end   :: Column --> --}}
                            <!-- begin :: Column -->
                            {{-- <div class="col-md-2 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('Enter the installment') }}</label>
                                <div class="form-floating">
                                    <input style="direction: {{ isArabic() ? 'rtl' : '' }}" type="text"
                                        class="form-control" id="{{ $bankSector->slug }}_installment"
                                        name="{{ $bankSector->slug }}[installment]"
                                        value="{{ $bankSector['pivot']['installment'] }}" placeholder="example" />
                                    <label for="installment">{{ __('Enter the installment') }}</label>
                                </div>
                                <p class="invalid-feedback" id="{{ $bankSector->slug }}_installment"></p>
                            </div> --}}
                            <div class="col-md-2 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('Enter the installment') }}</label>

                                <div class="form-floating" style="padding: 2px">
                                    <select class="form-select" data-control="select2"
                                        name="{{ $bankSector->slug }}[installment]"
                                        id="{{ $bankSector->slug }}_installment"
                                        data-placeholder="{{ __('Enter the installment') }}"
                                        data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                        <option value="1"
                                            {{ $bankSector['pivot']['installment'] == 1 ? 'selected' : '' }}> 1</option>
                                        <option value="2"
                                            {{ $bankSector['pivot']['installment'] == 2 ? 'selected' : '' }}> 2</option>
                                        <option value="3"
                                            {{ $bankSector['pivot']['installment'] == 3 ? 'selected' : '' }}> 3</option>
                                        <option value="4"
                                            {{ $bankSector['pivot']['installment'] == 4 ? 'selected' : '' }}> 4</option>
                                        <option value="5"
                                            {{ $bankSector['pivot']['installment'] == 5 ? 'selected' : '' }}> 5</option>
                                    </select>
                                </div>
                                <p class="invalid-feedback" id="{{ $bankSector->slug }}_installment"></p>
                            </div>
                            <!-- end   :: Column -->
                            <!-- begin :: Column -->
                            <div class="col-md-2 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('Support') }} %</label>
                                <div class="form-floating">
                                    <input style="direction: ltr" type="number" class="form-control"
                                        id="{{ $bankSector->slug }}_support_inp" name="{{ $bankSector->slug }}[support]"
                                        value="{{ $bankSector['pivot']['support'] }}" placeholder="example" />
                                    <label for="support_inp">{{ __('Enter the support') }}</label>
                                </div>
                                <p class="invalid-feedback" id="{{ $bankSector->slug }}_support"></p>
                            </div>
                            <!-- end   :: Column -->

                            <div class="col-md-2 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('administrative fees') }} %</label>
                                <div class="form-floating">
                                    <input style="direction: ltr" type="number" class="form-control"
                                        id="{{ $bankSector->slug }}_administrative_fees"
                                        value="{{ $bankSector['pivot']['administrative_fees'] }}"
                                        name="{{ $bankSector->slug }}[administrative_fees]" placeholder="example" />
                                    <label for="installment_inp">{{ __('Enter the administrative fees') }}</label>
                                </div>
                                <p class="invalid-feedback" id="{{ $bankSector->slug }}_administrative_fees"></p>
                            </div>
                            <!-- end   :: Column -->
                            <!-- begin :: Column -->
                            <div class="col-md-3 fv-row">
                                <label class="fs-5 fw-bold mb-2">{{ __('Enter the advance') }} %</label>
                                <div class="form-floating">
                                    <input style="direction: ltr" type="number" class="form-control"
                                        id="{{ $bankSector->slug }}_advance"
                                        value="{{ $bankSector['pivot']['advance'] }}"
                                        name="{{ $bankSector->slug }}[advance]" placeholder="example" />
                                    <label for="advance">{{ __('Enter the advance') }}</label>
                                </div>
                                <p class="invalid-feedback" id="{{ $bankSector->slug }}_advance"></p>
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
            $('.datepicker[name="from"]').val("{{ $bankOffer->from ?? '' }}");
            $('.datepicker[name="to"]').val("{{ $bankOffer->to ?? '' }}");

            initTinyMc({
                editingInp: true
            });
        })
    </script>
@endpush
