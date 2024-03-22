@extends('web.layouts.app')
@push('styles')

@endpush

@section('content')
    @include('web.layouts.navbar')

    <section class="contact inner-page">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="d-flex">
                        <div class="branches">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Riyadh
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Abha
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Dammam
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Jeddah
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Madina
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Mecca
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        test
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Riyadh
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Abha
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Dammam
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Jeddah
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Madina
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Mecca
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        test
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="contact-details">
                            <div class="selected-branch">
                                <p class="mb-0">
                                    Ranyah
                                </p>
                            </div>
                            <div class="changed-info">
                                <div class="map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3453.377599546716!2d31.202060976411225!3d30.05470911808276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584177183e24c1%3A0x89be8a01ae6e26bd!2zV2ViU1REWSAtINmI2YrYqCDYs9iq2K_Zig!5e0!3m2!1sen!2seg!4v1683635313081!5m2!1sen!2seg" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                                <div class="info-line">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
                                    </p>
                                </div>
                                <a href="tel:+96600000000" class="info-line">
                                    <i class="fas fa-phone-alt"></i>
                                    <p class="mb-0">
                                        +966 00000000
                                    </p>
                                </a>
                                <a href="example@mail.com" class="info-line">
                                    <i class="far fa-envelope"></i>
                                    <p class="mb-0">
                                        example@mail.com
                                    </p>
                                </a>
                            </div>
                            <div class="opening-hours">
                                <h6 class="text-center text-primary text-uppercase">
                                    {{__('Opening hours')}}
                                </h6>
                                <p>
                                    Monday – Friday: 09:00AM – 09:00PM
                                </p>
                                <p>
                                    Saturday: 09:00AM – 07:00PM
                                </p>
                                <p>
                                    Sunday: Closed
                                </p>
                            </div>
                            <ul class="nav social-icons">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fab fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fab fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="contact-form-container">
                        <h5 class="text-primary text-uppercase">
                            {{__('Contact form')}}
                        </h5>
                        <input name="" type="text" class="form-control light" placeholder="{{__('Name')}}">
                        <input name="" type="text" class="form-control light" placeholder="{{__('Mail')}}">
                        <input name="" type="text" class="form-control light" placeholder="{{__('Phone Number')}}">
                        <textarea rows="5" name="" type="text" class="form-control light" placeholder="{{__('Message')}}"></textarea>
                        <div class="w-100">
                            <button class="btn btn-filled mx-auto w-75 mt-3" type="submit">
                                {{__('Send')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('web.layouts.footer')
@endsection

@push('scripts')

@endpush
