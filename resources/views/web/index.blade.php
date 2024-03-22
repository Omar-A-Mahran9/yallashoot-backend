@extends('web.layouts.app')
@push('styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick-theme.css">
@endpush

@section('content')
    @include('web.layouts.navbar')

    <section class="intro">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <img src="{{asset('web/img/intro-img.png')}}" class="w-100" alt="">
                </div>
                <div class="col-12 col-lg-5">
                    <div class="centered h-100 position-relative">
                        <div class="text-container">
                            <span class="faded-text">
                                LAMBORGHINI
                                <br>
                                Aventador
                                <br>
                                50th anniversary
                            </span>
                            <h2>LAMBORGHINI</h2>
                            <h4>
                                Aventador<br>
                                50th anniversary
                            </h4>
                            <a href="#" class="btn sabr-btn">
                                {{__('Discover more about this car')}}
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="search-section">
                <form action="" method="" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6 col-lg-3">
                            <select class="form-control" name="" id="">
                                <option value="" selected>{{__('Select the vehicle type')}}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <select class="form-control" name="" id="">
                                <option value="" selected>{{__('Select car brand')}}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <select class="form-control" name="" id="">
                                <option value="" selected>{{__('Select car model')}}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <button class="btn btn-filled w-100" type="submit">{{__('Search')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="who-we-are">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <h2 class="title">
                        {{__('WHO WE ARE')}}
                    </h2>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    </p>
                    <a href="#" class="sabr-btn">
                        {{__('Know more')}}
                        <i class="fas fa-long-arrow-alt-right"></i>
                    </a>
                </div>
                <div class="col-12 col-lg-5">
                    <img src="{{asset('web/img/who-we-are-img.png')}}" class="w-100" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="latest-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">
                        {{__('Latest Vehicles')}}
                    </h4>
                    <div class="cars-container my-4">
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
                                            <img src="{{asset('web/img/arrow-icon.png')}}">
                                        </h3>
                                    </div>
                                    
                                </div>
                                <div class="car-details">
                                    <h4 class="car-name">
                                        DODGE CHALLENGER 2023
                                    </h4>
                                    <div class="price-container">
                                        <p class="vat">
                                            <span>After VAT</span>
                                            250.000 SAR
                                        </p>
                                        <p class="price">
                                            250.000
                                            <span>SAR</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="installments">
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
                                            <img src="{{asset('web/img/arrow-icon.png')}}">
                                        </h3>
                                    </div>
                                    
                                </div>
                                <div class="car-details">
                                    <h4 class="car-name">
                                        DODGE CHALLENGER 2023
                                    </h4>
                                    <div class="price-container">
                                        <p class="vat">
                                            <span>After VAT</span>
                                            250.000 SAR
                                        </p>
                                        <p class="price">
                                            250.000
                                            <span>SAR</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="installments">
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
                                            <img src="{{asset('web/img/arrow-icon.png')}}">
                                        </h3>
                                    </div>
                                </div>
                                <div class="car-details">
                                    <h4 class="car-name">
                                        DODGE CHALLENGER 2023
                                    </h4>
                                    <div class="price-container">
                                        <p class="vat">
                                            <span>After VAT</span>
                                            250.000 SAR
                                        </p>
                                        <p class="price">
                                            250.000
                                            <span>SAR</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="installments">
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
                                            <img src="{{asset('web/img/arrow-icon.png')}}">
                                        </h3>
                                    </div>
                                    
                                </div>
                                <div class="car-details">
                                    <h4 class="car-name">
                                        DODGE CHALLENGER 2023
                                    </h4>
                                    <div class="price-container">
                                        <p class="vat">
                                            <span>After VAT</span>
                                            250.000 SAR
                                        </p>
                                        <p class="price">
                                            250.000
                                            <span>SAR</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="installments">
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
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="authorized-distributors">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="title mb-4">
                        {{ __('Car Brands') }}
                    </h2>
                </div>
                <div class="col-12">
                    <div class="car-brands">
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/bmw.png') }}" alt="">
                            </div>
                            <p>BMW</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/ferrari.png') }}" alt="">
                            </div>
                            <p>Ferrari</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/lamborghini.png') }}" alt="">
                            </div>
                            <p>Lamborghini</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/mercedes.png') }}" alt="">
                            </div>
                            <p>Mercedes benz</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/porsche.png') }}" alt="">
                            </div>
                            <p>Porsche</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/volkswagen.png') }}" alt="">
                            </div>
                            <p>Volkswagen</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/bmw.png') }}" alt="">
                            </div>
                            <p>BMW</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/ferrari.png') }}" alt="">
                            </div>
                            <p>Ferrari</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/lamborghini.png') }}" alt="">
                            </div>
                            <p>Lamborghini</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/mercedes.png') }}" alt="">
                            </div>
                            <p>Mercedes benz</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/porsche.png') }}" alt="">
                            </div>
                            <p>Porsche</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/volkswagen.png') }}" alt="">
                            </div>
                            <p>Volkswagen</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/bmw.png') }}" alt="">
                            </div>
                            <p>BMW</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/ferrari.png') }}" alt="">
                            </div>
                            <p>Ferrari</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/lamborghini.png') }}" alt="">
                            </div>
                            <p>Lamborghini</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/mercedes.png') }}" alt="">
                            </div>
                            <p>Mercedes benz</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/porsche.png') }}" alt="">
                            </div>
                            <p>Porsche</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/volkswagen.png') }}" alt="">
                            </div>
                            <p>Volkswagen</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/bmw.png') }}" alt="">
                            </div>
                            <p>BMW</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/ferrari.png') }}" alt="">
                            </div>
                            <p>Ferrari</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/lamborghini.png') }}" alt="">
                            </div>
                            <p>Lamborghini</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/mercedes.png') }}" alt="">
                            </div>
                            <p>Mercedes benz</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/porsche.png') }}" alt="">
                            </div>
                            <p>Porsche</p>
                        </a>
                        <a href="/car/brand_id" class="car-brand-card">
                            <div class="img-container">
                                <img src="{{ asset('web/img/brands/volkswagen.png') }}" alt="">
                            </div>
                            <p>Volkswagen</p>
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="clients-reviews">
        <div class="container">
            <h2 class="title mb-4">
                {{ __("Clients' reviews") }}
            </h2>
            
            <div class="client-reviews-container">
                <div class="client-review__card">
                    <div class="img-container" style="background-image: url('{{asset('web/img/user.png')}}')"></div>
                    <h5 class="client-name">Client Name</h5>
                    <p class="review">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    </p>
                </div>
                <div class="client-review__card">
                    <div class="img-container" style="background-image: url('{{asset('web/img/user.png')}}')"></div>
                    <h5 class="client-name">Client Name</h5>
                    <p class="review">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    </p>
                </div>
                <div class="client-review__card">
                    <div class="img-container" style="background-image: url('{{asset('web/img/user.png')}}')"></div>
                    <h5 class="client-name">Client Name</h5>
                    <p class="review">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    </p>
                </div>
                <div class="client-review__card">
                    <div class="img-container" style="background-image: url('{{asset('web/img/user.png')}}')"></div>
                    <h5 class="client-name">Client Name</h5>
                    <p class="review">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    </p>
                </div>
            </div>
            
        </div>
    </section>

    <section class="purchase-order-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-9">
                    <div class="content-container">
                        <h4 class="">
                            {{__('Purchase Order')}}
                        </h4>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                        </p>
                        <div class="actions">
                            <a href="#" class="btn btn-filled">
                                {{__('Individuals')}}
                            </a>
                            <a href="#" class="btn btn-filled">
                                {{__('Corporate')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 position-relative">
                    <img src="{{asset('web/img/purchase-order-bg.png')}}" class="purchase-img" alt="">
                </div>
            </div>
        </div>
    </section>

    @include('web.layouts.footer')
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>
    <script>
        $('.client-reviews-container').slick({
            centerMode: true,
            centerPadding: '0px',
            slidesToShow: 3,
            responsive: [
                {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
                },
                {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
                }
            ]
        });
    </script>
    <script>
        if ($(window).scrollTop() < 100) {
            $('.navbar').removeClass('scrolled');
        }else{
            $('.navbar').addClass('scrolled');
        }
        $(document).ready(() => {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 50) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });
        })
    </script>
@endpush
