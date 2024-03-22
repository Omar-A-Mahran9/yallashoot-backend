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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><a
                        href="{{ route('dashboard.roles.index') }}"
                        class="text-muted text-hover-primary">{{ __('Roles') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Role data') }}
                    </li>
                    <!-- end   :: Item -->
                </ul>
                <!-- end   :: Breadcrumb -->

            </div>

        </div>

    </div>
    <!-- end   :: Subheader -->


    <!-- begin :: Layout -->
    <div class="d-flex flex-column flex-lg-row">

        <!-- begin :: Sidebar -->
        <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">

            <!-- begin :: Card -->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header mb-4">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2> {{ $role->name }}</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pb-2" style="height:500px !important;overflow-y: auto">
                    <!--begin::Permissions-->
                    <div class="d-flex flex-column text-gray-600">

                        @foreach ($role->abilities as $ability)
                            <div class="d-flex align-items-center py-3">
                                <span class="bullet bg-primary me-3"></span>
                                {{ __($ability->action) . ' ' . __(str_replace('_', ' ', $ability->category)) }}
                            </div>
                        @endforeach

                    </div>
                    <!--end::Permissions-->
                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer pt-4 text-center mt-1" style="border-top:solid 1px #D7D7D7">
                    <button type="button" class="btn btn-light btn-active-light-primary my-1 edit-role-btn"
                        data-role-id="{{ $role->id }}">

                        <span class="indicator-label">{{ __('Edit Role') }}</span>

                        <!-- begin :: Indicator -->
                        <span class="indicator-progress">{{ __('Please wait ...') }}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!-- end   :: Indicator -->

                    </button>
                </div>
                <!--end::Card footer-->

            </div>
            <!-- end   :: Card -->

            <!-- begin :: Modals -->


            <!-- begin :: Update role modal -->
            <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-750px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!-- begin :: Modal title -->
                            <h2 class="fw-bolder">{{ __('Edit Role') }}</h2>
                            <!-- end   :: Modal title -->
                            <!-- begin :: Close -->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                onclick="$('#kt_modal_update_role').modal('hide')" data-kt-roles-modal-action="close">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                            transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                            transform="rotate(45 7.41422 6)" fill="black"></rect>
                                    </svg>
                                </span>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 my-7">
                            <!--begin::Form-->
                            <form id="role_form_update" data-form-type="update"
                                class="form fv-plugins-bootstrap5 fv-plugins-framework" method="POST"
                                data-redirection-url="/dashboard/roles/{{ $role['id'] }}" data-trailing="_edit">
                                @csrf
                                @method('PUT')
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll"
                                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                    data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_modal_update_role_header"
                                    data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px"
                                    style="max-height: 637px;">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10 fv-plugins-icon-container">

                                        <!-- begin :: Row -->
                                        <div class="row mb-8">

                                            <!-- begin :: Column -->
                                            <div class="col-md-6 fv-row">

                                                <label class="fs-5 fw-bold mb-2">{{ __('Name in arabic') }}</label>
                                                <input type="text" class="form-control" id="name_ar_inp_edit"
                                                    name="name_ar" value="{{ $role['name_ar'] }}" />
                                                <p class="invalid-feedback" id="name_ar_edit"></p>


                                            </div>
                                            <!-- end   :: Column -->

                                            <!-- begin :: Column -->
                                            <div class="col-md-6 fv-row">

                                                <label class="fs-5 fw-bold mb-2">{{ __('Name in english') }}</label>
                                                <input type="text" class="form-control" id="name_en_inp_edit"
                                                    name="name_en" value="{{ $role['name_en'] }}" />
                                                <p class="invalid-feedback" id="name_en_edit"></p>


                                            </div>
                                            <!-- end   :: Column -->

                                        </div>
                                        <!-- end   :: Row -->

                                        <!--end::Input group-->
                                        <!--begin::Permissions-->
                                        <div class="fv-row">

                                            <div class="text-center m-auto" style="width:fit-content">
                                                <p class="bg-danger invalid-feedback text-white rounded p-2"
                                                    id="abilities_edit"></p>
                                            </div>

                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bolder form-label mb-2">{{ __('Role Permissions') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Table wrapper-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                    <!--begin::Table body-->
                                                    <tbody class="text-gray-600 fw-bold">

                                                        <!--begin::Table row-->
                                                        <tr>
                                                            <td class="text-gray-800">{{ __('Administrator Access') }}
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-bs-original-title="Allows a full access to the system"
                                                                    aria-label="Allows a full access to the system"></i>
                                                            </td>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="edit-select-all" data-form-type="update">
                                                                    <span class="form-check-label"
                                                                        for="edit-select-all">{{ __('Select all') }}</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                        </tr>
                                                        <!--end::Table row-->

                                                        @foreach ($modules as $module)
                                                            <tr>
                                                                <!--begin::Label-->
                                                                <td class="text-gray-800">
                                                                    {{ __(str_replace('_', ' ', ucwords($module))) }}
                                                                </td>
                                                                <!--end::Label-->
                                                                <!--begin::Input group-->
                                                                <td>
                                                                    <!--begin::Wrapper-->
                                                                    <div class="d-flex">
                                                                        @foreach ($abilities->where('category', $module) as $ability)
                                                                            <!--begin::Checkbox-->
                                                                            <label
                                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                                <input
                                                                                    class="form-check-input edit-checkbox"
                                                                                    type="checkbox"
                                                                                    id="edit_{{ $ability->name }}"
                                                                                    data-id="{{ $ability->id }}"
                                                                                    name="abilities[]">
                                                                                <label class="custom-control-label mx-4"
                                                                                    for="edit_{{ $ability->name }}">{{ __($ability->action) }}</label>
                                                                            </label>
                                                                            <!--end::Checkbox-->
                                                                        @endforeach
                                                                    </div>
                                                                    <!--end::Wrapper-->
                                                                </td>
                                                                <!--end::Input group-->
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table wrapper-->
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>

                                <!--begin::Actions-->
                                <div class="text-center pt-4 mt-1">
                                    <button type="submit" class="btn btn-primary" id="submit-btn"
                                        data-kt-roles-modal-action="submit">
                                        <span class="indicator-label">{{ __('Save') }}</span>
                                        <span class="indicator-progress">{{ __('Please wait ...') }}
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->

                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!-- end   :: Update role modal-->

            <!-- end   :: Modals -->
        </div>
        <!-- end   :: Sidebar -->

        <!-- begin :: Content -->
        <div class="flex-lg-row-fluid ms-lg-10">
            <!--begin::Card-->
            <div class="card card-flush mb-6 mb-xl-9">

                <!--begin::Card body-->
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">

                    <!-- begin :: Filter -->
                    <div class="d-flex flex-stack flex-wrap mb-15">

                        <!-- begin :: Header -->
                        <div>
                            <h2 class="d-flex align-items-center">{{ __('Employees Assigned') }}
                                <span class="text-gray-600 fs-6 ms-1">( {{ $role->employees->count() }} )</span>
                            </h2>
                        </div>
                        <!-- end   :: Header -->


                        <!-- begin :: General Search -->
                        <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0 d-none">

                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <i class="fa fa-search fa-lg"></i>
                            </span>

                            <input type="text"
                                class="form-control form-control-solid w-250px ps-15 border-gray-300 border-1"
                                id="general-search-inp" placeholder="{{ __('Search ...') }}">

                        </div>
                        <!-- end   :: General Search -->

                    </div>
                    <!-- end   :: Filter -->

                    <!-- begin :: Datatable -->
                    <table id="kt_datatable" class="table text-center table-row-dashed fs-6 gy-5">

                        <thead>
                            <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th>#</th>
                                <th>{{ __('employee') }}</th>
                                <th>{{ __('date') }}</th>
                                <th class="min-w-100px">{{ __('actions') }}</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-600 fw-bold text-center">

                        </tbody>
                    </table>
                    <!-- end   :: Datatable -->


                </div>
                <!--end::Card body-->

            </div>
            <!--end::Card-->
        </div>
        <!-- end   :: Content -->
    </div>
    <!-- end   :: Layout -->
@endsection
@push('scripts')
    <script>
        let roleId = "{{ $role['id'] }}"
    </script>
    <script src="{{ asset('js/dashboard/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/dashboard/datatables/role_employees.js') }}"></script>
    <script src="{{ asset('js/dashboard/forms/roles/common.js') }}"></script>
    <script>
        let currentUserId = {{ auth()->id() }};
    </script>
@endpush
