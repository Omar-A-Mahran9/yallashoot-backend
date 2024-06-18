\<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">

        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="black" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">

                @can('view_continents')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('continent') }}" href="{{ route('dashboard.continent.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-globe"></i>
                            </span>
                            <span class="menu-title"> {{ __('continents') }}</span>
                        </a>
                    </div>
                @endcan
                @can('view_countries')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('country') }}" href="{{ route('dashboard.country.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-flag"></i>
                            </span>
                            <span class="menu-title"> {{ __('countries') }}</span>
                        </a>
                    </div>
                @endcan
                @can('view_coaches')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('coache') }}" href="{{ route('dashboard.coache.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fas fa-user-tie"></i>
                            </span>
                            <span class="menu-title"> {{ __('coaches') }}</span>
                        </a>
                    </div>
                @endcan
                @can('view_team')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('team') }}" href="{{ route('dashboard.team.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-users"></i>
                            </span>
                            <span class="menu-title"> {{ __('Teams') }}</span>
                        </a>
                    </div>
                @endcan
                @can('view_players')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('player') }}" href="{{ route('dashboard.player.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-child"></i>
                            </span>
                            <span class="menu-title"> {{ __('players') }}</span>
                        </a>
                    </div>
                @endcan
                @can('view_playground')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('playground') }}"
                            href="{{ route('dashboard.playground.index') }}" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-building"></i>
                            </span>
                            <span class="menu-title"> {{ __('playgrounds') }}</span>
                        </a>
                    </div>
                @endcan
                @can('view_channel')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('channel') }}" href="{{ route('dashboard.channel.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fas fa-check-circle"></i>
                            </span>
                            <span class="menu-title">
                                {{ __('channels') }}</span>
                        </a>
                    </div>
                @endcan

                @can('view_league')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('league') }}" href="{{ route('dashboard.league.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-futbol"></i>
                            </span>
                            <span class="menu-title"> {{ __('League') }}</span>
                        </a>
                    </div>
                @endcan
                @can('view_games')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('games') }}" href="{{ route('dashboard.games.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-gamepad"></i>
                            </span>
                            <span class="menu-title"> {{ __('games') }}</span>
                        </a>
                    </div>
                @endcan
                @can('view_news')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('news') }}" href="{{ route('dashboard.news.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-newspaper"></i>
                            </span>
                            <span class="menu-title"> {{ __('News') }}</span>
                        </a>
                    </div>
                @endcan

                @can('view_contact_us')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('contact-us') }}"
                            href="{{ route('dashboard.contact-us.index') }}" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fas fa-comments"></i>
                            </span>
                            <span class="menu-title"> {{ __('ContactUs us') }}</span>
                        </a>
                    </div>
                @endcan

                @can('view_news_subscribers')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('news-subscribers') }}"
                            href="{{ route('dashboard.news-subscribers.index') }}" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fas fa-newspaper"></i>
                            </span>
                            <span class="menu-title"> {{ __('News Subscribers') }}</span>
                        </a>
                    </div>
                @endcan

                <!-- end   :: vendors section -->

                <!-- start :: finance approvals -->
                {{-- @canany(['view_finance_approvals'])
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-0">
                            <span
                                class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('Finance approvals') }}</span>
                        </div>
                    </div>
                @endcanany

                @can('view_finance_approvals')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('finance-approvals') }}"
                            href="{{ route('dashboard.finance-approvals.index') }}" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-file"></i>
                            </span>
                            <span class="menu-title"> {{ __('Finance approvals') }}</span>
                        </a>
                    </div>
                @endcan --}}
                <!-- end :: finance approvals -->

                {{-- @canany(['view_careers', 'view_news', 'view_faq', 'view_services', 'view_offers'])
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-0">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('Website') }}</span>
                        </div>
                    </div>
                @endcanany

                @can('view_careers')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('careers') }}" href="{{ route('dashboard.careers.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-briefcase"></i>
                            </span>
                            <span class="menu-title"> {{ __('Careers') }}</span>
                        </a>
                    </div>
                @endcan --}}



                {{-- 
                @can('view_faq')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('faqs') }}" href="{{ route('dashboard.faqs.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-question-circle"></i>
                            </span>
                            <span class="menu-title"> {{ __('FAQ') }}</span>
                        </a>
                    </div>
                @endcan --}}
                {{-- 

                @can('view_offers')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('offers') }}" href="{{ route('dashboard.offers.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-gifts"></i>
                            </span>
                            <span class="menu-title"> {{ __('Offers') }}</span>
                        </a>
                    </div>
                @endcan


                @canany(['view_cities', 'view_branches', 'view_banks', 'view_roles', 'view_employees', 'view_settings'])
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-0">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('Settings') }}</span>
                        </div>
                    </div>
                @endcanany


                @can('view_cities')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('cities') }}" href="{{ route('dashboard.cities.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-city"></i>
                            </span>
                            <span class="menu-title"> {{ __('Cities') }}</span>
                        </a>
                    </div>
                @endcan

                @can('view_branches')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('branches') }}"
                            href="{{ route('dashboard.branches.index') }}" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-building"></i>
                            </span>
                            <span class="menu-title"> {{ __('Branches') }}</span>
                        </a>
                    </div>
                @endcan

                @can('view_Financing_companies')
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link--><span class="menu-link"><span class="menu-icon"><i
                                    class="bi bi-coin"></i><span class="path1"></span><span
                                    class="path2"></span></i></span><span
                                class="menu-title">{{ __('Financing institutions') }}</span><span
                                class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion" kt-hidden-height="543"
                            style="display: none; overflow: hidden;"><!--begin:Menu item-->
                            <div class="menu-item">
                                <a class="menu-link {{ isTabActive('banks') }}"
                                    href="{{ route('dashboard.banks.index') }}" data-bs-toggle="tooltip"
                                    data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                    <span class="menu-icon">
                                        <i class="bi bi-bank"></i>
                                    </span>
                                    <span class="menu-title"> {{ __('Banks') }}</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ isTabActive('finance') }}"
                                    href="{{ route('dashboard.financeing.index') }}" data-bs-toggle="tooltip"
                                    data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                    <span class="menu-icon">
                                        <i class="fas fa-money-bill"></i>
                                    </span>
                                    <span class="menu-title"> {{ __('Financing companies') }}</span>
                                </a>
                            </div>
                        @endcan <!--end:Menu item--><!--begin:Menu item-->

                    </div><!--end:Menu sub-->
                </div> --}}
                {{-- 
                @can('view_banks')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('banks') }}"
                            href="{{ route('dashboard.bank_offers.index') }}" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="bi bi-bank"></i>
                            </span>
                            <span class="menu-title"> {{ __('banks-offers') }}</span>
                        </a>
                    </div>
                @endcan --}}

                @can('view_roles')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('roles') }}" href="{{ route('dashboard.roles.index') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-lock"></i>
                            </span>
                            <span class="menu-title"> {{ __('Roles') }}</span>
                        </a>
                    </div>
                @endcan

                @can('view_employees')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('employees') }}"
                            href="{{ route('dashboard.employees.index') }}" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fa fa-user-shield"></i>
                            </span>
                            <span class="menu-title"> {{ __('Employees') }}</span>
                        </a>
                    </div>
                @endcan
                {{-- @can('view_delegates')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('delegates') }}"
                            href="{{ route('dashboard.delegates.index') }}" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon">
                                <!-- <i class="fa fa-user-shield"></i> -->
                                <i class="fa fa-user-tie"></i>
                            </span>
                            <span class="menu-title"> {{ __('Delegates') }}</span>
                        </a>
                    </div>
                @endcan --}}
                @can('view_settings')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('settings') }}"
                            href="{{ route('dashboard.settings.index') }}" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="bi bi-gear-fill"></i>
                            </span>
                            <span class="menu-title"> {{ __('Settings') }}</span>
                        </a>
                    </div>
                @endcan

                {{-- @can('view_recycle_bin')
                    <div class="menu-item">
                        <a class="menu-link {{ isTabActive('trash') }}" href="{{ route('dashboard.trash') }}"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="menu-title"> {{ __('Recycle Bin') }}</span>
                        </a>
                    </div>
                @endcan --}}


            </div>
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Aside menu-->
</div>
