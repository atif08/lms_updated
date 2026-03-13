<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('marketplace.layouts.front_layout')
@section('style')
    <style>
        /* Basic styles */

        /* Styles for the modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #f5f5f5;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
            z-index: 10000;
            width: 90%;
            max-width: 500px;
            height: 400px;
            border-radius: 8px;
        }

        .close-modal {
            position: absolute;
            top: 8px;
            right: 15px;
            cursor: pointer;
            font-size: 2rem;
        }
    </style>
    <style>
        .iti {
            /* display: block !important; */
            width: 100%;
        }

        .field-phone {
            padding-left: 100px !important;
        }

        .iti__selected-country {
            background: #f5f5f5;
        }

        /* Styles for small screens menu tab*/
        @media (max-width: 768px) {
            .tab-ul {
                display: none;
                flex-direction: column;
                align-items: center;
                background: rgba(0, 0, 0, 0.9);
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                z-index: 1000;
                justify-content: center;
                padding: 20px;
            }

            .tab-ul.show {
                display: flex;
            }

            .tab-list a {
                color: #fff;
                font-size: 20px;
                padding: 15px;
            }

            .menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                background: #111111;
                color: #fff;
                padding: 10px 15px;
                border-radius: 5px;
                cursor: pointer;
                width: 120px;
                margin: 3px;
            }

            .menu-btn i {
                font-size: 22px;
            }

            .menu-container {
                position: sticky;
                display: flex;
                justify-content: center;
                top: 79px;
                z-index: 999;
                background: white;
                text-align: center;
                padding: 10px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            }

            /* Close button inside the menu */
            .close-menu {
                position: absolute;
                top: 15px;
                right: 20px;
                color: #fff;
                font-size: 24px;
                cursor: pointer;
            }

            .tab-list {
                border: none;
            }
        }
    </style>

    <style>
        form {
            display: flex;
            flex-direction: column;
        }

        button {
            padding: 10px;
            cursor: pointer;
        }

        .primary-button {
            z-index: 0;
        }
    </style>

    <!-- ==============================================
                                                                                Theme Settings
                                                                                =============================================== -->
    <style>
        :root {
            --header-bg-color: #111111;
            --nav-item-color: #f5f5f5;
            --top-nav-item-color: #f5f5f5;
            --hero-bg-color: #000000;

            --section-1-bg-color: #f5f5f5;
            --section-2-bg-color: #111111;
            --section-3-bg-color: #f5f5f5;

            --footer-bg-color: #191919;
        }

        .content input {
            display: none;
        }

        .content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content .list {
            display: flex;
            flex-direction: column;
            position: relative;
            margin-right: 50px;
        }

        .content .list label {
            cursor: pointer;
            line-height: 60px;
            font-size: 22px;
            font-weight: 500;
            padding-right: 10px;
            padding-left: 25px;
            transition: all 0.5s ease;
            z-index: 10;
        }

        #program-spec:checked~.list label.program-spec,
        #program-module:checked~.list label.program-module,
        #uk-levels:checked~.list label.uk-levels,
        #how-to-apply:checked~.list label.how-to-apply,
        #program-fees:checked~.list label.program-fees,
        #admission-requirement:checked~.list label.admission-requirement,
        #accreditation:checked~.list label.accreditation,
        #outcome:checked~.list label.outcome {
            color: #fff;
        }

        .content .slider {
            position: absolute;
            left: 0;
            top: 0;
            height: 60px;
            width: 100%;
            border-radius: 12px;
            transition: all 0.5s ease;

            background: brown;
        }

        #program-spec:checked~.list .slider {
            top: 0;
        }

        #program-module:checked~.list .slider {
            top: 60px;
        }

        #outcome:checked~.list .slider {
            top: 120px;
        }

        .content .text-content {
            width: 60%;
            height: 100%;
        }

        .content .text {
            display: none;
        }

        .content .text .title {
            font-size: 25px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .container .text p {
            text-align: justify;
        }

        .content .text-content .program-spec {
            display: block;
        }

        #program-spec:checked~.text-content .program-spec,
        #program-module:checked~.text-content .program-module,
        #uk-levels:checked~.text-content .uk-levels,
        #how-to-apply:checked~.text-content .how-to-apply,
        #program-fees:checked~.text-content .program-fees,
        #admission-requirement:checked~.text-content .admission-requirement,
        #accreditation:checked~.text-content .accreditation,
        #outcome:checked~.text-content .outcome {
            display: block;
        }

        #program-module:checked~.text-content .program-spec,
        #uk-levels:checked~.text-content .program-spec,
        #how-to-apply:checked~.text-content .program-spec,
        #program-fees:checked~.text-content .program-spec,
        #admission-requirement:checked~.text-content .program-spec,
        #accreditation:checked~.text-content .program-spec,
        #outcome:checked~.text-content .program-spec {
            display: none;
        }

        .content .list label:hover {
            color: brown;
        }

        :root {
            --ring-size: calc(min(200px, 14vw));
            --ring-border-size: calc(var(--ring-size) * 0.1);
            --ring-offset-left: calc(var(--ring-size) + var(--ring-border-size));
            --ring-offset-top: calc((var(--ring-size) - var(--ring-border-size)) * 0.5);

            --logo-size-w: calc((var(--ring-size) * 3 + var(--ring-border-size) * 2) * 1.5);
            --logo-size-h: calc((var(--ring-size) * 1.5 - var(--ring-border-size) * 0.5) * 2);
            --logo-bg-color: #f1f1f1;
        }

        .header-wrapper {
            margin: 50px 0px 0 0;
            position: relative;
        }

        .gallery-box {
            height: calc(var(--logo-size-h) * 1.25);
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr calc(var(--logo-size-w) * 0.6) 1fr 1fr 1fr 1fr;
            grid-template-rows: 1fr 1fr 1fr 1fr;
            grid-template-areas:
                "p6 p6 p6 p6 . p5 p5 p4 p4"
                "p6 p6 p6 p6 . p5 p5 p4 p4"
                "p1 p1 p7 p7 . p2 p2 p2 p3"
                "p1 p1 p8 p8 . p2 p2 p2 p3";
        }

        .i1 {
            background: url("./assets/images/gal1.webp");
            grid-area: p1;
        }

        .i2 {
            background: url("./assets/images/gal2.webp");
            grid-area: p2;
        }

        .i3 {
            background: url("./assets/images/gal3.webp");
            grid-area: p3;
        }

        .i4 {
            background: url("./assets/images/gal4.webp");
            grid-area: p4;
        }

        .i5 {
            background: url("./assets/images/gal5.webp");
            grid-area: p5;
        }

        .i6 {
            background: url("./assets/images/gal6.webp");
            grid-area: p6;
        }

        .i7 {
            background: url("./assets/images/gal7.webp");
            grid-area: p7;
        }

        .i8 {
            background: url("./assets/images/gal8.webp");
            grid-area: p8;
        }

        .photo {
            background-position: center;
            background-size: cover;
        }

        .dwc-logo {
            clip-path: polygon(0 0, 100% 0, 80% 100%, 20% 100%);
            background: linear-gradient(to bottom, #fff, #fff);
            width: calc(var(--logo-size-w) * 1);
            height: calc(var(--logo-size-h) * 1.25);
            margin: 0 auto;
            padding: 20px 0;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, 0);
        }

        .olympic-rings {
            position: relative;
            width: calc(var(--ring-size) * 3 + var(--ring-border-size) * 2);
            height: calc(var(--ring-size) * 1.5 - var(--ring-border-size) * 0.5);
            margin: 158px auto;
        }

        .button-enrollNow {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .enroll-button {
            background: linear-gradient(135deg, #ff8a00, #e52e71);
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            padding: 14px 24px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            align-items: center;
            width: 250px;
            max-width: 250px;
            text-align: center;

        }

        .enroll-button:hover {
            background: linear-gradient(135deg, #e67e22, #d63031);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
            transform: translateY(-2px);
        }

        .enroll-button:active {
            transform: translateY(0);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
    <style>
        .facts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 16px;
            max-width: 900px;
            /* controls overall width */
            margin: 0 auto;
            /* centers grid */
        }

        .fact-box {
            background: #fff;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
            /* border: 2px solid rebeccapurple; */
        }

        .enroll-button {
            margin: 10px 0px;
        }
    </style>
    <style>
        .why-section {
            background: #ffffff;
            padding: 70px 0;
        }

        .why-header {
            text-align: center;
            max-width: 900px;
            margin: 0 auto 40px;
        }

        .why-header h3 {
            font-size: 28px;
            font-weight: 600;
            line-height: 1.4;
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }

        .why-card {
            background: #fff;
            padding: 32px 24px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .why-card i {
            font-size: 34px;
            color: #ff4a17;
            margin-bottom: 16px;
        }

        .why-card h4 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .why-card p {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
        }

        .why-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
        }

        @media (max-width: 576px) {
            .why-header h3 {
                font-size: 22px;
            }

            .why-card {
                padding: 24px 18px;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Hero -->
    <section id="slider" class="hero p-0 odd">
        <div class="swiper-container no-slider slider-h-75">
            <div class="swiper-wrapper">
                <!-- Item 1 -->
                <div class="swiper-slide slide-center">
                    <img src="/frontend/assets/images/programs-banner/webp/Education and training.webp" class="full-image"
                        data-mask="70" />

                    <div class="slide-content row text-center">
                        <div class="col-12 mx-auto inner">
                            <h1 data-aos="zoom-out-up" data-aos-delay="400" class="title effect-static-text"
                                style="font-size: 3rem !important">
                                Blockchain Technology Program
                            </h1>
                            <h6 style="color: #000"> Explore the Future of Digital Innovation with Blockchain & Technology
                            </h6>
                        </div>
                        <!--<div class="col-12 row align-items-center justify-content-center">-->
                        <!--  <button-->
                        <!--    type="button"-->
                        <!--    class="btn primary-button"-->
                        <!--    id="open-modal"-->
                        <!--  >-->
                        <!--    Download Brochure-->
                        <!--    <i class="icon-arrow-down-circle left"></i>-->
                        <!--  </button>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fun Facts -->
    <section id="funfacts" class="section-3" style="padding: 10px 0px">
        <div class="container">
            <div class="facts-grid">
                <div class="fact-box">
                    <h4>Mode of Study</h4>
                    <span>Online</span>
                </div>

                <div class="fact-box">
                    <h4>Program Duration</h4>
                    <span>6 Months</span>
                </div>

                <div class="fact-box" style="display:none">
                    <h4>Program Fee</h4>
                    <span>$599</span>
                </div>
            </div>
        </div>
    </section>
    <!-- enroll-button-code-starts-here -->

    <div class="button-enrollNow">
        @if (\Illuminate\Support\Facades\Auth::check())
            <a href="{{ route('courses.checkout', $course->slug) }}" class="enroll-button">
                Enroll Now
            </a>
        @else
            <a class="enroll-button" href="{{ route('login') }}">
                Enroll Now
            </a>
        @endif


    </div>

    <!-- enroll-button-code-ends-here -->
    <!-- About [image] -->
    <section id="about" class="section-1 highlights image-right" style="padding: 20px 0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 align-self-center text-center text-md-left">
                    <div class="row intro">
                        <div class="col-12 p-0">
                            <h3 class="featured alt">
                                What You Will Achieve from the Online Blockchain and Technology Diploma Program
                            </h3>
                            <p style="text-align: justify">
                                A thorough foundation in one of the 21st century's most disruptive technologies is provided
                                by the Online Blockchain and Technology Diploma Program. Your knowledge of blockchain
                                architecture, consensus processes, bitcoin, smart contracts, and Hyperledger Fabric will all
                                be enhanced by this training. You will acquire the skills necessary to create and oversee
                                decentralized systems through practical experience and real-world applications, preparing
                                you for positions in fintech, cybersecurity, logistics, and other fields.
                            </p>
                            <a href="/courses/contact" class="btn primary-button button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#">
                        <img src="/frontend/assets/images/block-chain-technology-programme-1.jpg" class="fit-image"
                            alt="Block Chain Technology" />
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="section-1" style="background-color: #fff; padding: 40px 0">
        <!-- Sticky Menu Button for Small Screens -->
        <div class="menu-container d-md-none">
            <div class="menu-btn" onclick="toggleMenu()">
                <i class="fas fa-bars"></i> Menu
            </div>
            <div class="menu-btn" onclick="document.getElementById('contact').scrollIntoView({ behavior: 'smooth' })">
                Enroll Now
            </div>
        </div>

        <!-- Desktop Tab Menu -->
        <div class="row mt--40 nav-sticky sticky-top d-none d-md-block z-0" style="top: 84px">
            <div class="col-12 col-md-12 align-self-center text-center">
                <main>
                    <ul class="tab-ul">
                        <li class="tab-list">
                            <a href="#section1"><span>Overview</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section2"> <span>Objective</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section3"><span>Module</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section4"> <span>specification</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section5"><span>Learning outcomes</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section6"><span>Skills Covered</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section7"><span>Accreditations</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section8"><span>FAQ</span> </a>
                        </li>
                    </ul>
                </main>
            </div>
        </div>

        <!-- Mobile Fullscreen Menu -->
        <ul class="tab-ul d-md-none" id="mobileMenu">
            <span class="close-menu" onclick="closeMenu()">✖</span>
            <li class="tab-list">
                <a href="#section1" onclick="scrollToSection(event)">Overview</a>
            </li>
            <li class="tab-list">
                <a href="#section2" onclick="scrollToSection(event)">Objective</a>
            </li>
            <li class="tab-list">
                <a href="#section3" onclick="scrollToSection(event)">Course Module</a>
            </li>
            <li class="tab-list">
                <a href="#section4" onclick="scrollToSection(event)">Specification</a>
            </li>
            <li class="tab-list">
                <a href="#section5" onclick="scrollToSection(event)">Learning Outcomes</a>
            </li>
            <li class="tab-list">
                <a href="#section6" onclick="scrollToSection(event)">Skills Covered</a>
            </li>
            <li class="tab-list">
                <a href="#section7" onclick="scrollToSection(event)">Accreditations</a>
            </li>
            <li class="tab-list">
                <a href="#section8" onclick="scrollToSection(event)">Faq</a>
            </li>
        </ul>
        <div class="container">
            <div id="section1" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Overview</h3>
                        <p>
                            An in-depth grasp of blockchain technology and its practical applications in a range of
                            industries is offered by this diploma program. It gives students the theoretical and technical
                            know-how required to create decentralized systems, oversee cryptocurrency assets, and create
                            smart contracts with Hyperledger Fabric and Ethereum.
                        </p>
                    </div>
                </div>
            </div>

            <div id="section2" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Objective</h3>
                        <ul>
                            <li>
                                To provide a thorough understanding of blockchain architecture and decentralized networks
                            </li>
                            <li>
                                To develop competencies in smart contract creation and Ethereum programming
                            </li>
                            <li>
                                To explore the functionality of cryptocurrency, wallets, and secure transactions
                            </li>
                            <li>
                                To equip learners with enterprise-level knowledge of Hyperledger Fabric and permissioned
                                blockchains
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="section3" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Program Modules</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered"
                                style="
                    border-collapse: collapse !important;
                    border-spacing: 0 !important;
                  ">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Title</th>
                                        <th>Duration</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Introduction to Blockchain</td>
                                        <td>4 Hours</td>
                                        <td>Blockchain basics, history, centralization vs decentralization, block structure,
                                            blockchain types</td>
                                    </tr>
                                    <tr>
                                        <td>Cryptographic Foundations</td>
                                        <td>4 Hours</td>
                                        <td>Hashing (SHA-256, Keccak), Digital signatures, PKI, Merkle Trees, Wallets</td>
                                    </tr>
                                    <tr>
                                        <td>Blockchain
                                            Structure & Data
                                            Model</td>
                                        <td>B/744/5222</td>
                                        <td>CRYPTO CURRENCY AND WALLET</td>
                                    </tr>
                                    <tr>
                                        <td>Consensus Mechanisms</td>
                                        <td>6 Hours</td>
                                        <td>PoW, PoS, DPoS, PBFT, algorithm comparisons</td>
                                    </tr>
                                    <tr>
                                        <td>Smart Contracts</td>
                                        <td>6 Hours</td>
                                        <td>Solidity basics, EVM, security patterns, Remix IDE</td>
                                    </tr>
                                    <tr>
                                        <td>Blockchain Platforms</td>
                                        <td>6 Hours</td>
                                        <td>Ethereum, Bitcoin, Hyperledger, BSC, Solana, platform comparison</td>
                                    </tr>
                                    <tr>
                                        <td>Decentralized Applications (DApps)</td>
                                        <td>4 Hours</td>
                                        <td>DApp structure, tools (Truffle, Hardhat, MetaMask), front-end integration</td>
                                    </tr>
                                    <tr>
                                        <td>Tokens and ICOs</td>
                                        <td>4 Hours</td>
                                        <td>ERC-20, ERC-721, ERC-1155, Tokenomics, ICO structure, regulations</td>
                                    </tr>
                                    <tr>
                                        <td>Blockchain Use Cases</td>
                                        <td>6 Hours</td>
                                        <td>Finance, DeFi, supply chain, healthcare, voting, identity, NFTs</td>
                                    </tr>
                                    <tr>
                                        <td>Future Trends & Final Project</td>
                                        <td>4 Hours</td>
                                        <td>Layer 2, interoperability (Polkadot, Cosmos), quantum risks, capstone project
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section4" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Program Specification</h3>

                        <div class="table-responsive">
                            <table class="table table-bordered"
                                style="
                    border-collapse: collapse !important;
                    border-spacing: 0 !important;
                  ">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Qualification Title</th>
                                        <th>Mode of Study</th>
                                        <th>Duration</th>
                                        <th>Assessment</th>
                                        <th>Certification</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Blockchain Technology Program</td>
                                        <td>100% Online</td>
                                        <td>Flexible (6 months)</td>
                                        <td>Assignments, hands-on projects</td>
                                        <td>Internationally recognized qualification</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-center">
                            <a href="/courses/contact" class="btn primary-button button">Enquiry Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section5" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Learning outcomes</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <ul>
                                    <li>
                                        Understand the fundamentals of blockchain and its architecture
                                    </li>
                                    <li>
                                        Analyze and apply different consensus algorithms (PoW, PoS, etc.)
                                    </li>
                                    <li>
                                        Develop and deploy smart contracts using Solidity and Ethereum tools
                                    </li>
                                    <li>
                                        Gain hands-on skills in Hyperledger Fabric setup and chain code deployment
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="section6" class="content-section pb-5" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Skills Covered</h3>
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Blockchain Fundamentals & Decentralization
                                        Principles</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Consensus Mechanisms: PoW, PoS, and Emerging
                                        Models</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Cryptocurrency Wallets: Setup, Security, and
                                        Transactions</span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Smart Contract Development Using Solidity</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Ethereum DApp Deployment</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Hyperledger Fabric Architecture & Network
                                        Configuration</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section
                                                                              id="about"
                                                                              class="section-1 highlights image-right"
                                                                              style="padding: 40px 0"
                                                                            >
                                                                              <div class="container">
                                                                                <div class="row">
                                                                                  <div class="col-12 col-md-12 align-self-center text-center">
                                                                                    <div class="row intro">
                                                                                      <div class="col-12 p-0">
                                                                                        <h3 class="featured alt">UK Level System</h3>
                                                                                        <img src="assets/images/uk-level.png" />
                                                                                      </div>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </section> -->
    <!-- enroll-button-code-starts-here -->

    <div class="button-enrollNow">
        @if (\Illuminate\Support\Facades\Auth::check())
            <a href="{{ route('courses.checkout', $course->slug) }}" class="enroll-button">
                Enroll Now
            </a>
        @else
            <a class="enroll-button" href="{{ route('login') }}">
                Enroll Now
            </a>
        @endif


    </div>

    <!-- enroll-button-code-ends-here -->
    <!-- Features -->
    <section id="features" class="section-2 odd offers" style="padding: 40px 0 !important">
        <div class="container">
            <h3 class="text-center">
                Why Choose ASTI Online for Blockchain Technology Program ?
            </h3>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-globe"></i>
                        <h4>Curriculum Designed by Industry Experts</h4>
                        <p>
                            Learn practical skills that employers are hiring for.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-basket"></i>
                        <h4>100% Online, Anytime Learning</h4>
                        <p> Flexible and accessible from anywhere in the world
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-layers"></i>
                        <h4>Hands-On Blockchain Development</h4>
                        <p>
                            Practice on platforms like Ethereum and Hyperledger.

                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-graduation"></i>
                        <h4>Career-Ready Certification</h4>
                        <p>
                            Gain a recognized credential in a high-demand field.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features -->

    <section id="section7" class="section-3 highlights image-right" style="background-color: #fff; padding:10px 0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <h3 class="text-center">Our Accreditations & Recognitions</h3>
                    <p>
                        ASTI Academy offers government-approved vocational educational
                        certification programs in Dubai and is recognized and accredited
                        by the Government of Dubai, KHDA, TVET, Ofqual, and other
                        international educational legal authorities.
                    </p>
                </div>
            </div>

            <div class="col-12">
                <div class="row divided-list">
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/wes-logo.png">
                                <img src="/frontend/assets/images/wes-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/sce-logo.png">
                                <img src="/frontend/assets/images/sce-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/mof-logo.png">
                                <img src="/frontend/assets/images/mof-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/khd-logo.png">
                                <img src="/frontend/assets/images/khd-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/moh-logo.png">
                                <img src="/frontend/assets/images/moh-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/qad-logo.png">
                                <img src="/frontend/assets/images/qad-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/ofqual-logo.png">
                                <img src="/frontend/assets/images/ofqual-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/tvet-logo.png">
                                <img src="/frontend/assets/images/tvet-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="features" class="offers" style="background-color: #000 !important; padding: 20px 0">
        <div class="container">
            <div class="row justify-content-center items">
                <div class="col-12 col-md-12 col-lg-12" style="display: flex">
                    <h4 style="color: #ff0101">
                        We have changed the lives of over 300,000 students since 1995. Now
                        it’s your turn!
                    </h4>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="tel:+971564157272" class="btn primary-button">
                        Call Now</a>
                </div>
            </div>
        </div>
    </section>
    <section id="section8" class="section-6 subscribe" style="padding: 20px 0px">
        <div class="container smaller">
            <div class="row text-center intro">
                <div class="col-12">
                    <h3>Frequently Asked Questions</h3>
                </div>
            </div>
            <div class="faq-container">
                <div class="faq">
                    <h5 class="faq-title">
                        What is this program about?
                    </h5>
                    <p class="faq-text">
                        The program teaches the technical, practical, and strategic use of blockchain technology, including
                        cryptocurrency, smart contracts, and enterprise applications.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">Is prior coding experience necessary?</h5>
                    <p class="faq-text">
                        Basic IT knowledge is sufficient. Coding concepts like Solidity for Ethereum are taught from
                        scratch.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">What kind of jobs can I get after this diploma?</h5>
                    <p class="faq-text">
                        You can pursue roles such as Blockchain Developer, Smart Contract Engineer, Crypto Analyst, or
                        Hyperledger Consultant.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">
                        Is this a certified course?
                    </h5>
                    <p class="faq-text">
                        Yes, you'll receive a recognized diploma certificate upon successful completion.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">
                        Is the course fully online?
                    </h5>
                    <p class="faq-text">
                        Yes, it's designed to be 100% online, with interactive sessions, video lectures, and support.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">
                        What tools will I learn?
                    </h5>
                    <p class="faq-text">
                        You will gain experience with Ethereum, Solidity, Hyperledger Fabric, Remix IDE, Truffle, Ganache,
                        and wallets like MetaMask.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Features -->
    <section id="why-blockchain" class="why-section">
        <div class="container">
            <div class="why-header">
                <h3>
                    What are the 4 reasons to Study Online Blockchain Technology Program?
                </h3>
            </div>

            <div class="why-grid">
                <div class="why-card">
                    <i class="icon icon-globe"></i>
                    <h4>Blockchain is the Future</h4>
                    <p>
                        Gain in-demand skills in a rapidly growing, high-paying
                        technology sector shaping the future of digital systems.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-basket"></i>
                    <h4>Hands-On, Career-Focused Learning</h4>
                    <p>
                        Build real-world blockchain applications that demonstrate
                        your practical knowledge and problem-solving ability.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-screen-smartphone"></i>
                    <h4>Flexible Learning Format</h4>
                    <p>
                        Designed for working professionals and tech enthusiasts who
                        need flexibility without compromising quality.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-layers"></i>
                    <h4>Applicable Across Industries</h4>
                    <p>
                        From finance and supply chain to healthcare and logistics,
                        blockchain is transforming modern business models.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Testimonials -->
    {{-- <section id="testimonials" class="section-3 carousel" style="background-color: #fff">
        <div class="overflow-holder">
            <div class="container">
                <div class="row text-center intro">
                    <div class="col-12">
                        <h3>Testimonials</h3>
                    </div>
                </div>
                <div class="swiper-container mid-slider items">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/18.webp" alt="Adams Baker"
                                        class="person" />
                                    <h4>Sara M</h4>
                                    <p style="text-align: justify">
                                        This course made a complex subject easy to learn. I’ve already built my first smart
                                        contract!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/12.webp" alt="Mary Evans"
                                        class="person" />
                                    <h4>Khalid M/h4>
                                        <p style="text-align: justify">
                                            Loved the mix of Ethereum coding and Hyperledger enterprise solutions. Highly
                                            recommend it.
                                        </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/19.webp" alt="Nadia Malik"
                                        class="person" />
                                    <h4>Fatima S</h4>
                                    <p style="text-align: justify">
                                        I joined with no coding background and now I understand wallets, tokens, and
                                        contract security.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/13.webp" alt="Khalid Mansoor"
                                        class="person" />
                                    <h4>Omar T</h4>
                                    <p style="text-align: justify">
                                        ASTI’s support system and instructor guidance were very helpful throughout the
                                        course.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_6.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Ayesha R</h4>
                                    <p style="text-align: justify">
                                        I was working in finance, but this course helped me switch to crypto consulting.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- enroll-button-code-starts-here -->

    <div class="button-enrollNow">
        @if (\Illuminate\Support\Facades\Auth::check())
            <a href="{{ route('courses.checkout', $course->slug) }}" class="enroll-button">
                Enroll Now
            </a>
        @else
            <a class="enroll-button" href="{{ route('login') }}">
                Enroll Now
            </a>
        @endif


    </div>

    <!-- enroll-button-code-ends-here -->
@endsection
