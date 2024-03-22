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
                        href="{{ route('dashboard.careers.index') }}"
                        class="text-muted text-hover-primary">{{ __('Careers') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Edit an career') }}
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
            <form action="{{ route('dashboard.careers.update', $career->id) }}" class="form" method="post"
                id="submitted-form" data-redirection-url="{{ route('dashboard.careers.index') }}">
                @csrf
                @method('PUT')
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <div class="card-title">
                        <h3 class="fw-bolder text-dark">{{ __('Edit career') . ' : ' . $career->title }}</h3>
                    </div>

                    <div class="card-title">
                        <div class="form-check form-switch form-check-custom form-check-solid mb-2">
                            <label class="fs-5 fw-bold mt-1 mx-2">{{ __('status') }}</label>
                            <input class="form-check-input mx-2" style="height: 28px;width:60px;" type="checkbox"
                                name="status" id="status-checkbox" @if ($career['status']) checked @endif />
                            <label class="form-check-label" for="status-checkbox"></label>
                        </div>

                    </div>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">


                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Job title in arabic') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="title_ar_inp" name="title_ar"
                                    value="{{ $career['title_ar'] }}" placeholder="example" />
                                <label for="title_ar_inp">{{ __('Enter the title in arabic') }}</label>
                            </div>
                            <p class="invalid-feedback" id="title_ar"></p>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Job title in english') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="title_en_inp" name="title_en"
                                    value="{{ $career['title_en'] }}" placeholder="example" />
                                <label for="title_en_inp">{{ __('Enter the title in english') }}</label>
                            </div>
                            <p class="invalid-feedback" id="title_en"></p>


                        </div>
                        <!-- end   :: Column -->
                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Work type') }}</label>
                            <select class="form-select" data-control="select2" name="work_type"
                                data-placeholder="{{ __('Choose the work type') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option></option>
                                <option value="full-time" {{ $career->work_type == 'full-time' ? 'selected' : '' }}>
                                    {{ __('Full-time') }} </option>
                                <option value="part-time" {{ $career->work_type == 'part-time' ? 'selected' : '' }}>
                                    {{ __('Part-time') }} </option>
                                <option value="remotely" {{ $career->work_type == 'remotely' ? 'selected' : '' }}>
                                    {{ __('Remotely') }} </option>
                            </select>
                            <p class="invalid-feedback" id="work_type"></p>

                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('City') }}</label>
                            <select class="form-select" data-control="select2" name="city_id"
                                data-placeholder="{{ __('Choose the city') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option></option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ $career['city_id'] == $city->id ? 'selected' : '' }}> {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="invalid-feedback" id="city_id"></p>

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
@endpush
