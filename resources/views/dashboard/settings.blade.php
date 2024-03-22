@extends('partials.dashboard.master')
@section('content')
    <!--begin::Card-->
    <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10 mt-0"
        style="background-size: auto  calc(100% + 10rem); background-position: {{ isArabic() ? 'left' : 'right' }} ; background-image: url('{{ asset('dashboard-assets/media/illustrations/sketchy-1/4.png') }}')">
        <!--begin::Card header-->
        <div class="p-6">
            <div class="d-flex align-items-center">
                <!--begin::Icon-->
                <div class="symbol symbol-circle me-5">
                    <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs020.svg-->
                        <span>
                            <i class="bi bi-gear-fill fs-1 text-primary"></i>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <!--end::Icon-->
                <!--begin::Title-->
                <div class="d-flex flex-column">
                    <h2>{{ __('settings') }}</h2>
                </div>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pb-0">

            <!--begin::Navs-->
            <div class="d-flex overflow-auto h-55px">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold flex-nowrap">

                    <!--begin::Nav item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6  setting-label active" id="general-settings-label"
                            href="javascript:" onclick="changeSettingView('general')">{{ __('General') }}</a>
                    </li>
                    <!--end::Nav item-->

                    <!--begin::Nav item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 setting-label" id="seo-settings-label"
                            href="javascript:" onclick="changeSettingView('seo')">{{ __('Seo') }}</a>
                    </li>
                    <!--end::Nav item-->

                    <!--begin::Nav item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 setting-label" id="website-settings-label"
                            href="javascript:" onclick="changeSettingView('website')">{{ __('Website') }}</a>
                    </li>
                    <!--end::Nav item-->

                    <!--begin::Nav item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 setting-label" id="about-website-settings-label"
                            href="javascript:" onclick="changeSettingView('about-website')">{{ __('About us') }}</a>
                    </li>
                    <!--end::Nav item-->

                </ul>
            </div>
            <!--begin::Navs-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

    <!--begin::Form-->
    <form action="{{ route('dashboard.settings.store') }}" class="form" method="post" id="submitted-form"
        data-redirection-url="{{ route('dashboard.settings.index') }}">
        @csrf

        <!-- Begin :: General Settings Card -->
        <input type="hidden" name="setting_type" value="general" id="setting-type-inp">

        <!-- Begin :: General Settings Card -->
        <div class="card card-flush setting-card" id="general-settings-card">
            <!--begin::Card header-->
            <div class="card-header pt-8">

                <div class="card-title">
                    <h2>{{ __('General') }}</h2>
                </div>

                <div class="card-title">

                    <!-- begin :: Submit btn -->
                    <button type="submit" class="btn btn-primary mx-4" id="submit-btn-general">

                        <span class="indicator-label">{{ __('Save') }}</span>

                        <!-- begin :: Indicator -->
                        <span class="indicator-progress">{{ __('Please wait ...') }}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!-- end   :: Indicator -->

                    </button>
                    <!-- end   :: Submit btn -->

                </div>
            </div>
            <!--end::Card header-->

            <!-- Begin :: Card body -->
            <div class="card-body">
                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-4">

                        <label class="form-label">{{ __('Website name in arabic') }}</label>
                        <input type="text" class="form-control" name="website_name_ar"
                            value="{{ settings()->getSettings('website_name_ar') ?? '' }}" id="website_name_ar_inp"
                            placeholder="{{ __('Enter the website name in arabic') }}">
                        <p class="invalid-feedback" id="website_name_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-4">

                        <label class="form-label">{{ __('Website name in english') }}</label>
                        <input type="text" class="form-control" name="website_name_en"
                            value="{{ settings()->getSettings('website_name_en') ?? '' }}" id="website_name_en_inp"
                            placeholder="{{ __('Enter the website name in english') }}">
                        <p class="invalid-feedback" id="website_name_en"></p>

                    </div>
                    <!-- End   :: Col -->


                    <!-- End   :: Col -->
                    <div class="col-md-4 fv-row">
                        <label class="fs-5 fw-bold mb-2">{{ __('Phone') }}</label>
                        <div class="input-group mb-5">
                            <input type="text" class="form-control" value="{{ settings()->getSettings('phone') }}"
                                id="phone_inp" name="phone" placeholder="{{ __('Enter the phone') }}" />
                            <p class="invalid-feedback" id="phone"></p>
                        </div>
                    </div>

                </div>
                <!-- End   :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-12
                    ">
                        <label class="form-label">{{ __('video aboutus (Youtube)') }}</label>
                        <input type="text" class="form-control" name="about_us_video"
                            value="{{ $fullYoutubeUrl ?? '' }}" id="about_us_video_inp"
                            placeholder="{{ __('Enter the about us video url') }}">
                        <p class="invalid-feedback" id="about_us_video"></p>

                    </div>
                    <!-- End   :: Col -->
                </div>
                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-4">

                        <label class="form-label">{{ __('Facebook') }}</label>
                        <input type="text" class="form-control" name="facebook_url"
                            value="{{ settings()->getSettings('facebook_url') ?? '' }}" id="facebook_url_inp"
                            placeholder="{{ __('Enter the facebook page url') }}">
                        <p class="invalid-feedback" id="facebook_url"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-4">

                        <label class="form-label">{{ __('Twitter') }}</label>
                        <input type="text" class="form-control" name="twitter_url"
                            value="{{ settings()->getSettings('twitter_url') ?? '' }}" id="twitter_url_inp"
                            placeholder="{{ __('Enter the twitter page url') }}">
                        <p class="invalid-feedback" id="twitter_url"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-4">

                        <label class="form-label">{{ __('Snapchat') }}</label>
                        <input type="text" class="form-control" name="snapchat_url"
                            value="{{ settings()->getSettings('snapchat_url') ?? '' }}" id="snapchat_url_inp"
                            placeholder="{{ __('Enter the snapchat url') }}">
                        <p class="invalid-feedback" id="snapchat_url"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-4">
                        <label class="form-label">{{ __('Instagram') }}</label>
                        <input type="text" class="form-control" name="instagram_url"
                            value="{{ settings()->getSettings('instagram_url') ?? '' }}" id="instagram_url_inp"
                            placeholder="{{ __('Enter the instagram page url') }}">
                        <p class="invalid-feedback" id="instagram_url"></p>
                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-4">

                        <label class="form-label">{{ __('Youtube') }}</label>
                        <input type="text" class="form-control" name="youtube_url"
                            value="{{ settings()->getSettings('youtube_url') ?? '' }}" id="youtube_url_inp"
                            placeholder="{{ __('Enter the youtube channel url') }}">
                        <p class="invalid-feedback" id="youtube_url"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-4">

                        <label class="form-label">{{ __('Whatsapp') }}</label>
                        <input type="text" class="form-control" name="whatsapp_url"
                            value="{{ settings()->getSettings('whatsapp_url') ?? '' }}" id="whatsapp_url_inp"
                            placeholder="{{ __('Enter the whatsapp url') }}">
                        <p class="invalid-feedback" id="whatsapp_url"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">
                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Email') }}</label>
                        <input type="text" class="form-control" name="email"
                            value="{{ settings()->getSettings('email') ?? '' }}" id="email_inp"
                            placeholder="{{ __('Enter the email') }}">
                        <p class="invalid-feedback" id="email"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Tiktok') }}</label>
                        <input type="text" class="form-control" name="tiktok"
                            value="{{ settings()->getSettings('tiktok') ?? '' }}" id="tiktok_inp"
                            placeholder="{{ __('Enter the tiktok page url') }}">
                        <p class="invalid-feedback" id="tiktok"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin location :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Address') }}</label>
                        <input type="text" class="form-control" name="address"
                            value="{{ settings()->getSettings('address') ?? '' }}" id="address_inp"
                            placeholder="{{ __('Enter the address') }}">
                        <p class="invalid-feedback" id="address"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Address') }}</label>
                        <input type="text" class="form-control" name="address_iframe"
                            value="{{ settings()->getSettings('address_iframe') ?? '' }}" id="address_iframe_inp"
                            placeholder="{{ __('Enter the address') }}">
                        <p>{{ __('example') }}: <span
                                class="text-danger fw-bolder">{{ '<iframe src="https://www.google.com/maps/.." ></iframe>' }}</span>
                        </p>
                        <p class="invalid-feedback" id="address_iframe"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->
                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Tax in percentage') }}</label>
                        <input type="text" class="form-control" name="tax"
                            value="{{ settings()->getSettings('tax') ?? '' }}" id="tax_inp"
                            placeholder="{{ __('Enter the tax in percentage') }}">
                        <p class="invalid-feedback" id="tax"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <div class="d-flex justify-content-between align-items-center mt-12">

                            <label class="form-label">{{ __('Tax active') }}</label>

                            <div class="form-check form-check-custom form-check-solid my-auto">
                                <input class="form-check-input" type="radio" value="1" name="maintenance_mode"
                                    id="active-radio-btn"
                                    {{ settings()->getSettings('maintenance_mode') == '1' ? 'checked' : '' }} />
                                <label class="form-check-label me-10" for="active-radio-btn"> {{ __('active') }}
                                </label>

                                <input class="form-check-input" type="radio" value="0" name="maintenance_mode"
                                    id="inactive-radio-btn"
                                    {{ settings()->getSettings('maintenance_mode') == '0' ? 'checked' : '' }} />
                                <label class="form-check-label" for="inactive-radio-btn"> {{ __('inactive') }} </label>
                            </div>

                        </div>
                        <p class="invalid-feedback" id="maintenance_mode"></p>


                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->
                <div class="fv-row row mt-5">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Min year of production available for financing') }}</label>
                        <input type="number" class="form-control" name="Last_year_of_finance"
                            value="{{ settings()->getSettings('Last_year_of_finance') ?? date('Y') }}"
                            id="Last_year_of_finance_inp"
                            placeholder="{{ __('Enter the Min year of production available for financing') }}">
                        <p class="invalid-feedback" id="Last_year_of_finance"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Min year of production available for add ads') }}</label>
                        <input type="number" class="form-control" name="Last_year_of_ads"
                            value="{{ settings()->getSettings('Last_year_of_ads') ?? date('Y') }}"
                            id="Last_year_of_ads_inp"
                            placeholder="{{ __('Enter the Min year of production available for add ads') }}">
                        <p class="invalid-feedback" id="Last_year_of_ads"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <div class="fv-row row mb-15 mt-10">

                    <div class="col-md-12">

                        <label class="form-label">{{ __('working time') }}</label>
                        <input type="text" class="form-control" name="working_time"
                            value="{{ settings()->getSettings('working_time') ?? '' }}" id="working_time_inp"
                            placeholder="{{ __('Enter the working time url') }}">
                        <p class="invalid-feedback" id="working_time"></p>

                    </div>
                </div>
                <h2 class="text-decoration-underline fw-bolder">{{ __('Insurance Percentage') }}</h2>

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15 mt-5">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Males') }}</label>
                        <input type="number" class="form-control" name="males_insurance"
                            value="{{ settings()->getSettings('male_insurance') ?? 3.75 }}" id="males_insurance_inp"
                            placeholder="{{ __('Enter the males insurance in percentage') }}">
                        <p class="invalid-feedback" id="males_insurance"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Females') }}</label>
                        <input type="number" class="form-control" name="females_insurance"
                            value="{{ settings()->getSettings('females_insurance') ?? 6.75 }}" id="females_insurance_inp"
                            placeholder="{{ __('Enter the females insurance in percentage') }}">
                        <p class="invalid-feedback" id="females_insurance"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->


                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('logo') }}</label>
                        <br>
                        <input type="file" class="d-none" accept="image/*" name="logo" id="logo-uploader">
                        <button class="btn btn-secondary w-100 image-upload-inp" type="button"> <i
                                class="bi bi-upload fs-8"></i>
                            {{ settings()->getSettings('logo') ?: __('no file is selected') }}
                        </button>
                        <p class="invalid-feedback" id="logo"></p>


                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('favicon') }}</label>
                        <br>
                        <input type="file" class="d-none" accept="image/*" name="favicon" id="favicon-uploader">
                        <button class="btn btn-secondary w-100 image-upload-inp" type="button"> <i
                                class="bi bi-upload fs-8"></i>
                            {{ settings()->getSettings('favicon') ?: __('no file is selected') }} </button>
                        <p class="invalid-feedback" id="favicon"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-12">

                        <label class="form-label">{{ __('orders statuses') }}</label>
                        <br>
                        <!--begin::Repeater-->
                        <div id="form_repeater">
                            <!--begin::Form group-->
                            <input type="text" hidden name='deletedstatus[]' id='deletedStatusInput'>
                            <div class="form-group">
                                <div data-repeater-list="orders_statuses">
                                    @foreach ($orderStatuses ?? [] as $status)
                                        <div data-repeater-item>
                                            <div class="form-group row mt-5">
                                                <input type="text" name="id" value="{{ $status['id'] }}" hidden>
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label status-order">{{ $loop->iteration . ' - ' . __('Name in arabic') }}</label>
                                                    <input type="text" class="form-control mb-2 mb-md-0"
                                                        name="name_ar" {{ $loop->first ? 'readonly' : '' }}
                                                        value="{{ $status['name_ar'] }}"
                                                        placeholder="{{ __('Enter status name in arabic') }}" />
                                                    <p class="invalid-feedback"
                                                        id="orders_statuses_{{ $loop->index }}_name_ar"></p>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">{{ __('Name in english') }}</label>
                                                    <input type="text" class="form-control mb-2 mb-md-0"
                                                        name="name_en" {{ $loop->first ? 'readonly' : '' }}
                                                        value="{{ $status['name_en'] }}"
                                                        placeholder="{{ __('Enter status name in english') }}" />
                                                    <p class="invalid-feedback"
                                                        id="orders_statuses_{{ $loop->index }}_name_en"></p>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">{{ __('status color') }}</label>
                                                    <input type="color" name="color" class="form-control"
                                                        placeholder="{{ __('Enter status color') }}"
                                                        value="{{ $status['color'] }}" style="height:47.5px" />
                                                    <p class="invalid-feedback"
                                                        id="orders_statuss_{{ $loop->index }}_color"></p>
                                                </div>

                                                <div class="col-md-3 text-center">
                                                    <a href="javascript:" data-repeater-delete
                                                        onclick="deleteId('{{ $status['id'] }}')"
                                                        class="btn btn-sm btn-light-danger mt-4 mt-md-9">
                                                        <i class="la la-trash-o"></i>{{ __('Delete') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="form-group mt-5">
                                <a href="javascript:" data-repeater-create class="btn btn-light-primary">
                                    <i class="la la-plus"></i>{{ __('Add') }}
                                </a>
                            </div>
                            <!--end::Form group-->
                        </div>
                        <!--end::Repeater-->



                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

            </div>
            <!-- End   :: Card body -->

        </div>
        <!-- End   :: General Settings Card -->


        <!-- Begin :: Seo Settings Card -->
        <div class="card card-flush setting-card" style="display:none" id="seo-settings-card">
            <!--begin::Card header-->
            <div class="card-header pt-8">

                <div class="card-title">
                    <h2>Seo</h2>
                </div>

                <div class="card-title">

                    <!-- begin :: Submit btn -->
                    <button type="submit" class="btn btn-primary mx-4" id="submit-btn-seo">

                        <span class="indicator-label">{{ __('Save') }}</span>

                        <!-- begin :: Indicator -->
                        <span class="indicator-progress">{{ __('Please wait ...') }}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!-- end   :: Indicator -->

                    </button>
                    <!-- end   :: Submit btn -->

                </div>

            </div>
            <!--end::Card header-->

            <!-- Begin :: Card body -->
            <div class="card-body">

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Meta tag description in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="meta_tag_description_ar"
                            id="meta_tag_description_ar_inp" data-kt-autosize="true">{{ settings()->getSettings('meta_tag_description_ar') ?? '' }}</textarea>
                        <p class="invalid-feedback" id="meta_tag_description_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Meta tag description in english') }}</label>
                        <textarea class="form-control form-control form-control" name="meta_tag_description_en"
                            id="meta_tag_description_en_inp" data-kt-autosize="true">{{ settings()->getSettings('meta_tag_description_en') ?? '' }}</textarea>
                        <p class="invalid-feedback" id="meta_tag_description_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Meta tag keywords in arabic') }}</label>
                        <input type="text" class="" id="meta_tag_keyword_ar_inp" name="meta_tag_keyword_ar"
                            value="{{ settings()->getSettings('meta_tag_keyword_ar') ?? '' }}"
                            placeholder="{{ __('Enter the meta tag keywords in arabic') }}" />
                        <p class="invalid-feedback" id="meta_tag_keyword_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Meta tag keywords in english') }}</label>
                        <input type="text" class="" id="meta_tag_keyword_en_inp" name="meta_tag_keyword_en"
                            value="{{ settings()->getSettings('meta_tag_keyword_ar') ?? '' }}"
                            placeholder="{{ __('Enter the meta tag keywords in english') }}" />
                        <p class="invalid-feedback" id="meta_tag_keyword_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

            </div>
            <!-- End   :: Card body -->

        </div>
        <!-- End   :: Seo Settings Card -->


        <!-- Begin :: Website Settings Card -->
        <div class="card card-flush setting-card" style="display:none" id="website-settings-card">

            <!-- Begin :: Card header-->
            <div class="card-header pt-8">

                <div class="card-title">
                    <h2>{{ __('Website') }}</h2>
                </div>

                <div class="card-title">

                    <!-- begin :: Submit btn -->
                    <button type="submit" class="btn btn-primary mx-4" id="submit-btn-website">

                        <span class="indicator-label">{{ __('Save') }}</span>

                        <!-- begin :: Indicator -->
                        <span class="indicator-progress">{{ __('Please wait ...') }}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!-- end   :: Indicator -->

                    </button>
                    <!-- end   :: Submit btn -->

                </div>

            </div>
            <!-- End   :: Card header-->

            <!-- Begin :: Card body -->
            <div class="card-body">


                <div class="fv-row row mb-15">

                    <div class="col-md-6">
                        <label class="form-label">{{ __('Slider dashboard username') }}</label>
                        <input type="text" class="form-control" name="slider_dashboard_username"
                            value="{!! settings()->getSettings('slider_dashboard_username') ?? '' !!}" id="slider_dashboard_username_inp"
                            placeholder="{{ __('Enter slider dashboard username') }}">
                        <p class="text-danger error-element" id="slider_dashboard_username"></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('Slider dashboard password') }}</label>
                        <input type="text" class="form-control" name="slider_dashboard_password"
                            value="{!! settings()->getSettings('slider_dashboard_password') ?? '' !!}" id="slider_dashboard_password_inp"
                            placeholder="{{ __('Enter slider dashboard password') }}">
                        <p class="text-danger error-element" id="slider_dashboard_password"></p>
                    </div>

                </div>

                <div class="fv-row row mb-15">

                    <div class="col-md-6">
                        <label class="fs-5 fw-bold mb-2">{{ __('Arabic slider') }}</label>
                        <select class="form-select" data-control="select2" name="slider_ar"
                            data-placeholder="{{ __('Choose the slider') }}"
                            data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                            <option value="" selected></option>
                            {{-- @foreach ($sliders as $slider)
                                <option {{ settings()->getSettings('slider_ar') == $slider->alias ? 'selected' : '' }} value="{{ $slider->alias }}"> {{ $slider->title }} </option>
                            @endforeach --}}
                        </select>
                        <p class="text-danger error-element" id="slider_ar"></p>
                    </div>

                    <div class="col-md-6">
                        <label class="fs-5 fw-bold mb-2">{{ __('English slider') }}</label>
                        <select class="form-select" data-control="select2" name="slider_en"
                            data-placeholder="{{ __('Choose the slider') }}"
                            data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                            <option value="" selected></option>
                            {{-- @foreach ($sliders as $slider)
                                <option {{ settings()->getSettings('slider_en') == $slider->alias ? 'selected' : '' }} value="{{ $slider->alias }}"> {{ $slider->title }} </option>
                            @endforeach --}}
                        </select>
                        <p class="text-danger error-element" id="slider_en"></p>
                    </div>

                </div>

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->

                    <div class="col-md-6">

                        <label class="form-label">{{ __('Brands text in home page in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="brand_text_in_home_page_ar" data-kt-autosize="true">{!! settings()->getSettings('brand_text_in_home_page_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="brand_text_in_home_page_ar"></p>

                    </div>

                    <!-- End :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Brands text in home page in english') }}</label>
                        <textarea class="form-control form-control form-control" name="brand_text_in_home_page_en" data-kt-autosize="true">{!! settings()->getSettings('brand_text_in_home_page_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="brand_text_in_home_page_en"></p>

                    </div>
                    <!-- End :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->

                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing bodies text in home page in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="financing_body_text_in_home_page_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('financing_body_text_in_home_page_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="financing_body_text_in_home_page_ar"></p>

                    </div>

                    <!-- End :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing bodies text in home page in english') }}</label>
                        <textarea class="form-control form-control form-control" name="financing_body_text_in_home_page_en"
                            data-kt-autosize="true">{!! settings()->getSettings('financing_body_text_in_home_page_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="financing_body_text_in_home_page_en"></p>

                    </div>
                    <!-- End :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->

                    <div class="col-md-6">

                        <label class="form-label">{{ __('Finance text in finance page in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="finance_text_in_home_page_ar" data-kt-autosize="true">{!! settings()->getSettings('finance_text_in_home_page_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="finance_text_in_home_page_ar"></p>

                    </div>

                    <!-- End :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Finance text in finance page in english') }}</label>
                        <textarea class="form-control form-control form-control" name="finance_text_in_home_page_en" data-kt-autosize="true">{!! settings()->getSettings('finance_text_in_home_page_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="finance_text_in_home_page_en"></p>

                    </div>
                    <!-- End :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin exhibition :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->

                    <div class="col-md-6">

                        <label class="form-label">{{ __('Exhibition text in exhibition page in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="exhibition_text_in_exhibition_page_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('exhibition_text_in_exhibition_page_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="exhibition_text_in_exhibition_page_ar"></p>

                    </div>

                    <!-- End :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Exhibition text in exhibition page in english') }}</label>
                        <textarea class="form-control form-control form-control" name="exhibition_text_in_exhibition_page_en"
                            data-kt-autosize="true">{!! settings()->getSettings('exhibition_text_in_exhibition_page_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="exhibition_text_in_exhibition_page_en"></p>

                    </div>
                    <!-- End :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin Cars News :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->

                    <div class="col-md-6">

                        <label class="form-label">{{ __('Cars news text in cars news page in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="cars_news_text_in_cars_news_page_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('cars_news_text_in_cars_news_page_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="cars_news_text_in_cars_news_page_ar"></p>

                    </div>

                    <!-- End :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Cars news text in cars news page in english') }}</label>
                        <textarea class="form-control form-control form-control" name="cars_news_text_in_cars_news_page_en"
                            data-kt-autosize="true">{!! settings()->getSettings('cars_news_text_in_cars_news_page_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="cars_news_text_in_cars_news_page_en"></p>

                    </div>
                    <!-- End :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin offer :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->

                    <div class="col-md-6">

                        <label class="form-label">{{ __('Offer text in offer page in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="offer_text_in_offer_page_ar" data-kt-autosize="true">{!! settings()->getSettings('offer_text_in_offer_page_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="offer_text_in_offer_page_ar"></p>

                    </div>

                    <!-- End :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Offer text in offer page in english') }}</label>
                        <textarea class="form-control form-control form-control" name="offer_text_in_offer_page_en" data-kt-autosize="true">{!! settings()->getSettings('offer_text_in_offer_page_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="offer_text_in_offer_page_en"></p>

                    </div>
                    <!-- End :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin Track your order :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->

                    <div class="col-md-6">

                        <label
                            class="form-label">{{ __('Track your order text in track your order page in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="track_order_text_in_track_order_page_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('track_order_text_in_track_order_page_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="track_order_text_in_track_order_page_ar"></p>

                    </div>

                    <!-- End :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label
                            class="form-label">{{ __('Track your order text in track your order page in english') }}</label>
                        <textarea class="form-control form-control form-control" name="track_order_text_in_track_order_page_en"
                            data-kt-autosize="true">{!! settings()->getSettings('track_order_text_in_track_order_page_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="track_order_text_in_track_order_page_en"></p>

                    </div>
                    <!-- End :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin contact us :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->

                    <div class="col-md-6">

                        <label class="form-label">{{ __('Contact us text in contact us page in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="contact_us_text_in_contact_us_page_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('contact_us_text_in_contact_us_page_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="contact_us_text_in_contact_us_page_ar"></p>

                    </div>

                    <!-- End :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Contact us text in contact us page in english') }}</label>
                        <textarea class="form-control form-control form-control" name="contact_us_text_in_contact_us_page_en"
                            data-kt-autosize="true">{!! settings()->getSettings('contact_us_text_in_contact_us_page_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="contact_us_text_in_contact_us_page_en"></p>

                    </div>
                    <!-- End :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin contact us :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->

                    <div class="col-md-6">

                        <label
                            class="form-label">{{ __('Text of the Add your ad section on the Add your ad page in Arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="add_ads_ar" data-kt-autosize="true">{!! settings()->getSettings('add_ads_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="add_ads_ar"></p>

                    </div>

                    <!-- End :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label
                            class="form-label">{{ __('Text of the Add your ad section on the Add your ad page in English') }}</label>
                        <textarea class="form-control form-control form-control" name="add_ads_en" data-kt-autosize="true">{!! settings()->getSettings('add_ads_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="add_ads_en"></p>

                    </div>
                    <!-- End :: Col -->

                </div>
                <!-- End   :: Input group -->
                <!-- Begin contact us :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->

                    <div class="col-md-6">

                        <label
                            class="form-label">{{ __('Text of the Add your profile section on the Add your setting page in Arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="setting_profile_ar" data-kt-autosize="true">{!! settings()->getSettings('setting_profile_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="setting_profile_ar"></p>

                    </div>

                    <!-- End :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label
                            class="form-label">{{ __('Text of the Add your profile section on the Add your setting page in English') }}</label>
                        <textarea class="form-control form-control form-control" name="setting_profile_en" data-kt-autosize="true">{!! settings()->getSettings('setting_profile_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="setting_profile_en"></p>

                    </div>
                    <!-- End :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Privacy policy in arabic') }}</label>
                        <textarea id="tinymce_privacy_policy_ar" name="privacy_policy_ar" class="tinymce">{!! settings()->getSettings('privacy_policy_ar') ?? '' !!}</textarea>

                        <p class="text-danger invalid-feedback" id="privacy_policy_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Privacy policy in english') }}</label>
                        <textarea id="tinymce_privacy_policy_en" name="privacy_policy_en" class="tinymce">{!! settings()->getSettings('privacy_policy_en') ?? '' !!}</textarea>

                        <!--<textarea rows="2" class="form-control form-control form-control" name="privacy_policy_en"-->
                        <!--    data-kt-autosize="true">{!! settings()->getSettings('privacy_policy_en') ?? '' !!}</textarea>-->
                        <p class="text-danger error-element" id="privacy_policy_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->
                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Terms and conditions in arabic') }}</label>
                        <!--<textarea rows="2" class="form-control form-control form-control" name="terms_and_conditions_ar"-->
                        <!--    data-kt-autosize="true">{!! settings()->getSettings('terms_and_conditions_ar') ?? '' !!}</textarea>-->
                        <textarea id="tinymce_terms_and_conditions_ar" name="terms_and_conditions_ar" class="tinymce">{!! settings()->getSettings('terms_and_conditions_ar') ?? '' !!}</textarea>


                        <p class="text-danger invalid-feedback" id="terms_and_conditions_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Terms and conditions in english') }}</label>

                        <!--<textarea rows="2" class="form-control form-control form-control" name="terms_and_conditions_en"-->
                        <!--    data-kt-autosize="true">{!! settings()->getSettings('terms_and_conditions_en') ?? '' !!}</textarea>-->
                        <textarea id="tinymce_terms_and_conditions_en" name="terms_and_conditions_en" class="tinymce">{!! settings()->getSettings('terms_and_conditions_en') ?? '' !!}</textarea>



                        <p class="text-danger invalid-feedback" id="terms_and_conditions_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

            </div>
            <!-- End   :: Card body -->

        </div>
        <!-- End   :: Website Settings Card -->


        <!-- Begin :: About Website Settings Card -->
        <div class="card card-flush setting-card" style="display:none" id="about-website-settings-card">

            <!-- Begin :: Card header-->
            <div class="card-header pt-8">

                <div class="card-title">
                    <h2>{{ __('About us') }}</h2>
                </div>

                <div class="card-title">

                    <!-- begin :: Submit btn -->
                    <button type="submit" class="btn btn-primary mx-4" id="submit-btn-about-website">

                        <span class="indicator-label">{{ __('Save') }}</span>

                        <!-- begin :: Indicator -->
                        <span class="indicator-progress">{{ __('Please wait ...') }}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!-- end   :: Indicator -->

                    </button>
                    <!-- end   :: Submit btn -->

                </div>

            </div>
            <!-- End   :: Card header-->

            <!-- Begin :: Card body -->
            <div class="card-body">

                <!-- Begin   :: Input group -->
                <div class="fv-row row mb-15">

                    <div class="col-md-6">
                        <label class="form-label">{{ __('Financing advantage section photo in home page') }}</label>
                        <input type="file" accept="image/*" class="d-none" name="financing_advantage_photo"
                            id="financing_advantage_photo-uploader">
                        <button class="btn btn-secondary w-100 image-upload-inp" type="button"> <i
                                class="bi bi-upload fs-8"></i>
                            {{ settings()->getSettings('financing_advantage_photo') ?: __('no file is selected') }}
                        </button>
                        <p class="invalid-feedback" id="financing_advantage_photo"></p>
                    </div>
                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('who code car section photo') }}</label>
                        <br>
                        <input type="file" accept="image/*" class="d-none" name="who_code_car_photo"
                            id="who_code_car_photo-uploader">
                        <button class="btn btn-secondary w-100 image-upload-inp" type="button"> <i
                                class="bi bi-upload fs-8"></i>
                            {{ settings()->getSettings('who_code_car_photo') ?: __('no file is selected') }} </button>
                        <p class="invalid-feedback" id="who_code_car_photo"></p>


                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->
                <!-- Begin   :: Input group -->
                <div class="fv-row row mb-15">

                    <div class="col-md-4">
                        <label class="form-label">{{ __('Why CodeCar icon card 1') }}</label>
                        <input type="file" accept="image/*" class="d-none" name="why_code_car_icon_card_1"
                            id="why_code_car_icon_card_1-uploader">
                        <button class="btn btn-secondary w-100 image-upload-inp" type="button"> <i
                                class="bi bi-upload fs-8"></i>
                            {{ settings()->getSettings('why_code_car_icon_card_1') ?: __('no file is selected') }}
                        </button>
                        <p class="invalid-feedback" id="why_code_car_icon_card_1"></p>
                    </div>
                    <!-- Begin :: Col -->
                    <div class="col-md-4">

                        <label class="form-label">{{ __('Why CodeCar icon card 2') }}</label>
                        <br>
                        <input type="file" accept="image/*" class="d-none" name="why_code_car_icon_card_2"
                            id="why_code_car_icon_card_2-uploader">
                        <button class="btn btn-secondary w-100 image-upload-inp" type="button"> <i
                                class="bi bi-upload fs-8"></i>
                            {{ settings()->getSettings('why_code_car_icon_card_2') ?: __('no file is selected') }}
                        </button>
                        <p class="invalid-feedback" id="why_code_car_icon_card_2"></p>
                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-4">

                        <label class="form-label">{{ __('Why CodeCar icon card 3') }}</label>
                        <br>
                        <input type="file" accept="image/*" class="d-none" name="why_code_car_icon_card_3"
                            id="why_code_car_icon_card_3-uploader">
                        <button class="btn btn-secondary w-100 image-upload-inp" type="button"> <i
                                class="bi bi-upload fs-8"></i>
                            {{ settings()->getSettings('why_code_car_icon_card_3') ?: __('no file is selected') }}
                        </button>
                        <p class="invalid-feedback" id="why_code_car_icon_card_3"></p>
                    </div>
                    <!-- End   :: Col -->
                </div>
                <!-- End   :: Input group -->
                <!-- Begin  icons card finance advantage :: Input group -->
                <div class="fv-row row mb-15">

                    <div class="col-md-6">
                        <label class="form-label">{{ __('Financing advantage card 1 icon in home page') }}</label>
                        <input type="file" accept="image/*" class="d-none" name="financing_advantage_card_1_icon"
                            id="financing_advantage_card_1_icon-uploader">
                        <button class="btn btn-secondary w-100 image-upload-inp" type="button"> <i
                                class="bi bi-upload fs-8"></i>
                            {{ settings()->getSettings('financing_advantage_card_1_icon') ?: __('no file is selected') }}
                        </button>
                        <p class="invalid-feedback" id="financing_advantage_card_1_icon"></p>
                    </div>
                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing advantage card 2 icon in home page') }}</label>
                        <br>
                        <input type="file" accept="image/*" class="d-none" name="financing_advantage_card_2_icon"
                            id="financing_advantage_card_1_icon-uploader">
                        <button class="btn btn-secondary w-100 image-upload-inp" type="button"> <i
                                class="bi bi-upload fs-8"></i>
                            {{ settings()->getSettings('financing_advantage_card_2_icon') ?: __('no file is selected') }}
                        </button>
                        <p class="invalid-feedback" id="financing_advantage_card_2_icon"></p>


                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- End   :: Input group -->
                <!-- Begin  icons card about us :: Input group -->
                <div class="fv-row row mb-15">

                    <div class="col-md-6">
                        <label class="form-label">{{ __('Icon about us left card ') }}</label>
                        <input type="file" accept="image/*" class="d-none" name="about_us_card_left_icon"
                            id="about_us_card_left_icon-uploader">
                        <button class="btn btn-secondary w-100 image-upload-inp" type="button"> <i
                                class="bi bi-upload fs-8"></i>
                            {{ settings()->getSettings('about_us_card_left_icon') ?: __('no file is selected') }}
                        </button>
                        <p class="invalid-feedback" id="about_us_card_left_icon"></p>
                    </div>
                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Icon about us right card ') }}</label>
                        <br>
                        <input type="file" accept="image/*" class="d-none" name="about_us_card_right_icon"
                            id="about_us_card_right_iconicon-uploader">
                        <button class="btn btn-secondary w-100 image-upload-inp" type="button"> <i
                                class="bi bi-upload fs-8"></i>
                            {{ settings()->getSettings('about_us_card_right_icon') ?: __('no file is selected') }}
                        </button>
                        <p class="invalid-feedback" id="about_us_card_right_icon"></p>


                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label clss="forma-label">{{ __('Financing advantage section in home page in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="financing_advantage_ar" data-kt-autosize="true">{!! settings()->getSettings('financing_advantage_ar') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="financing_advantage_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing advantage section in home page in english') }}</label>
                        <textarea class="form-control form-control form-control" name="financing_advantage_en" data-kt-autosize="true">{!! settings()->getSettings('financing_advantage_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="financing_advantage_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing advantage text card 1 in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="financing_advantage_text_card_1_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('financing_advantage_text_card_1_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="financing_advantage_text_card_1_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing advantage text card 1 in english') }}</label>
                        <textarea class="form-control form-control form-control" name="financing_advantage_text_card_1_en"
                            data-kt-autosize="true">{!! settings()->getSettings('financing_advantage_text_card_1_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="financing_advantage_text_card_1_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing advantage card 1 in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="financing_advantage_card_1_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('financing_advantage_card_1_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="financing_advantage_card_1_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing advantage card 1 in english') }}</label>
                        <textarea class="form-control form-control form-control" name="financing_advantage_card_1_en"
                            data-kt-autosize="true">{!! settings()->getSettings('financing_advantage_card_1_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="financing_advantage_card_1_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing advantage text card 2 in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="financing_advantage_text_card_2_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('financing_advantage_text_card_2_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="financing_advantage_text_card_2_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing advantage text card 2 in english') }}</label>
                        <textarea class="form-control form-control form-control" name="financing_advantage_text_card_2_en"
                            data-kt-autosize="true">{!! settings()->getSettings('financing_advantage_text_card_2_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="financing_advantage_text_card_2_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">


                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing advantage card 2 in arabic') }}</label>
                        <textarea class="form-control form-control form-control"name="financing_advantage_card_2_ar" data-kt-autosize="true">{!! settings()->getSettings('financing_advantage_card_2_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="financing_advantage_card_2_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Financing advantage card 2 in english') }}</label>
                        <textarea class="form-control form-control form-control" name="financing_advantage_card_2_en"
                            data-kt-autosize="true">{!! settings()->getSettings('financing_advantage_card_2_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="financing_advantage_card_2_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('About us in arabic') }}</label>
                        <textarea class=" form-control" name="about_us_ar" data-kt-autosize="true">{!! settings()->getSettings('about_us_ar') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="about_us_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('About us in english') }}</label>
                        <textarea class="form-control" name="about_us_en" data-kt-autosize="true">{!! settings()->getSettings('about_us_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="about_us_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin about us description :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('About us description in arabic') }}</label>
                        <textarea class="form-control" name="about_us_description_ar" data-kt-autosize="true">{!! settings()->getSettings('about_us_description_ar') ?? '' !!}</textarea>

                        <p class="text-danger invalid-feedback" id="about_us_description_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('About us description in english') }}</label>
                        <textarea class="form-control" name="about_us_description_en" data-kt-autosize="true">{!! settings()->getSettings('about_us_description_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="about_us_description_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin Our goals :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('About Us text card left side section in arabic') }}</label>
                        <textarea name="about_us_section_card_left_ar" class="form-control" data-kt-autosize="true">{!! settings()->getSettings('about_us_section_card_left_ar') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="about_us_section_card_left_ar"></p>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">{{ __('About Us text card left side section in english') }}</label>
                        <textarea name="about_us_section_card_left_en" class="form-control" data-kt-autosize="true">{!! settings()->getSettings('about_us_section_card_left_en') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="about_us_section_card_left_en"></p>

                    </div>



                    <!--<div class="col-md-6">-->

                    <!--    <label class="form-label">{{ __('Why CodeCar section card 3 in arabic') }}</label>-->
                    <!--    <textarea class="form-control form-control form-control" name="why_code_car_section_card_3_ar"-->
                    <!--        data-kt-autosize="true">{!! settings()->getSettings('why_code_car_section_card_3_ar') ?? '' !!}</textarea>-->
                    <!--    <p class="text-danger invalid-feedback" id="why_code_car_section_card_3_ar"></p>-->

                    <!--</div>-->

                    <!-- End   :: Col -->

                </div>

                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('About Us card left side section in arabic') }}</label>
                        <textarea name="about_us_card_left_ar" class="form-control form-control form-control" data-kt-autosize="true">{!! settings()->getSettings('about_us_card_left_ar') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="about_us_card_left_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('About Us card left side section in english') }}</label>
                        <textarea name="about_us_card_left_en" class="form-control form-control form-control" data-kt-autosize="true">{!! settings()->getSettings('about_us_card_left_en') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="about_us_card_left_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin distinguishes us :: Input group -->

                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('About Us text card right side section in arabic') }}</label>
                        <textarea name="about_us_section_card_right_ar" class="form-control form-control form-control"
                            data-kt-autosize="true">{!! settings()->getSettings('about_us_section_card_right_ar') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="about_us_section_card_right_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('About Us text card right side section in english') }}</label>
                        <textarea name="about_us_section_card_right_en" class="form-control form-control form-control"
                            data-kt-autosize="true">{!! settings()->getSettings('about_us_section_card_right_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="about_us_section_card_right_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>

                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('About Us card right side section in arabic') }}</label>
                        <textarea name="about_us_card_right_ar" class="form-control form-control form-control" data-kt-autosize="true">{!! settings()->getSettings('about_us_card_right_ar') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="about_us_card_right_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('About Us card right side section in english') }}</label>
                        <textarea id="tinymce_about_us_card_right_en" name="about_us_card_right_en"
                            class="form-control form-control form-control" data-kt-autosize="true">{!! settings()->getSettings('about_us_card_right_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="about_us_card_right_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_cars_ar" data-kt-autosize="true">{!! settings()->getSettings('why_code_car_cars_ar') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="why_code_car_cars_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar in english') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_cars_en" data-kt-autosize="true">{!! settings()->getSettings('why_code_car_cars_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="why_code_car_cars_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar section card 1 in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_section_card_1_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('why_code_car_section_card_1_ar') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="why_code_car_section_card_1_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar section card 1 in english') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_section_card_1_en"
                            data-kt-autosize="true">{!! settings()->getSettings('why_code_car_section_card_1_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="why_code_car_section_card_1_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">


                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar card 1 in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_cars_card_1_ar" data-kt-autosize="true">{!! settings()->getSettings('why_code_car_cars_card_1_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="why_code_car_cars_card_1_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar card 1 in english') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_cars_card_1_en" data-kt-autosize="true">{!! settings()->getSettings('why_code_car_cars_card_1_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="why_code_car_cars_card_1_en"></p>

                    </div>
                    <!-- End   :: Col -->


                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar section card 2 in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_section_card_2_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('why_code_car_section_card_2_ar') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="why_code_car_section_card_2_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar section card 2 in english') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_section_card_2_en"
                            data-kt-autosize="true">{!! settings()->getSettings('why_code_car_section_card_2_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="why_code_car_section_card_2_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">


                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar card 2 in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_cars_card_2_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('why_code_car_cars_card_2_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="why_code_car_cars_card_2_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar card 2 in english') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_cars_card_2_en"
                            data-kt-autosize="true">{!! settings()->getSettings('why_code_car_cars_card_2_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="why_code_car_cars_card_2_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar section card 3 in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_section_card_3_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('why_code_car_section_card_3_ar') ?? '' !!}</textarea>
                        <p class="text-danger invalid-feedback" id="why_code_car_section_card_3_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar section card 3 in english') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_section_card_3_en"
                            data-kt-autosize="true">{!! settings()->getSettings('why_code_car_section_card_3_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="why_code_car_section_card_3_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->
                <!-- Begin :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar card 3 in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_cars_card_3_ar"
                            data-kt-autosize="true">{!! settings()->getSettings('why_code_car_cars_card_3_ar') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="why_code_car_cars_card_3_ar"></p>

                    </div>
                    <!-- End   :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('Why CodeCar card 3 in english') }}</label>
                        <textarea class="form-control form-control form-control" name="why_code_car_cars_card_3_en"
                            data-kt-autosize="true">{!! settings()->getSettings('why_code_car_cars_card_3_en') ?? '' !!}</textarea>
                        <p class="text-danger error-element" id="why_code_car_cars_card_3_en"></p>

                    </div>
                    <!-- End   :: Col -->

                </div>
                <!-- End   :: Input group -->

                <!-- Begin :: Input group -->
                <!--<div class="fv-row row mb-15">-->

                <!-- Begin :: Col -->
                <!--    <div class="col-md-6">-->

                <!--        <label class="form-label">{{ __('Settings section in arabic') }}</label>-->
                <!--        <textarea class="form-control " name="setting_ar" data-kt-autosize="true">{!! settings()->getSettings('setting_ar') ?? '' !!}</textarea>-->
                <!--        <p class="text-danger error-element" id="setting_ar"></p>-->

                <!--    </div>-->
                <!-- End   :: Col -->

                <!-- Begin :: Col -->
                <!--    <div class="col-md-6">-->

                <!--        <label class="form-label">{{ __('Settings section in english') }}</label>-->
                <!--        <textarea class="form-control form-control form-control" name="setting_en" data-kt-autosize="true">{!! settings()->getSettings('setting_en') ?? '' !!}</textarea>-->
                <!--        <p class="text-danger error-element" id="setting_en"></p>-->

                <!--    </div>-->
                <!-- End   :: Col -->

                <!--</div>-->
                <!-- End   :: Input group --

                                                                                                                                                                                                                                                                                     Begin   :: Input group -->
                <div class="fv-row row mb-15">

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('footer text in arabic') }}</label>
                        <textarea class="form-control form-control form-control" name="footer_text_ar" id="footer_text_ar_inp"
                            data-kt-autosize="true">{{ settings()->getSettings('footer_text_ar') ?? '' }}</textarea>
                        <p class="invalid-feedback" id="footer_text_ar"></p>

                    </div>
                    <!-- End :: Col -->

                    <!-- Begin :: Col -->
                    <div class="col-md-6">

                        <label class="form-label">{{ __('footer text in english') }}</label>
                        <textarea class="form-control form-control form-control" name="footer_text_en" id="footer_text_en_inp"
                            data-kt-autosize="true">{{ settings()->getSettings('footer_text_en') ?? '' }}</textarea>
                        <p class="invalid-feedback" id="footer_text_en"></p>

                    </div>
                    <!-- End :: Col -->

                </div>
                <!-- End   :: Input group -->
                <div class="fv-row row mb-15">


                </div>



            </div>
            <!-- End   :: Card body -->

        </div>
        <!-- End   :: About Website Settings Card -->

    </form>
    <!--end::Form-->
@endsection
@push('scripts')
    <script>
        let deletedIds = [];

        function deleteId(itemId) {
            // Add the deleted ID to the array
            deletedIds.push(itemId);
            // Perform any other deletion logic if needed
            console.log(deletedIds);
            // Remove the deleted item from the DOM
            // You may need to adjust this based on your structure
            // Here, I'm assuming you're using the repeater functionality
            // provided by Livewire's `data-repeater`

            // Update the value of the deletedstatus[] input field
            const deletedstatusInput = document.getElementById('deletedStatusInput');

            const deletedIdsString = deletedIds.join(',');

            deletedstatusInput.value = deletedIdsString;

        }
    </script>
    <script src="{{ asset('dashboard-assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('js/dashboard/components/form_repeater.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script>
        let changeSettingView = (tab) => {

            $('.setting-card').hide();
            $('.setting-label').removeClass('active');

            $("#" + tab + '-settings-card').show()
            $("#" + tab + '-settings-label').addClass('active')

            $("#setting-type-inp").val(tab);
        };

        $(document).ready(() => {

            initTinyMc(true);

            $('.image-upload-inp').click(function() {

                $(this).prev().trigger('click');

            });

            $('[id*=-uploader]').change(function() {

                let fileName = $(this)[0].files[0].name;

                $(this).next().html(`<i class="bi bi-upload fs-8" ></i> ${ fileName } `);

            });

            new Tagify(document.getElementById('meta_tag_keyword_ar_inp'), {
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
            });
            new Tagify(document.getElementById('meta_tag_keyword_en_inp'), {
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
            });


        });
    </script>
@endpush
