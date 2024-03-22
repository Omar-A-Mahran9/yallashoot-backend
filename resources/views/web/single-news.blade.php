@extends('web.layouts.app')

@section('content')
    @include('web.layouts.navbar')
    
    <section class="inner-page single-news-page">
        <div class="container">
            
            <div class="row">
                <div class="col-12">
                    <div class="news-image" style="background-image: url('{{asset('web/img/single-news-image.png')}}')"></div>
                    <div class="news-info">
                        <h5 class="news-title">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr 
                        </h5>
                        <div class="d-flex">
                            <p class="mb-0 mr-2">
                                <i class="fas fa-tag"></i>
                                Tag Name
                            </p>
                            <p class="mb-0 mr-2">
                                <i class="fas fa-tag"></i>
                                2 {{__('days ago')}}
                            </p>
                        </div>
                    </div>
                    <div class="news-details">
                        <p>
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.
                        </p>
                    </div>
                </div>
                <div class="col-12">
                    <h2 class="text-primary">
                        {{__('Related News')}}
                    </h2>
                    <div class="news-container">
                        <div class="single-news">
                            <a href="{{route('single-news')}}">
                                <div class="img-conitaner" style="background-image: url('{{asset('web/img/news-image-3.png')}}');">
                                    <div class="news-info">
                                        <p>
                                            <i class="fas fa-tag"></i>
                                            Tag Name
                                        </p>
                                        <p>
                                            <i class="fas fa-clock"></i>
                                            2 {{__('days ago')}}
                                        </p>
                                    </div>
                                </div>
                                <div class="news-details">
                                    <h4 class="title">Title</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.
                                    </p>
                                    <p class="more">
                                        {{__('Read more')}}
                                        <span class="mr-2">
                                            <i class="fas fa-chevron-right flip"></i>
                                        </span>
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="single-news">
                            <a href="{{route('single-news')}}">
                                <div class="img-conitaner" style="background-image: url('{{asset('web/img/news-image-3.png')}}');">
                                    <div class="news-info">
                                        <p>
                                            <i class="fas fa-tag"></i>
                                            Tag Name
                                        </p>
                                        <p>
                                            <i class="fas fa-clock"></i>
                                            2 {{__('days ago')}}
                                        </p>
                                    </div>
                                </div>
                                <div class="news-details">
                                    <h4 class="title">Title</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.
                                    </p>
                                    <p class="more">
                                        {{__('Read more')}}
                                        <span class="mr-2">
                                            <i class="fas fa-chevron-right flip"></i>
                                        </span>
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="single-news">
                            <a href="{{route('single-news')}}">
                                <div class="img-conitaner" style="background-image: url('{{asset('web/img/news-image-3.png')}}');">
                                    <div class="news-info">
                                        <p>
                                            <i class="fas fa-tag"></i>
                                            Tag Name
                                        </p>
                                        <p>
                                            <i class="fas fa-clock"></i>
                                            2 {{__('days ago')}}
                                        </p>
                                    </div>
                                </div>
                                <div class="news-details">
                                    <h4 class="title">Title</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.
                                    </p>
                                    <p class="more">
                                        {{__('Read more')}}
                                        <span class="mr-2">
                                            <i class="fas fa-chevron-right flip"></i>
                                        </span>
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="single-news">
                            <a href="{{route('single-news')}}">
                                <div class="img-conitaner" style="background-image: url('{{asset('web/img/news-image-3.png')}}');">
                                    <div class="news-info">
                                        <p>
                                            <i class="fas fa-tag"></i>
                                            Tag Name
                                        </p>
                                        <p>
                                            <i class="fas fa-clock"></i>
                                            2 {{__('days ago')}}
                                        </p>
                                    </div>
                                </div>
                                <div class="news-details">
                                    <h4 class="title">Title</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem.
                                    </p>
                                    <p class="more">
                                        {{__('Read more')}}
                                        <span class="mr-2">
                                            <i class="fas fa-chevron-right flip"></i>
                                        </span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('web.layouts.footer')
@endsection