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
                        href="{{ route('dashboard.vendors.index') }}"
                        class="text-muted text-hover-primary">{{ __('Vendors') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Vendor data') }}
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
            <form class="form">
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">{{ __('Vendor') . ' : ' . $vendor->name }}</h3>
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
                                <label class="text-center fw-bold mb-4">{{ __('Image') }}</label>
                                <x-dashboard.upload-image-inp name="image" :image="$vendor->image" directory="Vendors"
                                    placeholder="default.jpg" type="show"></x-dashboard.upload-image-inp>
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
                        <div class="col-md-4 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Name') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name_inp" name="name"
                                    value="{{ $vendor->name }}" placeholder="example" disabled />
                                <label for="name_inp">{{ __('Enter the name') }}</label>
                            </div>
                            <p class="invalid-feedback" id="name"></p>
                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Phone') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="phone_inp" name="phone"
                                    value="{{ $vendor->phone }}" placeholder="example" disabled />
                                <label for="phone_inp">{{ __('Enter the phone') }}</label>
                            </div>
                            <p class="invalid-feedback" id="phone"></p>
                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Another phone') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="another_phone_inp" name="another_phone"
                                    value="{{ $vendor->another_phone }}" placeholder="example" disabled />
                                <label for="another_phone_inp">{{ __('Enter another phone') }}</label>
                            </div>
                            <p class="invalid-feedback" id="another_phone"></p>
                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        {{--  <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __("Address") }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="address_inp" name="address" value="{{ $vendor->address }}" placeholder="example" disabled/>
                                <label for="address_inp">{{ __("Enter the address") }}</label>
                            </div>
                            <p class="invalid-feedback" id="address" ></p>
                        </div>  --}}
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Status') }}</label>
                            <select class="form-select" name="status" id="status-sp"
                                data-placeholder="{{ __('Choose the status') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}" disabled>
                                <option value=""></option>
                                @foreach (App\Enums\VendorStatus::values() as $key => $value)
                                    <option value="{{ $key }}" {{ $vendor->status == $key ? 'selected' : '' }}>
                                        {{ __(ucfirst($value)) }}</option>
                                @endforeach
                            </select>
                            <p class="invalid-feedback" id="status"></p>
                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Type') }}</label>
                            <select class="form-select" name="type" id="type-sp"
                                data-placeholder="{{ __('Choose the type') }}" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}"
                                disabled>
                                <option value=""></option>
                                <option value="individual" {{ $vendor->type == 'individual' ? 'selected' : '' }}>
                                    {{ __('Individual') }}</option>
                                <option value="exhibition" {{ $vendor->type == 'exhibition' ? 'selected' : '' }}>
                                    {{ __('Exhibition') }}</option>
                                <option value="agency" {{ $vendor->type == 'agency' ? 'selected' : '' }}>
                                    {{ __('Agency') }}</option>
                            </select>
                            <p class="invalid-feedback" id="type"></p>
                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('City') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" value="{{ $vendor->city->name }}"
                                    placeholder="example" disabled />
                                <label>{{ __('Enter the city') }}</label>
                            </div>
                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row" style="{{ $vendor->type == 'individual' ? 'display: none;' : '' }}"
                            id="commercial_container">
                            <label class="fs-5 fw-bold mb-2">{{ __('Commercial registration no') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="commercial_registration_no_inp"
                                    name="commercial_registration_no" placeholder="example"
                                    value=" {{ $vendor->commercial_registration_no }} " disabled />
                                <label
                                    for="commercial_registration_no_inp">{{ __('Enter the commercial registration no') }}</label>
                            </div>
                            <p class="invalid-feedback" id="commercial_registration_no"></p>
                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row" style="{{ $vendor->type != 'individual' ? 'display: none;' : '' }}"
                            id="identity_container">
                            <label class="fs-5 fw-bold mb-2">{{ __('Identity no') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="identity_no_inp" name="identity_no"
                                    value="{{ $vendor->identity_no }}" placeholder="example" disabled />
                                <label for="identity_no_inp">{{ __('Enter the identity no') }}</label>
                            </div>
                            <p class="invalid-feedback" id="identity_no"></p>
                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Google maps url') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="google_maps_url_inp"
                                    name="google_maps_url" value="{{ $vendor->google_maps_url }}" placeholder="example"
                                    disabled />
                                <label for="google_maps_url_inp">{{ __('Enter the google maps url') }}</label>
                            </div>
                            <p class="invalid-feedback" id="google_maps_url"></p>
                        </div>
                        <!-- end   :: Column -->
                        <div class="col-md-4 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Packages') }}</label>

                            <select class="form-select" name="package_id" data-placeholder="{{ __('Packages list') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}" disabled>
                                <option value=""></option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package['id'] }}"
                                        {{ $package['id'] == $vendor['package_id'] ? 'selected' : '' }}>
                                        {{ $package['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="invalid-feedback" id="package_id"></p>
                        </div>

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-8"
                        style="{{ $vendor->status != App\Enums\VendorStatus::rejected->value ? 'display: none;' : '' }}"
                        id="rejection_container">

                        <!-- begin :: Column -->
                        <div class="col-12 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Rejection reason') }}</label>
                            <div class="form-floating">
                                <textarea rows="5" class="form-control" id="rejection_reason_inp" name="rejection_reason"
                                    placeholder="example" disabled></textarea>
                                <label for="rejection_reason_inp">{{ __('Enter the rejection reason') }}</label>
                            </div>
                            <p class="invalid-feedback" id="rejection_reason"></p>
                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->



                </div>
                <!-- end   :: Inputs wrapper -->

                <!-- begin :: Form footer -->
                <div class="form-footer">

                    <!-- begin :: Submit btn -->
                    <a href="{{ route('dashboard.vendors.index') }}" class="btn btn-primary">
                        <span class="indicator-label">{{ __('Back') }}</span>
                    </a>
                    <!-- end   :: Submit btn -->

                </div>
                <!-- end   :: Form footer -->
            </form>
            <!-- end   :: Form -->
        </div>
        <!-- end   :: Card body -->
    </div>
@endsection
