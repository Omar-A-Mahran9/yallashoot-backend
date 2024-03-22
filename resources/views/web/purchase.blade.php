@extends('web.layouts.app')
@push('styles')

@endpush

@section('content')
    @include('web.layouts.navbar')

    <section class="purchase-order inner-page pt-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="title">
                        {{__('Purchase Order')}}
                    </h4>
                </div>
                <div class="col-12 col-lg-9 order-2 order-lg-1"> 
                    <!-- Nav pills -->
                    <ul class="nav nav-pills" id="main-nav">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="#individuals">
                                {{__('Individuals')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#corporate">
                                {{__('Corporate')}}
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="individuals">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="inputs-group">
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Payment method')}}</label>
                                        </div>
                                        <div class="col-8">
                                            <div class="radio-buttons">
                                                <div class="custom-control custom-radio">
                                                    <input checked type="radio" class="custom-control-input" id="individuals-finance" name="payment_method" value="finance">
                                                    <label class="custom-control-label" for="individuals-finance">{{__('Finanace')}}</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="individuals-cash" name="payment_method" value="cash">
                                                    <label class="custom-control-label" for="individuals-cash">{{__('Cash')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('The selected vehicle')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <select class="form-select">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Price')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" min="20000" class="form-control" placeholder="{{__('Minimum SAR 20.000')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Name')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" placeholder="{{__('Name')}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="">{{__('Mobile number')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="tel" class="form-control" placeholder="{{__('Phone number')}}">
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                </div>
                                <div class="inputs-group individuals-finance-only">
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Total salary in ATM')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" min="0" class="form-control" placeholder="{{__('Salary and allowances')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Total commitments')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" min="0" class="form-control" placeholder="{{__('Commitment amount')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Is there a mortgage loan?')}} *</label>
                                        </div>
                                        <div class="col-8 d-flex">
                                            <div class="form-check me-5">
                                                <input type="radio" class="form-check-input" id="individual-mortage-loan-yes" name="mortage_loan" value="option1" checked>
                                                <label class="form-check-label" for="individual-mortage-loan-yes">{{__('Yes')}}</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="individual-mortage-loan-no" name="mortage_loan" value="option2">
                                                <label class="form-check-label" for="individual-mortage-loan-no">{{__('No')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('The last installment')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" min="0" class="form-control" placeholder="35%">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('The first installment')}} *</label>
                                        </div>
                                        <div class="col-6">
                                            <select class="form-select">
                                                <option>0</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <input type="number" min="0" disabled class="form-control" placeholder="" value="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="inputs-group individuals-finance-only">
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('City')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" placeholder="{{__('City')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Employer')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" placeholder="{{__('Employer')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Bank account')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <select class="form-select">
                                                <option value="" selected="">{{__('select bank')}}</option>
                                                <option>0</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Driving License Status')}} *</label>
                                        </div>
                                        <div class="col-8 d-flex">
                                            <div class="form-check me-5">
                                                <input type="radio" class="form-check-input" id="driving-license-valid" name="mortage_loan" value="option1" checked>
                                                <label class="form-check-label" for="driving-license-valid">{{__('Valid')}}</label>
                                            </div>
                                            <div class="form-check me-5">
                                                <input type="radio" class="form-check-input" id="driving-license-invalid" name="mortage_loan" value="option2">
                                                <label class="form-check-label" for="driving-license-invalid">{{__('Invalid')}}</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="driving-license-unavailable" name="mortage_loan" value="option2">
                                                <label class="form-check-label" for="driving-license-unavailable">{{__('Unavailable')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-filled mb-5">
                                            {{__('Send')}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="corporate">
                            <div class="inputs-group">
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                                </p>
                                <div class="corporate-details">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <span class="icon">
                                                <i class="fas fa-phone-alt"></i>
                                            </span>
                                            <span>
                                                {{__('Mobile Number')}}
                                            </span>
                                            <a href="tel:05000000000" class="phone">
                                                05000000000
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <span class="icon">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span>
                                                {{__('E-mail')}}
                                            </span>
                                            <a href="mailto:example@gmail.com" class="mail">
                                                example@gmail.com
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <span class="icon">
                                                <i class="fab fa-whatsapp"></i>
                                            </span>
                                            <span>
                                                {{__('Whatsapp')}}
                                            </span>
                                            <a href="#" class="whatsapp">
                                                {{__('CLICK HERE')}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="fill-form-instruction">
                                    <p>{{__('Or please fill the form below: You will receive a reply within a maximum of 24 hours.')}}</p>
                                </div>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="inputs-group">
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Payment method')}}</label>
                                        </div>
                                        <div class="col-8">
                                            <div class="radio-buttons">
                                                <div class="custom-control custom-radio">
                                                    <input checked type="radio" class="custom-control-input" id="corporate-finance" name="payment_method" value="finance">
                                                    <label class="custom-control-label" for="corporate-finance">{{__('Finanace')}}</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="corporate-cash" name="payment_method" value="cash">
                                                    <label class="custom-control-label" for="corporate-cash">{{__('Cash')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('The selected vehicle')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <select class="form-select">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Company Name')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" placeholder="{{__('Company Name')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Official email')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="email" class="form-control" placeholder="{{__('Official email')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('The Chief Executive Officer (CEO)')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" placeholder="{{__('The Chief Executive Officer (CEO)')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <label for="">{{__('Mobile number')}} *</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="tel" class="form-control" placeholder="{{__('Mobile number')}}">
                                        </div>
                                    </div>
                                    <div class="corporate-finance-only">
                                        <div class="row mb-4">
                                            <div class="col-4">
                                                <label for="">{{__('The company\'s headquarter')}} *</label>
                                            </div>
                                            <div class="col-8">
                                                <input type="text"  class="form-control" placeholder="{{__('City')}}">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-4">
                                                <label for="">{{__('The last installment')}} *</label>
                                            </div>
                                            <div class="col-8">
                                                <input type="number" min="0" class="form-control" placeholder="35%">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-4">
                                                <label for="">{{__('Company activity (According to the record)')}} *</label>
                                            </div>
                                            <div class="col-8">
                                                <select class="form-select">
                                                    <option value="" selected="">{{__('Company activity (According to the record)')}}</option>
                                                    <option>0</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-4">
                                                <label for="">{{__('Company age')}} *</label>
                                            </div>
                                            <div class="col-8">
                                                <input type="number" min="0" name="" id="" class="form-control" placeholder="{{__('Company age')}}">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-4">
                                                <label for="">{{__('Bank account')}} *</label>
                                            </div>
                                            <div class="col-8">
                                                <select class="form-select">
                                                    <option value="" selected="">{{__('select bank')}}</option>
                                                    <option>0</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-filled mb-5">
                                            {{__('Send')}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 order-1 order-lg-2">
                    <a href="#">
                        <div class="car-card">
                            <button class="btn fav-btn">
                                <i class="fas fa-heart"></i>
                            </button>
                            <div class="car-info">
                                <div class="car-image" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                <div class="details-anchor"  style="background-image: url('{{asset('web/img/car-image.png')}}');">
                                    <h3 class="anchor">
                                        {{__('Details')}}
                                        <i class="fas fa-long-arrow-alt-right flip ms-2"></i>
                                    </h3>
                                </div>
                                <ul class="nav">
                                    <li>
                                        <div class="icon car-icon"></div>
                                        2020
                                    </li>
                                    <li>
                                        <div class="icon motor-icon"></div>
                                        2020 {{__('Liter')}}                                
                                    </li>
                                    <li>
                                        <div class="icon seat-icon"></div>
                                        {{__('Leather')}}
                                    </li>
                                    <li>
                                        <div class="icon front-wheel-icon"></div>
                                        {{__('Front wheel')}}
                                    </li>
                                </ul>
                            </div>
                            <div class="car-details">
                                <h4 class="car-name">
                                    DODGE CHALLENGER 2023
                                </h4>
                                <div class="price-container">
                                    <p class="price">
                                        250.000
                                        <span>SAR</span>
                                    </p>
                                    <p class="vat">
                                        <span>After VAT</span>
                                        250.000 SAR
                                    </p>
                                </div>
                            </div>
                            <div class="installments">
                                <p>installment now starting from</p>
                                <p class="installment-price">
                                    1500
                                    <span>
                                        SAR
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>


    @include('web.layouts.footer')
@endsection

@push('scripts')
        <script>
            $(document).ready(function(){
                $('input[name="payment_method"]').on('change', function(){
                    if($('#individuals-cash').is(":checked")){
                        $('.individuals-finance-only input').prop('disabled', true);
                        $('.individuals-finance-only').hide('');
                    }else{
                        $('.individuals-finance-only input').prop('disabled', false);
                        $('.individuals-finance-only').fadeIn('');
                    }
                });

                $('input[name="payment_method"]').on('change', function(){
                    if($('#corporate-cash').is(":checked")){
                        $('.corporate-finance-only input').prop('disabled', true);
                        $('.corporate-finance-only').hide('');
                    }else{
                        $('.corporate-finance-only input').prop('disabled', false);
                        $('.corporate-finance-only').fadeIn('');
                    }
                });
            })
        </script>
    @endpush
