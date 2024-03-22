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
                        href="{{ route('dashboard.orders.index') }}"
                        class="text-muted text-hover-primary">{{ __('Orders') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Order data') }}
                    </li>
                    <!-- end   :: Item -->
                </ul>
                <!-- end   :: Breadcrumb -->

            </div>

        </div>

    </div>
    <!-- end   :: Subheader -->

    <!--begin::Order details page-->
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-lg-n2 me-auto">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                        href="#kt_ecommerce_sales_order_summary">{{ __('Order Summary') }}</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                        href="#kt_ecommerce_sales_order_history">{{ __('Order History') }}</a>
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->


            <div class="w-200px">

                <!--begin::Select2-->
                <select class="form-select" data-control="select2" data-hide-search="false" id="order-status-sp"
                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}" data-placeholder="{{ __('Status') }}">
                    @foreach (settings()->getOrdersStatus() ?? [] as $status)
                        <option value="{{ $status['id'] . '_' . $status['name_en'] }}"
                            {{ $status['id'] == $order['status_id'] ? 'selected' : '' }}>
                            {{ $status['name_' . getLocale()] }}</option>
                    @endforeach
                </select>
                <!--end::Select2-->
            </div>
            @can('update_Distribution_of_Orders')
                <div class="w-200px">
                    <select class="form-select" data-control="select2" data-hide-search="false" name="employee_id"
                        id="employee-sp" data-placeholder="{{ __('Assign the employee') }}"
                        data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                        <option value="" selected disabled>{{ __('Assign the employee') }}</option>
                        @foreach ($employees as $employeedat)
                            <option value="{{ $employeedat->id }}" {{ $employee->id == $employeedat->id ? 'selected' : '' }}>
                                {{ $employeedat->name }} </option>
                        @endforeach
                    </select>
                    <p class="invalid-feedback" id="employee_id"></p>

                </div>
            @endcan
            {{-- @endif --}}


        </div>
        <!--begin::Order summary-->
        <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
            <!--begin::Order details-->

            <div class="card card-flush  flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('Order Details') }} ( #{{ $order['id'] }} )</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <span>
                                                <i class="fa fa-calendar mx-2"></i>
                                            </span> {{ __('Date') }}
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ date('Y-m-d', strtotime($order['created_at'])) }}
                                    </td>
                                </tr>
                                <!--end::Date-->
                                <!--begin::Time-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <span>
                                                <i class="fa fa-clock mx-2"></i>
                                            </span> {{ __('Time') }}
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ date('H:i a', strtotime($order['created_at'])) }}
                                    </td>
                                </tr>
                                <!--end::Time-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Order details-->
            <!--begin::Customer details-->
            <div class="card card-flush  flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header d-flex justify-content-between align-items-between">
                    <div class="card-title ">
                        <h2 style="font-weight:bold; ">{{ __('Customer Details') }}</h2>

                    </div>

                    @if ($order['orderDetailsCar']['type'] == 'individual')
                        <div class="ps-4">
                            <a href="https://wa.me/{{ $order['phone'] }}?text={{ urlencode(__('السلام عليكم. موقع كود كار للسيارات يرحب بكم ويسعدنا التواصل معك بخصوص طلبك رقم ' . $order['id'] . ' لسيارة: ' . $order['car_name'] . '')) }}"
                                target="_blank" title="Chat on WhatsApp" class="whatsapp-icon">
                                <img src="{{ asset('dashboard-assets/media/svg/social-logos/whatsapp.svg') }}"
                                    alt="WhatsApp Logo"
                                    style="width:50px; height: 50px; margin-left: 23px; margin-right: 23px;">
                            </a>
                        </div>
                    @else
                        @if ($order['orderDetailsCar']['cars'])
                            @php
                                $carCount = 0;
                            @endphp
                            @foreach (json_decode($order['orderDetailsCar']['cars'], true) as $car)
                                @if (isset($car))
                                    {{-- Here you can put any code related to displaying individual cars --}}
                                    @php
                                        $carCount += $car['count'];
                                    @endphp
                                @endif <!--end::Cars-->
                            @endforeach
                            <div class="ps-4">
                                <a href="https://wa.me/{{ $order['phone'] }}?text={{ urlencode(__('السلام عليكم. موقع كود كار للسيارات يرحب بكم ويسعدنا التواصل معك بخصوص طلبك رقم ' . $order['id'] . ' ' . ' العدد الطلوب' . ' ' . $carCount . ' ' . 'سيارة')) }}"
                                    target="_blank" title="Chat on WhatsApp" class="whatsapp-icon">
                                    <img src="{{ asset('dashboard-assets/media/svg/social-logos/whatsapp.svg') }}"
                                        alt="WhatsApp Logo"
                                        style="width:50px; height: 50px; margin-left: 23px; margin-right: 23px;">
                                </a>
                            </div>
                        @else
                            <a href="https://wa.me/{{ $order['phone'] }}?text={{ urlencode(__('السلام عليكم. موقع كود كار للسيارات يرحب بكم ويسعدنا التواصل معك بخصوص طلبك رقم ' . $order['id'] . ' لسيارة: ' . ' ' . $order['car_name'] . ' ' . 'عدد' . ' ' . $order['orderDetailsCar']['car_count'])) }}"
                                target="_blank" title="Chat on WhatsApp" class="whatsapp-icon">
                                <img src="{{ asset('dashboard-assets/media/svg/social-logos/whatsapp.svg') }}"
                                    alt="WhatsApp Logo"
                                    style="width:50px; height: 50px; margin-left: 23px; margin-right: 23px;">
                            </a>
                        @endif
                    @endif




                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                                <!--begin::Customer name-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <span>
                                                <i class="fa fa-user"></i> {{ __('Customer') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <!--begin::Name-->
                                            <a href=""
                                                class="text-gray-600 text-hover-primary">{{ $order['name'] }}</a>
                                            <!--end::Name-->
                                        </div>
                                    </td>
                                </tr>
                                <!--end::Customer name-->
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z"
                                                        fill="black" />
                                                    <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            {{ __('Phone') }}
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $order['phone'] }}</td>
                                </tr>
                                @if ($order['birth_date'])
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                <span>
                                                    <i class="fa fa-calendar mx-2"></i>
                                                </span>


                                                {{ __('Birth date') }}
                                            </div>
                                        </td>
                                        <td class="fw-bolder text-end">{{ $order['birth_date'] }}</td>
                                    </tr>
                                @endif
                                <!--end::Date-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Customer details-->
        </div>
        <!--end::Order summary-->
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                <!--begin::Orders-->

                @if ($order['type'] == 'car')
                    @if ($order['orderDetailsCar']['type'] == 'individual')
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <!--begin::Product List-->
                            <div class="card card-flush  flex-row-fluid overflow-hidden">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Order') }} #{{ $order['id'] . ' ' }} </h2>
                                    </div>
                                    <div class="card-title">
                                        <h2>{{ __('Order Type') . ' : ' }}
                                            {{ __(ucfirst($order['orderDetailsCar']['type'])) . ' ' }} </h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <!--begin::Table body-->
                                            <tbody class="fw-bold text-gray-600">
                                                <tr>
                                                    <td class="text-start fw-boldest" colspan="4">{{ __('Car') }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end align-items-center">
                                                            @if ($order->car)
                                                                <!--begin::Thumbnail-->
                                                                <a href="/dashboard/cars/{{ $order['car_id'] }}"
                                                                    class="symbol symbol-50px">
                                                                    <img src="{{ getImagePathFromDirectory($order->car->main_image, 'Cars') }}"
                                                                        alt="Car Image" class="symbol-label">
                                                                </a>
                                                                <div class="ms-5">
                                                                    <a href="/dashboard/cars/{{ $order['car_id'] }}"
                                                                        target="_blank"
                                                                        class="fw-boldest text-gray-600 text-hover-primary">{{ $order['car_name'] }}</a>
                                                                </div>
                                                            @else
                                                                <div class="ms-5">
                                                                    <a href="#"
                                                                        class="fw-boldest text-gray-600 text-hover-primary">{{ $order['car_name'] }}</a>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-boldest">{{ __('Price') }}</td>
                                                    <td class="text-end fw-boldest" colspan="4">
                                                        {{ $order['price'] . ' ' . currency() }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-boldest">{{ __('Payment Type') }}</td>
                                                    <td class="text-end fw-boldest" colspan="4">
                                                        {{ __(ucfirst($order['orderDetailsCar']['payment_type'])) }}
                                                    </td>
                                                </tr>
                                                @if ($order['orderDetailsCar']['payment_type'] == 'finance')
                                                    @if ($order['orderDetailsCar']['work'])
                                                        <tr>
                                                            <td class="fw-boldest">{{ __('Work') }}</td>
                                                            <td class="text-end fw-boldest" colspan="4">
                                                                {{ $order['orderDetailsCar']['work'] }}</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('Salary') }}</td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $order['orderDetailsCar']['salary'] . ' ' . currency() }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('Commitments') }}</td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $order['orderDetailsCar']['commitments'] . ' ' . currency() }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('Is there a mortgage loan') }}
                                                        </td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $order['orderDetailsCar']['having_loan'] ? __('Yes') : __('No') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-boldest" style="font-weight:900">
                                                            {{ __('Max limit to monthely installment') . ' ' }}
                                                        </td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $approve_amount . ' ' . currency() }}
                                                        </td>
                                                    </tr>
                                                    @if ($order['orderDetailsCar']['driving_license'])
                                                        <tr>
                                                            <td class="fw-boldest">{{ __('Driving License Status') }}</td>
                                                            <td class="text-end fw-boldest" colspan="4">
                                                                {{ __(str_replace('_', ' ', $order['orderDetailsCar']['driving_license'])) }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('The last installment') }}</td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $order['orderDetailsCar']['last_installment'] }} %
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('The last installment amount') }}
                                                        </td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $order['orderDetailsCar']['last_payment_value'] . ' ' . currency() }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('The first installment') }}</td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $order['orderDetailsCar']['first_installment'] }} %
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('The first installment amount') }}
                                                        </td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $order['orderDetailsCar']['first_payment_value'] . ' ' . currency() }}
                                                        </td>
                                                    </tr>

                                                    @if ($order['orderDetailsCar']['bank'])
                                                        <tr>
                                                            <td class="fw-boldest">{{ __('Bank') }}</td>
                                                            <td class="text-end fw-boldest" colspan="4">
                                                                {{ $order['orderDetailsCar']['bank']['name'] }}</td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            </tbody>
                                            <!--end::Table head-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Product List-->
                        </div>
                    @else
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <!--begin::Product List-->
                            <div class="card card-flush  flex-row-fluid overflow-hidden">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Order') }} #{{ $order['id'] . ' ' }} </h2>
                                    </div>
                                    <div class="card-title">
                                        <h2>{{ __('Order Type') . ' : ' }}
                                            {{ __(ucfirst($order['orderDetailsCar']['type'])) . ' ' }} </h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">

                                            <!--begin::Table body-->
                                            <tbody class="fw-bold text-gray-600">
                                                <!--begin::Cars-->
                                                @if ($order['orderDetailsCar']['cars'])
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr
                                                            class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="min-w-175px fw-boldest">{{ __('Car') }}
                                                            </th>
                                                            <th class="min-w-70px text-end fw-boldest" colspan="4">
                                                                {{ __('Quantity') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <!--end::Table head-->
                                                    @foreach (json_decode($order['orderDetailsCar']['cars'], true) as $car)
                                                        @if (isset($car))
                                                            <tr class="p-5">
                                                                <td class="text-start fw-boldest">
                                                                    {{ $car['car_name'] }}
                                                                </td>
                                                                <td class="text-end fw-boldest" colspan="4">
                                                                    {{ $car['count'] . ' ' . __('car') }}</td>
                                                            </tr>
                                                        @endif <!--end::Cars-->
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="text-start fw-boldest" colspan="4">
                                                            {{ __('Car') }}
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-end align-items-center">
                                                                @if ($order->car)
                                                                    <!--begin::Thumbnail-->
                                                                    <a href="/dashboard/cars/{{ $order['car_id'] }}"
                                                                        class="symbol symbol-50px">
                                                                        <img src="{{ getImagePathFromDirectory($order->car->main_image, 'Cars') }}"
                                                                            alt="Car Image" class="symbol-label">
                                                                    </a>
                                                                    <div class="ms-5">
                                                                        <a href="/dashboard/cars/{{ $order['car_id'] }}"
                                                                            target="_blank"
                                                                            class="fw-boldest text-gray-600 text-hover-primary">{{ $order['car_name'] }}</a>
                                                                    </div>
                                                                @else
                                                                    <div class="ms-5">
                                                                        <a href="#"
                                                                            class="fw-boldest text-gray-600 text-hover-primary">{{ $order['car_name'] }}</a>
                                                                    </div>
                                                                @endif

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if (!$order['orderDetailsCar']['cars'])
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('Price') }}</td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $order['price'] . ' ' . currency() }}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td class="fw-boldest">{{ __('Payment Type') }}</td>
                                                    <td class="text-end fw-boldest" colspan="4">
                                                        {{ __(ucfirst($order['orderDetailsCar']['payment_type'])) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-boldest">{{ __('Organization Name') }}</td>
                                                    <td class="text-end fw-boldest" colspan="4">
                                                        {{ $order['orderDetailsCar']['organization_name'] }}</td>
                                                </tr>
                                                @if ($order['orderDetailsCar']['organization_email'])
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('Organization Email') }}</td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $order['orderDetailsCar']['organization_email'] }}</td>
                                                    </tr>
                                                @endif
                                                @if ($organization_activity)
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('Organization Activity') }}
                                                        </td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $organization_activity->title }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($organization_type->title)
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('Organization Type') }}</td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $organization_type->title }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td class="fw-boldest">{{ __('Organization Age') }}</td>
                                                    <td class="text-end fw-boldest" colspan="4">
                                                        {{ $order['orderDetailsCar']['organization_age'] . ' ' . __('Years') }}
                                                    </td>
                                                </tr>
                                                @if ($order['orderDetailsCar']['car_count'])
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('Cars Count') }}</td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $order['orderDetailsCar']['car_count'] . ' ' . __('Cars') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($order['orderDetailsCar']['bank'])
                                                    <tr>
                                                        <td class="fw-boldest">{{ __('Bank') }}</td>
                                                        <td class="text-end fw-boldest" colspan="4">
                                                            {{ $order['orderDetailsCar']['bank']['name'] }}</td>
                                                    </tr>
                                                @endif
                                                @if ($order['orderDetailsCar']['payment_type'] == 'finance')
                                                    @if ($order['orderDetailsCar']['organization_location'])
                                                        <tr>
                                                            <td class="fw-boldest">
                                                                {{ __("The company's headquarter") }}
                                                            </td>
                                                            <td class="text-end fw-boldest" colspan="4">
                                                                {{ $order['orderDetailsCar']['organization_location'] }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            </tbody>
                                            <!--end::Table head-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Product List-->
                        </div>
                    @endif
                @else
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Product List-->
                        <div class="card card-flush flex-row-fluid overflow-hidden">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ __('Order') }} #{{ $order['id'] . ' ' }} </h2>
                                </div>
                                <div class="card-title">
                                    <h2>{{ __('Order Type') . ' : ' }}
                                        {{ __(str_replace('_', ' ', $order['type'])) . ' ' }} </h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                        <!--begin::Table body-->
                                        <tbody class="fw-bold text-gray-600">
                                            <tr>
                                                <td class="text-start fw-boldest" colspan="4">{{ __('Car name') }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <!--be  gin::Title-->
                                                        <div class="ms-5">
                                                            <a href="#"
                                                                class="fw-boldest text-gray-600 text-hover-primary">{{ $order['car_name'] }}</a>
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-boldest">{{ __('City') }}</td>
                                                <td class="text-end fw-boldest" colspan="4">
                                                    {{ $order['city']['name'] }}</td>
                                            </tr>
                                        </tbody>
                                        <!--end::Table head-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Product List-->
                    </div>


                @endif
                <!--end::Orders-->
            </div>
            <!--end::Tab pane-->
            <!--begin::Tab pane-->
            <div class="tab-pane fade" id="kt_ecommerce_sales_order_history" role="tab-panel">
                <!--begin::Orders-->
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <!--begin::Order history-->
                    <div class="card card-flush  flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Order History') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle text-center table-row-dashed fs-6 gy-5 mb-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-70px">{{ __('Order Status') }}</th>
                                            <th class="min-w-175px">{{ __('Comment') }}</th>
                                            <th class="min-w-100px">{{ __('employee') }}</th>
                                            <th class="min-w-100px">{{ __('assign to') }}</th>
                                            <th class="min-w-100px">{{ __('Date') }}</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">

                                        @foreach ($order->statusHistory as $record)
                                            @php($statusObj = getStatusObject($record['status']))

                                            <tr>

                                                <td>
                                                    <div class="badge"
                                                        style="background-color:{{ $statusObj['color'] }}">
                                                        {{ $statusObj['name_' . getLocale()] }}</div>
                                                </td>

                                                <td>{{ $record['comment'] ?? '-' }}</td>
                                                <td>{{ $record['employee']['name'] }}</td>

                                                <td>{{ $record['assign']['name'] ?? '-' }}</td>

                                                <td>
                                                    {{ date('Y-m-d', strtotime($record['created_at'])) . ' / ' . date('H:i a', strtotime($record['created_at'])) }}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <!--end::Table head-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Order history-->
                </div>
                <!--end::Orders-->
            </div>
            <!--end::Tab pane-->
        </div>
        <!--end::Tab content-->
    </div>
    <!-- Assuming you are using Bootstrap that comes with Metronic -->
    @if ($order['identity_Card'] || $order['License_Card'] || $order['Hr_Letter_Image'] || $order['Insurance_Image'])
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div style="text-align: center; margin-bottom:30px">
                        <h5 class="card-title">{{ __('Download Documents') }}</h5>
                        <p class="card-text">{{ __('Click on the buttons below to download your documents') }}.</p>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        @if ($order['identity_Card'])
                            <a href="{{ route('dashboard.files.download', $order['identity_Card']) }}"
                                class="btn btn-success me-md-2" target="_blank">
                                <i class="bi bi-file-earmark-arrow-down"></i> {{ __('Download Identity Card') }}
                            </a>
                        @endif
                        @if ($order['License_Card'])
                            <a href="{{ route('dashboard.files.download', $order['License_Card']) }}"
                                class="btn btn-info me-md-2" target="_blank">
                                <i class="bi bi-file-earmark-arrow-down"></i>{{ __('Download Identity License Card') }}
                            </a>
                        @endif
                        @if ($order['Hr_Letter_Image'])
                            <a href="{{ route('dashboard.files.download', $order['Hr_Letter_Image']) }}"
                                class="btn btn-warning me-md-2" target="_blank">
                                <i class="bi bi-file-earmark-arrow-down"></i>{{ __('Download License Hr Letter Image') }}
                            </a>
                        @endif
                        @if ($order['Insurance_Image'])
                            <a href="{{ route('dashboard.files.download', $order['Insurance_Image']) }}"
                                class="btn btn-primary me-md-2" target="_blank">
                                <i class="bi bi-file-earmark-arrow-down"></i> {{ __('Download Insurance Image') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    @endif


    <!--end::Order details page-->
@endsection
@push('styles')
    <style>
        .card-header {
            background-color: rgb(0, 74, 111) !important;
        }

        .card-header h2 {
            color: white !important;
            font-weight: bold;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $('#order-status-sp').change(function() {

            let newStatus = $(this).val();
            let comment = '';

            inputAlert().then((result) => {

                comment = result.value[0] || '';

                if (result.isConfirmed) {
                    $.ajax({
                        url: "/dashboard/change-status/" + "{{ $order['id'] }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        data: {
                            status: newStatus,
                            comment
                        },
                        success: (response) => {
                            successAlert('{{ __('status has been changed successfully') }}')
                                .then(() => window.location.reload())
                        },
                        error: (error) => {
                            console.log(error)
                        },

                    });
                }

            });


        });
    </script>
    <script>
        $('#employee-sp').change(function() {
            let employee_id = $(this).val();
            let comment = '';

            inputAlert().then((result) => {

                comment = result.value[0] || '';

                if (result.isConfirmed) {
                    $.ajax({
                        url: "/dashboard/assigntoemployee/" + "{{ $order['id'] }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        data: {
                            employee_id: employee_id,
                            comment
                        },
                        success: (response) => {
                            successAlert(
                                    '{{ __('employees has been changed successfully') }}')
                                .then(() => window.location.reload())
                        },
                        error: (error) => {
                            console.log(error)
                        },

                    });
                }

            });


        });
    </script>
@endpush
