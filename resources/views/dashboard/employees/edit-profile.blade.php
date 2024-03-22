@extends('partials.dashboard.master')
@section('content')
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">

                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <h2 class="text-gray-900 fs-2 fw-bolder me-1">{{ auth()->user()->name }}</h2>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <span class="d-flex align-items-center text-gray-400 me-5 mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <!--end::Svg Icon-->
                                    @foreach (auth()->user()->roles as $role)
                                        @if ($loop->first)
                                            {{ $role->name }}
                                        @else
                                            {{ ',' . $role->name }}
                                        @endif
                                    @endforeach
                                </span>

                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
            <!--begin::Navs-->
            <ul class="nav nav-pills nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder"
                role="tablist">
                <!--begin::Nav item-->
                <li class="nav-item mt-2">
                    <a style="cursor: pointer" class="nav-link text-active-primary ms-0 me-10 py-5 active"
                        id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="true">{{ __('Change profile data') }}</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item mt-2">
                    <a style="cursor: pointer" class="nav-link text-active-primary ms-0 me-10 py-5" id="pills-password-tab"
                        data-bs-toggle="pill" data-bs-target="#pills-password" role="tab" aria-controls="pills-password"
                        aria-selected="false">{{ __('Change password') }}</a>
                </li>
                <!--end::Nav item-->
            </ul>
            <!--begin::Navs-->
        </div>
    </div>
    <!--end::Navbar-->
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Content-->
        <div class="tab-content" id="pills-tab-content">
            <!--begin::Form-->
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <form action="{{ route('dashboard.update-profile') }}" class="submitted-form" method="post"
                    data-redirection-url="{{ route('dashboard.index') }}"
                    data-success-message="{{ __('Profile has been updated successfully') }}">
                    @csrf
                    @method('PUT')
                    <!--begin::Card body-->
                    <div class="card-body  p-9">
                        <!--begin::Input group-->

                        <div class="row mb-6">
                            <label
                                class="col-lg-2 required fs-5 fw-bold mb-2 d-flex align-items-center">{{ __('Name') }}</label>

                            <div class="col-lg-10 form-floating">
                                <input type="text" class="form-control" id="name_inp" name="name"
                                    placeholder="example" value="{{ auth()->user()->name }}" />
                                <label style="margin-right:8px" for="name_inp">{{ __('Enter the name') }}</label>
                                <p class="invalid-feedback" id="name"></p>
                            </div>
                        </div>

                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label
                                class="col-lg-2 col-form-label required fw-bold fs-6 d-flex align-items-center">{{ __('Phone') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-10 form-floating">
                                <div class="input-group mb-5">
                                    <span class="input-group-text" id="basic-addon1">+966</span>
                                    <input type="text" class="form-control" id="phone_inp" name="phone"
                                        placeholder="example"
                                        value="{{ __(str_replace('966', ' ', auth()->user()->phone)) }}" />
                                </div>
                                <p class="invalid-feedback" id="phone"></p>
                            </div>


                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label
                                class="col-lg-2 col-form-label required fw-bold fs-6 d-flex align-items-center">{{ __('Email') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-10 form-floating">
                                <input type="text" class="form-control" id="email_inp" name="email"
                                    placeholder="example" value="{{ auth()->user()->email }}" />
                                <label style="margin-right:8px" for="email_inp">{{ __('Enter the email') }}</label>
                                <p class="invalid-feedback" id="email"></p>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        {{-- <a href="/dashboard" class="btn btn-light btn-active-light-primary me-2">{{ __('Back') }}</a> --}}
                        <button type="submit" class="btn btn-primary" id=submit-btn>
                            <span class="indicator-label">{{ __('Save') }}</span>

                            <!-- begin :: Indicator -->
                            <span class="indicator-progress">{{ __('Please wait ...') }}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                            <!-- end   :: Indicator -->
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
            <!--end::Form-->
            <!--begin::Form-->
            <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab">
                <form action="{{ route('dashboard.update-password') }}" class="submitted-form" method="post"
                    data-redirection-url="{{ route('dashboard.index') }}"
                    data-success-message="{{ __('Password has been updated successfully') }}">
                    @csrf
                    @method('PUT')
                    <!--begin::Card body-->
                    <div class="card-body  p-9">

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label
                                class="col-lg-2 required fs-5 fw-bold mb-2  d-flex align-items-center">{{ __('Password') }}</label>

                            <div class="col-lg-10">
                                <div class="d-flex align-items-center form-floating">
                                    <input type="password" class="form-control" id="password_field" name="password"
                                        placeholder="example" />
                                    <a onclick="showHidePass( 'password_field' , $(this) )" style="cursor: pointer">
                                        <span class="fa fa-fw fa-eye fa-md toggle-password"
                                            @if (isArabic()) style="margin-right:-30px" @else style="margin-left:-30px" @endif></span>
                                    </a>
                                    <label style="margin-right: 8px"
                                        for="password">{{ __('Enter the password') }}</label>
                                </div>
                                <p class="invalid-feedback" id="password"></p>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label
                                class="col-lg-2 col-form-label required fw-bold fs-6  d-flex align-items-center">{{ __('Password confirmation') }}</label>

                            <div class="col-lg-10">
                                <div class="d-flex align-items-center form-floating">
                                    <input type="password" class="form-control" id="password_confirmation_field"
                                        name="password_confirmation" placeholder="example" />
                                    <a onclick="showHidePass( 'password_confirmation_field' , $(this) )"
                                        style="cursor: pointer">
                                        <span class="fa fa-fw fa-eye fa-md toggle-password"
                                            @if (isArabic()) style="margin-right:-30px" @else style="margin-left:-30px" @endif></span>
                                    </a>
                                    <label style="margin-right:8px"
                                        for="password_confirmation">{{ __('Enter the password confirmation') }}</label>
                                </div>
                                <p class="invalid-feedback" id="password_confirmation"></p>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->

                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        {{-- <a href="/dashboard" class="btn btn-light btn-active-light-primary me-2">{{ __('Back') }}</a> --}}
                        <button type="submit" class="btn btn-primary" id=submit-btn>
                            <span class="indicator-label">{{ __('Save') }}</span>

                            <!-- begin :: Indicator -->
                            <span class="indicator-progress">{{ __('Please wait ...') }}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                            <!-- end   :: Indicator -->
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->
@endsection
