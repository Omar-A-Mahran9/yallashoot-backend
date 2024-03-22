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
    @can('view_reports')
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Dashboard-->
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-xl-6">
                        <!--begin::Statistics Widget 3-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column p-0">
                                <div class="d-flex flex-stack flex-grow-1 card-p">
                                    <div class="d-flex flex-column me-2">
                                        <a href="#"
                                            class="text-dark text-hover-primary fw-bolder fs-3">{{ __('All Cars') }}</a>
                                    </div>
                                    <span class="symbol symbol-50px">
                                        <span
                                            class="symbol-label fs-5 fw-bolder bg-light-primary text-primary">{{ array_sum($carsMonthlyRate['data']) }}</span>
                                    </span>
                                </div>
                                <div class="card-rounded-bottom" id="cars_chart" data-kt-chart-color="primary"
                                    style="height: 150px"></div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Statistics Widget 3-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Statistics Widget 3-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column p-0">
                                <div class="d-flex flex-stack flex-grow-1 card-p">
                                    <div class="d-flex flex-column me-2">
                                        <a href="#"
                                            class="text-dark text-hover-primary fw-bolder fs-3">{{ __('All Orders') }}</a>
                                    </div>
                                    <span class="symbol symbol-50px">
                                        <span
                                            class="symbol-label fs-5 fw-bolder bg-light-primary text-primary">{{ array_sum($ordersMonthlyRate['data']) }}</span>
                                    </span>
                                </div>
                                <div class="card-rounded-bottom" id="orders_chart" data-kt-chart-color="primary"
                                    style="height: 150px"></div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Statistics Widget 3-->
                    </div>
                    {{-- <div class="col-xl-4">
                    <!--begin::Statistics Widget 3-->
                    <div class="card card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column p-0">
                            <div class="d-flex flex-stack flex-grow-1 card-p">
                                <div class="d-flex flex-column me-2">
                                    <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">{{ __("All Vendors") }}</a>
                                </div>
                                <span class="symbol symbol-50px">
                                    <span class="symbol-label fs-5 fw-bolder bg-light-primary text-primary">{{ array_sum($clientsMonthlyRate['data']) }}</span>
                                </span>
                            </div>
                            <div class="card-rounded-bottom" id="clients_chart" data-kt-chart-color="primary" style="height: 150px"></div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Statistics Widget 3-->
                </div> --}}
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row g-5 g-xl-8 mt-5">
                    <div class="col-xl-4">
                        <!--begin::Statistics Widget 3-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column p-0">
                                <a href="#"
                                    class="text-dark text-hover-primary text-center my-10 fw-bolder fs-4">{{ __('Orders Types') }}</a>
                                @if (count($ordersTypesPercentage) == 0)
                                    <p class="text-dark text-hover-primary text-center my-10 fw-boldest mt-20 fs-3">
                                        {{ __('There are no orders yet') }}</p>
                                @endif
                                <div id="orders_types_pie_chart" class="h-400px"></div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Statistics Widget 3-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin::Statistics Widget 3-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column p-0">
                                <a href="#"
                                    class="text-dark text-hover-primary text-center my-10 fw-bolder fs-4">{{ __('Number of orders per brand') }}</a>
                                @if (count($carOrdersBrandsPercentage) == 0)
                                    <p class="text-dark text-hover-primary text-center my-10 fw-boldest mt-20 fs-3">
                                        {{ __('There are no orders yet') }}</p>
                                @endif
                                <div id="orders_brands_pie_char" class="h-400px"></div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Statistics Widget 3-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin::Statistics Widget 3-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column p-0">
                                <a href="#"
                                    class="text-dark text-hover-primary text-center my-10 fw-bolder fs-4">{{ __('Percentages of the number of cars in each brand') }}</a>
                                @if (count($carBrandsPercentage) == 0)
                                    <p class="text-dark text-hover-primary text-center my-10 fw-boldest mt-20 fs-3">
                                        {{ __('There are no cars yet') }}</p>
                                @endif
                                <div id="cars_brands_pie_char" class="h-400px"></div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Statistics Widget 3-->
                    </div>
                </div>
                <!--end::Row-->
                <!--end::Dashboard-->
            </div>
            <!--end::Container-->
        </div>
    @endcan
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
    <script>
        let carsMonthlyRate = @json($carsMonthlyRate);
        let ordersMonthlyRate = @json($ordersMonthlyRate);
        let ordersTypesPercentage = @json($ordersTypesPercentage);
        let carBrandsPercentage = @json($carBrandsPercentage);
        let carOrdersBrandsPercentage = @json($carOrdersBrandsPercentage);
    </script>

    <script src="{{ asset('dashboard-assets') }}/js/widgets.bundle.js"></script>
    <script src="{{ asset('dashboard-assets') }}/js/custom/widgets.js"></script>

    <script src="{{ asset('dashboard-assets') }}/plugins/custom/flotcharts/flotcharts.bundle.js"></script>

    <script src="{{ asset('js/dashboard/statistics.js') }}"></script>
@endpush
