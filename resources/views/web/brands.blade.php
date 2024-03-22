@extends('web.layouts.app')
@push('styles')

@endpush

@section('content')
    @include('web.layouts.navbar')

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
    
    @include('web.layouts.footer')
@endsection

@push('scripts')

@endpush
