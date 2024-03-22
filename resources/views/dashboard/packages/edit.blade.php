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
                        href="{{ route('dashboard.packages.index') }}"
                        class="text-muted text-hover-primary">{{ __('Packages') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Edit a package') }}
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
            <form action="{{ route('dashboard.packages.update', $package->id) }}" class="form" method="post"
                id="submitted-form" data-redirection-url="{{ route('dashboard.packages.index') }}">
                @csrf
                @method('PUT')
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center justify-content-between">

                    <div class="card-title">
                        <h3 class="fw-bolder text-dark">{{ __('Edit a package') . ' : ' . $package->name }}</h3>
                    </div>
                    <div class="card-title">

                        <div class="form-check form-check-custom form-check-solid mx-4">
                            <label class="form-check-label me-10" for="image-radio-btn"> {{ __('Discount') }} </label>

                            <input class="form-check-input" type="radio" value="1" name="discount_flag"
                                {{ $package->monthly_price_after_discount ? 'checked' : '' }} />
                            <label class="form-check-label me-10" for="image-radio-btn"> {{ __('active') }} </label>

                            <input class="form-check-input" type="radio" value="0" name="discount_flag"
                                {{ $package->monthly_price_after_discount ? '' : 'checked' }} />
                            <label class="form-check-label" for="color-radio-btn"> {{ __('inactive') }} </label>
                        </div>

                    </div>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">

                    <!-- begin :: Row -->
                    <div class="row mb-10">

                        <!-- begin :: Column -->
                        <div class="col-md-3 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Name in arabic') }}</label>
                            <input type="text" class="form-control" id="name_ar_inp" name="name_ar"
                                value="{{ $package->name_ar }}" />
                            <p class="invalid-feedback" id="name_ar"></p>

                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-3 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Name in english') }}</label>
                            <input type="text" class="form-control" id="name_en_inp" name="name_en"
                                value="{{ $package->name_en }}" />

                            <p class="invalid-feedback" id="name_en"></p>

                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-3 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Monthly price') }}</label>
                            <input type="text" class="form-control" id="monthly_price" name="monthly_price"
                                value="{{ $package->monthly_price }}" />
                            <p class="invalid-feedback" id="monthly_price"></p>

                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-3 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Annual price') }}</label>
                            <input type="text" class="form-control" id="annual_price" name="annual_price"
                                value="{{ $package->annual_price }}" />
                            <p class="invalid-feedback" id="annual_price"></p>


                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->

                    <div class="row mb-10 discount" id="discount"
                        style="{{ $package->monthly_price_after_discount ? '' : 'display:none' }}">

                        <!-- begin :: Column -->
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Monthly price after discount') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="monthly_price_after_discount_inp"
                                    name="monthly_price_after_discount"
                                    value="{{ $package->monthly_price_after_discount }}" placeholder="example" />
                                <label
                                    for="monthly_price_after_discount_inp">{{ __('Enter the monthly price after discount') }}</label>
                            </div>
                            <p class="invalid-feedback" id="monthly_price_after_discount"></p>
                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-3 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Annual price after discount') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="annual_price_after_discount_inp"
                                    name="annual_price_after_discount" value="{{ $package->annual_price_after_discount }}"
                                    placeholder="example" />
                                <label
                                    for="annual_price_after_discount_inp">{{ __('Enter the annual price after discount') }}</label>
                            </div>
                            <p class="invalid-feedback" id="annual_price_after_discount"></p>
                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-3 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Discount from date') }}</label>
                            <div class="form-floating">
                                <input class="form-control form-control-solid datepicker border-gray-300 border-1 me-4"
                                    id="discountFromDate" name="discount_from_date" readonly
                                    placeholder="{{ __('Choose the start date') }}" />
                            </div>
                            <p class="invalid-feedback" id="discount_from_date"></p>
                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-3 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Discount to date') }}</label>
                            <div class="form-floating">
                                <input class="form-control form-control-solid datepicker border-gray-300 border-1 me-4"
                                    id="discountToDate" name="discount_to_date" readonly
                                    placeholder="{{ __('Choose the end date') }}" />
                            </div>
                            <p class="invalid-feedback" id="discount_to_date"></p>
                        </div>
                        <!-- end   :: Column -->
                    </div>
                    <!-- end   :: Row -->
                    <!-- end   :: Row -->
                    @if (!$package->features->isEmpty())
                        <!-- begin :: Datatable -->
                        <div class="row mb-10 ">
                            <!-- begin :: Column -->
                            <div class="col-md-6 fv-row " style="overflow: scroll;height: 284px;width: 100%;">
                                <table data-ordering="false" id="kt_datatable"
                                    class="table text-center table-row-dashed fs-6 gy-5 ">

                                    <thead>
                                        <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <!-- <th>#</th> -->
                                            <th>{{ __('name') }}</th>
                                            <th>{{ __('Value') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-bold text-center">
                                        @foreach ($features as $key => $feature)
                                            @php
                                                $packageFeaturesArray = $package->features->toArray();
                                                $isFeatureInPackage = in_array($feature->id, array_column($packageFeaturesArray, 'feature_id'));
                                                $featurePackage = $isFeatureInPackage
                                                    ? current(
                                                        array_filter($packageFeaturesArray, function ($item) use ($feature) {
                                                            return $item['feature_id'] === $feature->id;
                                                        }),
                                                    )
                                                    : null;
                                            @endphp
                                            <tr>
                                                <td style="text-align: start;">
                                                    <input type="checkbox" class="form-check-input mx-2"
                                                        data-target="value{{ $loop->index }}"
                                                        style="height: 20px;width:20px;" multiple name="features[]"
                                                        value="{{ $feature->id }}"
                                                        id="check-feature{{ $loop->index }}"
                                                        {{ $isFeatureInPackage ? 'checked' : '' }}>
                                                    {{ $feature->name }}
                                                    <p class="invalid-feedback" id="features"></p>
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <input type="number" class="form-control w-25"
                                                        value="{{ $featurePackage ? $featurePackage['value'] : '' }}"
                                                        name="values[]" multiple id="value{{ $loop->index }}"
                                                        {{ $isFeatureInPackage ? '' : 'disabled' }}>
                                                    <p class="invalid-feedback" id="values"></p>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end   :: Datatable -->
                    @endif



                    <div class="row mb-10">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Description in arabic') }}</label>
                            <textarea class="form-control" rows="4" name="description_ar" id="meta_tag_description_ar_inp"
                                data-kt-autosize="true">{!! $package->description_ar !!}</textarea>
                            <p class="text-danger invalid-feedback" id="description_ar"></p>

                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Description in english') }}</label>
                            <textarea class="form-control" rows="4" name="description_en" id="meta_tag_description_en_inp"
                                data-kt-autosize="true">{!! $package->description_en !!}</textarea>
                            <p class="text-danger invalid-feedback" id="description_en"></p>

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
            initTinyMc(true);
        });
    </script>
    <script>
        let $discount = $("#discount");
        let $discountFlag = $('input[name="discount_flag"]');

        $(document).ready(() => {
            $("#discountFromDate").val("{{ $package->discount_from_date }}").trigger('change');
            $("#discountToDate").val("{{ $package->discount_to_date }}").trigger('change');

            $discountFlag.change(function() {
                console.log($(this).val());
                if ($(this).val() === "0") {
                    $discount.hide();
                } else {
                    $discount.show();
                }
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $(".form-check-input").on("change", function() {
                var targetValueId = $(this).data("target");
                $("#" + targetValueId).prop("disabled", !$(this).prop("checked"));
            });
        });
    </script>
    <script>
        // Assuming $package->discount_to_date is in a format like 'Y-m-d'
        var initialDateValue = '{{ $package->discount_to_date }}';

        // Set the initial date value in the datepicker
        $(document).ready(function() {
            // Set the initial date value
            // $('.datepicker').datepicker('setDate', new Date(initialDateValue));
        });
    </script>
@endpush
