@extends('web.layouts.app')
@push('styles')

@endpush

@section('content')
    @include('web.layouts.navbar')

        <section class="favourites inner-page">
            <div class="container">
                <h2 class="title">
                    {{__('My Favourites')}}
                </h2>
                <div class="cars-container">
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
        </section>


    @include('web.layouts.footer')
@endsection

@push('scripts')

@endpush
