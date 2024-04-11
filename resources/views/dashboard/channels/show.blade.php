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
                        href="{{ route('dashboard.team.index') }}"
                        class="text-muted text-hover-primary">{{ __('Channels') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Add new Channel') }}
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
            <form action="{{ route('dashboard.channel.update', $channel->id) }}" class="form" method="post"
                id="submitted-form" data-redirection-url="{{ route('dashboard.channel.index') }}">
                @csrf
                @method('PUT')

                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">{{ __('Add new Channel') }}</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">
                    <!-- begin :: Row -->
                    <div class="row mb-10">

                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row d-flex justify-content-evenly">

                            <div class="d-flex flex-column align-items-center">
                                <!-- begin :: Upload image component -->
                                <label class="text-center fw-bold mb-4">{{ __('Image') }}</label>
                                <div>
                                    <x-dashboard.upload-image-inp name="main_image" :image="$channel['main_image']" directory="Channels"
                                        placeholder="default.jpg" type="editable"></x-dashboard.upload-image-inp>
                                </div>
                                <p class="invalid-feedback" id="main_image"></p>
                                <!-- end   :: Upload image component -->
                            </div>


                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Title in arabic') }}</label>
                            <div class="form-floating">
                                <input readonly type="text" class="form-control" id="title_ar_inp" name="title_ar"
                                    placeholder="example" value="{{ $channel->title_ar }}" />
                                <label for="title_ar_inp">{{ __('Enter the Channel title in arabic') }}</label>
                            </div>
                            <p class="invalid-feedback" id="title_ar"></p>
                        </div>
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Title in english') }}</label>
                            <div class="form-floating">
                                <input readonly type="text" class="form-control" id="title_en_inp" name="title_en"
                                    placeholder="example" value="{{ $channel->title_en }}" />
                                <label for="title_en_inp">{{ __('Enter the Channel title in english') }}</label>
                            </div>
                            <p class="invalid-feedback" id="title_en"></p>


                        </div>

                    </div>
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Commenter's name in arabic") }}</label>
                            <div class="form-floating">
                                <input readonly type="text" class="form-control" id="commenter_name_ar_inp"
                                    name="commenter_name_ar" placeholder="example"
                                    value="{{ $channel->commenter_name_ar }}" />
                                <label for="commenter_name_ar_inp">{{ __("Enter the Commenter's name in arabic") }}</label>
                            </div>
                            <p class="invalid-feedback" id="commenter_name_ar"></p>
                        </div>
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("Commenter's name in english") }}</label>
                            <div class="form-floating">
                                <input readonly type="text" class="form-control" id="commenter_name_en_inp"
                                    name="commenter_name_en" placeholder="example"
                                    value="{{ $channel->commenter_name_en }}" />
                                <label
                                    for="commenter_name_en_inp">{{ __("Enter the Commenter's name in english") }}</label>
                            </div>
                            <p class="invalid-feedback" id="commenter_name_en"></p>


                        </div>

                    </div>

                    <!-- begin :: Row -->
                    <div class="row mb-10">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Description in arabic') }}</label>
                            <textarea disabled class="form-control" rows="4" name="description_ar" id="meta_tag_description_ar_inp">{{ $channel->description_ar }}</textarea>
                            <p class="text-danger invalid-feedback" id="description_ar"></p>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Description in english') }}</label>
                            <textarea disabled class="form-control" rows="4" name="description_en" id="meta_tag_description_en_inp">{{ $channel->description_ar }}</textarea>
                            <p class="text-danger invalid-feedback" id="description_en"></p>

                        </div>
                        <!-- end   :: Column -->



                    </div>
                    <!-- Begin :: Input group -->
                    <div class="fv-row row mb-15">

                        <!-- Begin :: Col -->
                        <div class="col-md-12">

                            <label class="form-label">{{ __('Satellite and terrestrial frequencies') }}</label>
                            <br>



                            <!--begin::Repeater-->
                            <div id="form_repeater">
                                <!--begin::Form group-->
                                <input readonly type="text" hidden name='deletedsatellites[]'
                                    id='deletedSatelliteInput'>
                                <div class="form-group">
                                    <div data-repeater-list="satellites">
                                        @foreach ($satellites ?? [] as $satellite)
                                            {{ $loop->index }}
                                            <div data-repeater-item>
                                                <div class="form-group row mt-5">
                                                    <input readonly type="text" name="id"
                                                        value="{{ $satellite['id'] }}" hidden>
                                                    <div class="col-md-2">
                                                        <label class="form-label">{{ __('Name') }}</label>
                                                        <input readonly type="text" class="form-control mb-2 mb-md-0"
                                                            name="name" value="{{ $satellite['name'] }}"
                                                            placeholder="{{ __('Enter name') }}" />
                                                        <p class="invalid-feedback"
                                                            id="satellites_{{ $loop->index }}_name"></p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">{{ __('Frequency') }}</label>
                                                        <input readonly type="text" class="form-control mb-2 mb-md-0"
                                                            name="frequency" value="{{ $satellite['frequency'] }}"
                                                            placeholder="{{ __('Enter frequency') }}" />
                                                        <p class="invalid-feedback"
                                                            id="satellites_{{ $loop->index }}_frequency"></p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">{{ __('Polarization') }}</label>
                                                        <input readonly type="text" class="form-control mb-2 mb-md-0"
                                                            name="polarization" value="{{ $satellite['polarization'] }}"
                                                            placeholder="{{ __('Enter polarization') }}" />
                                                        <p class="invalid-feedback"
                                                            id="satellites_{{ $loop->index }}_polarization"></p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">{{ __('Modulation') }}</label>
                                                        <input readonly type="text" class="form-control mb-2 mb-md-0"
                                                            name="modulation" value="{{ $satellite['modulation'] }}"
                                                            placeholder="{{ __('Enter modulation') }}" />
                                                        <p class="invalid-feedback"
                                                            id="satellites_{{ $loop->index }}_modulation"></p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">{{ __('Correction') }}</label>
                                                        <input readonly type="text" class="form-control mb-2 mb-md-0"
                                                            name="correction" value="{{ $satellite['correction'] }}"
                                                            placeholder="{{ __('Enter correction') }}" />
                                                        <p class="invalid-feedback"
                                                            id="satellites_{{ $loop->index }}_correction"></p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">{{ __('Encryption') }}</label>
                                                        <input readonly type="text" class="form-control mb-2 mb-md-0"
                                                            name="encryption" value="{{ $satellite['encryption'] }}"
                                                            placeholder="{{ __('Enter encryption') }}" />
                                                        <p class="invalid-feedback"
                                                            id="satellites_{{ $loop->index }}_encryption"></p>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>



                            </div>
                            <!--end::Repeater-->



                        </div>
                        <!-- End   :: Col -->

                    </div>
                    <!-- End   :: Input group -->



                </div>
                <!-- end   :: Inputs wrapper -->

                <!-- begin :: Form footer -->
                <div class="form-footer">

                    <!-- begin :: Submit btn -->
                    <a href="{{ route('dashboard.channel.index') }}" class="btn btn-primary">
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
@push('scripts')
    {{-- <script>
        document.querySelector('#addRepeaterItem').addEventListener('click', function() {
            let index = document.querySelectorAll('[data-repeater-item]').length;
            console.log("Index of the new repeater item:", index);
        });
    </script> --}}

    <script>
        let deletedIds = [];

        function deleteSatellite(itemId) {
            // Add the deleted ID to the array
            deletedIds.push(itemId);

            const deletedSatelliteInput = document.getElementById('deletedSatelliteInput');

            const deletedIdsString = deletedIds.join(',');

            deletedSatelliteInput.value = deletedIdsString;

        }
    </script>

    <script src="{{ asset('dashboard-assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('js/dashboard/components/form_repeater.js') }}"></script>
@endpush
