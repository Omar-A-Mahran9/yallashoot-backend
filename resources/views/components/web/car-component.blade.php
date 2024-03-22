<a href="{{ route('home.cars.show', $car->id) }}" class="car">
    <div class="car-card card-light">
        @if($car->hasOffers())
            <div class="offer">
                {{ __('Offer') }}
            </div>
        @endif
        <div class="favourite-btn fav {{ in_array( $car->id , getFavouriteCars() ) ? 'active' : ''}}" data-checked="{{ in_array( $car->id , getFavouriteCars() ) ? 1 : 0}}" data-car-id="{{ $car->id }}" >
            <i class="far fa-heart text-green"></i>
        </div>
        <div class="car-info">
            <div class="img-container">
                <img src="{{ getImagePathFromDirectory($car['main_image'], 'Cars') }}" alt="{{ $car->name }}">
                <div class="car-condition {{ $car['is_new']? 'new' : 'used' }}">
                    <p class="mb-0">
                        {{ __($car['is_new'] ? 'New' : 'Used') }}
                    </p>
                </div>
            </div>
            <h1 class="car-name">
                {{$car->name}}
            </h1>
            <div class="pricing-container">
                @if($car['price_field_status'] == 'show')
                    <div class="pricing">
                        {!! $car['price_field_value'] !!}
                    </div>
                    <div class="vat">
                        <h6 class="text-center">
                            {{ __('After VAT') }}
                            <br>
                            {{ $car->price_after_vat }}
                            <span>{{ __('SAR') }}</span>
                        </h6>
                    </div>
                @else
                    <div class="pricing">
                        <h6>{{ __($car['price_field_value']) }}</h6>
                    </div>
                @endif
            </div>
            <ul class="car-details nav justify-content-center">
                <li>
                    <span>
                        <img src="{{ asset('web/img/car-icon.png') }}" alt="">
                    </span>
                    {{ $car['year'] }}
                </li>
                <li>
                    <span>
                        <img src="{{ asset('web/img/engine-icon.png') }}" alt="">
                    </span>
                    {{ $car['fuel_consumption'] }} {{ __('Liter') }}
                </li>
                <li>
                    <span>
                        <img src="{{ asset('web/img/chair-icon.png') }}" alt="">
                    </span>
                    {{ __( ucfirst($car['upholstered_seats'])) }}
                </li>
                <li>
                    <span>
                        <img src="{{ asset('web/img/type-icon.png') }}" alt="">
                    </span>
                    {{ __(ucfirst(str_replace('_', ' ', $car['traction_type']))) }}
                </li>
                @if (!$car['is_new'])
                    <li>
                        <span>
                            <i class="fa fa-road px-1" aria-hidden="true"></i>
                        </span>
                        {{ $car['kilometers']. " " . __('Kilometer') . " "}}
                    </li>
                @endif
            </ul>
        </div>
        <div class="card-link">
            <p class="mb-0">
                {{ __('Details') }}
            </p>
        </div>
    </div>
</a>
