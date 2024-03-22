<div id="kt_header" style="" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Aside mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                id="kt_aside_mobile_toggle">
                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                <span class="svg-icon svg-icon-1">
                    <i class="fa fa-hamburger"></i>
                </span>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!--end::Aside mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ route('dashboard.index') }}" class="d-lg-none">
                <img alt="Logo" src="{{ asset('dashboard-assets/media/logos/logo-2.svg') }}" class="h-30px" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <!--begin::Menu wrapper-->
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end"
                    data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                    data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    <!--begin::Menu-->

                    <!--end::Menu-->
                </div>
                <!--end::Menu wrapper-->
            </div>
            <!--end::Navbar-->
            <!--begin::Toolbar wrapper-->
            <div class="d-flex align-items-stretch flex-shrink-0">

                <!--begin::User menu-->
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <div class="px-4">
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ __('Hello') }} ,
                            {{ auth()->user()->name }}</small>
                    </div>
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click"
                        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img src="{{ asset('dashboard-assets/media/avatars/blank.png') }}" alt="user" />
                    </div>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{ asset('dashboard-assets/media/avatars/blank.png') }}" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-5"> {{ auth()->user()->name }}
                                    </div>
                                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7">
                                        {{ auth()->user()->email }}</a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-title position-relative">{{ __('Language') }}
                                    <span
                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">{{ isArabic() ? __('Arabic') : __('English') }}
                                        <img class="w-15px h-15px rounded-1 ms-2"
                                            src="{{ asset('dashboard-assets/media/flags/' . (isArabic() ? 'saudi-arabia' : 'united-states') . '.svg') }}"
                                            alt="" /></span></span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">

                                <div class="menu-item px-3">
                                    <a href="{{ route('change-language', 'ar') }}"
                                        class="menu-link d-flex px-5 @if (isArabic() == 'ar') active @endif">
                                        <span class="symbol symbol-20px me-4">
                                            <img class="rounded-1"
                                                src="{{ asset('dashboard-assets/media/flags/saudi-arabia.svg') }}"
                                                alt="" />
                                        </span>{{ __('Arabic') }}
                                    </a>
                                </div>

                                <div class="menu-item px-3">
                                    <a href="{{ route('change-language', 'en') }}"
                                        class="menu-link d-flex px-5 @if (!isArabic()) active @endif">
                                        <span class="symbol symbol-20px me-4">
                                            <img class="rounded-1"
                                                src="{{ asset('dashboard-assets/media/flags/united-states.svg') }}"
                                                alt="" />
                                        </span>{{ __('English') }}
                                    </a>
                                </div>

                            </div>
                            <!--end::Menu sub-->
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <div class="menu-content px-5">
                                <label
                                    class="form-check form-switch form-check-custom form-check-solid pulse pulse-success"
                                    for="toggle-theme-mode">
                                    <input class="form-check-input w-30px h-20px" type="checkbox"
                                        {{ isDarkMode() ? 'checked' : 'false' }} name="mode"
                                        id="toggle-theme-mode" />
                                    <span class="pulse-ring ms-n1"></span>
                                    <span class="form-check-label text-gray-600 fs-7">{{ __('Dark Mode') }}</span>
                                </label>
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-5">
                            <div class="menu-content px-5">
                                <label
                                    class="form-check form-switch form-check-custom form-check-solid pulse pulse-success"
                                    for="toggle-notifications">
                                    <input class="form-check-input w-30px h-20px" type="checkbox" value="1"
                                        name="mode" id="toggle-notifications" />
                                    <span class="pulse-ring ms-n1"></span>
                                    <span class="form-check-label text-gray-600 fs-7">{{ __('Notifications') }}</span>
                                </label>
                            </div>
                        </div> --}}
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5 my-1">
                            <a href="{{ route('dashboard.edit-profile') }}"
                                class="menu-link px-5">{{ __('Account Settings') }}</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <form id="logout-form" method="post" action="{{ route('employee.logout') }}">
                                @csrf
                                <a href="javascript:" onclick="$('#logout-form').submit()"
                                    class="menu-link px-5">{{ __('Sign Out') }}</a>
                            </form>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
                {{-- <!--begin::Notifications-->
                <div class="d-flex align-items-center ms-3 ms-lg-4">
                    <!--begin::Drawer wrapper-->
                    <div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline w-40px h-40px position-relative"
                        data-kt-menu-trigger="{default: 'click', lg: 'click'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com003.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z"
                                    fill="currentColor" />
                                <path
                                    d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z"
                                    fill="currentColor" />
                            </svg>
                        </span>

                        <!--end::Svg Icon-->
                        <!--begin::Bullet-->
                        <span
                            class="bullet bullet-dot bg-danger h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink  {{ $unreadNotifications->count() == 0 ? 'd-none' : '' }}"></span>
                        <!--end::Bullet-->
                    </div>
                    <!--end::Drawer wrapper-->

                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" id="kt_menu"
                        data-kt-menu="true" style="">
                        <!--begin::Heading-->
                        <div class="d-flex flex-column bgi-no-repeat rounded-top"
                            style="background-image:url('{{ asset('dashboard-assets/media/misc/menu-header-bg.jpg') }}')">
                            <div class="d-flex justify-content-between align-items-center">
                                <!--begin::Title-->
                                <h3 class="text-white fw-semibold px-9 mt-10 mb-6">{{ __('Notifications') }}
                                    @if ($unreadNotifications->count() > 0)
                                        <span
                                            class="fs-8 opacity-75 ps-3 notifications-counter">{{ $unreadNotifications->count() . ' ' . __('unread') }}</span>
                                    @else
                                        <span class="fs-8 opacity-75 ps-3 notifications-counter">
                                            {{ __('nothing new') }}</span>
                                    @endif
                                </h3>
                                <!--end::Title-->
                                <a href="{{ route('notifications.mark_all_as_read') }}"
                                    class="text-white fw-semibold px-9 mt-10 mb-6">{{ __('Mark all as read') }}</a>
                            </div>

                            <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9"
                                role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-white opacity-75 opacity-state-100 pb-4"
                                        data-bs-toggle="tab" href="#all_notifications" aria-selected="false"
                                        tabindex="-1" role="tab">{{ __('All') }}</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active"
                                        data-bs-toggle="tab" href="#unread_notifications" aria-selected="true"
                                        role="tab">{{ __('Unread') }}</a>
                                </li>
                            </ul>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <div class="tab-pane fade" id="all_notifications" role="tabpanel">
                                <!--begin::Wrapper-->
                                <div class="scroll-y mh-325px min-h-325px my-5 px-8" id="all-notifications-container">
                                    @forelse ($allNotifications->take(10)->get() as $notification)
                                        <div class="d-flex flex-stack py-4 notification-item">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-4">
                                                    <span
                                                        class="symbol-label bg-light-{{ $notification->data['color'] }}">
                                                        <span
                                                            class="svg-icon svg-icon-2x svg-icon-{{ $notification->data['color'] }}">
                                                            {!! $notification->data['icon'] !!}
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->

                                                <!--begin::Title-->
                                                <div class="mb-0 me-2">
                                                    <a href="{{ route('notifications.mark_as_read', $notification->id) }}"
                                                        class="fs-6 text-gray-800 text-hover-primary fw-bold">{{ $notification->data['title_' . app()->getLocale()] }}</a>
                                                    <div class="text-gray-400 fs-7">
                                                        {{ $notification->data['description_' . app()->getLocale()] }}
                                                    </div>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Section-->

                                            <!--begin::Label-->
                                            <span
                                                class="badge badge-light fs-8">{{ $notification->created_at->diffForHumans() }}</span>
                                            <!--end::Label-->
                                        </div>
                                    @empty
                                        <div class="d-flex flex-column px-9 pb-5 no-notifications-alert">
                                            <!--begin::Illustration-->
                                            <div class="text-center px-4">
                                                <img class="mw-100 mh-200px" alt="image"
                                                    src="{{ asset('dashboard-assets/media/illustrations/unitedpalms-1/notifications.png') }}">
                                            </div>
                                            <!--end::Illustration-->
                                            <!--begin::Section-->
                                            <div class="pt-5 pb-0">
                                                <!--begin::Title-->
                                                <h3 class="text-dark text-center fw-bold">
                                                    {{ __('There are no new notifications!') }}</h3>
                                                <!--end::Title-->
                                                <!--begin::Text-->
                                                <div class="text-center text-gray-600 fw-semibold pt-1">
                                                    {{ __('Here it shows you all the notifications from the website to be aware of the latest important processes and events that need to be re-reviewed and a new action taken with them.') }}
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                    @endforelse

                                    <!--begin::Item-->
                                    @if ($allNotifications->count() > 10)
                                        <!--begin::Item-->
                                        <button type="submit" class="btn border-none p-0 d-flex m-auto"
                                            data-kt-indicator="" id="all-load-more">
                                            <span class="indicator-label">
                                                <span class="svg-icon svg-icon-danger svg-icon-2x">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Navigation\Angle-double-down.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <path
                                                                d="M8.2928955,3.20710089 C7.90237121,2.8165766 7.90237121,2.18341162 8.2928955,1.79288733 C8.6834198,1.40236304 9.31658478,1.40236304 9.70710907,1.79288733 L15.7071091,7.79288733 C16.085688,8.17146626 16.0989336,8.7810527 15.7371564,9.17571874 L10.2371564,15.1757187 C9.86396402,15.5828377 9.23139665,15.6103407 8.82427766,15.2371482 C8.41715867,14.8639558 8.38965574,14.2313885 8.76284815,13.8242695 L13.6158645,8.53006986 L8.2928955,3.20710089 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(12.000003, 8.499997) scale(-1, -1) rotate(-90.000000) translate(-12.000003, -8.499997) " />
                                                            <path
                                                                d="M6.70710678,19.2071045 C6.31658249,19.5976288 5.68341751,19.5976288 5.29289322,19.2071045 C4.90236893,18.8165802 4.90236893,18.1834152 5.29289322,17.7928909 L11.2928932,11.7928909 C11.6714722,11.414312 12.2810586,11.4010664 12.6757246,11.7628436 L18.6757246,17.2628436 C19.0828436,17.636036 19.1103465,18.2686034 18.7371541,18.6757223 C18.3639617,19.0828413 17.7313944,19.1103443 17.3242754,18.7371519 L12.0300757,13.8841355 L6.70710678,19.2071045 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                                transform="translate(12.000003, 15.499997) scale(-1, -1) rotate(-360.000000) translate(-12.000003, -15.499997) " />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="indicator-progress">
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                        <!--end::Item-->
                                    @endif
                                    <!--end::Item-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <div class="tab-pane fade show active" id="unread_notifications" role="tabpanel">
                                <!--begin::Wrapper-->
                                <div class="scroll-y mh-325px min-h-325px my-5 px-8"
                                    id="unread-notifications-container">
                                    @forelse ($unreadNotifications->take(10)->get() as $notification)
                                        <div class="d-flex flex-stack py-4 notification-item">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-4">
                                                    <span
                                                        class="symbol-label bg-light-{{ $notification->data['color'] }}">
                                                        <span
                                                            class="svg-icon svg-icon-2x svg-icon-{{ $notification->data['color'] }}">
                                                            {!! $notification->data['icon'] !!}
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->

                                                <!--begin::Title-->
                                                <div class="mb-0 me-2">
                                                    <a href="{{ route('notifications.mark_as_read', $notification->id) }}"
                                                        class="fs-6 text-gray-800 text-hover-primary fw-bold">{{ $notification->data['title_' . app()->getLocale()] }}</a>
                                                    <div class="text-gray-400 fs-7">
                                                        {{ $notification->data['description_' . app()->getLocale()] }}
                                                    </div>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Section-->

                                            <!--begin::Label-->
                                            <span
                                                class="badge badge-light fs-8">{{ $notification->created_at->diffForHumans() }}</span>
                                            <!--end::Label-->
                                        </div>
                                    @empty
                                        <div class="d-flex flex-column px-9 pb-5" id="no-notification-alert">
                                            <!--begin::Illustration-->
                                            <div class="text-center px-4">
                                                <img class="mw-100 mh-200px" alt="image"
                                                    src="{{ asset('dashboard-assets/media/illustrations/unitedpalms-1/notifications.png') }}">
                                            </div>
                                            <!--end::Illustration-->
                                            <!--begin::Section-->
                                            <div class="pt-5 pb-0">
                                                <!--begin::Title-->
                                                <h3 class="text-dark text-center fw-bold">
                                                    {{ __('There are no new notifications!') }}</h3>
                                                <!--end::Title-->
                                                <!--begin::Text-->
                                                <div class="text-center text-gray-600 fw-semibold pt-1">
                                                    {{ __('Here it shows you all the notifications from the website to be aware of the latest important processes and events that need to be re-reviewed and a new action taken with them.') }}
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                    @endforelse
                                    <!--begin::Item-->
                                    @if ($unreadNotifications->count() > 10)
                                        <!--begin::Item-->
                                        <button type="submit" class="btn border-none p-0 d-flex m-auto"
                                            data-kt-indicator="" id="unread-load-more">
                                            <span class="indicator-label">
                                                <span class="svg-icon svg-icon-danger svg-icon-2x">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Navigation\Angle-double-down.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <path
                                                                d="M8.2928955,3.20710089 C7.90237121,2.8165766 7.90237121,2.18341162 8.2928955,1.79288733 C8.6834198,1.40236304 9.31658478,1.40236304 9.70710907,1.79288733 L15.7071091,7.79288733 C16.085688,8.17146626 16.0989336,8.7810527 15.7371564,9.17571874 L10.2371564,15.1757187 C9.86396402,15.5828377 9.23139665,15.6103407 8.82427766,15.2371482 C8.41715867,14.8639558 8.38965574,14.2313885 8.76284815,13.8242695 L13.6158645,8.53006986 L8.2928955,3.20710089 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(12.000003, 8.499997) scale(-1, -1) rotate(-90.000000) translate(-12.000003, -8.499997) " />
                                                            <path
                                                                d="M6.70710678,19.2071045 C6.31658249,19.5976288 5.68341751,19.5976288 5.29289322,19.2071045 C4.90236893,18.8165802 4.90236893,18.1834152 5.29289322,17.7928909 L11.2928932,11.7928909 C11.6714722,11.414312 12.2810586,11.4010664 12.6757246,11.7628436 L18.6757246,17.2628436 C19.0828436,17.636036 19.1103465,18.2686034 18.7371541,18.6757223 C18.3639617,19.0828413 17.7313944,19.1103443 17.3242754,18.7371519 L12.0300757,13.8841355 L6.70710678,19.2071045 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                                transform="translate(12.000003, 15.499997) scale(-1, -1) rotate(-360.000000) translate(-12.000003, -15.499997) " />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="indicator-progress">
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                        <!--end::Item-->
                                    @endif
                                    <!--end::Item-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                        </div>
                        <!--end::Tab content-->
                    </div>
                </div>
                <!--end::Notifications--> --}}
                <!--begin::Header menu toggle-->
                <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                        id="kt_header_menu_mobile_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                                    fill="black" />
                                <path opacity="0.3"
                                    d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <!--end::Header menu toggle-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
@push('scripts')
    <script>
        var favIconCounter = {{ $unreadNotifications->count() }};
        var favicon;

        $(document).ready(() => {

            favicon = new Favico({
                animation: 'popFade'
            });

            if (favIconCounter > 0)
                favicon.badge(favIconCounter);

            $("#toggle-theme-mode").change(function() {

                let mode = $(this).prop('checked') ? 'dark' : 'light';

                window.location.replace(`/dashboard/change-theme-mode/${ mode }`)

            });

            $("#toggle-notifications").change(function() {

            });
        })
    </script>
@endpush
