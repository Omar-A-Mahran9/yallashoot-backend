<nav class="navbar navbar-expand-lg fixed-top scrolled">
    <div class="container">
        <a class="navbar-brand" href="#">
            <div class="logo-container"></div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <div class="search-container ms-auto">
                <div class="input-group">
                    <input type="text" class="form-control" name="" id="" placeholder="{{__('Search here')}}...">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('home.index')}}" title="{{ __('Home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('brands')}}" title="{{ __('Cars') }}">{{ __('Cars') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('offers')}}" title="{{ __('Offers') }}">{{ __('Offers') }}</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="/purchase" title="{{ __('Purchase') }}">{{ __('Purchase') }}</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{route('faq')}}" title="{{ __('FAQ') }}">{{ __('FAQ') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about" title="{{ __('About us') }}">{{ __('About us') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact" title="{{ __('Contact Us') }}">{{ __('Contact Us') }}</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{route('news')}}" title="{{ __('News') }}">{{ __('News') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/careers" title="{{ __('Careers') }}">{{ __('Careers') }}</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link lang" href="#">
                        <img src="{{asset('web/img/earth-icon.png')}}" alt="">
                        <span>ع</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

