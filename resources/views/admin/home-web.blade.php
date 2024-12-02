@extends('admin.layouts.app')

@section('title', 'Website Management')

@section('content')


    <div class="main-container">

        {{-- <div class="row mb-3">
            <div class="col-md-1">
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>
            </div>
        </div> --}}

        <div class="row gutters p-5">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('logo.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Logo</h3><p>Website Logo</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('seo.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>SEO</h3><p>Website SEO</p></div>
                    </div>
                </a>
            </div>

            {{-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('home.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Home</h3><p>Website Home</p></div>
                    </div>
                </a>
            </div> --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('slider.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Slider</h3><p>Website Slider</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('project.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Project</h3><p>Website Projects</p></div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('brochure.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Brochure</h3><p>Website Brochure</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('gallery.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Gallery</h3><p>Website Gallerys</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('client.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Client</h3><p>Website Clients</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('service.index') }}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Services</h3><p>Website Services</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{route('testimonial.index')}}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Testimonials</h3><p>Website Testimonials</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{route('job.index')}}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Jobs</h3><p>Website Jobs</p></div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{route('application.index')}}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Applications</h3><p>Website Application</p></div>
                    </div>
                </a>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{route('director_message.index')}}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Director's Message</h3><p>Message</p></div>
                    </div>
                </a>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{route('footer_certification.index')}}">
                    <div class="info-stats2">
                        <div class="info-icon danger"><i class="icon-layers2"></i></div>
                        <div class="sale-num"><h3>Footer Certification</h3><p>Certification</p></div>
                    </div>
                </a>
            </div>



        </div>
    </div>

@endsection
