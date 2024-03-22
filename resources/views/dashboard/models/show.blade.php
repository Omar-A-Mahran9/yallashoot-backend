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
                        href="{{ route('dashboard.brands.index') }}"
                        class="text-muted text-hover-primary">{{ __('Models') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('model data') }}
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

            <!-- begin :: Card header -->
            <div class="card-header d-flex align-items-center">
                <h3 class="fw-bolder text-dark">{{ __('model data') . ' : ' . $model->name }}</h3>
            </div>
            <!-- end   :: Card header -->

            <!-- begin :: Inputs wrapper -->
            <div class="inputs-wrapper">

                <!-- begin :: Row -->
                <div class="row mb-10">

                    <!-- begin :: Column -->
                    <div class="col-md-{{ request('type') === 'sub' ? '6' : '12' }} fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __('Brand') }}</label>
                        <input type="text" class="form-control" id="name_ar_inp" name="name_ar"
                            value="{{ $model->brand->name }}" readonly />

                    </div>
                    <!-- end   :: Column -->

                    @if (request('type') === 'sub')
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Main model') }}</label>
                            <input type="text" class="form-control" id="name_ar_inp" name="name_ar"
                                value="{{ $model->parentModel->name }}" readonly />

                        </div>
                        <!-- end   :: Column -->
                    @endif
                </div>
                <!-- end   :: Row -->

                <!-- begin :: Row -->
                <div class="row mb-10">

                    <!-- begin :: Column -->
                    <div class="col-md-6 fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __('Name in arabic') }}</label>
                        <input type="text" class="form-control" id="name_ar_inp" name="name_ar"
                            value="{{ $model->name_ar }}" readonly />

                    </div>
                    <!-- end   :: Column -->

                    <!-- begin :: Column -->
                    <div class="col-md-6 fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __('Name in english') }}</label>
                        <input type="text" class="form-control" id="name_en_inp" name="name_en"
                            value="{{ $model->name_en }}" readonly />


                    </div>
                    <!-- end   :: Column -->

                </div>
                <!-- end   :: Row -->

                <!-- begin :: Row -->
                <div class="row mb-10">

                    <!-- begin :: Column -->
                    <div class="col-md-6 fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __('Meta tag keywords in arabic') }}</label>
                        <input type="text" class="form-control" id="meta_keyword_ar_inp" name="meta_keyword_ar"
                            value="{{ $model->meta_keyword_ar }}" readonly />

                    </div>
                    <!-- end   :: Column -->

                    <!-- begin :: Column -->
                    <div class="col-md-6 fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __('Meta tag keywords in english') }}</label>
                        <input type="text" class="form-control" id="meta_keyword_en_inp" name="meta_keyword_en"
                            value="{{ $model->meta_keyword_en }}" readonly />


                    </div>
                    <!-- end   :: Column -->

                </div>
                <!-- end   :: Row -->

                <!-- begin :: Row -->
                <div class="row mb-10">

                    <!-- begin :: Column -->
                    <div class="col-md-6 fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __('Meta description in arabic') }}</label>
                        <input type="text" class="form-control" id="meta_desc_ar_inp" name="meta_desc_ar"
                            value="{{ $model->meta_desc_ar }}" readonly />

                    </div>
                    <!-- end   :: Column -->

                    <!-- begin :: Column -->
                    <div class="col-md-6 fv-row">

                        <label class="fs-5 fw-bold mb-2">{{ __('Meta description in english') }}</label>
                        <input type="text" class="form-control" id="meta_desc_en_inp" name="meta_desc_en"
                            value="{{ $model->meta_desc_en }}" readonly />

                    </div>
                    <!-- end   :: Column -->

                </div>
                <!-- end   :: Row -->


            </div>
            <!-- end   :: Inputs wrapper -->

            <!-- begin :: Form footer -->
            <div class="form-footer">

                <!-- begin :: Submit btn -->
                <a href="{{ route('dashboard.models.index', ['type' => request('type')]) }}" class="btn btn-primary">

                    <span class="indicator-label">{{ __('Back') }}</span>

                </a>
                <!-- end   :: Submit btn -->

            </div>
            <!-- end   :: Form footer -->
            <!-- end   :: Form -->
        </div>
        <!-- end   :: Card body -->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/dashboard/forms/car_models/common.js') }}"></script>
    <script>
        $(document).ready(() => {
            brandsSp.trigger('change', "{{ $model->parent_model_id }}");
        });
    </script>
@endpush
