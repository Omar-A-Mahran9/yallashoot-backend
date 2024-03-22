@extends('partials.dashboard.master')
@push('styles')
    <link href="{{ asset('dashboard-assets/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!-- begin :: Subheader -->
    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('Careers') }}</h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Careers list') }}
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

                    <input
                        class="form-control form-control-solid ms-4 datepicker border-gray-300 border-1 filter-datatable-inp me-4"
                        readonly placeholder="{{ __('Choose the date') }}" data-filter-index="6" />

                    <select class="form-select form-select-solid border-gray-300 border-1 filter-datatable-inp"
                        data-filter-index="5" data-control="select2" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}"
                        data-placeholder="{{ __('Choose the status') }}">
                        <option value=""></option>
                        <option value="all" selected>{{ __('All') }}</option>
                        <option value="1">{{ __('available') }}</option>
                        <option value="0">{{ __('unavailable') }}</option>
                    </select>

                    <select class="form-select form-select-solid border-gray-300 border-1 filter-datatable-inp ms-4"
                        data-filter-index="3" data-control="select2" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}"
                        data-placeholder="{{ __('Choose the city') }}">
                        <option value=""></option>
                        <option value="all" selected>{{ __('All') }}</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- end   :: General Search -->

                <!-- begin :: Toolbar -->
                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">

                    <!-- begin :: Add Button -->
                    <a href="{{ route('dashboard.careers.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                        title="">

                        <span class="svg-icon svg-icon-2">
                            <i class="fa fa-plus fa-lg"></i>
                        </span>

                        {{ __('Add new career') }}

                    </a>
                    <!-- end   :: Add Button -->

                </div>
                <!-- end   :: Toolbar -->

                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                    <div class="fw-bolder me-5">
                        <span class="me-2" data-kt-docs-table-select="selected_count"></span>Selected
                    </div>
                    <button type="button" class="btn btn-danger" data-kt-docs-table-select="delete_selected">Selection
                        Action</button>
                </div>
                <!--end::Group actions-->

            </div>
            <!-- end   :: Filter -->

            <!-- begin :: Datatable -->
            <table data-ordering="false" id="kt_datatable" class="table text-center table-row-dashed fs-6 gy-5">

                <thead>
                    <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th>#</th>
                        <th>{{ __('Job title in arabic') }}</th>
                        <th>{{ __('Job title in english') }}</th>
                        <!-- <th>{{ __('short description') }}</th> -->
                        <th>{{ __('city') }}</th>
                        <!-- <th>{{ __('address') }}</th> -->
                        <th>{{ __('status') }}</th>
                        <th>{{ __('created date') }}</th>
                        <th>{{ __('applicants') }}</th>
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
    <script src="{{ asset('js/dashboard/datatables/careers.js') }}"></script>
@endpush
