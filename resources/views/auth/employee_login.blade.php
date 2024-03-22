<!DOCTYPE html>
<html lang="{{ getLocale() }}" direction="{{ isArabic() ? 'rtl' : 'ltr' }}"
    style="direction:{{ getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>{{ __('CodeCar - Dashboard') }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />

    <!--begin::Fonts-->
    @if (isArabic())
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;900&display=swap"
            rel="stylesheet">
    @endif
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('dashboard-assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard-assets/css/style' . '.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <style>

    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a onclick="window.location.reload()" class="mb-12">
                    <img alt="Logo" src="{{ asset('dashboard-assets/media/logos/logo-1-dark.svg') }}"
                        class="h-90px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" data-success-message="{{ __('Signed in successfully') }}"
                        data-redirection-url="{{ str_contains('/dashboard', URL::previous()) ? URL::previous() : '/dashboard' }}"
                        id="submitted-form" action="{{ route('employee.login') }}" method="POST">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">{{ __('Sign In to CodeCar') }}</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                                autocomplete="off" />
                            <p class="invalid-feedback" id="email"></p>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Input-->
                            <div class="d-flex align-items-center">
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    name="password" autocomplete="off" id="password-field" />
                                <a onclick="showHidePass( 'password-field' , $(this) )" style="cursor: pointer">
                                    <span class="fa fa-fw fa-eye fa-md toggle-password"
                                        @if (isArabic()) style="margin-right:-30px" @else style="margin-left:-30px" @endif></span>
                                </a>
                            </div>
                            <p class="invalid-feedback" id="password"></p>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->

                            <button type="submit" id="submit-btn" class="btn btn-lg btn-primary w-100 mb-5"
                                data-kt-indicator="">
                                <span class="indicator-label">
                                    {{ __('Sign In') }}
                                </span>

                                <span class="indicator-progress">
                                    {{ __('Please wait ...') }} <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>

                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-column-auto p-10">
                <!--begin::Links-->
                <div class="d-flex align-items-center fw-bold fs-6">
                    <a href="https://webstdy.com/{{ getLocale() }}" target="_blank"
                        class="text-muted text-hover-primary px-2">
                        {{ __('Developed By') }} <img class="mx-4" src="https://webstdy.com/CDN/cr_dark.png">
                    </a>

                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--end::Main-->

    <!--begin::Javascript-->
    <script src="{{ asset('dashboard-assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('js/dashboard/translations.js') }}"></script>
    <script src="{{ asset('js/dashboard/global_scripts.js') }}"></script>
    <!--end::Javascript-->

</body>
<!--end::Body-->

</html>
