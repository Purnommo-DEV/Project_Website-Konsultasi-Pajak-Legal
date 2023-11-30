@extends('Front.layout.master', ['title' => 'Beranda'])
@section('konten')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">

                    <img class="w-100" src="{{ asset('Front/img/carousel-1.jpg') }}" alt="Image" />
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-10">
                                    <h5 class="text-light text-uppercase mb-3 animated slideInDown">
                                        Welcome to Apex
                                    </h5>
                                    <h1 class="display-2 text-light mb-3 animated slideInDown">
                                        Lorem ipsum is placeholder text
                                    </h1>
                                    <ol class="breadcrumb mb-4 pb-2">
                                        <li class="breadcrumb-item fs-5 text-light">
                                            Commercial
                                        </li>
                                        <li class="breadcrumb-item fs-5 text-light">
                                            Residential
                                        </li>
                                        <li class="breadcrumb-item fs-5 text-light">
                                            Industrial
                                        </li>
                                    </ol>
                                    <a href="" class="btn btn-primary py-3 px-5">More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('Front/img/carousel-2.jpg') }}" alt="Image" />
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-10">
                                    <h5 class="text-light text-uppercase mb-3 animated slideInDown">
                                        Welcome to Apex
                                    </h5>
                                    <h1 class="display-2 text-light mb-3 animated slideInDown">
                                        From its medieval origins
                                    </h1>
                                    <ol class="breadcrumb mb-4 pb-2">
                                        <li class="breadcrumb-item fs-5 text-light">
                                            Commercial
                                        </li>
                                        <li class="breadcrumb-item fs-5 text-light">
                                            Residential
                                        </li>
                                        <li class="breadcrumb-item fs-5 text-light">
                                            Industrial
                                        </li>
                                    </ol>
                                    <a href="" class="btn btn-primary py-3 px-5">More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-end mb-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="border-start border-5 border-primary ps-4">
                        <h6 class="text-body text-uppercase mb-2">Our Services</h6>
                        <h1 class="display-6 mb-0">
                            PAKET PELAYANAN PAJAK
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card-deck h-100" style="border-radius: 10px; box-shadow:0 0 15px 3px rgba(30,5,0,0.15);">
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-sm-6 text-right">
                                    <img class="img-fluid" src="{{ asset('Front/img/team-1.jpg') }}" alt=""
                                        style="aspect-ratio:1/1;" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body" style="height: 85% !important">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text"> This content is a little bit longer.This content is a little
                                            bit longer.This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card-deck h-100" style="border-radius: 10px; box-shadow:0 0 15px 3px rgba(30,5,0,0.15);">
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-sm-6 text-right">
                                    <img class="img-fluid" src="{{ asset('Front/img/team-1.jpg') }}" alt=""
                                        style="aspect-ratio:1/1;" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body" style="height: 86% !important">
                                        <h5 class="mb-0 card-title">Card title</h5>
                                        <p class="mb-0 card-text">
                                            bit longer.This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card-deck h-100" style="border-radius: 10px; box-shadow:0 0 15px 3px rgba(30,5,0,0.15);">
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-sm-6 text-right">
                                    <img class="img-fluid" src="{{ asset('Front/img/team-1.jpg') }}" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body" style="height: 86% !important">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text"> This content is a little bit longer.This content is a little
                                            bit longer.This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card-deck h-100" style="border-radius: 10px; box-shadow:0 0 15px 3px rgba(30,5,0,0.15);">
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-sm-6 text-right">
                                    <img class="img-fluid" src="{{ asset('Front/img/team-1.jpg') }}" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body" style="height: 86% !important">
                                        <h5 class="mb-0 card-title">Card title</h5>
                                        <p class="mb-0 card-text">
                                            bit longer.This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-end mb-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="border-start border-5 border-primary ps-4">
                        <h6 class="text-body text-uppercase mb-2">Our Services</h6>
                        <h1 class="display-6 mb-0">
                            PAKET BUNDLING PELAYANAN PAJAK
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row g-3 justify-content-center">

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card-deck" style="border-radius: 10px; box-shadow:0 0 15px 3px rgba(30,5,0,0.15);">
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-sm-6 text-right">
                                    <img class="img-fluid" src="{{ asset('Front/img/team-1.jpg') }}" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body" style="height: 86% !important">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text"> This content is a little bit longer.This content is a little
                                            bit longer.This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card-deck" style="border-radius: 10px; box-shadow:0 0 15px 3px rgba(30,5,0,0.15);">
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-sm-6 text-right">
                                    <img class="img-fluid" src="{{ asset('Front/img/team-1.jpg') }}" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body" style="height: 86% !important">
                                        <h5 class="mb-0 card-title">Card title</h5>
                                        <p class="mb-0 card-text">
                                            bit longer.This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-end mb-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="border-start border-5 border-primary ps-4">
                        <h6 class="text-body text-uppercase mb-2">Our Services</h6>
                        <h1 class="display-6 mb-0">
                            PAKET PELAYANAN NOTARIS
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row g-3 justify-content-center">

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card-deck" style="border-radius: 10px; box-shadow:0 0 15px 3px rgba(30,5,0,0.15);">
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-sm-6 text-right">
                                    <img class="img-fluid" src="{{ asset('Front/img/team-1.jpg') }}" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body" style="height: 86% !important">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text"> This content is a little bit longer.This content is a little
                                            bit longer.This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card-deck" style="border-radius: 10px; box-shadow:0 0 15px 3px rgba(30,5,0,0.15);">
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-sm-6 text-right">
                                    <img class="img-fluid" src="{{ asset('Front/img/team-1.jpg') }}" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body" style="height: 86% !important">
                                        <h5 class="mb-0 card-title">Card title</h5>
                                        <p class="mb-0 card-text">
                                            bit longer.This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-end mb-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="border-start border-5 border-primary ps-4">
                        <h6 class="text-body text-uppercase mb-2">Our Services</h6>
                        <h1 class="display-6 mb-0">
                            LAYANAN SATUAN
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row g-3 justify-content-center">

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card-deck" style="border-radius: 10px; box-shadow:0 0 15px 3px rgba(30,5,0,0.15);">
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-sm-6 text-right">
                                    <img class="img-fluid" src="{{ asset('Front/img/team-1.jpg') }}" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body" style="height: 86% !important">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text"> This content is a little bit longer.This content is a little
                                            bit longer.This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card-deck" style="border-radius: 10px; box-shadow:0 0 15px 3px rgba(30,5,0,0.15);">
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-sm-6 text-right">
                                    <img class="img-fluid" src="{{ asset('Front/img/team-1.jpg') }}" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body" style="height: 86% !important">
                                        <h5 class="mb-0 card-title">Card title</h5>
                                        <p class="mb-0 card-text">
                                            bit longer.This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointment Start -->
    <div class="container-fluid appointment my-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel testimonial-carousel">
            <div class="testimonial-item">
                <div class="container py-5">
                    <div class="row g-5">
                        <div class="col-lg-5 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                            <div class="border-start border-5 border-primary ps-4 mb-5">
                                <h6 class="text-white text-uppercase mb-2">About Us</h6>
                                <h1 class="display-6 text-white mb-0">
                                    TAX CONSULTANT
                                </h1>
                            </div>
                            <p class="text-white mb-0">
                                PT. ANEKA KONSULTAMA NUSANTARA menawarkan
                                pelayanan melalui solusi satu pintu untuk segala
                                kebutuhan konsultasi pajak dengan harga yang
                                kompetitif dan pendekatan yang humanis. Dengan
                                memiliki sumber daya tenaga ahli yang telah
                                berpengalaman sesuai bidangnya, siap membantu
                                kebutuhan bisnis perusahaan maupun perorangan.
                                Para ahli akan mendampingi para pelaku usaha bisnis
                                maupun individu secara professional terkait urusan
                                perpajakan
                            </p>
                        </div>
                        <div class="col-lg-7 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                            <form>
                                <div class="row g-3">
                                    <div class="position-relative overflow-hidden ps-5 pt-5 h-100"
                                        style="min-height: 400px">
                                        <img class="position-absolute w-100 h-100" style="object-fit: cover"
                                            src="{{ asset('Front/img/team-1.jpg') }}" alt="" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-item">
                <div class="container py-5">
                    <div class="row g-5">
                        <div class="col-lg-5 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                            <div class="border-start border-5 border-primary ps-4 mb-5">
                                <h6 class="text-white text-uppercase mb-2">About Us</h6>
                                <h1 class="display-6 text-white mb-0">
                                    LEGAL CONSULTANT
                                </h1>
                            </div>
                            <p class="text-white mb-0">
                                PT. ANEKA KONSULTAMA NUSANTARA menawarkan
                                pelayanan melalui solusi satu pintu untuk segala kebutuhan
                                Layanan Notaris dan konsultasi PPAT dengan harga yang
                                kompetitif dan pendekatan yang humanis. Dengan memiliki
                                sumber daya tenaga ahli yang telah berpengalaman sesuai
                                bidangnya, siap membantu kebutuhan bisnis perusahaan
                                maupun perorangan. Para ahli akan mendampingi para
                                pelaku usaha bisnis maupun individu secara professional
                                terkait urusan Kenotariatan dan PPAT
                            </p>
                        </div>
                        <div class="col-lg-7 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                            <form>
                                <div class="row g-3">
                                    <div class="position-relative overflow-hidden ps-5 pt-5 h-100"
                                        style="min-height: 400px">
                                        <img class="position-absolute w-100 h-100" style="object-fit: cover"
                                            src="{{ asset('Front/img/team-1.jpg') }}" alt="" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->
@endsection
@section('script')
    <script>
        $(".owl-nav").hide();
    </script>
@endsection
