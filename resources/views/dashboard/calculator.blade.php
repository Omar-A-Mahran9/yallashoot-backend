@extends('partials.dashboard.master')
@section('content')

    <!-- begin :: Subheader -->
    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><a href="{{ route('dashboard.cities.index') }}" class="text-muted text-hover-primary">{{ __("Cities") }}</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        {{ __("Calculator") }}
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
            <form action="{{ route('dashboard.calculateInstallment') }}" class="form" method="post">
            {{-- <form action="{{ route('dashboard.calculateInstallment') }}" class="form" method="post" id="calculator-form" > --}}
                @csrf
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">{{ __("Calculator") }}</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">
                    <!-- begin :: Row -->
                    <div class="row mb-8">
                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __("Car") }}</label>
                            <div class="form-floating">
                                <select class="form-select" data-control="select2" name="car_id" id="car-inp" data-placeholder="{{ __("Choose the car") }}" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                    <option></option>
                                    @foreach( \App\Models\Car::get() as $car)
                                        <option value="{{ $car->id }}" data-price="{{$car->price}}"> {{ "$car->name $car->price" }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="invalid-feedback" id="car_id" ></p>
                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __("Salary In Bank") }}</label>
                            <div class="form-floating">
                                <select class="form-select" data-control="select2" name="bank_id" id="bank-inp" data-placeholder="{{ __("Choose the bank") }}" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                    <option></option>
                                    @foreach( $banks as $bank)
                                        <option data-sectors="{{$bank->sectors}}" value="{{ $bank->id }}"> {{ $bank->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="invalid-feedback" id="bank_id" ></p>
                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __("Jop Sector") }}</label>
                            <div class="form-floating">
                                <select class="form-select" data-control="select2" name="sector_id" id="sector-inp" data-placeholder="{{ __("Choose the sector") }}" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                    <option></option>


                                </select>
                            </div>
                            <p class="invalid-feedback" id="sector_id" ></p>
                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __("Salary") }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="salary_inp" name="salary" placeholder="example"/>
                            </div>
                            <p class="invalid-feedback" id="salary" ></p>
                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __("Administrative fees") }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="administrative_fees_inp" name="administrative_fees" readonly  placeholder="example"/>
                            </div>
                            <p class="invalid-feedback" id="administrative_fees" ></p>
                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __("First Batch") }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="first_installment_inp" name="first_installment" placeholder="example"/>
                            </div>
                            <p class="invalid-feedback" id="first_installment" ></p>
                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __("Last Batch") }}</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="last_installment_inp" name="last_installment" placeholder="example"/>
                            </div>
                            <p class="invalid-feedback" id="last_installment" ></p>
                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __("Insurance") }} (%)</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="insurance_percentage_inp" readonly value="{{$settings->get('insurance_percentage')}}" name="insurance_percentage" placeholder="example"/>
                            </div>
                            <p class="invalid-feedback" id="insurance_percentage" ></p>
                        </div>
                        <!-- end   :: Column -->
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2">{{ __("Installment in years") }}</label>
                            <div class="form-floating">
                                <select class="form-select" data-control="select2" name="installment" id="installment-inp" data-placeholder="{{ __("Choose the installment") }}" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                    <option></option>
                                    @for($i = 1; $i<=15; $i++)
                                        <option value="{{ $i }}"> {{ $i }} </option>
                                    @endfor
                                </select>
                            </div>
                            <p class="invalid-feedback" id="installment" ></p>
                        </div>
                        <!-- end   :: Column -->
                    </div>
                    <!-- end   :: Row -->
                    <div class="row mb-8 d-flex justify-content-center">
                        <h6 style="width: fit-content;">{{__('Approximate and not final monthly installment')}} : <span id="monthly_installment" class="badge badge-success">0.0000</span></h6>
                        <h6 style="width: fit-content;display: none" id="lower_isntallment_container">{{__('There is entity that offers a lower monthly installment')}} : <span id="lower_isntallment" class="badge badge-success">0.0000</span></h6>
                    </div>
                </div>
                <!-- end   :: Inputs wrapper -->

                <!-- begin :: Form footer -->
                <div class="form-footer">

                    <!-- begin :: Submit btn -->
                    <button type="submit" class="btn btn-primary" id="submit-btn">

                        <span class="indicator-label">{{ __("Calculate monthly installment") }}</span>

                        <!-- begin :: Indicator -->
                        <span class="indicator-progress">{{ __("Please wait ...") }}
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
    <script>
        var  insurance_percentage = "";
        insurance_percentage = parseFloat(insurance_percentage);
        insurance_percentage = insurance_percentage/100;
        $(document).ready(function(){
            $('select[name="car_id"]').on('change',function(){

            });

            $("#calculator-form").submit(function (e) {
               e.preventDefault();
                let form = $(this);

               $.ajax({
                   method:form.attr ('method'),
                   url:form.attr('action'),
                   data:form.serialize(),
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   success:function (response) {
                        removeValidationMessages();
                        $("#monthly_installment").text(response['monthly_installment']);
                        console.log('343434');
                        if(response['lwest_monthly_installment'] !=null){
                            $('#lower_isntallment_container').show();
                            $('#lower_isntallment').text(`${response['lwest_monthly_installment'].monthlyInstallment}`);
                        }
                        // lower_isntallment_container
                        // lower_isntallment
                   },
                   error:function (response) {
                        removeValidationMessages();

                        if (response.status === 422)
                           displayValidationMessages(response.responseJSON.errors , form.data('trailing'));
                        else if (response.status === 403)
                           unauthorizedAlert();
                        else
                           errorAlert("something went wrong" , { time: 5000 })
                   },
               });
            });
        });

        $(`select[name="bank_id"]`).on('change',function(){
            let sectors = $(this).children('option:selected').data('sectors');
            let sectorOptionsHtml = `<option></option>`;
            sectors.forEach(sector => {
                sectorOptionsHtml = sectorOptionsHtml + `<option data-pivot="${encodeURIComponent(JSON.stringify(sector.pivot))}" value="${sector.id}">${sector.name_ar}</option>`;
            });

            $(`select[name="sector_id"]`).html(sectorOptionsHtml)


        });
        $(`select[name="sector_id"]`).on('change',function(){
            let price = $('select[name="car_id"]').find(':selected').data('price');
            price = parseFloat(price);
            console.log(price);
            let pivot = JSON.parse(decodeURIComponent($(this).children('option:selected').data('pivot')));
            let administrative_fees = price * (pivot.administrative_fees / 100);
            $(`input[name="administrative_fees"]`).val(administrative_fees);
            console.log(pivot)
        });


    </script>
@endpush
