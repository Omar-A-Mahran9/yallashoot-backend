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
                        href="{{ route('dashboard.coache.index') }}"
                        class="text-muted text-hover-primary">{{ __('Games') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Add new game') }}
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
            <form action="{{ route('dashboard.games.update', $game->id) }}" class="form" method="post"
                id="submitted-form" data-redirection-url="{{ route('dashboard.games.index') }}">
                @csrf
                @method('PUT')
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">{{ __('Edit game') }}</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">


                    <div class="row mb-8">

                        <div class="col-md-4 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('team number one') }}</label>
                            <select class="form-select" data-control="select2" name="team_one_id" id="team_one_id-sp"
                                data-placeholder="{{ __('Choose the team number one') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option value="" selected></option>

                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}"
                                        {{ $game->team_one_id == $team->id ? 'selected' : '' }}>
                                        {{ $team->title }} </option>
                                @endforeach
                            </select>

                            <p class="invalid-feedback" id="team_one_id"></p>

                        </div>
                        <!-- end   :: Column -->
                        <div class="col-md-4 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('team number two') }}</label>
                            <select class="form-select" data-control="select2" name="team_two_id" id="team_two_id-sp"
                                data-placeholder="{{ __('Choose the team number two') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option value="" selected></option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}"
                                        {{ $game->team_two_id == $team->id ? 'selected' : '' }}>
                                        > {{ $team->title }} </option>
                                @endforeach
                            </select>

                            <p class="invalid-feedback" id="team_two_id"></p>

                        </div>
                        <!-- end   :: Column -->

                        <div class="col-md-4 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Country') }}</label>
                            <select class="form-select" data-control="select2" name="country_id" id="country_id-sp"
                                data-placeholder="{{ __('Choose the country') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option value="" selected></option>

                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ $game->country_id == $country->id ? 'selected' : '' }}>
                                        > {{ $country->title }} </option>
                                @endforeach
                            </select>

                            <p class="invalid-feedback" id="country_id"></p>

                        </div>
                        <!-- end   :: Column -->
                    </div>
                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- end   :: Column -->
                        <div class="col-md-4 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('playground') }}</label>
                            <select class="form-select" data-control="select2" name="playground_id" id="playground_id-sp"
                                data-placeholder="{{ __('Choose the playground') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option value="" selected></option>
                                @foreach ($playgrounds as $playground)
                                    <option value="{{ $playground->id }}"
                                        {{ $game->playground_id == $playground->id ? 'selected' : '' }}>
                                        > {{ $playground->title }} </option>
                                @endforeach
                            </select>

                            <p class="invalid-feedback" id="playground_id"></p>

                        </div>
                        <!-- end   :: Column -->
                        <div class="col-md-4 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('League') }}</label>
                            <select class="form-select" data-control="select2" name="league_id" id="league_id-sp"
                                data-placeholder="{{ __('Choose the league') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option value="" selected></option>
                                @foreach ($leagues as $league)
                                    <option value="{{ $league->id }}"
                                        {{ $game->league_id == $league->id ? 'selected' : '' }}>
                                        > {{ $league->title }} </option>
                                @endforeach
                            </select>

                            <p class="invalid-feedback" id="league_id"></p>

                        </div>
                        <!-- end   :: Column -->
                        <div class="col-md-4 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Channel') }}</label>
                            <select class="form-select" data-control="select2" name="channel_ids[]" multiple
                                id="channel_ids-sp" data-placeholder="{{ __('Choose the channel') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}" @if (in_array($channel->id, $selectedchannelssIds)) selected @endif>
                                        {{ $channel->title }} </option>
                                @endforeach
                            </select>

                            <p class="invalid-feedback" id="channel_ids"></p>

                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->
                    <div class="row mb-8">
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Game Date') }}</label>
                            <input type="date" class="form-control" id="start_date-en" name="start_date"
                                placeholder="{{ __('Enter Game Date') }}" value="{{ $game->start_date }}" />
                            <!-- Add any necessary validation feedback here -->
                            <p class="invalid-feedback" id="start_date"></p>

                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Game Start Time') }}</label>
                            <input type="time" class="form-control" id="start_time-en" name="start_time"
                                placeholder="{{ __('Enter start time') }}" value="{{ $game->start_time }}" />
                            <!-- Add any necessary validation feedback here -->
                            <p class="invalid-feedback" id="start_time"></p>

                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('Game End Time') }}</label>
                            <input type="time" class="form-control" id="end_time-en" name="end_time"
                                placeholder="{{ __('Enter end time') }}" value="{{ $game->end_time }}" />
                            <!-- Add any necessary validation feedback here -->
                            <p class="invalid-feedback" id="end_time"></p>

                        </div>

                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __('statue') }}</label>
                            <select class="form-select" data-control="select2" name="status" id="status-sp"
                                data-placeholder="{{ __('Choose the statue') }}"
                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option value="" selected></option>
                                @foreach ($statues as $statue)
                                    <option value="{{ $statue }}" {{ $game->status == $statue ? 'selected' : '' }}>
                                        {{ __($statue) }}
                                    </option>
                                @endforeach
                            </select>

                            <p class="invalid-feedback" id="status"></p>

                        </div>
                        <!-- end   :: Column -->
                    </div>
                    <!-- begin :: Row -->
                    <div class="row mb-10">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Description in arabic') }}</label>
                            <textarea class="form-control" rows="4" name="description_ar" id="meta_tag_description_ar_inp">{{ $game->description_ar }}</textarea>
                            <p class="text-danger invalid-feedback" id="description_ar"></p>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __('Description in english') }}</label>
                            <textarea class="form-control" rows="4" name="description_en" id="meta_tag_description_en_inp">{{ $game->description_en }}</textarea>
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
@push('scripts')
@endpush
