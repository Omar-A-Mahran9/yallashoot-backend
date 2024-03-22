@extends('web.layouts.app')
@push('styles')

@endpush

@section('content')
    @include('web.layouts.navbar')

    <div class="order-placed">
        <img src="{{asset('web/img/order-placed.png')}}" alt="">
        <h2 class="text-primary mb-0">
            {{__('Thank you for your trust ')}}
        </h2>
        <h2 class="text-primary">
            {{__('Your order placed')}}
        </h2>
        <p>
            {{__('One of our representatives will contact you as soon as possible')}}
        </p>
        <a href="{{route('home.index')}}" class="btn btn-filled">
            {{__('Back to home')}}
        </a>
    </div>


    @include('web.layouts.footer')
@endsection

@push('scripts')

@endpush
