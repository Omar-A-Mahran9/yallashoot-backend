@extends('web.layouts.app')
@push('styles')
    <style>
        .sticky-top{
            position: sticky;
            top: 0px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
@endpush

@section('content')
    @include('web.layouts.navbar')
    
    <section class="car-page inner-page">
        <div class="container">
            

            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="row" >
                        <div class="col-12">
                            <div class="rtl-slider-flex">
                                <div class="rtl-slider-nav">
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                </div>
                                <div class="rtl-slider">
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                    <div class="rtl-slider-slide" style="background-image: url('{{asset('web/img/car-image.png')}}');"></div>
                                </div>
                                
                                <span class="thumb-prev"><i class="fa fa-angle-up fa-lg"></i></span>
                                <span class="thumb-next"><i class="fa fa-angle-down fa-lg"></i><span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="car-content" style="position: relative;">
                                <nav id="main-nav" class="sticky-nav">
                                    <ul class="nav nav-pills w-100 max-w-1 mx-auto flex-nowrap pb-0 pt-2">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#car_desc">{{__('Car Description')}}</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" href="#car_specs">{{__('Specifications')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#car_features">{{__('Features')}}</a>
                                        </li>
                                    </ul>
                                </nav>
                                <div data-bs-spy="scroll" data-bs-target="#main-nav" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
                                    <div class="car-desc" id="car_desc">
                                        <h4 class="text-primary">
                                            {{__('Car Description')}}
                                        </h4>
                                        <div class="desc">
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                                            </p>
                                        </div>
                                    </div>
                                    <div class="specs" id="car_specs">
                                        <h4 class="text-primary">
                                            {{__('Specifications')}}
                                        </h4>
                                        <!-- Nav tabs -->
                                        <div class="d-flex mx-auto">
                                            <ul class="nav nav-tabs nav-justified flex-column" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#engine-spec" aria-selected="false" role="tab" tabindex="-1">
                                                        {{-- SVG ICON --}}
                                                        <div class="svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" id="noun-v-twin-engine-780343" width="38.724" height="35.095" viewBox="0 0 38.724 35.095">
                                                                <path id="Path_19120" data-name="Path 19120" d="M260.352,306.29a6.654,6.654,0,1,0,6.663,6.654A6.663,6.663,0,0,0,260.352,306.29Zm0,1.206a5.444,5.444,0,1,1-5.44,5.449A5.442,5.442,0,0,1,260.352,307.5Z" transform="translate(-240.995 -286.924)" fill="#bbb"/>
                                                                <path id="Path_19121" data-name="Path 19121" d="M235.634,398.129v5.493l-2.671,2.671H222.576l-2.671-2.671v-5.19H218.69v5.69l3.385,3.385h11.389l3.376-3.385v-5.994Z" transform="translate(-208.407 -372.413)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19122" data-name="Path 19122" d="M325.53,376.3a1.813,1.813,0,1,0,1.822,1.813A1.821,1.821,0,0,0,325.53,376.3Zm0,1.206a.607.607,0,0,1,0,1.215.607.607,0,0,1,0-1.215Z" transform="translate(-306.172 -352.093)" fill="#bbb"/>
                                                                <path id="Path_19123" data-name="Path 19123" d="M301.117,35a3.631,3.631,0,1,0,3.635,3.626A3.633,3.633,0,0,0,301.117,35Zm0,1.206a2.421,2.421,0,1,1-2.412,2.421A2.412,2.412,0,0,1,301.117,36.206Z" transform="translate(-281.76 -34.392)" fill="#bbb"/>
                                                                <path id="Path_19124" data-name="Path 19124" d="M112.435,68.848l-1.054.6L117.857,80.8l-8.8,5.431-6.351-11.541-1.063.581,6.583,11.96V91.92a.6.6,0,0,0,.607.607h4.234V91.312h-3.626V87.417l9.549-5.9h0a.605.605,0,0,0,.214-.822Z" transform="translate(-99.455 -65.899)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19125" data-name="Path 19125" d="M194.07,204.62l-9.87,6.208.643,1.027,9.87-6.217Z" transform="translate(-176.302 -192.284)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19126" data-name="Path 19126" d="M149.612,126.07l-1.063.59,5.645,10.165,1.054-.59Z" transform="translate(-143.116 -119.165)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19127" data-name="Path 19127" d="M198.572,97.523l-1.063.59,5.645,10.156,1.054-.581Z" transform="translate(-188.691 -92.592)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19128" data-name="Path 19128" d="M268.086,86.156l-2.251,1.411.643,1.027,2.251-1.411Z" transform="translate(-252.293 -82.011)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19129" data-name="Path 19129" d="M292.516,116.77l-2.26,1.411.643,1.027,2.26-1.411Z" transform="translate(-275.025 -110.508)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19130" data-name="Path 19130" d="M81.884,26.215a.608.608,0,0,0-.321.089L70.272,33.11a.605.605,0,0,0-.205.84l1.411,2.269a.605.605,0,0,0,.831.2L83.6,29.609h0a.6.6,0,0,0,.206-.84L82.393,26.5h0a.605.605,0,0,0-.509-.286Zm-.206,1.429.768,1.242L72.192,35.067l-.768-1.233Z" transform="translate(-69.976 -26.214)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19131" data-name="Path 19131" d="M350.062,68.848,343.291,80.7h0a.6.6,0,0,0,.214.822l9.549,5.9v3.894h-3.626v1.215h4.234a.605.605,0,0,0,.607-.607V87.231l6.574-11.96-1.054-.581L353.438,86.23l-8.8-5.431,6.476-11.353-1.054-.6Z" transform="translate(-324.318 -65.899)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19132" data-name="Path 19132" d="M364.282,204.62l-.652,1.018,9.879,6.217.643-1.027Z" transform="translate(-343.326 -192.284)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19133" data-name="Path 19133" d="M460.21,126.07l-5.636,10.165,1.054.59,5.645-10.165Z" transform="translate(-427.982 -119.165)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19134" data-name="Path 19134" d="M411.25,97.523l-5.636,10.165,1.054.581,5.645-10.156Z" transform="translate(-382.407 -92.592)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19135" data-name="Path 19135" d="M392.952,86.156l-.643,1.027,2.251,1.411.643-1.027Z" transform="translate(-370.022 -82.011)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19136" data-name="Path 19136" d="M368.412,116.77l-.643,1.027,2.26,1.411.643-1.027Z" transform="translate(-347.179 -110.508)" fill="#bbb" fill-rule="evenodd"/>
                                                                <path id="Path_19137" data-name="Path 19137" d="M288.75,394.355a.6.6,0,1,1,.605.6A.6.6,0,0,1,288.75,394.355Z" transform="translate(-273.623 -368.337)" fill="#bbb"/>
                                                                <path id="Path_19138" data-name="Path 19138" d="M393.75,394.355a.6.6,0,1,1,.605.6A.6.6,0,0,1,393.75,394.355Z" transform="translate(-371.363 -368.337)" fill="#bbb"/>
                                                                <path id="Path_19139" data-name="Path 19139" d="M341.855,341.25a.6.6,0,1,1-.605.6A.6.6,0,0,1,341.855,341.25Z" transform="translate(-322.493 -319.467)" fill="#bbb"/>
                                                                <path id="Path_19140" data-name="Path 19140" d="M341.855,446.25a.6.6,0,1,1-.605.605A.6.6,0,0,1,341.855,446.25Z" transform="translate(-322.493 -417.207)" fill="#bbb"/>
                                                                <path id="Path_19141" data-name="Path 19141" d="M430.761,26.2a.6.6,0,0,0-.545.286L428.8,28.759h0a.605.605,0,0,0,.205.84l11.29,6.806a.6.6,0,0,0,.831-.2l1.411-2.269a.605.605,0,0,0-.205-.84l-11.29-6.806a.605.605,0,0,0-.286-.089Zm.17,1.429,10.254,6.19-.768,1.233-10.254-6.181Z" transform="translate(-403.91 -26.204)" fill="#bbb" fill-rule="evenodd"/>
                                                            </svg>
                                                        </div>
                                                        <p>{{__('Engine Specifications')}}</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#transmission" aria-selected="false" role="tab" tabindex="-1">
                                                        <div class="svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" id="noun-transmission-1325127" width="28.14" height="26.222" viewBox="0 0 28.14 26.222">
                                                                <path id="Path_19142" data-name="Path 19142" d="M107.76,50.4a4.151,4.151,0,0,0-.639,8.254v9.713a4.157,4.157,0,1,0,1.279,0V64.146h8.634v4.217a4.157,4.157,0,1,0,1.279,0V64.146h9.273a.64.64,0,0,0,.639-.639V58.65a4.157,4.157,0,1,0-1.279,0v4.217h-8.634V58.65a4.157,4.157,0,1,0-1.279,0v4.217H108.4V58.65a4.151,4.151,0,0,0-.64-8.254Zm0,1.279a2.878,2.878,0,1,1-2.878,2.878A2.868,2.868,0,0,1,107.76,51.675Zm9.913,0a2.878,2.878,0,1,1-2.878,2.878A2.868,2.868,0,0,1,117.673,51.675Zm9.913,0a2.878,2.878,0,1,1-2.878,2.878A2.868,2.868,0,0,1,127.586,51.675Zm0,16.628a4.157,4.157,0,1,0,2.858,7.165.64.64,0,1,0-.879-.919,2.877,2.877,0,1,1,.9-2.088.64.64,0,1,0,1.279,0,4.167,4.167,0,0,0-4.157-4.157ZM107.76,69.583a2.878,2.878,0,1,1-2.878,2.878A2.868,2.868,0,0,1,107.76,69.583Zm9.913,0a2.878,2.878,0,1,1-2.878,2.878A2.868,2.868,0,0,1,117.673,69.583Z" transform="translate(-103.603 -50.396)" fill="#a8a8a8"/>
                                                            </svg>
                                                        </div>
                                                        <p>{{__('Transmission')}}</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#measurements" aria-selected="false" role="tab" tabindex="-1">
                                                        <div class="svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="35.189" height="27.099" viewBox="0 0 35.189 27.099">
                                                                <g id="Group_3325" data-name="Group 3325" transform="translate(0)">
                                                                    <g id="noun-car-4258091">
                                                                        <path id="Path_19144" data-name="Path 19144" d="M178.43,191.39a4.352,4.352,0,0,1-3.456-1.934l-.175-.294a5.158,5.158,0,0,0-4.451-2.517h-7.675a5.215,5.215,0,0,0-3.864,1.74l-.82.82a9.48,9.48,0,0,1-5.854,3.1l-3.57.488a3.009,3.009,0,0,0-2.574,2.929v2.617a2.9,2.9,0,0,0,2.925,2.929h2.394a3.513,3.513,0,0,0,6.926,0h11.809a3.513,3.513,0,0,0,6.926,0h1.223a2.981,2.981,0,0,0,2.987-2.844v-4.11a2.982,2.982,0,0,0-2.749-2.925Zm-23.66,11.652a2.346,2.346,0,1,1,2.328-2.332,2.37,2.37,0,0,1-2.328,2.332Zm18.734,0a2.37,2.37,0,1,1,1.644-.691,2.347,2.347,0,0,1-1.644.691Zm6.442-4.7a1.725,1.725,0,0,1-1.754,1.758H176.97a3.551,3.551,0,0,0-2.019-2.617l-.071-.028h-.043l-.118-.047h-.028l-.133-.043h-.028l-.133-.038h-.028l-.138-.033H174.2l-.133-.024h-1.119l-.128.024h-.038l-.133.033h-.028l-.138.038h-.028l-.128.043h-.033l-.114.047h-.043l-.071.028h0a3.531,3.531,0,0,0-2.019,2.617H158.231a3.532,3.532,0,0,0-2.02-2.617l-.061-.014h-.043l-.114-.047h-.033l-.128-.043H155.8l-.128-.076h-.028l-.133-.033h-.038l-.128-.024H154.23l-.133.024h-.033l-.138.033H153.9l-.133.038h-.028l-.133.043h-.028l-.118.047h-.043l-.071.028h0a3.541,3.541,0,0,0-2.019,2.617h-2.413a1.725,1.725,0,0,1-1.768-1.735v-2.617a1.673,1.673,0,0,1,1.521-1.7l3.574-.474h0a10.349,10.349,0,0,0,6.613-3.456l.82-.948a3.881,3.881,0,0,1,2.986-1.346h7.684a4.072,4.072,0,0,1,3.4,1.9l.175.294a5.428,5.428,0,0,0,4.389,2.517,1.739,1.739,0,0,1,1.64,1.759Z" transform="translate(-145.992 -186.645)" fill="#a8a8a8"/>
                                                                    </g>
                                                                    <path id="Union_2" data-name="Union 2" d="M0,27.514V.537a.537.537,0,1,1,1.075,0V1.842H3.7a.537.537,0,0,1,0,1.074H1.075V4.782H5.568a.537.537,0,0,1,0,1.075H1.075V7.722H3.7A.537.537,0,0,1,3.7,8.8H1.075V10.6H3.7a.537.537,0,0,1,0,1.075H1.075v1.866H5.568a.537.537,0,1,1,0,1.074H1.075v1.866H3.7a.537.537,0,0,1,0,1.075H1.075v1.809H3.7a.537.537,0,0,1,0,1.074H1.075v1.866H5.568a.537.537,0,0,1,0,1.075H1.075v1.865H3.7a.537.537,0,0,1,0,1.075H1.075v1.192a.537.537,0,0,1-1.075,0Z" transform="translate(31.62 20.993) rotate(90)" fill="#a8a8a8"/>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <p>{{__('Measurments')}}</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#skeleton" aria-selected="false" role="tab" tabindex="-1">
                                                        <div class="svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" id="noun-car-4414889" width="36.044" height="25.995" viewBox="0 0 36.044 25.995">
                                                                <path id="Path_19145" data-name="Path 19145" d="M153.517,254.609l-26.293-.071a3.233,3.233,0,0,1-3.234-3.234v-3.945a3.234,3.234,0,0,1,3.234-3.234H140.36c1.992,0,4.476,0,6.875.032s4.528.052,6.268.032a3.233,3.233,0,0,1,3.234,3.234v3.926a3.234,3.234,0,0,1-3.234,3.234Zm-26.293-9.191a1.94,1.94,0,0,0-1.94,1.94V251.3a1.94,1.94,0,0,0,1.94,1.94l26.286.091h0a2.007,2.007,0,0,0,1.378-.563,1.941,1.941,0,0,0,.569-1.378v-3.971a1.94,1.94,0,0,0-1.94-1.94c-1.779,0-3.965,0-6.287-.032s-4.87-.052-6.856-.032Z" transform="translate(-122.231 -233.549)" fill="#a8a8a8"/>
                                                                <path id="Path_19146" data-name="Path 19146" d="M137.328,112.925a.648.648,0,0,1-.608-.867l2.587-7.115a6.468,6.468,0,0,1,5.912-3.881H159.1a6.423,6.423,0,0,1,6.022,4.107l2.07,6.927a.649.649,0,0,1-1.242.375l-2.05-6.888a5.129,5.129,0,0,0-4.8-3.234h-13.88A5.174,5.174,0,0,0,140.5,105.4l-2.587,7.115a.647.647,0,0,1-.588.414Z" transform="translate(-133.984 -101.063)" fill="#a8a8a8"/>
                                                                <path id="Path_19147" data-name="Path 19147" d="M145.7,373.8h-1.449a2.587,2.587,0,0,1-2.587-2.587v-3.066a.647.647,0,0,1,1.294,0v3.079a1.293,1.293,0,0,0,1.294,1.294H145.7a.983.983,0,0,0,.977-.977v-3.4a.647.647,0,0,1,1.294,0v3.4a2.271,2.271,0,0,1-2.27,2.251Z" transform="translate(-138.597 -347.807)" fill="#a8a8a8"/>
                                                                <path id="Path_19148" data-name="Path 19148" d="M467.8,370.562h-1.468a2.587,2.587,0,0,1-2.587-2.587V364.98a.647.647,0,1,1,1.294,0v2.988a1.293,1.293,0,0,0,1.294,1.294h1.449a.977.977,0,0,0,.977-.977V364.65a.647.647,0,0,1,1.294,0v3.641a2.27,2.27,0,0,1-2.251,2.27Z" transform="translate(-436.873 -344.566)" fill="#a8a8a8"/>
                                                                <path id="Path_19149" data-name="Path 19149" d="M172.4,288.617a2.3,2.3,0,1,1,1.62-.679,2.3,2.3,0,0,1-1.62.679Zm0-3.3a1,1,0,1,0,1,1,1,1,0,0,0-1-1Z" transform="translate(-164.934 -270.5)" fill="#a8a8a8"/>
                                                                <path id="Path_19150" data-name="Path 19150" d="M466.14,288.617a2.3,2.3,0,1,1,1.62-.679,2.3,2.3,0,0,1-1.62.679Zm0-3.3a1,1,0,1,0,1,1,1,1,0,0,0-1-1Z" transform="translate(-436.958 -270.5)" fill="#a8a8a8"/>
                                                                <path id="Path_19151" data-name="Path 19151" d="M291.092,309.554h-7.646a.647.647,0,0,1,0-1.294h7.646a.647.647,0,1,1,0,1.294Z" transform="translate(-269.302 -292.944)" fill="#a8a8a8"/>
                                                                <path id="Path_19152" data-name="Path 19152" d="M103.089,195.416a.647.647,0,0,1-.446-.181l-1.843-1.753a1.94,1.94,0,0,1,1.345-3.344h2.84a.647.647,0,0,1,0,1.294h-2.84a.645.645,0,0,0-.446,1.113l1.837,1.759h0a.657.657,0,0,1-.446,1.113Z" transform="translate(-100.199 -183.553)" fill="#a8a8a8"/>
                                                                <path id="Path_19153" data-name="Path 19153" d="M518.639,195.069a.647.647,0,0,1-.453-1.113l1.837-1.759a.645.645,0,0,0-.446-1.112h-2.684a.647.647,0,0,1,0-1.294h2.7a1.94,1.94,0,0,1,1.339,3.344l-1.837,1.759a.647.647,0,0,1-.459.175Z" transform="translate(-485.492 -183.232)" fill="#a8a8a8"/>
                                                            </svg>
                                                        </div>
                                                        <p>{{__('Skeleton')}}</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        
                                            <!-- Tab panes -->
                                            
                                            <div class="tab-content">
                                                <div class="tab-pane container active" id="engine-spec" role="tabpanel">
                                                    <table class="table w-50 mx-auto">
                                                        <tbody>
                                                            <tr class="line">
                                                                <td>
                                                                    قياس المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    2.5 لتر
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نوع المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    4
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                تيربو
                                                                </td>
                                                                <td class="text-center">
                                                                    غير متاح
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نظام المحرك
                                                                </td>
                                                                <td class="text-center">
                                                                    بنزين
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    الصمّامات
                                                                </td>
                                                                <td class="text-center">
                                                                    16
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    العزم
                                                                </td>
                                                                <td class="text-center">
                                                                    241 نيوتن
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    استهلاك الوقود باللتر
                                                                </td>
                                                                <td class="text-center">
                                                                    11.4 لتر
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane container fade" id="transmission" role="tabpanel">
                                                    <table class="table w-50 mx-auto">
                                                        <tbody>
                                                            <tr class="line">
                                                                <td>
                                                                    قياس المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    2.5 لتر
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نوع المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    4
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                تيربو
                                                                </td>
                                                                <td class="text-center">
                                                                    غير متاح
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نظام المحرك
                                                                </td>
                                                                <td class="text-center">
                                                                    بنزين
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    الصمّامات
                                                                </td>
                                                                <td class="text-center">
                                                                    16
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    العزم
                                                                </td>
                                                                <td class="text-center">
                                                                    241 نيوتن
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    استهلاك الوقود باللتر
                                                                </td>
                                                                <td class="text-center">
                                                                    11.4 لتر
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane container fade" id="measurements" role="tabpanel">
                                                    <table class="table w-50 mx-auto">
                                                        <tbody>
                                                            <tr class="line">
                                                                <td>
                                                                    قياس المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    2.5 لتر
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نوع المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    4
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                تيربو
                                                                </td>
                                                                <td class="text-center">
                                                                    غير متاح
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نظام المحرك
                                                                </td>
                                                                <td class="text-center">
                                                                    بنزين
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    الصمّامات
                                                                </td>
                                                                <td class="text-center">
                                                                    16
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    العزم
                                                                </td>
                                                                <td class="text-center">
                                                                    241 نيوتن
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    استهلاك الوقود باللتر
                                                                </td>
                                                                <td class="text-center">
                                                                    11.4 لتر
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane container fade" id="skeleton" role="tabpanel">
                                                    <table class="table w-50 mx-auto">
                                                        <tbody>
                                                            <tr class="line">
                                                                <td>
                                                                    قياس المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    2.5 لتر
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نوع المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    4
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                تيربو
                                                                </td>
                                                                <td class="text-center">
                                                                    غير متاح
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نظام المحرك
                                                                </td>
                                                                <td class="text-center">
                                                                    بنزين
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    الصمّامات
                                                                </td>
                                                                <td class="text-center">
                                                                    16
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    العزم
                                                                </td>
                                                                <td class="text-center">
                                                                    241 نيوتن
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    استهلاك الوقود باللتر
                                                                </td>
                                                                <td class="text-center">
                                                                    11.4 لتر
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="features" id="car_features">
                                        <h4 class="text-primary">
                                            {{__('Features')}}
                                        </h4>
                                        <!-- Nav tabs -->
                                        <div class="d-flex mx-auto">
                                            <ul class="nav nav-tabs nav-justified flex-column" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#external_equipment" aria-selected="false" role="tab" tabindex="-1">
                                                        {{-- SVG ICON --}}
                                                        <div class="svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" id="noun-car-service-3944581" width="52.548" height="31.453" viewBox="0 0 52.548 31.453">
                                                                <path id="Path_19154" data-name="Path 19154" d="M152.868,233.085a17.132,17.132,0,0,0-1.25-4.276c-.008-.016-.008-.024-.016-.04a8.289,8.289,0,0,0-3.464-3.782,6.466,6.466,0,0,0-3.225-.836h-6.474a23,23,0,0,0-16.8-6.554c-3.13-.342-7.342,1.131-11.395,2.675l-1.537.589c-.04.016-.088.032-.127.048a.84.84,0,0,0,.056-.286.8.8,0,0,0-.8-.8.757.757,0,0,1-.557-.231.782.782,0,0,1-.239-.565.8.8,0,1,0-1.592,0,.806.806,0,0,1-.231.565.788.788,0,0,1-.565.231.8.8,0,1,0,0,1.592.787.787,0,0,1,.772.677,39.93,39.93,0,0,1-3.878,1.226.793.793,0,0,0-.6.637,29.74,29.74,0,0,0-.589,5.853c0,.016-.008.024-.008.04a.182.182,0,0,0,.016.064c.088,2.309.741,4.348,2.548,5.606a.788.788,0,0,0,.454.143H107.1a4.775,4.775,0,0,0,9.476,0h17.734a4.775,4.775,0,0,0,9.476,0h7.007a2.109,2.109,0,0,0,1.608-.756,2.3,2.3,0,0,0,.469-1.824Zm-3.273-4.618a4.82,4.82,0,0,1-4.244-2.691,4.916,4.916,0,0,1,1.991.6,6.494,6.494,0,0,1,2.254,2.094Zm-24.8-4.316-2.015-4.961a20.76,20.76,0,0,1,13.234,4.961Zm-3.742-4.977,2.023,4.985H113.26l-1.585-2.724C114.972,220.2,118.508,219.046,121.048,219.174Zm-18.992,8.194h.828a.844.844,0,1,1,0,1.689h-.94C101.953,228.522,101.992,227.957,102.056,227.368Zm9.771,10.886a3.185,3.185,0,1,1,3.185-3.185A3.184,3.184,0,0,1,111.826,238.253Zm27.209,0a3.185,3.185,0,1,1,3.185-3.185A3.184,3.184,0,0,1,139.036,238.253Zm12.128-4.372a.5.5,0,0,1-.382.191H143.71a4.779,4.779,0,0,0-9.349,0H116.5a4.779,4.779,0,0,0-9.349,0h-3.527a4.8,4.8,0,0,1-1.617-3.424h.876a2.437,2.437,0,1,0,0-4.873h-.629c.048-.342.1-.685.167-1.035a70.8,70.8,0,0,0,6.848-2.389l.9-.342,1.943,3.345a.8.8,0,0,0,.685.4h30.785a6.509,6.509,0,0,0,6.2,4.332c.207,0,.422-.008.637-.024a17.647,17.647,0,0,1,.884,3.321.612.612,0,0,1-.135.5Z" transform="translate(-100.352 -208.393)" fill="#bbb"/>
                                                                <path id="Path_19155" data-name="Path 19155" d="M343.233,135.325a2.4,2.4,0,0,1,2.389,2.389.8.8,0,1,0,1.592,0,2.379,2.379,0,0,1,2.389-2.389.8.8,0,0,0,0-1.592,2.378,2.378,0,0,1-2.389-2.389.8.8,0,1,0-1.592,0,2.379,2.379,0,0,1-2.389,2.389.8.8,0,0,0,0,1.592Zm2.819-1.171a4.464,4.464,0,0,0,.366-.422,3.762,3.762,0,0,0,.374.43,4.454,4.454,0,0,0,.422.366,3.763,3.763,0,0,0-.43.374,4.45,4.45,0,0,0-.366.422,3.769,3.769,0,0,0-.8-.8A3.8,3.8,0,0,0,346.052,134.154Z" transform="translate(-316.964 -130.548)" fill="#bbb"/>
                                                                <path id="Path_19156" data-name="Path 19156" d="M485.65,195.859a.8.8,0,0,1,.8.8.8.8,0,1,0,1.592,0,.748.748,0,0,1,.239-.557.791.791,0,0,1,.557-.239.8.8,0,1,0,0-1.592.757.757,0,0,1-.557-.231.782.782,0,0,1-.239-.565.8.8,0,1,0-1.592,0,.807.807,0,0,1-.231.565.788.788,0,0,1-.565.231.8.8,0,1,0,0,1.592Z" transform="translate(-444.394 -186.137)" fill="#bbb"/>
                                                                <path id="Path_19157" data-name="Path 19157" d="M225.33,136.3a.8.8,0,0,1,.8.8.8.8,0,0,0,1.592,0,.748.748,0,0,1,.239-.557.791.791,0,0,1,.557-.239.8.8,0,0,0,0-1.592.757.757,0,0,1-.557-.231.782.782,0,0,1-.239-.565.8.8,0,0,0-1.592,0,.807.807,0,0,1-.231.565.821.821,0,0,1-.565.231.8.8,0,0,0,0,1.592Z" transform="translate(-211.467 -132.844)" fill="#bbb"/>
                                                            </svg>
                                                        </div>
                                                        <p>{{__('External Equipment')}}</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#ease_and_comfort" aria-selected="false" role="tab" tabindex="-1">
                                                        <div class="svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" id="noun-easy-4676087" width="26.953" height="36.433" viewBox="0 0 26.953 36.433">
                                                                <path id="Path_19159" data-name="Path 19159" d="M311.234,414.724a1.054,1.054,0,0,0,.674,1.791h.032a1.054,1.054,0,1,0-.706-1.791Z" transform="translate(-301.122 -383.544)" fill="#a8a8a8"/>
                                                                <path id="Path_19160" data-name="Path 19160" d="M232.988,138.783a2.418,2.418,0,0,0-1.5-.738,2.343,2.343,0,0,0,.258-1.017,2.317,2.317,0,0,0-.627-1.649,2.266,2.266,0,0,0-1.48-.717,2.492,2.492,0,0,0-.5-2.634,2.465,2.465,0,0,0-1.412-.748L232,127.235a2.292,2.292,0,0,0,.09-3.214,2.266,2.266,0,0,0-1.581-.717,2.291,2.291,0,0,0-1.633.622l-10.216,9.668a8.919,8.919,0,0,0-2.15-4.215,5.505,5.505,0,0,0-3.793-2.039,1.739,1.739,0,0,0-1.654.785,2.892,2.892,0,0,0,.032,2.9,12.044,12.044,0,0,1,1.491,7.15,11.311,11.311,0,0,1-.564,2.524,1.913,1.913,0,0,0-.622-.137,1.728,1.728,0,0,0-1.233.469l-2.945,2.771a1.722,1.722,0,0,0-.079,2.434l8.9,9.484a1.733,1.733,0,0,0,2.439.079l2.945-2.771a1.691,1.691,0,0,0,.527-1.2,1.727,1.727,0,0,0-.2-.859l1.391-.748a23.741,23.741,0,0,0,5.042-3.625l4.668-4.389a2.423,2.423,0,0,0,.111-3.424ZM220.76,152.318l-2.95,2.766h0a.738.738,0,0,1-1.054-.032l-8.9-9.484a.743.743,0,0,1,.032-1.054l2.956-2.782a.755.755,0,0,1,.527-.2.733.733,0,0,1,.527.237l7.366,7.866,1.533,1.633h0a.732.732,0,0,1-.032,1.049Zm11.9-11.828a1.433,1.433,0,0,1-.453,1.006l-4.673,4.389a22.786,22.786,0,0,1-4.831,3.477l-1.581.838-3.835-4.094-4.463-4.742a11.686,11.686,0,0,0,.727-3.019,13.173,13.173,0,0,0-1.581-7.766,1.933,1.933,0,0,1-.074-1.892.749.749,0,0,1,.748-.343,4.478,4.478,0,0,1,3.161,1.713,7.277,7.277,0,0,1,2.013,4.573h0a.485.485,0,0,0,.284.464.49.49,0,0,0,.527-.09l10.895-10.353a1.3,1.3,0,0,1,.933-.353,1.287,1.287,0,0,1,.906.406,1.3,1.3,0,0,1-.047,1.833l-6.849,6.523a.49.49,0,0,0,.669.712l1.2-1.122a1.493,1.493,0,0,1,2.044,2.176l-1.581,1.491a.49.49,0,1,0,.669.716l1.107-1.054a1.321,1.321,0,1,1,1.812,1.923l-.8.753-.827.774a.5.5,0,0,0,0,.7.49.49,0,0,0,.69,0l.832-.78a1.444,1.444,0,0,1,2.429,1.1Z" transform="translate(-206.675 -119.827)" fill="#a8a8a8"/>
                                                                <path id="Path_19161" data-name="Path 19161" d="M290.449,113.1a.49.49,0,0,0,.348.142.526.526,0,0,0,.348-.142.49.49,0,0,0,0-.69l-1.713-1.723a.49.49,0,0,0-.69.7Z" transform="translate(-280.896 -108.278)" fill="#a8a8a8"/>
                                                                <path id="Path_19162" data-name="Path 19162" d="M344.443,89.741a.49.49,0,0,0,.49-.49V86.838a.49.49,0,0,0-.98,0v2.413A.49.49,0,0,0,344.443,89.741Z" transform="translate(-331.038 -86.348)" fill="#a8a8a8"/>
                                                                <path id="Path_19163" data-name="Path 19163" d="M383.09,112.574a.489.489,0,0,0,.348-.142l1.707-1.707a.49.49,0,1,0-.69-.68l-1.707,1.7a.487.487,0,0,0,.342.832Z" transform="translate(-366.049 -107.632)" fill="#a8a8a8"/>
                                                            </svg>
                                                        </div>
                                                        <p>{{__('Ease and comfort')}}</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#seats" aria-selected="false" role="tab" tabindex="-1">
                                                        <div class="svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" id="noun-car-seat-1694451" width="27.021" height="36.737" viewBox="0 0 27.021 36.737">
                                                                <path id="Path_19158" data-name="Path 19158" d="M157.635,49.155a5.277,5.277,0,0,0,1.412,2.639,10.844,10.844,0,0,0,3.5,2.824.456.456,0,0,0,.276.061h16.665a.234.234,0,0,0,.153-.061,11.716,11.716,0,0,0,3.5-2.824,5.388,5.388,0,0,0,1.412-2.639c.246-1.627-.43-4.082-2.271-4.573-.184-1.719-.307-2.916-.338-3.591-.031-.368-.061-.767-.123-1.136s-.123-.767-.184-1.136q-.046-.276-.092-.46V38.2a27.227,27.227,0,0,1-.184-7.089,4.639,4.639,0,0,0-1.136-3.437,3.041,3.041,0,0,0-2.21-1.013h-3.284V25.4h.829a1.825,1.825,0,0,0,1.381-.614,1.292,1.292,0,0,0,.276-1.136l-1.074-4.512a1.643,1.643,0,0,0-1.657-1.2h-6.66a1.643,1.643,0,0,0-1.657,1.2l-.982,4.512a1.292,1.292,0,0,0,.276,1.136,1.726,1.726,0,0,0,1.381.614h.829v1.258h-3.038a3.1,3.1,0,0,0-2.056.982,4.494,4.494,0,0,0-1.136,3.376,18.605,18.605,0,0,1-.522,6.507l-.031.092c-.061.246-.153.522-.246.859-.276,1.043-.43,1.841-.46,1.995a15.907,15.907,0,0,0,0,4.021h-.092c-1.995.46-2.732,3.008-2.455,4.665Zm2.333,1.872A3.9,3.9,0,0,1,158.832,49c-.184-1.2.307-3.008,1.535-3.253a2.5,2.5,0,0,1,2.455,1.381v6.292a10.78,10.78,0,0,1-2.854-2.394Zm18.292,2.455h-14.21V47.467a.234.234,0,0,0,.061-.153h14.118v6.169Zm-12.43-16.911h10.619v9.545H165.829Zm17.494,12.4A4.4,4.4,0,0,1,182.188,51a9.782,9.782,0,0,1-2.7,2.3V47.283a2.641,2.641,0,0,1,2.056-1.565c.061,0,.092.031.153.031h.123c1.166.184,1.688,2.087,1.5,3.223Zm-5.371-21.054a1.724,1.724,0,0,1,1.289.614,3.332,3.332,0,0,1,.8,2.517,28.4,28.4,0,0,0,.215,7.458v.061a3.266,3.266,0,0,1,.092.43c.061.338.123.706.184,1.043a6,6,0,0,1,.092,1.043c.031.645.153,1.841.338,3.468a3.84,3.84,0,0,0-2.24,1.565h-1.074v-18.2Zm-11.54-3.867a.237.237,0,0,1-.031-.092l.982-4.512a.474.474,0,0,1,.46-.246h6.691c.276,0,.43.123.46.246l.982,4.512a.152.152,0,0,1-.031.092.512.512,0,0,1-.43.153h-8.685a.54.54,0,0,1-.4-.153Zm2.455,1.381h4.542V26.69h-4.542Zm7.611,2.486v7.428H165.83V27.918ZM161.41,40.685c.031-.153.153-.89.43-1.872.092-.338.184-.583.215-.767l.031-.092a20.439,20.439,0,0,0,.552-6.936,3.319,3.319,0,0,1,.829-2.486,2.025,2.025,0,0,1,1.166-.614V46.087h-.982a3.907,3.907,0,0,0-2.21-1.535,15.859,15.859,0,0,1-.031-3.867Z" transform="translate(-157.579 -17.943)" fill="#a8a8a8"/>
                                                            </svg>
                                                        </div>
                                                        <p>{{__('Seats')}}</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#safty" aria-selected="false" role="tab" tabindex="-1">
                                                        <div class="svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="28.889" height="34.582" viewBox="0 0 28.889 34.582">
                                                                <path id="noun-safety-4716650" d="M165.655,42.035a2.828,2.828,0,0,0-.709.089L153.328,45.15a2.836,2.836,0,0,0-2.118,2.742V62.273c0,4.841,3.835,8.19,6.992,10.453a39.072,39.072,0,0,0,6.308,3.65,2.824,2.824,0,0,0,2.283,0,38.983,38.983,0,0,0,6.314-3.65c3.156-2.263,6.992-5.612,6.992-10.453V47.892a2.836,2.836,0,0,0-2.118-2.742l-11.617-3.026a2.815,2.815,0,0,0-.709-.089Zm0,2.033a.78.78,0,0,1,.2.024l11.617,3.028a.79.79,0,0,1,.594.773V62.273c0,3.74-3.135,6.635-6.143,8.792a37.467,37.467,0,0,1-5.947,3.447l-.008.008a.773.773,0,0,1-.632,0l-.006-.008a37.576,37.576,0,0,1-5.941-3.447c-3.008-2.157-6.143-5.052-6.143-8.792V47.892a.791.791,0,0,1,.594-.773l11.617-3.028a.78.78,0,0,1,.2-.024Zm0,1.635a1.018,1.018,0,0,0-.258.034l-9.807,2.569a1.017,1.017,0,0,0-.767.983V62.273a6.68,6.68,0,0,0,1.727,4.023,18.78,18.78,0,0,0,3.755,3.485,28.5,28.5,0,0,0,4.919,2.861,1.019,1.019,0,0,0,.856,0,28.5,28.5,0,0,0,4.925-2.861A18.791,18.791,0,0,0,174.76,66.3a6.679,6.679,0,0,0,1.727-4.023V49.289a1.017,1.017,0,0,0-.765-.983l-9.807-2.569a1.019,1.019,0,0,0-.26-.034Zm0,2.076,8.794,2.291v12.2a5.131,5.131,0,0,1-1.284,2.762,17.035,17.035,0,0,1-3.35,3.1,22.5,22.5,0,0,1-4.168,2.424,22.527,22.527,0,0,1-4.161-2.424,17.013,17.013,0,0,1-3.348-3.1,5.137,5.137,0,0,1-1.285-2.762V50.07Zm3.994,6.676a1.019,1.019,0,0,0-.7.346l-4.182,4.8-2.094-2.253a1.016,1.016,0,0,0-1.488,1.383l2.861,3.078a1.017,1.017,0,0,0,1.51-.022l4.925-5.647a1.017,1.017,0,0,0-.835-1.683Z" transform="translate(-151.21 -42.035)" fill="#a8a8a8"/>
                                                            </svg>
                                                        </div>
                                                        <p>{{__('Safty')}}</p>
                                                    </a>
                                                </li>
                                            </ul>
                                            
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div class="tab-pane container active" id="external_equipment" role="tabpanel">
                                                    <table class="table w-50 mx-auto">
                                                        <tbody>
                                                            <tr class="line">
                                                                <td>
                                                                    قياس المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    2.5 لتر
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نوع المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    4
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                تيربو
                                                                </td>
                                                                <td class="text-center">
                                                                    غير متاح
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نظام المحرك
                                                                </td>
                                                                <td class="text-center">
                                                                    بنزين
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    الصمّامات
                                                                </td>
                                                                <td class="text-center">
                                                                    16
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    العزم
                                                                </td>
                                                                <td class="text-center">
                                                                    241 نيوتن
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    استهلاك الوقود باللتر
                                                                </td>
                                                                <td class="text-center">
                                                                    11.4 لتر
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane container fade" id="ease_and_comfort" role="tabpanel">
                                                    <table class="table w-50 mx-auto">
                                                        <tbody>
                                                            <tr class="line">
                                                                <td>
                                                                    قياس المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    2.5 لتر
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نوع المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    4
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                تيربو
                                                                </td>
                                                                <td class="text-center">
                                                                    غير متاح
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نظام المحرك
                                                                </td>
                                                                <td class="text-center">
                                                                    بنزين
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    الصمّامات
                                                                </td>
                                                                <td class="text-center">
                                                                    16
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    العزم
                                                                </td>
                                                                <td class="text-center">
                                                                    241 نيوتن
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    استهلاك الوقود باللتر
                                                                </td>
                                                                <td class="text-center">
                                                                    11.4 لتر
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane container fade" id="seats" role="tabpanel">
                                                    <table class="table w-50 mx-auto">
                                                        <tbody>
                                                            <tr class="line">
                                                                <td>
                                                                    قياس المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    2.5 لتر
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نوع المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    4
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                تيربو
                                                                </td>
                                                                <td class="text-center">
                                                                    غير متاح
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نظام المحرك
                                                                </td>
                                                                <td class="text-center">
                                                                    بنزين
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    الصمّامات
                                                                </td>
                                                                <td class="text-center">
                                                                    16
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    العزم
                                                                </td>
                                                                <td class="text-center">
                                                                    241 نيوتن
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    استهلاك الوقود باللتر
                                                                </td>
                                                                <td class="text-center">
                                                                    11.4 لتر
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane container fade" id="safty" role="tabpanel">
                                                    <table class="table w-50 mx-auto">
                                                        <tbody>
                                                            <tr class="line">
                                                                <td>
                                                                    قياس المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    2.5 لتر
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نوع المحرّك
                                                                </td>
                                                                <td class="text-center">
                                                                    4
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                تيربو
                                                                </td>
                                                                <td class="text-center">
                                                                    غير متاح
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    نظام المحرك
                                                                </td>
                                                                <td class="text-center">
                                                                    بنزين
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    الصمّامات
                                                                </td>
                                                                <td class="text-center">
                                                                    16
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    العزم
                                                                </td>
                                                                <td class="text-center">
                                                                    241 نيوتن
                                                                </td>
                                                            </tr>
                                                            <tr class="line">
                                                                <td>
                                                                    استهلاك الوقود باللتر
                                                                </td>
                                                                <td class="text-center">
                                                                    11.4 لتر
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="sticky-top car-details">
                        <div class="car-actions">
                            <a href="#" class="btn">
                                <i class="fas fa-share-alt"></i>
                            </a>
                            <a href="#" class="btn">
                                <i class="fas fa-heart"></i>
                            </a>
                        </div>
                        <h5 class="car-name text-start">
                            DODGE CHALLENGER 2023
                        </h5>
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
                        <div class="installments">
                            <p>installment now starting from</p>
                            <p class="installment-price">
                                1500
                                <span>
                                    SAR
                                </span>
                            </p>
                        </div>
                        <div class="purchase-car-card__colors" style="font-family: Tajawal;">
                            <div class="selected-color" style="background-color: rgb(255, 255, 255); font-family: Tajawal;">
                                <span style="color: black; font-family: Tajawal;">ابيض</span>
                            </div>
                            <div class="available-colors" style="font-family: Tajawal;">
                                <label style="font-family: Tajawal;">{{__('Available colors')}}</label>
                                <div class="color-selection-input" style="font-family: Tajawal;">
                                    <div class="form-check" style="font-family: Tajawal;">
                                        <input type="radio" class="form-check-input" checked="" id="radio1" name="color" data-pivot="{&quot;car_id&quot;:47,&quot;color_id&quot;:1,&quot;inner_images&quot;:&quot;[\&quot;webstdy_16727358985G6B0651.jpg\&quot;,\&quot;webstdy_16727358985G6B0862.jpg\&quot;,\&quot;webstdy_16727358985G6B0868.jpg\&quot;,\&quot;webstdy_16727358985G6B0872.jpg\&quot;,\&quot;webstdy_16727358985G6B0805.jpg\&quot;,\&quot;webstdy_16727358985G6B0815.jpg\&quot;,\&quot;webstdy_16727358985G6B0819.jpg\&quot;]&quot;,&quot;outer_images&quot;:&quot;[\&quot;webstdy_16727358985G6B0825.jpg\&quot;,\&quot;webstdy_16727358985G6B0835.jpg\&quot;,\&quot;webstdy_16727358985G6B0845.jpg\&quot;,\&quot;webstdy_16727358985G6B0853.jpg\&quot;,\&quot;webstdy_16727358985G6B0774.jpg\&quot;,\&quot;webstdy_16727358985G6B0784.jpg\&quot;,\&quot;webstdy_16727358985G6B0792.jpg\&quot;,\&quot;webstdy_16727358985G6B0799.jpg\&quot;]&quot;}" value="1" data-color-name="ابيض" data-color-hex-code="#ffffff" style="background-color: rgb(255, 255, 255); font-family: Tajawal;">
                                        <label class="form-check-label" for="radio1" style="font-family: Tajawal;"></label>
                                    </div>
                                    <div class="form-check" style="font-family: Tajawal;">
                                        <input type="radio" class="form-check-input" id="radio1" name="color" data-pivot="{&quot;car_id&quot;:47,&quot;color_id&quot;:2,&quot;inner_images&quot;:&quot;[]&quot;,&quot;outer_images&quot;:&quot;[\&quot;webstdy_16727358985G6B0714.jpg\&quot;,\&quot;webstdy_16727358985G6B0722.jpg\&quot;,\&quot;webstdy_16727358985G6B0727.jpg\&quot;,\&quot;webstdy_16727358985G6B0738.jpg\&quot;]&quot;}" value="2" data-color-name="اسود" data-color-hex-code="#000000" style="background-color: rgb(0, 0, 0); font-family: Tajawal;">
                                        <label class="form-check-label" for="radio1" style="font-family: Tajawal;"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="side-icons">
                            <div class="line">
                                <img src="{{asset('web/img/icons/car-icon.png')}}" alt="">
                                2020
                            </div>
                            <div class="line">
                                <img src="{{asset('web/img/icons/seat-icon.png')}}" alt="">
                                Leather
                            </div>
                            <div class="line">
                                <img src="{{asset('web/img/icons/front-wheel-icon.png')}}" alt="">
                                1.5 Liter
                            </div>
                            <div class="line">
                                <img src="{{asset('web/img/icons/motor-icon.png')}}" alt="">
                                Front wheel
                            </div>
                        </div>
                        <button class="btn btn-filled w-100 mt-4">{{__('Purchase')}}</button>
                    </div>
                </div>
                <div class="col-12">
                    <h4 class="text-primary">
                        {{__('Similar cars')}}
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
            </div>

            
        </div>
    </section>


    @include('web.layouts.footer')
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.rtl-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
                
            asNavFor: '.rtl-slider-nav'
            });
            $('.rtl-slider-nav').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                vertical: true,
            asNavFor: '.rtl-slider',
            centerMode: false,
            focusOnSelect: true,
                prevArrow: ".thumb-prev",
            nextArrow: ".thumb-next",
            });
        });
    </script>
@endpush
