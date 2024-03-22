@extends('partials.dashboard.master')
@push('styles')
    <link href="{{ asset('dashboard-assets/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <style>
        .ranges {
            font-family: Cairo, serif !important;
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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('Orders') }}</h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Orders list') }}
                    </li>
                    <!-- end   :: Item -->
                </ul>
                <!-- end   :: Breadcrumb -->

            </div>

        </div>

    </div>
    <!-- end   :: Subheader -->

    <!-- begin :: Datatable card -->
    <div class="card mb-2">
        <!-- begin :: Card Body -->
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">

            <!-- begin :: Filter -->
            <div class="d-flex flex-stack flex-wrap mb-15">

                <!-- begin :: General Search -->
                <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">

                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <i class="fa fa-search fa-lg"></i>
                    </span>

                    <input type="text" class="form-control form-control-solid w-250px ps-15 border-gray-300 border-1"
                        id="general-search-inp" placeholder="{{ __('Search ...') }}">

                    <select class="form-select form-select-solid w-200px ms-4 border-gray-300 border-1 filter-datatable-inp"
                        data-filter-index="5" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}" data-control="select2"
                        data-placeholder="{{ __('Status') }}">
                        <option></option>
                        <option value="all" selected>{{ __('All') }}</option>
                        @foreach (settings()->getOrdersStatus() ?? [] as $status)
                            <option value="{{ $status['name_en'] }}">{{ $status['name_' . getLocale()] }}</option>
                        @endforeach
                    </select>

                </div>
                <!-- end   :: General Search -->

                <!-- begin :: Toolbar -->
                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">

                    <div class="w-200px">
                        <!--begin::Select2-->
                        <input
                            class="form-control form-control-solid border-gray-300 border-1 px-4 text-center filter-datatable-inp"
                            data-filter-index="6" placeholder="{{ __('Pick date range') }}" id="from_to_dp" />
                        <!--end::Select2-->
                    </div>



                </div>
                <!-- end   :: Toolbar -->



            </div>
            <!-- end   :: Filter -->

            <!-- begin :: Datatable -->
            <table data-ordering="false" id="kt_datatable" class="table text-center table-row-dashed fs-6 gy-5">

                <thead>
                    <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th>#</th>
                        <th>{{ __('name') }}</th>
                        <th>{{ __('phone') }}</th>
                        <th>{{ __('price') }}</th>
                        <th>{{ __('type') }}</th>
                        <th>{{ __('status') }}</th>
                        <th>{{ __('created date') }}</th>
                        <th>{{ __('opened by') }}</th>
                        <th>{{ __('opened at') }}</th>
                        {{-- <th>{{ __('assign to') }}</th> --}}
                        <th class="min-w-100px">{{ __('actions') }}</th>

                    </tr>
                </thead>

                <tbody class="text-gray-600 fw-bold text-center">

                </tbody>

            </table>
            <!-- end   :: Datatable -->


        </div>
        <!-- end   :: Card Body -->
    </div>
    <!-- end   :: Datatable card -->
@endsection
@push('scripts')
    <script src="{{ asset('js/dashboard/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/dashboard/datatables/orders.js') }}"></script>
    <script>
        let fromToDp = $("#from_to_dp");
        let start = moment().subtract(29, "days");
        let end = moment();

        function cb(start, end) {
            fromToDp.html(start.format("yyyy-mm-d") + "  -  " + end.format("yyyy-mm-d"));
        }


        fromToDp.daterangepicker({
            startDate: start,
            endDate: end,
            locale: {
                format: 'YYYY-MM-DD'
            },
            ranges: {
                '{{ __('All') }}': [moment().subtract(50, "years"), moment()],
                '{{ __('Today') }}': [moment(), moment()],
                '{{ __('Yesterday') }}': [moment().subtract(1, "days"), moment().subtract(1, "days")],
                '{{ __('Last 7 Days') }}': [moment().subtract(6, "days"), moment()],
                '{{ __('Last 30 Days') }}': [moment().subtract(29, "days"), moment()],
                '{{ __('This Month') }}': [moment().startOf("month"), moment().endOf("month")],
                '{{ __('Last Month') }}': [moment().subtract(1, "month").startOf("month"), moment().subtract(1,
                    "month").endOf("month")]
            }
        }, cb).val('');



        $('li[data-range-key="Custom Range"]').html(translate('Custom Range')) // translate 'Custom Range'
    </script>
@endpush
