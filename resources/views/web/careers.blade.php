@extends('web.layouts.app')
@push('styles')

@endpush

@section('content')
    @include('web.layouts.navbar')

    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">
                        {{__('Careers')}}
                    </h2>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="input-group">
                        <input type="text" class="form-control light" placeholder="{{__('Job title or key')}}...">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <div class="opportunities-count">
                        <p class="mb-0">
                            3
                            {{__('open opportunitie(s)')}}
                        </p>
                    </div>
                    <div class="jobs-container">
                        <a href="#" class="single-job active">
                            <div>
                                <h6 class="job-title">
                                    Job Title
                                </h6>
                                <div class="job-info">
                                    <p>location</p>
                                    <p>2 {{__('days ago')}}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right flip"></i>
                        </a>
                        <a href="#" class="single-job">
                            <div>
                                <h6 class="job-title">
                                    Job Title
                                </h6>
                                <div class="job-info">
                                    <p>location</p>
                                    <p>2 {{__('days ago')}}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right flip"></i>
                        </a>
                        <a href="#" class="single-job">
                            <div>
                                <h6 class="job-title">
                                    Job Title
                                </h6>
                                <div class="job-info">
                                    <p>location</p>
                                    <p>2 {{__('days ago')}}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right flip"></i>
                        </a>
                        <a href="#" class="single-job">
                            <div>
                                <h6 class="job-title">
                                    Job Title
                                </h6>
                                <div class="job-info">
                                    <p>location</p>
                                    <p>2 {{__('days ago')}}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right flip"></i>
                        </a>
                        <a href="#" class="single-job">
                            <div>
                                <h6 class="job-title">
                                    Job Title
                                </h6>
                                <div class="job-info">
                                    <p>location</p>
                                    <p>2 {{__('days ago')}}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right flip"></i>
                        </a>
                        <a href="#" class="single-job">
                            <div>
                                <h6 class="job-title">
                                    Job Title
                                </h6>
                                <div class="job-info">
                                    <p>location</p>
                                    <p>2 {{__('days ago')}}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right flip"></i>
                        </a>
                        <a href="#" class="single-job">
                            <div>
                                <h6 class="job-title">
                                    Job Title
                                </h6>
                                <div class="job-info">
                                    <p>location</p>
                                    <p>2 {{__('days ago')}}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right flip"></i>
                        </a>
                        <a href="#" class="single-job">
                            <div>
                                <h6 class="job-title">
                                    Job Title
                                </h6>
                                <div class="job-info">
                                    <p>location</p>
                                    <p>2 {{__('days ago')}}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right flip"></i>
                        </a>
                        <a href="#" class="single-job">
                            <div>
                                <h6 class="job-title">
                                    Job Title
                                </h6>
                                <div class="job-info">
                                    <p>location</p>
                                    <p>2 {{__('days ago')}}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right flip"></i>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="job-container sticky-top">
                        <div class="job-container__header">
                            <h5 class="job-title">Job title</h5>
                            <div class="d-flex align-items-center">
                                <div class="job-info me-4">
                                    <p>location</p>
                                    <p>2 {{__('days ago')}}</p>
                                </div>
                                <a href="#" class="btn btn-filled">
                                    {{__('Apply Now')}}
                                </a>
                            </div>
                        </div>
                        <div class="job-container__body">
                            <h6 class="category-title">
                                {{__('Responsibilities')}}:
                            </h6>
                            <ul class="">
                                <li>
                                    Analyze and share a deep understanding of overarching customer behavior to understand future trends and areas of a potential investment.
                                </li>
                                <li>
                                    Analyze and share a deep understanding of overarching customer behavior to understand future trends and areas of a potential investment.
                                </li>
                                <li>
                                    Analyze and share a deep understanding of overarching customer behavior to understand future trends and areas of a potential investment.
                                </li>
                                <li>
                                    Analyze and share a deep understanding of overarching customer behavior to understand future trends and areas of a potential investment.
                                </li>
                                <li>
                                    Analyze and share a deep understanding of overarching customer behavior to understand future trends and areas of a potential investment.
                                </li>
                            </ul>
                            <h6 class="category-title">
                                {{__('Requirements')}}:
                            </h6>
                            <ul class="">
                                <li>
                                    Analyze and share a deep understanding of overarching customer behavior to understand future trends and areas of a potential investment.
                                </li>
                                <li>
                                    Analyze and share a deep understanding of overarching customer behavior to understand future trends and areas of a potential investment.
                                </li>
                                <li>
                                    Analyze and share a deep understanding of overarching customer behavior to understand future trends and areas of a potential investment.
                                </li>
                                <li>
                                    Analyze and share a deep understanding of overarching customer behavior to understand future trends and areas of a potential investment.
                                </li>
                                <li>
                                    Analyze and share a deep understanding of overarching customer behavior to understand future trends and areas of a potential investment.
                                </li>
                            </ul>
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
