@extends('web.layouts.app')

@push('styles')
    <link href="{{asset('web/css/select2.css')}}" rel="stylesheet" />
    <style>
        @media(max-width: 800px){
            .calculator .tab-content{
                padding: 0 !important;
            }
            .calculation-result .car-card{
                margin: 0 !important;
            }
            .calculation-result .container{
                padding: 0 !important;
                width: 100% !important;
            }
            .calculation-result .cars-container .car-card{
                max-width: 100% !important;
                margin-top: 20px !important;
            }
        }
    </style>
@endpush
@section('content')
    @include('web.layouts.navbar')
    
    <section class="calculator inner-page pt-5">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="sticky">
                        <h5 class="section-title">
                            {{__('Calculator')}}
                        </h5>
                        <div id="carCard" style="display: none">
                            <div class="car-card w-100 mx-auto" >
                                <a href="#">
                                    <button class="btn fav-icon">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <div class="img-container">
                                        <img class="lazyload" src="{{asset('web/img/img-placeholder.png')}}" data-src="{{asset('web/img/car.png')}}" alt="">
                                    </div>
                                    <h6 class="title">
                                        DODGE CHALLENGER 2022
                                    </h6>
                                    <div class="car-card__price">
                                        <div class="without-vat">
                                            <span>{{__('Price')}}</span>
                                            <h6>
                                                250.000 {{('SAR')}}
                                            </h6>
                                        </div>
                                        <div class="with-vat">
                                            <span>{{__('After VAT')}}</span>
                                            <h6>
                                                250.000 {{('SAR')}}
                                            </h6>
                                        </div>
                                    </div>
                                    <button class="btn btn-filled">
                                        {{__('Details')}}
                                        <span>
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3 mt-lg-0">
                    <div class="invalid-feedback m-2" style="display: block;" id="duplicated">
                        
                    </div>
                    <!-- Nav tabs -->
                    {{-- <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#car-calculator">
                                {{__('Calculate for a Car')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#amount-calculator">
                                {{__('Calculate by amount to pay')}}
                            </a>
                        </li>
                    </ul> --}}
                    
                    <!-- Tab panes -->
                    {{-- <div class="tab-content">
                        <div class="tab-pane container active " id="car-calculator" > --}}
                            <form action="{{route('home.calculateInstallments')}}" class="submitted-calculator-for-car-form" data-redirection-url="#" method="POST" enctype="multipart/form-data">
                            {{-- <form action="{{route('home.calculateInstallments')}}"  data-redirection-url="#" method="POST" enctype="multipart/form-data"> --}}

                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="section-title">
                                            {{__('Vehicle Information')}}
                                        </h6>
                                    </div>
                                    <div class="col-12 col-lg-3 form-group">
                                        <label for="">{{__('Brand')}}</label>
                                        <select class="form-select" name="brand_id" id="brandSp">
                                            <option value="" selected="">
                                                {{__('Select the brand')}}
                                            </option>
                                            @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        <p class="invalid-feedback m-2" id="brand_id" style="display: block;"></p>
                                    </div>
                                    <div class="col-12 col-lg-3 form-group">
                                        <label for="">{{__('Model')}}</label>
                                        <select class="form-select " name="model_id" id="modelSp" disabled>
                                            <option value="" selected="">
                                                {{__('Select the model')}}
                                            </option>
                                            
                                        </select>
                                        <p class="invalid-feedback m-2" id="model_id" style="display: block;"></p>
                                    </div>
                                    <div class="col-12 col-lg-3 form-group">
                                        <label for="">{{__('Category')}}</label>
                                        <select class="form-select " name="category_id" id="categorySp" disabled>
                                            <option value="" selected="">
                                                {{__('Select the category')}}
                                            </option>
                                            
                                        </select>
                                        <p class="invalid-feedback m-2" id="category_id" style="display: block;"></p>
                                    </div>
                                    <div class="col-12 col-lg-3 form-group">
                                        <label for="">{{__('Car')}}</label>
                                        <select class="form-select" name="car_id" disabled id="carSp">
                                            <option value="" selected="">
                                                {{__('Select the car')}}
                                            </option>
                                            
                                        </select>
                                        <p class="invalid-feedback m-2" id="car_id" style="display: block;"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="section-title">
                                            {{__('Installment information')}}
                                        </h5>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group">
                                        <label for="">{{__('Bank name')}}</label>
                                        <select class="form-select" name="bank_id" id="">
                                            <option value="" selected="">
                                                {{__('Select the bank')}}...
                                            </option>
                                            @foreach($banks as $bank)
                                            <option value="{{$bank->id}}">{{$bank->name}}</option>
                                            @endforeach
                                        </select>
                                        <p class="invalid-feedback m-2" id="bank_id" style="display: block;"></p>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group">
                                        <label for="">{{__('Business sector')}}</label>
                                        <select class="form-select" name="sector_id" id="">
                                            <option value="" selected="">
                                                {{__('Select Business sector')}}...
                                            </option>
                                            @foreach($sectors as $sector)
                                            <option value="{{$sector->id}}">{{$sector->name}}</option>
                                            @endforeach

                                        </select>
                                        <p class="invalid-feedback m-2" id="sector_id" style="display: block;"></p>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group">
                                        <label for="">{{__('Current salary')}}</label>
                                        <input class="form-select" type="number" min="0" value="0" name="salary" id="" placeholder="{{__('Enter your curent salary')}}..." >
                                        <p class="invalid-feedback m-2" id="salary" style="display: block;"></p>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group">
                                        <label for="">{{__('Commitment value of loans')}}</label>
                                        <input class="form-select"  type="number"  min="0" value="0" name="commitments" id="" placeholder=" {{__('Enter commitment value of loans')}}..." >
                                        <p class="invalid-feedback m-2" id="commitments" style="display: block;"></p>
                                    </div>
                                    <div class="col-12 col-lg-4 form-group">
                                        <label for="">{{__('Installment period')}} <span><span>{{__('years')}}</span></span></label>
                                        <select class="form-select" name="installment" id="">
                                            <option value="" selected="">
                                                {{__('Enter installment period')}} ...
                                            </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            {{-- <option value="6">6</option>
                                            <option value="7">7</option> --}}
                                        </select>
                                        <p class="invalid-feedback m-2" id="installment" style="display: block;"></p>
                                    </div>
                                    <div class="col-12 col-lg-4 form-group">
                                        <label for="">{{__('Down payment')}} %</label>
                                        <select class="form-select" name="first_installment" id="">
                                            <option value="" selected="">
                                                {{__('Enter down payment')}}...
                                            </option>
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="15">15%</option>
                                            <option value="20">20%</option>
                                            <option value="25">25%</option>
                                        </select>
                                        <p class="invalid-feedback m-2" id="first_installment" style="display: block;"></p>
                                            
                                    </div>
                                    <div class="col-12 col-lg-4 form-group">
                                        <label for="">{{__('Last batch')}}</label>
                                        <select class="form-select" name="last_installment" id="">
                                            <option value="" selected="">
                                                {{__('Enter last batch')}}
                                            </option>
                                            <option value="25">25%</option>
                                            <option value="30">30%</option>
                                            <option value="35">35%</option>
                                            <option value="40">40%</option>
                                            <option value="45">45%</option>
                                            <option value="50">50%</option>
                                        </select>
                                        <p class="invalid-feedback m-2" id="last_installment" style="display: block;"></p>
                                            
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-filled w-50 mx-auto my-3" type="submit">
                                            {{__('Calculate')}}
                                            <i class="fas fa-angle-double-right flip ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="calculation-result calculation-for-car-result" id="calculation-installment-result-contanier" style="display: none">
                                <button type="button" class="btn text-lightBlue" id="calculate-installments-back-btn"><i class="fas fa-chevron-left flip me-2 text-lightBlue"></i>{{__('Back')}}</button>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 col-lg-6" id="car-selected-for-calculation">
                                            
                                        </div>
                                        <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
                                            <div>
                                                <div class="bank-container">
                                                    <img id="calculation-for-car-result-bank-image" src="" alt="">
                                                    <h6 id="calculation-for-car-result-bank-name">Al rajhi bank</h6>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <span class="text-muted">
                                                                {{__('Approximate and not final monthly installment')}}:
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="text-lightBlue">
                                                                <strong id="calculation-for-car-result-monthly-installment">2400</strong>
                                                                {{__('SAR/month')}}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="text-muted">
                                                                {{__('installment Years')}}:
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="text-lightBlue">
                                                                <strong id="calculation-for-car-result-installment">>5</strong>
                                                                {{__('years')}}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="lwest_monthly_installment" style="display: none">
                                            <div class="results">
                                                <p>
                                                    {{__('You can pay only')}}
                                                </p>
                                                <p class="amount text-lightBlue">
                                                    <strong class="calculation-for-car-result-lowest-monthly-installment">2000</strong>
                                                    <span class="font-smaller">{{__('SAR/month')}}</span>
                                                </p>
                                                <p>{{__('with')}}</p>
                                                <p class="bank-name text-lightBlue">
                                                    {{__('another financing entity')}}
                                                </p>
                                                <p>
                                                    {{__('you can contact us to get the offer')}}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <a href="#" id="calculate-installments-again" class="btn btn-inverse w-50 mx-auto mt-3">
                                                {{__('Calculate again')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                        {{-- <div class="tab-pane container fade" id="amount-calculator">

                            <form id="amount-form">
                                
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="section-title">
                                            {{__('Installment information')}}
                                        </h5>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group">
                                        <label for="">{{__('Bank')}}</label>
                                        <select class="form-select" name="bank" id="bank-sp" data-placeholder="{{ __('Choose the bank') }}">
                                            <option value=""></option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="invalid-feedback" id="bank"></p>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group">
                                        <label for="">{{__('Occupation')}}</label>
                                        <select class="form-select" name="sector" id="sector-sp" data-placeholder="{{ __('Choose the occupation') }}">
                                            <option value=""></option>
                                            @foreach ($sectors as $sector)
                                                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="invalid-feedback" id="sector"></p>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group">
                                        <label for="">{{__('Monthly installment')}}</label>
                                        <input class="form-control" type="number" min="3000" name="installment_amount" placeholder="{{ __('Enter your desired monthly installment') }}">
                                        <p class="invalid-feedback" id="installment_amount"></p>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group">
                                        <label for="">{{__('Installment period')}} <span><span>{{__('years')}}</span></span></label>
                                        <select class="form-select" name="years" id="" data-placeholder="{{ __('Choose installment period in years') }}">
                                            <option value=""></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                        <p class="invalid-feedback" id="years"></p>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group">
                                        <label for="">{{__('First Batch')}}</label>
                                        <input class="form-control" type="number" min="0" name="first_batch" placeholder="{{ __('Enter your desired first batch') }}">
                                        <p class="invalid-feedback" id="first_batch"></p>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group">
                                        <label for="">{{__('Last Batch')}}</label>
                                        <input class="form-control" type="number" min="0" name="last_batch" placeholder="{{ __('Enter your desired last batch') }}">
                                        <p class="invalid-feedback" id="last_batch"></p>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-filled w-50 mx-auto my-3" id="amount-submit-btn">
                                            {{__('Calculate')}}
                                            <i class="fas fa-angle-double-right flip ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>


                            <div class="calculation-result d-none" id="amount-calculation-result">
                                <button type="button" class="btn text-lightBlue amount-back-btn"><i class="fas fa-chevron-left flip me-2 text-lightBlue"></i>{{__('Back')}}</button>

                                <div class="container w-100">
                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <div class="sticky">
                                                <h6 class="section-title">
                                                    {{__('Applicable cars')}}
                                                </h6>
                                                <p>
                                                    <span class="text-muted">
                                                        {{__('Maximum Car Price')}} :
                                                    </span>
                                                    <strong class="text-lightBlue" id="max-car-price"></strong>
                                                    <span class="font-smaller text-lightBlue">
                                                        {{__('SAR')}}
                                                    </span>
                                                </p>
                                                <p>
                                                    <span class="text-muted">
                                                        {{__('installment Years')}} :
                                                    </span>
                                                    <strong class="text-lightBlue" id="amount-years-count"></strong>
                                                    <span class="font-smaller text-lightBlue">
                                                        {{__('years')}}
                                                    </span>
                                                </p>
                                                <button class="btn btn-inverse w-100 mt-4 amount-back-btn">
                                                    {{__('Calculate again')}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-9">
                                            <div class="cars-container" id="amount-cars-container">
                                                <div class="car-card w-100" >
                                                    <a href="#">
                                                        <button class="btn fav-icon">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                        <div class="img-container">
                                                            <img class="lazyload" src="{{asset('web/img/img-placeholder.png')}}" data-src="{{asset('web/img/car.png')}}" alt="">
                                                        </div>
                                                        <h6 class="title">
                                                            DODGE CHALLENGER 2022
                                                        </h6>
                                                        <div class="car-card__price">
                                                            <div class="without-vat">
                                                                <span>{{__('Price')}}</span>
                                                                <h6>
                                                                    250.000 {{('SAR')}}
                                                                </h6>
                                                            </div>
                                                            <div class="with-vat">
                                                                <span>{{__('After VAT')}}</span>
                                                                <h6>
                                                                    250.000 {{('SAR')}}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-filled">
                                                            {{__('Details')}}
                                                            <span>
                                                                <i class="fas fa-arrow-right"></i>
                                                            </span>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="car-card w-100" >
                                                    <a href="#">
                                                        <button class="btn fav-icon">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                        <div class="img-container">
                                                            <img class="lazyload" src="{{asset('web/img/img-placeholder.png')}}" data-src="{{asset('web/img/car.png')}}" alt="">
                                                        </div>
                                                        <h6 class="title">
                                                            DODGE CHALLENGER 2022
                                                        </h6>
                                                        <div class="car-card__price">
                                                            <div class="without-vat">
                                                                <span>{{__('Price')}}</span>
                                                                <h6>
                                                                    250.000 {{('SAR')}}
                                                                </h6>
                                                            </div>
                                                            <div class="with-vat">
                                                                <span>{{__('After VAT')}}</span>
                                                                <h6>
                                                                    250.000 {{('SAR')}}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-filled">
                                                            {{__('Details')}}
                                                            <span>
                                                                <i class="fas fa-arrow-right"></i>
                                                            </span>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="car-card w-100" >
                                                    <a href="#">
                                                        <button class="btn fav-icon">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                        <div class="img-container">
                                                            <img class="lazyload" src="{{asset('web/img/img-placeholder.png')}}" data-src="{{asset('web/img/car.png')}}" alt="">
                                                        </div>
                                                        <h6 class="title">
                                                            DODGE CHALLENGER 2022
                                                        </h6>
                                                        <div class="car-card__price">
                                                            <div class="without-vat">
                                                                <span>{{__('Price')}}</span>
                                                                <h6>
                                                                    250.000 {{('SAR')}}
                                                                </h6>
                                                            </div>
                                                            <div class="with-vat">
                                                                <span>{{__('After VAT')}}</span>
                                                                <h6>
                                                                    250.000 {{('SAR')}}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-filled">
                                                            {{__('Details')}}
                                                            <span>
                                                                <i class="fas fa-arrow-right"></i>
                                                            </span>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="car-card w-100" >
                                                    <a href="#">
                                                        <button class="btn fav-icon">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                        <div class="img-container">
                                                            <img class="lazyload" src="{{asset('web/img/img-placeholder.png')}}" data-src="{{asset('web/img/car.png')}}" alt="">
                                                        </div>
                                                        <h6 class="title">
                                                            DODGE CHALLENGER 2022
                                                        </h6>
                                                        <div class="car-card__price">
                                                            <div class="without-vat">
                                                                <span>{{__('Price')}}</span>
                                                                <h6>
                                                                    250.000 {{('SAR')}}
                                                                </h6>
                                                            </div>
                                                            <div class="with-vat">
                                                                <span>{{__('After VAT')}}</span>
                                                                <h6>
                                                                    250.000 {{('SAR')}}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-filled">
                                                            {{__('Details')}}
                                                            <span>
                                                                <i class="fas fa-arrow-right"></i>
                                                            </span>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        

        <div class="modal" id="thank-you">
            <div class="modal-dialog">
                <div class="modal-content">
            
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
            
                    <!-- Modal body -->
                    <div class="modal-body calculation-result ">
                        <div class="content text-center">
                            <h4 class="section-title mx-auto">
                                {{__('Car installment')}}
                            </h4>
                            <img class="lazyload" src="{{asset('web/img/img-placeholder.png')}}" data-src="{{asset('web/img/submitted.png')}}" class="w-50 mx-auto mt-5 mb-3" alt="{{__('Thank you for your trust')}}">
                            <div class="text-center">
                                <h5>{{__('Thank you for your trust')}}</h5>
                                <p class="text-center">
                                    {{__('One of our representatives will contact you as soon as possible')}}
                                </p>
                            </div>
                            <a href="{{route('home.index')}}" class="btn btn-filled mx-auto" >
                                {{__('Back to home')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('web.layouts.footer')
@endsection

@push('scripts')
    <script src="{{asset('web/js/select2.js')}}"></script>

    <script>
        let amountCalculatorForm = $('#amount-form');
        let amountResultContainer = $('#amount-calculation-result');
        let amountCarsContainer = $('#amount-cars-container');
        let amountSubmitBtn = $('#amount-submit-btn');
        let amountBackBtn = $('.amount-back-btn');
        
        amountBackBtn.click(function(){
            amountResultContainer.addClass('d-none');
            amountCalculatorForm.removeClass('d-none');
        });

        amountSubmitBtn.click(function(e){
            e.preventDefault();

            let formData = new FormData( document.getElementById('amount-form') );

            $.ajax({
                url:`{{route('home.amount-calculator')}}`,
                method:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    removeValidationMessages();
                    amountResultContainer.removeClass('d-none');
                    amountCalculatorForm.addClass('d-none');
                    $("#amount-years-count").html(formData.get('years'));

                    $('#max-car-price').html(response.maxCarPrice);
                    amountCarsContainer.html('');

                    if(response.applicableCars.length > 0)
                    {
                        response.applicableCars.forEach(car => {
                        amountCarsContainer.append(`<div class="car-card w-100" >
                                                    <a href="/cars/${car.id}/${car.name}">
                                                        <div class="img-container">
                                                            <img class="lazyload" src="{{asset('web/img/img-placeholder.png')}}" data-src="${getImagePath('Cars',car.main_image)}" alt="${car.name}">
                                                        </div>
                                                        <h6 class="title">
                                                            ${car.name}
                                                        </h6>
                                                        <div class="car-card__price">
                                                            <div class="without-vat">
                                                                <span>${car.have_discount ? car.price : ''}</span>
                                                                <h6>
                                                                    ${car.selling_price} {{ __('SAR') }}
                                                                </h6>
                                                            </div>
                                                            <div class="with-vat">
                                                                <span>{{ __('After VAT') }}</span>
                                                                <h6>
                                                                    ${car.price_after_vat} {{ __('SAR') }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-filled">
                                                            {{__('Details')}}
                                                            <span>
                                                                <i class="fas fa-arrow-right"></i>
                                                            </span>
                                                        </button>
                                                    </a>
                                                </div>`
                                                );
                        });
                    }
                    else
                        amountCarsContainer.append("<h1>{{ __('There are no available cars at this price') }}</h1>");

                },
                error: (response) => {
                    removeValidationMessages();

                    if (response.status === 422)
                        displayValidationMessages(response.responseJSON.errors);
                    else if (response.status === 403)
                        unauthorizedAlert();
                    else
                        errorAlert("something went wrong" , { time: 5000 })
                }
            });

        });
        
    </script>
    <script src="{{asset('js/home/calculator.js')}}"></script>
@endpush