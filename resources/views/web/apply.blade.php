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
                        <a href="#" class="job-container__header">
                            <h5 class="job-title">
                                <i class="me-2 fas fa-chevron-left flip text-secondary"></i>
                                Job title
                            </h5>
                        </a>
                        <div class="job-container__body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <input name="" type="text" class="form-control" placeholder="{{__('First Name')}}...">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <input name="" type="text" class="form-control" placeholder="{{__('last Name')}}...">
                                </div>
                                <div class="col-12">
                                    <input name="" type="email" class="form-control" placeholder="{{__('Email')}}...">
                                </div>
                                <div class="col-12">
                                    <input name="" type="tel" class="form-control" placeholder="{{__('Mobile')}}...">
                                </div>
                                <div class="col-12">
                                    <input name="" type="text" class="form-control" placeholder="{{__('Address')}}...">
                                </div>
                                <div class="col-12">
                                    <div class="file-upload">
                                        <div class="file-select form-control">
                                            
                                            <div class="file-select-name" id="noFile">
                                                {{__('Upload your resume')}}
                                            </div> 
                                            <div class="file-select-button" id="fileName">
                                                <i class="me-2 fas fa-upload"></i>
                                                {{__('Upload')}}
                                            </div>
                                            <input type="file" name="chooseFile" id="chooseFile">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea name="" class="form-control" placeholder="{{__('Comment')}}..." rows="5"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="mt-3 btn btn-filled">
                                        {{__('Send application')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('web.layouts.footer')
@endsection

@push('scripts')
    <script>
        $('#chooseFile').bind('change', function () {
            var filename = $("#chooseFile").val();
            if (/^\s*$/.test(filename)) {
                $(".file-upload").removeClass('active');
                $("#noFile").text("No file chosen..."); 
            }
            else {
                $(".file-upload").addClass('active');
                $("#noFile").text(filename.replace("C:\\fakepath\\", "")); 
            }
        });
    </script>
@endpush
