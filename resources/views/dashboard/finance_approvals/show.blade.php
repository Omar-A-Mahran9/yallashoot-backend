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
                        href="{{ route('dashboard.finance-approvals.index') }}"
                        class="text-muted text-hover-primary">{{ __('Finance approvals') }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __('Finance approvals') }}
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
            <form class="form">
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">
                        {{ __('Finance approvals') . ' : ' . $financeApproval->order->car_name }}</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">
                    <div class="order-detail">
                        <input type="hidden" name="order_id" id="order_id_inp">
                        <!-- begin :: Row -->
                        <div class="row mb-3">
                            <div class="col-md-6 fv-row">
                                <div class="mb-3 d-flex">
                                    <h4 class="fw-bold">{{ __('Client name') }} :</h4>
                                    <h5 id="client_name" class="mb-0">{{ $financeApproval->order->name }}</h5>
                                </div>
                                <div class="mb-3 d-flex">
                                    <h4 class="fw-bold">{{ __('Phone') }} :</h4>
                                    <h5 id="phone_inp" class="mb-0">{{ $financeApproval->order->phone }}</h5>
                                </div>
                                <div class="mb-3 d-flex">
                                    <h4 class="fw-bold d-flex">{{ __('City') }} :</h4>
                                    <h5 id="city_inp" class="mb-0">{{ $financeApproval->order->city->name }}</h5>
                                </div>
                                <div class="mb-3 d-flex">
                                    <h4 class="fw-bold d-flex">{{ __('Order number') }} :</h4>
                                    <h5 id="city_inp" class="mb-0">{{ $financeApproval->order->id }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="mb-3 d-flex">
                                    <h4 class="fw-bold">{{ __('Financing entity') }} : </h4>
                                    <h5 id="financing_entity_inp" class="mb-0">
                                        {{ $financeApproval->order['orderDetailsCar']->bank->name ?? __($financeApproval->order['orderDetailsCar']->payment_type) }}
                                    </h5>
                                </div>
                                <div class="mb-3 d-flex">
                                    <h4 class="fw-bold">{{ __('Car name') }} : </h4>
                                    <h5 id="car_name_inp" class="mb-0">
                                        {{ $financeApproval->order->car->name }}
                                    </h5>
                                </div>
                                <div class="mb-3 d-flex">
                                    <h4 class="fw-bold">{{ __('Car color') }} : </h4>
                                    <h5 id="car_color_inp" class="mb-0">
                                        {{ $financeApproval->order->car->color->name }}
                                    </h5>
                                </div>
                                <div class="mb-3 d-flex">
                                    <h4 class="fw-bold d-flex">{{ __('Order Type') }} :</h4>
                                    <h5 id="order_type" class="mb-0">
                                        {{ __($financeApproval->order['orderDetailsCar']->type) }}</h5>
                                </div>
                            </div>
                            <!-- begin :: Column -->
                            <div class="col-md-2 fv-row">
                                @if ($financeApproval->order->bank)
                                    {{-- <label class="fs-5 fw-bold mb-2">{{ __('Client name') }}</label> --}}
                                    <div class="form-floating">
                                        <input type="text" class="form-control form-control-solid" id="client_name_inp"
                                            name="" hidden value="{{ $financeApproval->order->name }}"
                                            placeholder="example" disabled readonly />
                                    </div>
                                @endif
                            </div>
                            <!-- end   :: Column -->
                            <!-- begin :: Column -->
                            <div class="col-md-2 fv-row">

                                {{-- <label class="fs-5 fw-bold mb-2">{{ __('Phone') }}</label> --}}
                                <div class="form-floating">
                                    <input type="text" hidden class="form-control  form-control-solid" id="phone"
                                        value="{{ $financeApproval->order->phone }}" name="" placeholder="example"
                                        disabled readonly>
                                </div>
                                {{-- <p class="invalid-feedback" id="name_en"></p> --}}

                            </div>
                            <!-- end   :: Column -->
                            <!-- begin :: Column -->
                            <div class="col-md-2 fv-row">

                                {{-- <label class="fs-5 fw-bold mb-2">{{ __('City') }}</label> --}}
                                <div class="form-floating">
                                    <input type="text" hidden class="form-control form-control-solid" id="city"
                                        name="" value="{{ $financeApproval->order->city->name }}"
                                        placeholder="example" disabled readonly>
                                </div>

                            </div>
                            <!-- end   :: Column -->
                            <!-- begin :: Column -->
                            <div class="col-md-2 fv-row">
                                @if ($financeApproval->order->bank)
                                    {{-- <label class="fs-5 fw-bold mb-2">{{ __('Financing entity') }}</label> --}}
                                    <div class="form-floating">
                                        <input type="text" hidden class="form-control form-control-solid"
                                            value="{{ $financeApproval->order->bank->name }}" hidden id="financing_entity"
                                            name="" placeholder="example" disabled readonly>
                                    </div>
                                @endif
                            </div>
                            <!-- end   :: Column -->

                            <!-- begin :: Column -->
                            <div class="col-md-2 fv-row">

                                {{-- <label class="fs-5 fw-bold mb-2">{{ __('Car name') }}</label> --}}
                                <div class="form-floating">
                                    <input type="text" hidden class="form-control form-control-solid" id="car_name"
                                        name="" value="{{ $financeApproval->order->car->name }}"
                                        placeholder="example" disabled readonly>
                                </div>

                            </div>
                            <!-- end   :: Column -->
                            <!-- begin :: Column -->
                            <div class="col-md-2 fv-row">

                                {{-- <label class="fs-5 fw-bold mb-2">{{ __('Car color') }}</label> --}}
                                <div class="form-floating">
                                    <input type="text" hidden class="form-control form-control-solid" id="car_color"
                                        value="{{ $financeApproval->order->car->color->name }}" name=""
                                        placeholder="example" disabled readonly>
                                </div>


                            </div>


                        </div>
                        <!-- end   :: Row -->
                        <hr>
                        <div class="row mb-10">
                            <!-- begin :: Column -->
                            <div class="col-md-12 fv-row text-center">

                                <label class="fs-5 fw-bold mb-2">{{ __('Approval date') }}</label>
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input class="form-control form-control-solid    me-4" name="approval_date"
                                            placeholder="{{ __('Enter the approval date') }}"
                                            value="{{ $financeApproval->approval_date }}" data-filter-index="4"
                                            disabled />
                                    </div>
                                </div>
                                <p class="invalid-feedback" id="approval_date"></p>
                            </div>
                        </div>
                        <hr style="border-top: 2px solid #000; font-weight: bold;">
                        <div class="d-flex">
                            <div class="col-md-9">

                                <!-- begin :: Row -->
                                <div class="row mb-10">

                                    <!-- end   :: Column -->
                                    <!-- begin :: Column -->
                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Approval amount') }}</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control form-control-solid"
                                                id="approval_amount_inp" name="approval_amount"
                                                value="{{ $financeApproval->approval_amount }}" placeholder=""
                                                readonly />
                                            <label for="approval_date_inp">{{ __('Enter the approval amount') }}</label>
                                        </div>
                                        <p class="invalid-feedback" id="approval_amount"></p>

                                    </div>
                                    <!-- end   :: Column -->


                                    <!-- end   :
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                : Column -->
                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Tax discount') }}
                                            {{ settings()->getSettings('maintenance_mode') == 1 ? settings()->getSettings('tax') : 0 }}
                                            %</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control form-control-solid"
                                                id="tax_discount_inp" name="tax_discount"
                                                value="{{ $financeApproval->tax_discount }}" placeholder="" readonly />
                                            {{-- <!-- <label for="name_en_inp">{{ __('Enter the tax discount') }}</label> --> --}}
                                        </div>
                                        <p class="invalid-feedback" id="tax_discount"></p>

                                    </div>
                                    <!-- end   :: Column -->

                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Plate no cost') }}</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control plate_no_cost"
                                                id="plate_no_cost_inp" name="plate_no_cost"
                                                value="{{ $financeApproval->plate_no_cost }}" placeholder="example"
                                                disabled />
                                            <label for="plate_no_cost_inp">{{ __('Enter the plate no cost') }}</label>
                                        </div>
                                        <p class="invalid-feedback" id="plate_no_cost"></p>

                                    </div>


                                </div>
                                <!-- end   :: Row -->
                                <!-- begin :: Row -->
                                <div class="row mb-10 ">
                                    <!-- begin :: Column -->
                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Cashback percent') }} %</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="cashback_percent_inp"
                                                name="cashback_percent" value="{{ $financeApproval->cashback_percent }}"
                                                placeholder="example" disabled />
                                            <label
                                                for="cashback_percent_inp">{{ __('Enter the cashback percent') }}</label>
                                        </div>
                                        <p class="invalid-feedback" id="cashback_percent"></p>


                                    </div>
                                    <!-- end   :: Column -->

                                    <!-- begin :: Column -->
                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Cashback amount') }}</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control form-control-solid"
                                                id="cashback_amount_inp" value="{{ $financeApproval->cashback_amount }}"
                                                name="cashback_amount" placeholder="" readonly />
                                            <!-- <label for="cashback_amount_inp">{{ __('Enter the cashback amount') }}</label> -->
                                        </div>
                                        <p class="invalid-feedback" id="cashback_amount"></p>


                                    </div>
                                    <!-- end   :: Column -->
                                    <!-- begin :: Column -->
                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Delivery cost') }}</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control calculate-profit"
                                                id="delivery_cost_inp" name="delivery_cost"
                                                value="{{ $financeApproval->delivery_cost }}" placeholder="example"
                                                disabled />
                                            <label for="delivery_cost_inp">{{ __('Enter the delivery cost') }}</label>
                                        </div>
                                        <p class="invalid-feedback" id="delivery_cost"></p>

                                    </div>
                                    <!-- end   :: Column -->

                                    <!-- begin :: Column -->
                                    <div class="col-md-4 fv-row">

                                        {{-- <label class="fs-5 fw-bold mb-2">{{ __('Cost') }}</label> --}}
                                        <div class="form-floating">
                                            <input type="text" hidden class="form-control calculate-profit"
                                                id="cost_inp" name="cost" value="{{ $financeApproval->cost }}"
                                                placeholder="example" disabled />
                                            {{-- <label for="cost_inp">{{ __('Enter the cost') }}</label> --}}
                                        </div>
                                        {{-- <p class="invalid-feedback" id="cost"></p> --}}

                                    </div>


                                </div>
                                <!-- end   :: Row -->
                                <!-- begin :: Row -->
                                <div class="row mb-10">

                                    <!-- begin :: Column -->
                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Discount percent') }} %</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="discount_percent_inp"
                                                name="discount_percent" value="{{ $financeApproval->discount_percent }}"
                                                placeholder="example" disabled />
                                            <label
                                                for="discount_percent_inp">{{ __('Enter the discount percent') }}</label>
                                        </div>
                                        <p class="invalid-feedback" id="discount_percent"></p>
                                    </div>
                                    <!-- end   :: Column -->
                                    <!-- begin :: Column -->
                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Discount amount') }}</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control form-control-solid"
                                                id="discount_amount_inp" value="{{ $financeApproval->discount_amount }}"
                                                name="discount_amount" placeholder="" readonly />
                                            <!-- <label for="discount_amount_inp">{{ __('Enter the discount amount') }}</label> -->
                                        </div>
                                        <p class="invalid-feedback" id="discount_amount"></p>

                                    </div>
                                    <!-- end   :: Column -->
                                    <!-- begin :: Column -->
                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Insurance cost') }}</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control calculate-profit"
                                                id="insurance_cost_inp" value="{{ $financeApproval->insurance_cost }}"
                                                name="insurance_cost" placeholder="example" disabled />
                                            <label for="insurance_cost_inp">{{ __('Enter the insurance cost') }}</label>
                                        </div>
                                        <p class="invalid-feedback" id="insurance_cost"></p>


                                    </div>
                                    <!-- end   :: Column -->

                                </div>
                                <!-- end   :: Row -->
                                <!-- begin :: Row -->
                                <div class="row mb-10 ">
                                    <!-- begin :: Column -->
                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Delegate') }}</label>
                                        <select class="form-select" data-control="select2" name="delegate_id"
                                            id="delegate_id_sp" data-placeholder="{{ __('Choose the delegate') }}"
                                            data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}" disabled>
                                            <!-- <option > {{ __('Choose the delegate') }} </option> -->

                                            @foreach ($delegates as $delegate)
                                                <option value="{{ $delegate->id }}"
                                                    {{ $delegate->id === $financeApproval->delegate_id ? 'selected' : '' }}>
                                                    {{ $delegate->name }} </option>
                                            @endforeach
                                        </select>

                                        <p class="invalid-feedback" id="delegate_id"></p>

                                    </div>
                                    <!-- end   :: Column -->
                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Commission') }}</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control calculate-profit"
                                                id="commission_inp" name="commission"
                                                value="{{ $financeApproval->commission }}" placeholder="example"
                                                disabled />
                                            <label for="commission_inp">{{ __('Enter the commission') }}</label>
                                        </div>
                                        <p class="invalid-feedback" id="commission"></p>


                                    </div>

                                    <!-- begin :: Column -->
                                    <div class="col-md-4 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Extra details') }}</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control calculate-profit"
                                                id="extra_details_inp" value="{{ $financeApproval->extra_details }}"
                                                name="extra_details" placeholder="example" disabled />
                                            <label for="extra_details_inp">{{ __('Enter the extra details') }}</label>
                                        </div>
                                        <p class="invalid-feedback" id="extra_details"></p>
                                    </div>
                                    <!-- end   :: Column -->

                                    <!-- begin :: Column -->
                                    <div class="col-md-4 fv-row">
                                        {{-- <label class="fs-5 fw-bold mb-2">{{ __('Profit') }}</label> --}}
                                        <div class="form-floating">
                                            <input type="text" hidden class="form-control form-control-solid"
                                                id="profit_inp" value="{{ $financeApproval->profit }}" name="profit"
                                                placeholder="" readonly />
                                        </div>
                                        {{-- <p class="invalid-feedback" id="profit"></p> --}}
                                    </div>
                                    <!-- end   :: Column -->
                                </div>
                                <div class="row mb-10 ">
                                    <!-- begin :: Column -->
                                    <div class="col-md-12 fv-row text-center">
                                        @if (
                                            $financeApproval->order['orderDetailsCar']->type == 'organization' &&
                                                $financeApproval->order['orderDetailsCar']->payment_type == 'cash')
                                            <label class="fs-5 fw-bold mb-2">{{ __('Main cars cost') }}</label>
                                        @else
                                            <label class="fs-5 fw-bold mb-2">{{ __('Main car cost') }}</label>
                                        @endif

                                        <div class="form-floating">
                                            <input type="number" min="1" class="form-control text-center"
                                                id="Main_car_cost_inp" name="Main_car_cost"
                                                value="{{ $financeApproval->Main_car_cost }}" placeholder="example"
                                                disabled />
                                            @if (
                                                $financeApproval->order['orderDetailsCar']->type == 'organization' &&
                                                    $financeApproval->order['orderDetailsCar']->payment_type == 'cash')
                                                <label for="Main_car_cost">{{ __('Enter the main cars cost') }}</label>
                                            @else
                                                <label for="Main_car_cost">{{ __('Enter the main car cost') }}</label>
                                            @endif
                                        </div>
                                        <p class="invalid-feedback" id="Main_car_cost"></p>
                                    </div>
                                    <!-- end   :: Column -->
                                    <!-- begin :: Column -->
                                    <div class="col-md-3 fv-row">

                                        {{-- <label class="fs-5 fw-bold mb-2">{{ __('Cost') }}</label> --}}
                                        <div class="form-floating">
                                            <input type="text" hidden class="form-control calculate-profit"
                                                id="cost_inp" name="cost" value='0' placeholder="example" />
                                            {{-- <label for="cost_inp">{{ __('Enter the cost') }}</label> --}}
                                        </div>
                                        {{-- <p class="invalid-feedback" id="cost"></p> --}}

                                    </div>
                                    <!-- end   :: Column -->
                                </div>
                            </div>
                            <!-- end :: Row -->
                            <div class="col-md-3 text-center d-flex align-items-center justify-content-center">
                                <!-- begin :: Column -->
                                <div class="col-md-12 fv-row">
                                    {{-- <label class="fs-5 fw-bold mb-2">{{ __('Profit') }}</label> --}}
                                    <div class="form-floating">
                                        <div>
                                            <h4>{{ __('Profit') }}</h4>
                                            <h1 id='result' style="color: green; font-weight: bold;">
                                                {{ $financeApproval->profit }}</h1>
                                        </div>
                                        <input hidden type="text" class="form-control form-control-solid"
                                            id="profit_inp" name="profit" value="{{ $financeApproval->profit }}"
                                            placeholder="" readonly />
                                    </div>
                                    <p class="invalid-feedback" id="profit"></p>
                                </div>
                                <!-- end   :: Column -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end   :: Inputs wrapper -->
                <!-- begin :: Form footer -->
                <div class="form-footer">

                    <!-- begin :: Submit btn -->
                    <a href="{{ route('dashboard.finance-approvals.index') }}" class="btn btn-primary">
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
