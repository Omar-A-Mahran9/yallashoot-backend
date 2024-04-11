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
                        href="{{ route('dashboard.player.index') }}"
                        class="text-muted text-hover-primary">{{ __('Players') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Edit an player') }}
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
            <form action="{{ route('dashboard.player.update', $player->id) }}" class="form" method="post"
                id="submitted-form" data-redirection-url="{{ route('dashboard.player.index') }}">
                @csrf
                @method('PUT')
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">{{ __('Edit an player') . ' : ' . $player->name }}</h3>
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
                                    <x-dashboard.upload-image-inp name="main_image" :image="$player['main_image']" directory="Players"
                                        placeholder="default.jpg" type="editable"></x-dashboard.upload-image-inp>
                                </div>
                                <p class="invalid-feedback" id="main_image"></p>
                                <!-- end   :: Upload image component -->
                            </div>


                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Name in arabic') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name_ar_inp" name="name_ar"
                                    placeholder="example" value="{{ $player->name_ar }}" />
                                <label for="name_ar_inp">{{ __('Enter the name') }}</label>
                            </div>
                            <p class="invalid-feedback" id="name_ar"></p>
                        </div>
                        <!-- begin :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Name in english') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name_en_inp" name="name_en"
                                    placeholder="example" value="{{ $player->name_en }}" />
                                <label for="name_en_inp">{{ __('Enter the name') }}</label>
                            </div>
                            <p class="invalid-feedback" id="name_en"></p>


                        </div>
                        <!-- begin :: Column -->
                        <!-- begin :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Country') }}</label>
                            <select class="form-select" data-control="select2" name="country_id" id="country_id-sp"
                                data-placeholder="{{ __('Choose the country') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ $country->id == $player->country_id ? 'selected' : '' }}> {{ $country->title }}
                                    </option>
                                @endforeach
                            </select>

                            <p class="invalid-feedback" id="country_id"></p>

                        </div>
                        <!-- end   :: Column -->
                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-8">
                        <div class="col-md-4 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Phone') }}</label>
                            <div class="input-group mb-5">
                                <input type="text" class="form-control" id="phone_inp" name="phone"
                                    value="{{ $player->phone }}" placeholder="{{ __('Enter the phone') }}" />
                            </div>
                            <p class="invalid-feedback" id="phone"></p>


                        </div>
                        <!-- end   :: Column -->
                        <div class="col-md-4 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Birth Date') }}</label>
                            <input type="date" class="form-control" id="birthdate" name="birth_date"
                                placeholder="{{ __('Enter your birth date') }}" value="{{ $player->birth_date }}" />
                            <!-- Add any necessary validation feedback here -->
                            <p class="invalid-feedback" id="birth_date"></p>

                        </div>
                        <!-- begin :: Column -->
                        <div class="col-md-4 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Email') }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="email_inp" name="email"
                                    placeholder="example" value="{{ $player->email }}" />
                                <label for="email_inp">{{ __('Enter the email') }}</label>
                            </div>
                            <p class="invalid-feedback" id="email"></p>


                        </div>
                        <!-- end   :: Column -->


                    </div>
                    <!-- end   :: Row -->
                    <!-- end   :: Row -->
                    <div class="row mb-10">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Teams') }}</label>
                            <select class="form-select" data-control="select2" name="team_id" id="team_id-sp"
                                data-placeholder="{{ __('Choose the team') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option value="" selected></option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}"
                                        {{ $team->id == $player->team_id ? 'selected' : '' }}>
                                        {{ $team->title }} </option>
                                @endforeach
                            </select>

                            <p class="invalid-feedback" id="team_id"></p>

                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('player no') }}</label>
                            <input type="number" class="form-control" id="player_no-sp" name="player_no"
                                placeholder="{{ __('Enter your player no') }}" value="{{ $player->player_no }}" />
                            <!-- Add any necessary validation feedback here -->
                            <p class="invalid-feedback" id="player_no"></p>



                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- begin :: Row -->
                    <!-- begin :: Row -->
                    <div class="row mb-10">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Description in arabic') }}</label>
                            <textarea class="form-control" rows="4" name="description_ar" id="meta_tag_description_ar_inp">{{ $player->description_ar }}</textarea>
                            <p class="text-danger invalid-feedback" id="description_ar"></p>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Description in english') }}</label>
                            <textarea class="form-control" rows="4" name="description_en" id="meta_tag_description_en_inp">{{ $player->description_en }}</textarea>
                            <p class="text-danger invalid-feedback" id="description_en"></p>

                        </div>
                        <!-- end   :: Column -->

                    </div>



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
