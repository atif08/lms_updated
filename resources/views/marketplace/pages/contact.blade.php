<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('marketplace.layouts.front_layout')
@section('content')
    <!-- Hero -->
    <section id="slider" class="hero p-0 odd featured">
        <div class="swiper-container no-slider slider-h-75">
            <div class="swiper-wrapper">
                <!-- Item 1 -->
                <div class="swiper-slide slide-center">
                    <img src="/frontend/assets/images/contact us.webp" class="full-image" data-mask="70" />

                    <div class="slide-content row text-center">
                        <div class="col-12 mx-auto inner">
                            <h1 data-aos="zoom-out-up" data-aos-delay="400" class="title effect-static-text">
                                Contact Us
                            </h1>
                            <nav data-aos="zoom-out-up" data-aos-delay="800" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Contact Us
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contacts -->
    <section id="contacts" class="section-1 offers">
        <div class="container">
            <div class="row intro">
                <div class="col-12 col-md-9 align-self-center text-center text-md-left">
                    <h2 class="featured">How Can We Help?</h2>
                    <p>
                        Talk to one of our consultants today and learn how to start
                        leveraging your business.
                    </p>
                </div>
                <div class="col-12 col-md-3 align-self-end">
                    <a href="#contact" class="smooth-anchor btn mx-auto mr-md-0 ml-md-auto primary-button"><i
                            class="icon-speech"></i>GET IN TOUCH</a>
                </div>
            </div>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card featured" style="height: 264px">
                        <i class="icon icon-phone"></i>
                        <h4>+971 566033332</h4>
                        <h4 style="margin-top:0px"> +91 8885514426</h4>

                        <p class="mb-1">
                            We answer by phone from Monday to Saturday from 8:30am — 8:30pm
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card" style="height: 264px">
                        <i class="icon icon-envelope"></i>
                        <h4>enquire@astidubai.ac.ae</h4>
                        <p class="mb-1">
                            We will respond to your email within 8 hours on business days.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card featured" style="height: 264px">
                        <i class="icon icon-location-pin"></i>
                        <h4>
                            Dubai South Office, <br />A1 Building, 5th Floor, <br />Jabel
                            Ali Free zone, Dubai, UAE
                        </h4>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card featured" style="height: 264px">
                        <i class="icon icon-location-pin"></i>
                        <h4>
                            17-1-16/A, 6th-Floor, <br />Pinnacle Towers,
                            Santosh Nagar, <br />Saidabad, - 500059, Hyderabad, Telangana, India
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom -->
    <section id="custom" class="section-2 map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d231592.4359817217!2d54.81396119453123!3d24.9105376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f0ca11145b885%3A0x4ce897a92c258fd7!2sDubai%20South%20Office%20Headquarters!5e0!3m2!1sen!2sae!4v1712316926930!5m2!1sen!2sae"
            width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
@endsection
