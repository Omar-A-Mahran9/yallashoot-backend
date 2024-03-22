@extends('partials.dashboard.master')
@push('styles')
    <link href="{{ asset('dashboard-assets/css/wizard' . (isArabic() ? '.rtl' : '') . '.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .separator-dashed {
            border-color: #e4e6ef !important;
        }

        .modal .modal-body {
            overflow-y: auto;
            max-height: 500px;
        }
    </style>
@endpush
@section('content')
    <!-- begin :: Subheader -->

    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><a
                        href="{{ route('dashboard.cars.index') }}"
                        class="text-muted text-hover-primary">{{ __('Cars') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Edit car') }}
                    </li>
                    <!-- end   :: Item -->
                </ul>

                <!-- end   :: Breadcrumb -->

            </div>

        </div>

    </div>
    <!-- end   :: Subheader -->

    <!-- begin :: Card -->
    <div class="card">

        <div class="card-body p-0">
            <!-- begin :: Wizard -->

            <div class="card card-custom card-shadowless rounded-top-0">

                <div class="card-body p-0">
                    <div class="row justify-content-center pt-8">
                        <div class="col-xl-12">
                            <!-- begin :: Wizard Form -->

                            <form class="form mt-0 mt-lg-10" id="submitted-form" enctype="multipart/form-data">
                                <input type="hidden" name="is_duplicate"
                                    value="{{ request()->segment(4) === 'duplicate' }}" />
                                <input type="hidden" name="car_id" value={{ $car['id'] ?? null }} />

                                <div class="row mb-10">

                                    <!-- begin :: Column -->
                                    <div class="col-md-12 fv-row d-flex justify-content-evenly">

                                        <!--begin::Input group-->
                                        <div class="fv-row">

                                            <div class="dropzone" id="dropzone_input">

                                                <div class="dz-message needsclick">
                                                    <i class="bi-file-earmark-arrow-up fs-3x text-primary"><span
                                                            class="path1"></span><span class="path2"></span></i>

                                                    <!--begin::Info-->
                                                    <div class="ms-4">
                                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">
                                                            {{ __('Drop files here or click to upload') }}
                                                        </h3>
                                                        <span
                                                            class="fs-7 fw-semibold text-gray-500">{{ __('Upload up to 15 files') }}</span>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <input class="d-none" type="file" id="images_input" name="car_Images[]"
                                                    multiple>
                                                <input class="d-none" type="text" id="deleted_images"
                                                    name="deleted_images" value="[]">

                                            </div>
                                            <!--end::Dropzone-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="car_Images">
                                            </div>

                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!-- end   :: Column -->

                                </div>

                                <div class="p-8">

                                    <!-- begin :: Row -->
                                    <div class="row mb-10">

                                        <!-- begin :: Column -->
                                        <div class="col-md-3 fv-row">

                                            <label class="fs-5 fw-bold mb-2">{{ __('Brand') }}</label>
                                            <select class="form-select" data-control="select2" name="brand_id"
                                                id="brand-sp" data-placeholder="{{ __('Choose the brand') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                <option value="" selected></option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ $brand['id'] == $car['brand_id'] ? 'selected' : '' }}>
                                                        {{ $brand->name }} </option>
                                                @endforeach
                                            </select>
                                            <p class="invalid-feedback" id="brand_id"></p>


                                        </div>
                                        <!-- end   :: Column -->
                                        <!-- begin :: Column -->



                                        <div class="col-md-3 fv-row">

                                            <label class="fs-5 fw-bold mb-2">{{ __('Model') }}</label>
                                            <select class="form-select" data-control="select2" name="model_id"
                                                id="model-sp" data-placeholder="{{ __('Choose the model') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                <option value="" selected></option>
                                                @if (isset($models))
                                                    @foreach ($models as $model)
                                                        <option value="{{ $model->id }}"
                                                            {{ $model['id'] == $car['model_id'] ? 'selected' : '' }}>
                                                            {{ $model->name }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p class="invalid-feedback" id="model_id"></p>
                                        </div>



                                        <!-- begin :: Column -->
                                        <div class="col-md-3 fv-row">

                                            <label class="fs-5 fw-bold mb-2">{{ __('Colors') }}</label>

                                            <select class="form-select" data-control="select2" id="colors-sp"
                                                name="color_id" data-placeholder="{{ __('Choose the color') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                <option value="" selected></option>

                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}"
                                                        {{ $color['id'] == $car['color_id'] ? 'selected' : '' }}>
                                                        {{ $color->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <p class="invalid-feedback" id="color_id"></p>

                                        </div>
                                        <!-- end   :: Column -->
                                        <div class="col-md-3 fv-row">

                                            <label class="fs-5 fw-bold mb-2">{{ __('city data') }}</label>
                                            <select class="form-select" data-control="select2" name="city_id" id="city-sp"
                                                data-placeholder="{{ __('Choose the city') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                <option value="" selected></option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ $city['id'] == $car['city_id'] ? 'selected' : '' }}>
                                                        {{ $city->name }} </option>
                                                @endforeach
                                            </select>
                                            <p class="invalid-feedback" id="city_id"></p>
                                        </div>




                                    </div>
                                    <!-- end   :: Row -->

                                    <!-- begin :: Row -->
                                    <div class="row mb-10">
                                        <div class="col-md-3 fv-row">
                                            {{ $car['category_id'] }}
                                            <label class="fs-5 fw-bold mb-2">{{ __('Category') }}</label>
                                            <select class="form-select" data-control="select2" name="category_id"
                                                id="category-sp" data-placeholder="{{ __('Choose the category') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                <option value="" selected></option>
                                                @if (isset($categories))
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $category['id'] == $car['category_id'] ? 'selected' : '' }}>
                                                            {{ $category->name }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p class="invalid-feedback" id="category_id"></p>
                                        </div>

                                        <!-- begin :: Column -->
                                        <div class="col-md-3 fv-row">

                                            <label class="fs-5 fw-bold mb-2">{{ __('Car name in arabic') }}</label>

                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="name_ar_inp"
                                                    name="name_ar" value="{{ $car['name_ar'] }}"
                                                    placeholder="example" />
                                                <label
                                                    for="card_description_ar_inp">{{ __('Car name in arabic') }}</label>
                                            </div>

                                            <p class="invalid-feedback" id="name_ar"></p>

                                        </div>
                                        <!-- end   :: Column -->

                                        <!-- begin :: Column -->
                                        <div class="col-md-3 fv-row">

                                            <label class="fs-5 fw-bold mb-2">{{ __('Car name in english') }}</label>
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="card_description_en_inp"
                                                    name="name_en" value="{{ $car['name_en'] }}"
                                                    placeholder="example" />
                                                <label
                                                    for="card_description_en_inp">{{ __('Car name in english') }}</label>
                                            </div>
                                            <p class="invalid-feedback" id="name_en"></p>


                                        </div>
                                        <!-- end   :: Column -->

                                        <!-- begin :: Column -->
                                        <div class="col-md-3 fv-row">

                                            <label class="fs-5 fw-bold mb-2">{{ __('Year') }}</label>

                                            <select class="form-select" data-control="select2" name="year"
                                                data-placeholder="{{ __('Choose the year') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                @for ($year = Date('Y') + 1; $year >= 1800; $year--)
                                                    <option value="{{ $year }}"
                                                        {{ $year === $car['year'] ? 'selected' : '' }}>
                                                        {{ $year }} </option>
                                                @endfor
                                            </select>

                                            <p class="invalid-feedback" id="year"></p>


                                        </div>
                                        <!-- end   :: Column -->

                                    </div>
                                    <!-- end   :: Row -->

                                    <!-- begin :: Row -->
                                    <div class="row mb-10">
                                        <!-- begin :: Column -->
                                        <div class="col-md-3 fv-row">

                                            <label class="fs-5 fw-bold mb-2">{{ __('fuel type') }}</label>

                                            <select class="form-select" data-control="select2" name="fuel_type"
                                                data-placeholder="{{ __('Choose the fuel') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                <option value="gasoline"
                                                    {{ $car['fuel_type'] == 'gasoline' ? 'selected' : '' }}>
                                                    {{ __('gasoline') }}</option>
                                                <option value="diesel"
                                                    {{ $car['fuel_type'] == 'diesel' ? 'selected' : '' }}>
                                                    {{ __('diesel') }}</option>
                                                <option value="electric"
                                                    {{ $car['fuel_type'] == 'electric' ? 'selected' : '' }}>
                                                    {{ __('electric') }}</option>
                                                <option value="hybrid"
                                                    {{ $car['fuel_type'] == 'hybrid' ? 'selected' : '' }}>
                                                    {{ __('hybrid') }}</option>
                                            </select>
                                            <p class="invalid-feedback" id="fuel_type"></p>


                                        </div>
                                        <!-- begin :: Column -->
                                        <div class="col-md-3 fv-row">

                                            <label class="fs-5 fw-bold mb-2">{{ __('Video url') }}</label>

                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="video_url_inp"
                                                    name="video_url" value="{{ $fullYoutubeUrl }}"
                                                    placeholder="example" />
                                                <label for="video_url_inp">{{ __('Enter the video url') }}</label>
                                            </div>

                                            <p class="invalid-feedback" id="video_url"></p>

                                        </div>
                                        <!-- end   :: Column -->

                                        <!-- begin :: Column -->
                                        <div class="col-md-3 fv-row">

                                            <label class="fs-5 fw-bold mb-2">{{ __('Price') }}</label>
                                            <div class="form-floating">
                                                <input type="number" min="1" class="form-control" id="price_inp"
                                                    name="price" value="{{ $car['price'] }}" placeholder="example" />
                                                <label for="price_inp">{{ __('Enter the price') }}</label>
                                            </div>
                                            <p class="invalid-feedback" id="price"></p>


                                        </div>
                                        <!-- end   :: Column -->

                                        <!-- begin :: Column -->
                                        <div class="col-md-3 fv-row">

                                            <div class="form-check form-switch form-check-custom form-check-solid mb-2">
                                                <label class="fs-5 fw-bold">{{ __('Discount price') }}</label>
                                                <input class="form-check-input mx-2" style="height: 18px;width:36px;"
                                                    type="checkbox" name="have_discount"
                                                    {{ $car['have_discount'] ? 'checked' : '' }}
                                                    id="discount-price-switch" />
                                                <label class="form-check-label" for="flexSwitchChecked"></label>
                                            </div>

                                            <div class="form-floating">
                                                <input type="number" min="1" class="form-control"
                                                    id="discount_price_inp" name="discount_price"
                                                    value="{{ $car['discount_price'] }}"
                                                    {{ $car['have_discount'] ? '' : 'disabled' }} placeholder="example" />
                                                <label
                                                    for="discount_price_inp">{{ __('Enter the discount price') }}</label>
                                            </div>
                                            <p class="invalid-feedback" id="discount_price"></p>


                                        </div>
                                        <!-- end   :: Column -->
                                        <div class="row mb-10">




                                        </div>

                                        <!-- begin :: Column -->
                                        <div class="row mb-10">
                                            <!-- begin :: Column -->
                                            <div class="col-md-4 fv-row">

                                                <label class="fs-5 fw-bold mb-2">{{ __('fuel tank capacity') }}</label>
                                                <div class="form-floating">
                                                    <input type="number" min="30" class="form-control"
                                                        id="fuel_tank_capacity_inp" name="fuel_tank_capacity"
                                                        value="{{ $car['fuel_tank_capacity'] }}" placeholder="example" />
                                                    <label
                                                        for="fuel_tank_capacity_inp">{{ __('Enter the fuel tank capactiy in liters') }}</label>
                                                </div>
                                                <p class="invalid-feedback" id="fuel_tank_capacity"></p>
                                            </div>
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-bold mb-2">{{ __('status') }}</label>
                                                <select class="form-select" name="status" id="status-sp"
                                                    data-placeholder="{{ __('Choose the status') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    <option value=""></option>
                                                    @foreach (App\Enums\CarStatus::values() as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ $car->status == $key ? 'selected' : '' }}>
                                                            {{ __(ucfirst($value)) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="invalid-feedback" id="status"></p>
                                            </div>


                                            <div class="col-md-4 fv-row">

                                                <label class="fs-5 fw-bold mb-2">{{ __('Tags') }}</label>
                                                <select class="form-select" data-control="select2" name="tags[]"
                                                    multiple id="tags-sp"
                                                    data-placeholder="{{ __('Choose the tags') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    @foreach ($tags as $tag)
                                                        <option @if (in_array($tag->id, $selectedtagsIds)) selected @endif
                                                            value="{{ $tag['id'] }}">
                                                            {{ $tag['name'] }}
                                                        </option>
                                                    @endforeach

                                                </select>


                                                <p class="invalid-feedback" id="tags"></p>


                                            </div>

                                        </div>
                                        <!-- end   :: Column -->
                                    </div>
                                    <!-- end   :: Row -->



                                    <!-- begin :: Row -->
                                    <div class="row mb-10">

                                        <!-- begin :: Column -->
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-bold mb-2">{{ __('Description in arabic') }}</label>
                                            <textarea class="form-control" rows="4" id="tinymce_description_ar" name="description_ar">{!! $car['description_ar'] !!}</textarea>
                                            <p class="text-danger invalid-feedback" id="description_ar"></p>


                                        </div>


                                        <!-- end   :: Column -->

                                        <!-- begin :: Column -->
                                        <div class="col-md-6 fv-row">

                                            <label class="fs-5 fw-bold mb-2">{{ __('Description in english') }}</label>
                                            <textarea class="form-control" rows="4" id="tinymce_description_en" name="description_en">{!! $car['description_en'] !!}</textarea>
                                            <p class="text-danger error-element" id="description_en"></p>


                                        </div>
                                        <!-- end   :: Column -->

                                    </div>




                                    <div class="separator separator-dashed my-4"></div>

                                    <!-- begin :: Row -->
                                    <div class="row">

                                        <!-- begin :: Column -->
                                        <div class="col-md-12 fv-row">

                                            <x-dashboard.radio-btn title="Supplier" name="supplier" :radio-btns="[
                                                [
                                                    'label' => 'Gulf',
                                                    'value' => 'gulf',
                                                    'id' => 'supplier_gulf',
                                                    'checked' => $car['supplier'] == 'gulf',
                                                ],
                                                [
                                                    'label' => 'Saudi',
                                                    'value' => 'saudi',
                                                    'id' => 'supplier_saudi',
                                                    'checked' => $car['supplier'] == 'saudi',
                                                ],
                                            ]" />


                                        </div>
                                        <!-- end   :: Column -->


                                    </div>
                                    <!-- end   :: Row -->


                                    <div class="separator separator-dashed my-4"></div>
                                    <!-- begin :: Row -->
                                    <div class="row">

                                        <!-- begin :: Column -->
                                        <div class="col-md-12 fv-row">

                                            <x-dashboard.radio-btn title="car style" name="car_body" :radio-btns="[
                                                [
                                                    'label' => 'hatchback',
                                                    'value' => 'hatchback',
                                                    'id' => 'car_style_1',
                                                    'checked' => $car['car_body'] == 'hatchback',
                                                ],
                                                [
                                                    'label' => 'sedan',
                                                    'value' => 'sedan',
                                                    'id' => 'car_style_2',
                                                    'checked' => $car['car_body'] == 'sedan',
                                                ],
                                                [
                                                    'label' => '4x4',
                                                    'value' => 'four-wheel-drive',
                                                    'id' => 'car_style_3',
                                                    'checked' => $car['car_body'] == 'four-wheel-drive',
                                                ],
                                                [
                                                    'label' => 'family',
                                                    'value' => 'family',
                                                    'id' => 'car_style_4',
                                                    'checked' => $car['car_body'] == 'family',
                                                ],
                                                [
                                                    'label' => 'commercial',
                                                    'value' => 'commercial',
                                                    'id' => 'car_style_5',
                                                    'checked' => $car['car_body'] == 'commercial',
                                                ],
                                            ]" />


                                        </div>
                                        <!-- end   :: Column -->

                                    </div>
                                    <!-- end   :: Row -->
                                    <div class="separator separator-dashed my-4"></div>

                                    <!-- begin :: Row -->
                                    <div class="row">

                                        <!-- begin :: Column -->
                                        <div class="col-md-12 fv-row">

                                            <x-dashboard.radio-btn title="Publish car" name="publish" :radio-btns="[
                                                [
                                                    'label' => 'Yes',
                                                    'value' => '1',
                                                    'id' => 'publish_yes',
                                                    'checked' => $car['publish'] == '1',
                                                ],
                                                [
                                                    'label' => 'No',
                                                    'value' => '0',
                                                    'id' => 'publish_no',
                                                    'checked' => $car['publish'] == '0',
                                                ],
                                            ]" />

                                        </div>
                                        <!-- end   :: Column -->


                                    </div>
                                    <!-- end   :: Row -->

                                    <div class="separator separator-dashed my-4"></div>

                                    <!-- begin :: Row -->
                                    <div class="row">

                                        <!-- begin :: Column -->
                                        <div class="col-md-12 fv-row">

                                            <x-dashboard.radio-btn title="Car condition" name="is_new"
                                                :radio-btns="[
                                                    [
                                                        'label' => 'New',
                                                        'value' => '1',
                                                        'id' => 'is_new_used_radio_1',
                                                        'checked' => $car['is_new'] == '1',
                                                    ],
                                                    [
                                                        'label' => 'Used',
                                                        'value' => '0',
                                                        'id' => 'is_new_used_radio_2',
                                                        'checked' => $car['is_new'] == '0',
                                                    ],
                                                ]" />

                                        </div>
                                        <div class="row d-flex align-items-center"
                                            style="{{ $car['is_new'] ? 'display:none !important' : '' }}"
                                            id="kilometers-container">
                                            <div class="col-4">
                                                <label class="col-form-label fs-5 fw-bold"><i
                                                        class="bi bi-dash-lg fs-8 mx-3"></i>{{ __('Number of kilometers') }}</label>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-floating">
                                                    <input class="form-control" type="number" min="1"
                                                        id="kilometers_inp" name="kilometers"
                                                        value="{{ $car['kilometers'] }}" placeholder="example">
                                                    <label for="kilometers_inp">{{ __('Enter the kilometers') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-danger m-0 invalid-feedback" id="kilometers"></p>
                                            </div>
                                        </div>
                                        <!-- end   :: Column -->


                                    </div>
                                    <!-- end   :: Row -->

                                    <div class="separator separator-dashed my-4"></div>

                                    <!-- begin :: Row -->
                                    <div class="row">

                                        <!-- begin :: Column -->
                                        <div class="col-md-12 fv-row">

                                            <x-dashboard.radio-btn title="Show in home page" name="show_in_home_page"
                                                :radio-btns="[
                                                    [
                                                        'label' => 'Yes',
                                                        'value' => '1',
                                                        'id' => 'show_in_home_page_yes',
                                                        'checked' => $car['show_in_home_page'] == '1',
                                                    ],
                                                    [
                                                        'label' => 'No',
                                                        'value' => '0',
                                                        'id' => 'show_in_home_page_no',
                                                        'checked' => $car['show_in_home_page'] == '0',
                                                    ],
                                                ]" />

                                        </div>
                                        <!-- end   :: Column -->

                                    </div>
                                    <!-- end   :: Row -->
                                    <div class="separator separator-dashed my-4"></div>

                                    <!-- end   :: Row -->
                                    <div class="row">

                                        <!-- begin :: Column -->
                                        <div class="col-md-12 fv-row">

                                            <x-dashboard.radio-btn title="gear shifter" name="gear_shifter"
                                                :radio-btns="[
                                                    [
                                                        'label' => 'manual',
                                                        'value' => 'manual',
                                                        'id' => 'gear_shifter_manual',
                                                        'checked' => $car['gear_shifter'] == 'manual',
                                                    ],
                                                    [
                                                        'label' => 'automatic',
                                                        'value' => 'automatic',
                                                        'id' => 'gear_shifter_automatic',
                                                        'checked' => $car['gear_shifter'] == 'automatic',
                                                    ],
                                                ]" />

                                        </div>
                                        <!-- end   :: Column -->

                                    </div>
                                    <!-- end   :: Row -->




                                </div>


                                <div class="d-flex justify-content-between border-top py-10 px-10">

                                    <div>

                                        <button type="button"
                                            class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4 step-btn"
                                            id="next-btn" data-btn-type="next">

                                            <span class="indicator-label">{{ __('Save') }}</span>

                                            <!-- begin :: Indicator -->
                                            <span class="indicator-progress">{{ __('Please wait ...') }}
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                            <!-- end   :: Indicator -->

                                        </button>

                                    </div>
                                </div>
                                <!-- end   :: Wizard Actions -->
                            </form>
                            <!-- end   :: Wizard Form -->

                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- end   :: Wizard -->
    </div>

    </div>

    <!-- end   :: Card -->
@endsection
@push('scripts')
    <script>
        function setDropzoneImages(dropzone) {
            $.ajax({
                url: '/dashboard/cars/{{ $car->id }}/images',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        var file = {
                            name: value.image,
                            size: value.size,
                            type: 'image/jpeg',
                            status: 'success',
                            url: value.path,
                            is_stored_before: true
                        };

                        dropzone.options.addedfile.call(dropzone, file);
                        dropzone.options.thumbnail.call(dropzone, file, value.path);
                        dropzone.emit("complete", file);

                    });

                    $('.dz-image>img').css({
                        "width": "100%",
                        "height": "100%"
                    });

                }

            });

        }
    </script>
    <script>
        $(document).ready(function() {
            $('#brand-sp').on('change', function() {
                var brandId = $(this).val();
                // Clear the existing options in the "Model" dropdown
                $('#model-sp').empty();
                $('#model-sp').append('<option value="" selected></option>');

                if (brandId) {
                    // Make an AJAX request to fetch models based on the selected brand
                    $.ajax({
                        url: '/dashboard/get-models/' + brandId,
                        type: 'GET',
                        success: function(data) {
                            // Populate the "Model" dropdown with the fetched models
                            $.each(data, function(key, value) {
                                var selectedAttribute = value.id ==
                                    {{ $car['model_id'] }} ? 'selected' : '';

                                $('#model-sp').append('<option value="' + value.id +
                                    '" ' + selectedAttribute + '>' +
                                    value.name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#model-sp').on('change', function() {
                var modelId = $(this).val();

                // Clear the existing options in the "Category" dropdown
                $('#category-sp').empty();
                $('#category-sp').append('<option value="" selected></option>');

                if (modelId) {
                    // Make an AJAX request to fetch categories based on the selected model
                    $.ajax({
                        url: '/dashboard/get-categories/' + modelId,
                        type: 'GET',
                        success: function(data) {
                            // Populate the "Category" dropdown with the fetched categories
                            $.each(data, function(key, value) {
                                var selectedAttribute = value.id ==
                                    {{ $car['category_id'] }} ?
                                    'selected' : '';

                                $('#category-sp').append('<option value="' + value.id +
                                    '" ' + selectedAttribute + '>' +
                                    value.name + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
    <script src="{{ asset('dashboard-assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script>
        let carId = "{{ $car->id }}";
        let colorr = @json($color);
        let brands = @json($brands);
        let selectedModelId = "{{ $car['model_id'] }}";
        let isDuplicating = "{{ request()->segment(4) === 'duplicate' }}"
    </script>
    <script src="{{ asset('js/dashboard/forms/cars/dropzone.js') }}"></script>
    <script src="{{ asset('js/dashboard/forms/cars/edit.js') }}"></script>
    <script src="{{ asset('js/dashboard/components/wizard.js') }}"></script>
    <script>
        $(document).ready(() => {

            drivingModeSp.val(@json(json_decode($car->driving_mode))); // init driving mode with selected values
            drivingModeSp.trigger('change'); // draw selected elements

            brandsSp.trigger('change', selectedModelId); // trigger brand selectpicker

            // initializeColorsSp(); // draw colors containers with their images
            initTinyMc({
                editingInp: true
            });

            $('#is_new_used_radio_1,#is_new_used_radio_2').change(function() {

                if ($(this).val() == 1) {
                    $('#kilometers-container').attr("style", "display:none !important");
                    $('#kilometers_inp').val("");
                } else
                    $('#kilometers-container').css("display", "block");
            })

        });
    </script>
@endpush
