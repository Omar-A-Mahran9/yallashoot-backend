@extends('partials.dashboard.master')
@section('content')
    <!-- begin :: Subheader -->
    <div class="toolbar">
        <!--begin::Container-->
        <div class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('Dashboard') }}

                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                <!--end::Separator-->

                <!--begin::Description-->
                <small class="text-muted fs-7 fw-bold my-1 ms-1"></small>
                <!--end::Description-->

            </h1>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">

                <!--begin::Primary button-->
                <a href="https://codecar.webstdy.com/" target="_blank" class="btn btn-sm btn-primary"><i
                        class="bi bi-globe fs-6"></i> {{ __('website') }} </a>
                <!--end::Primary button-->

                <!--begin::Primary button-->
                {{-- <a href="https://www.tawk.to/" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-comments fs-6"></i> {{ __("Chat") }} </a> --}}
                <!--end::Primary button-->

                <!--begin::Primary button-->
                {{-- <a href="https://analytics.google.com/analytics/web/" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-chart-bar fs-6"></i> {{ __("Google Analytics") }} </a> --}}
                <!--end::Primary button-->
                {{--
                @can('view_slider_dashboard')
                    <!--begin::Primary button-->
                    <a href="https://slider.rotanacarshowroom.com?username={{ settings()->getSettings('slider_dashboard_username') }}&password={{ settings()->getSettings('slider_dashboard_password') }}" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-images fs-6"></i> {{ __("Slider dashboard") }} </a>
                    <!--end::Primary button-->
                @endcan --}}

            </div>
            <!--end::Actions-->

        </div>
        <!--end::Container-->
    </div>
    <!-- end   :: Subheader -->

    <!--begin::Entry-->

    <!--end::Entry-->

    <audio controls id="notification-sound" style="display: none">
        <source class="sound-source" src="{{ asset('dashboard-assets/sounds/new-notification.mp3') }}" type="audio/ogg">
        <source class="sound-source" src="{{ asset('dashboard-assets/sounds/new-notification.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <audio controls id="success-sound" style="display: none">
        <source class="sound-source" src="{{ asset('dashboard-assets/sounds/success.mp3') }}" type="audio/ogg">
        <source class="sound-source" src="{{ asset('dashboard-assets/sounds/success.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <audio controls id="error-sound" style="display: none">
        <source class="sound-source" src="{{ asset('dashboard-assets/sounds/error.mp3') }}" type="audio/ogg">
        <source class="sound-source" src="{{ asset('dashboard-assets/sounds/error.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
@endsection
@push('scripts')
    <script src="{{ asset('dashboard-assets') }}/js/widgets.bundle.js"></script>
    <script src="{{ asset('dashboard-assets') }}/js/custom/widgets.js"></script>

    <script src="{{ asset('dashboard-assets') }}/plugins/custom/flotcharts/flotcharts.bundle.js"></script>

    <script src="{{ asset('js/dashboard/statistics.js') }}"></script>
@endpush
