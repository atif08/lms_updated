<?php $page = 'Professional Cyber Security Training with Real-World Simulations'; ?>
@extends('frontend.layouts.front_layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/professional-courses.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
@endpush
@section('content')
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                    <img style="width: 150px" src="/frontend/assets/images/Asti_DWC_Regular Logo.png"
                        alt=" ASTI Academy " />
                </div>
                <button class="mobile-toggle" id="mobileToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About LTC</a></li>
                    <li><a href="#courses"> Courses</a></li>
                    <li><a href="#why-choose">Why Choose Us</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#apply" class="cta-btn">Enroll Now</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero" id="home">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-content">
                    <h1 class="hero-title">
                        Build Your Career with Globally Recognized Qualifications
                    </h1>
                    <p class="hero-subtitle">
                        Advance your future with internationally accredited programs from ASTI ACADEMY DWC. Our
                        qualifications are recognized by employers and universities worldwide. Learn from expert trainers,
                        gain real industry skills, and become job-ready for global career opportunities.
                    </p>
                    <div class="hero-cta">
                        <a href="#home" class="btn btn-primary">Enroll Now</a>
                        <a href="#contact" class="btn btn-secondary">Contact</a>
                    </div>
                </div>
                <div class="hero-form">
                    <div class="form-card">
                        <h3 class="form-title">Apply for Your IT & Qualification Program</h3>
                        <form id="applicationForm">
                            <div class="form-group">
                                <input type="text" id="fullName" placeholder="Full Name" required />
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" placeholder="Email ID" required />
                            </div>
                            <div class="form-group">
                                <div class="phone-group">
                                    <select id="phoneCode" class="country-code">
                                        <option value="+91" selected>+91 (India)</option>
                                        <option value="+1">+1 (United States / Canada)</option>
                                        <option value="+7">+7 (Russia)</option>
                                        <option value="+20">+20 (Egypt)</option>
                                        <option value="+27">+27 (South Africa)</option>
                                        <option value="+30">+30 (Greece)</option>
                                        <option value="+31">+31 (Netherlands)</option>
                                        <option value="+32">+32 (Belgium)</option>
                                        <option value="+33">+33 (France)</option>
                                        <option value="+34">+34 (Spain)</option>
                                        <option value="+36">+36 (Hungary)</option>
                                        <option value="+39">+39 (Italy)</option>
                                        <option value="+40">+40 (Romania)</option>
                                        <option value="+41">+41 (Switzerland)</option>
                                        <option value="+43">+43 (Austria)</option>
                                        <option value="+44">+44 (United Kingdom)</option>
                                        <option value="+45">+45 (Denmark)</option>
                                        <option value="+46">+46 (Sweden)</option>
                                        <option value="+47">+47 (Norway)</option>
                                        <option value="+48">+48 (Poland)</option>
                                        <option value="+49">+49 (Germany)</option>
                                        <option value="+51">+51 (Peru)</option>
                                        <option value="+52">+52 (Mexico)</option>
                                        <option value="+53">+53 (Cuba)</option>
                                        <option value="+54">+54 (Argentina)</option>
                                        <option value="+55">+55 (Brazil)</option>
                                        <option value="+56">+56 (Chile)</option>
                                        <option value="+57">+57 (Colombia)</option>
                                        <option value="+58">+58 (Venezuela)</option>
                                        <option value="+60">+60 (Malaysia)</option>
                                        <option value="+61">+61 (Australia)</option>
                                        <option value="+62">+62 (Indonesia)</option>
                                        <option value="+63">+63 (Philippines)</option>
                                        <option value="+64">+64 (New Zealand)</option>
                                        <option value="+65">+65 (Singapore)</option>
                                        <option value="+66">+66 (Thailand)</option>
                                        <option value="+81">+81 (Japan)</option>
                                        <option value="+82">+82 (South Korea)</option>
                                        <option value="+84">+84 (Vietnam)</option>
                                        <option value="+86">+86 (China)</option>
                                        <option value="+90">+90 (Turkey)</option>
                                        <option value="+92">+92 (Pakistan)</option>
                                        <option value="+93">+93 (Afghanistan)</option>
                                        <option value="+94">+94 (Sri Lanka)</option>
                                        <option value="+95">+95 (Myanmar)</option>
                                        <option value="+98">+98 (Iran)</option>
                                        <option value="+211">+211 (South Sudan)</option>
                                        <option value="+212">+212 (Morocco)</option>
                                        <option value="+213">+213 (Algeria)</option>
                                        <option value="+216">+216 (Tunisia)</option>
                                        <option value="+218">+218 (Libya)</option>
                                        <option value="+220">+220 (Gambia)</option>
                                        <option value="+221">+221 (Senegal)</option>
                                        <option value="+222">+222 (Mauritania)</option>
                                        <option value="+223">+223 (Mali)</option>
                                        <option value="+224">+224 (Guinea)</option>
                                        <option value="+225">+225 (Ivory Coast)</option>
                                        <option value="+226">+226 (Burkina Faso)</option>
                                        <option value="+227">+227 (Niger)</option>
                                        <option value="+228">+228 (Togo)</option>
                                        <option value="+229">+229 (Benin)</option>
                                        <option value="+230">+230 (Mauritius)</option>
                                        <option value="+231">+231 (Liberia)</option>
                                        <option value="+232">+232 (Sierra Leone)</option>
                                        <option value="+233">+233 (Ghana)</option>
                                        <option value="+234">+234 (Nigeria)</option>
                                        <option value="+235">+235 (Chad)</option>
                                        <option value="+236">+236 (Central African Republic)</option>
                                        <option value="+237">+237 (Cameroon)</option>
                                        <option value="+238">+238 (Cape Verde)</option>
                                        <option value="+239">+239 (São Tomé & Príncipe)</option>
                                        <option value="+240">+240 (Equatorial Guinea)</option>
                                        <option value="+241">+241 (Gabon)</option>
                                        <option value="+242">+242 (Congo)</option>
                                        <option value="+243">+243 (DR Congo)</option>
                                        <option value="+244">+244 (Angola)</option>
                                        <option value="+245">+245 (Guinea-Bissau)</option>
                                        <option value="+246">+246 (British Indian Ocean Territory)</option>
                                        <option value="+248">+248 (Seychelles)</option>
                                        <option value="+249">+249 (Sudan)</option>
                                        <option value="+250">+250 (Rwanda)</option>
                                        <option value="+251">+251 (Ethiopia)</option>
                                        <option value="+252">+252 (Somalia)</option>
                                        <option value="+253">+253 (Djibouti)</option>
                                        <option value="+254">+254 (Kenya)</option>
                                        <option value="+255">+255 (Tanzania)</option>
                                        <option value="+256">+256 (Uganda)</option>
                                        <option value="+257">+257 (Burundi)</option>
                                        <option value="+258">+258 (Mozambique)</option>
                                        <option value="+260">+260 (Zambia)</option>
                                        <option value="+261">+261 (Madagascar)</option>
                                        <option value="+262">+262 (Réunion)</option>
                                        <option value="+263">+263 (Zimbabwe)</option>
                                        <option value="+264">+264 (Namibia)</option>
                                        <option value="+265">+265 (Malawi)</option>
                                        <option value="+266">+266 (Lesotho)</option>
                                        <option value="+267">+267 (Botswana)</option>
                                        <option value="+268">+268 (Eswatini)</option>
                                        <option value="+269">+269 (Comoros)</option>
                                        <option value="+290">+290 (Saint Helena)</option>
                                        <option value="+297">+297 (Aruba)</option>
                                        <option value="+298">+298 (Faroe Islands)</option>
                                        <option value="+299">+299 (Greenland)</option>
                                        <option value="+350">+350 (Gibraltar)</option>
                                        <option value="+351">+351 (Portugal)</option>
                                        <option value="+352">+352 (Luxembourg)</option>
                                        <option value="+353">+353 (Ireland)</option>
                                        <option value="+354">+354 (Iceland)</option>
                                        <option value="+355">+355 (Albania)</option>
                                        <option value="+356">+356 (Malta)</option>
                                        <option value="+357">+357 (Cyprus)</option>
                                        <option value="+358">+358 (Finland)</option>
                                        <option value="+359">+359 (Bulgaria)</option>
                                        <option value="+370">+370 (Lithuania)</option>
                                        <option value="+371">+371 (Latvia)</option>
                                        <option value="+372">+372 (Estonia)</option>
                                        <option value="+373">+373 (Moldova)</option>
                                        <option value="+374">+374 (Armenia)</option>
                                        <option value="+375">+375 (Belarus)</option>
                                        <option value="+376">+376 (Andorra)</option>
                                        <option value="+377">+377 (Monaco)</option>
                                        <option value="+378">+378 (San Marino)</option>
                                        <option value="+380">+380 (Ukraine)</option>
                                        <option value="+381">+381 (Serbia)</option>
                                        <option value="+382">+382 (Montenegro)</option>
                                        <option value="+383">+383 (Kosovo)</option>
                                        <option value="+385">+385 (Croatia)</option>
                                        <option value="+386">+386 (Slovenia)</option>
                                        <option value="+387">+387 (Bosnia & Herzegovina)</option>
                                        <option value="+389">+389 (North Macedonia)</option>
                                        <option value="+420">+420 (Czech Republic)</option>
                                        <option value="+421">+421 (Slovakia)</option>
                                        <option value="+423">+423 (Liechtenstein)</option>
                                        <option value="+852">+852 (Hong Kong)</option>
                                        <option value="+855">+855 (Cambodia)</option>
                                        <option value="+856">+856 (Laos)</option>
                                        <option value="+880">+880 (Bangladesh)</option>
                                        <option value="+886">+886 (Taiwan)</option>
                                        <option value="+960">+960 (Maldives)</option>
                                        <option value="+961">+961 (Lebanon)</option>
                                        <option value="+962">+962 (Jordan)</option>
                                        <option value="+963">+963 (Syria)</option>
                                        <option value="+964">+964 (Iraq)</option>
                                        <option value="+965">+965 (Kuwait)</option>
                                        <option value="+966">+966 (Saudi Arabia)</option>
                                        <option value="+967">+967 (Yemen)</option>
                                        <option value="+968">+968 (Oman)</option>
                                        <option value="+970">+970 (Palestine)</option>
                                        <option value="+971">+971 (United Arab Emirates)</option>
                                        <option value="+972">+972 (Israel)</option>
                                        <option value="+973">+973 (Bahrain)</option>
                                        <option value="+974">+974 (Qatar)</option>
                                        <option value="+975">+975 (Bhutan)</option>
                                        <option value="+976">+976 (Mongolia)</option>
                                        <option value="+977">+977 (Nepal)</option>
                                        <option value="+992">+992 (Tajikistan)</option>
                                        <option value="+993">+993 (Turkmenistan)</option>
                                        <option value="+994">+994 (Azerbaijan)</option>
                                        <option value="+995">+995 (Georgia)</option>
                                        <option value="+996">+996 (Kyrgyzstan)</option>
                                        <option value="+998">+998 (Uzbekistan)</option>

                                    </select>
                                    <input type="tel" id="phone" placeholder="Phone Number" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="phone-group">
                                    <select id="whatsappCode" class="country-code">
                                        <option value="+1">+1 (United States / Canada)</option>
                                        <option value="+7">+7 (Russia)</option>
                                        <option value="+20">+20 (Egypt)</option>
                                        <option value="+27">+27 (South Africa)</option>
                                        <option value="+30">+30 (Greece)</option>
                                        <option value="+31">+31 (Netherlands)</option>
                                        <option value="+32">+32 (Belgium)</option>
                                        <option value="+33">+33 (France)</option>
                                        <option value="+34">+34 (Spain)</option>
                                        <option value="+36">+36 (Hungary)</option>
                                        <option value="+39">+39 (Italy)</option>
                                        <option value="+40">+40 (Romania)</option>
                                        <option value="+41">+41 (Switzerland)</option>
                                        <option value="+43">+43 (Austria)</option>
                                        <option value="+44">+44 (United Kingdom)</option>
                                        <option value="+45">+45 (Denmark)</option>
                                        <option value="+46">+46 (Sweden)</option>
                                        <option value="+47">+47 (Norway)</option>
                                        <option value="+48">+48 (Poland)</option>
                                        <option value="+49">+49 (Germany)</option>
                                        <option value="+51">+51 (Peru)</option>
                                        <option value="+52">+52 (Mexico)</option>
                                        <option value="+53">+53 (Cuba)</option>
                                        <option value="+54">+54 (Argentina)</option>
                                        <option value="+55">+55 (Brazil)</option>
                                        <option value="+56">+56 (Chile)</option>
                                        <option value="+57">+57 (Colombia)</option>
                                        <option value="+58">+58 (Venezuela)</option>
                                        <option value="+60">+60 (Malaysia)</option>
                                        <option value="+61">+61 (Australia)</option>
                                        <option value="+62">+62 (Indonesia)</option>
                                        <option value="+63">+63 (Philippines)</option>
                                        <option value="+64">+64 (New Zealand)</option>
                                        <option value="+65">+65 (Singapore)</option>
                                        <option value="+66">+66 (Thailand)</option>
                                        <option value="+81">+81 (Japan)</option>
                                        <option value="+82">+82 (South Korea)</option>
                                        <option value="+84">+84 (Vietnam)</option>
                                        <option value="+86">+86 (China)</option>
                                        <option value="+90">+90 (Turkey)</option>
                                        <option value="+91" selected>+91 (India)</option>
                                        <option value="+92">+92 (Pakistan)</option>
                                        <option value="+93">+93 (Afghanistan)</option>
                                        <option value="+94">+94 (Sri Lanka)</option>
                                        <option value="+95">+95 (Myanmar)</option>
                                        <option value="+98">+98 (Iran)</option>
                                        <option value="+211">+211 (South Sudan)</option>
                                        <option value="+212">+212 (Morocco)</option>
                                        <option value="+213">+213 (Algeria)</option>
                                        <option value="+216">+216 (Tunisia)</option>
                                        <option value="+218">+218 (Libya)</option>
                                        <option value="+220">+220 (Gambia)</option>
                                        <option value="+221">+221 (Senegal)</option>
                                        <option value="+222">+222 (Mauritania)</option>
                                        <option value="+223">+223 (Mali)</option>
                                        <option value="+224">+224 (Guinea)</option>
                                        <option value="+225">+225 (Ivory Coast)</option>
                                        <option value="+226">+226 (Burkina Faso)</option>
                                        <option value="+227">+227 (Niger)</option>
                                        <option value="+228">+228 (Togo)</option>
                                        <option value="+229">+229 (Benin)</option>
                                        <option value="+230">+230 (Mauritius)</option>
                                        <option value="+231">+231 (Liberia)</option>
                                        <option value="+232">+232 (Sierra Leone)</option>
                                        <option value="+233">+233 (Ghana)</option>
                                        <option value="+234">+234 (Nigeria)</option>
                                        <option value="+235">+235 (Chad)</option>
                                        <option value="+236">+236 (Central African Republic)</option>
                                        <option value="+237">+237 (Cameroon)</option>
                                        <option value="+238">+238 (Cape Verde)</option>
                                        <option value="+239">+239 (São Tomé & Príncipe)</option>
                                        <option value="+240">+240 (Equatorial Guinea)</option>
                                        <option value="+241">+241 (Gabon)</option>
                                        <option value="+242">+242 (Congo)</option>
                                        <option value="+243">+243 (DR Congo)</option>
                                        <option value="+244">+244 (Angola)</option>
                                        <option value="+245">+245 (Guinea-Bissau)</option>
                                        <option value="+246">+246 (British Indian Ocean Territory)</option>
                                        <option value="+248">+248 (Seychelles)</option>
                                        <option value="+249">+249 (Sudan)</option>
                                        <option value="+250">+250 (Rwanda)</option>
                                        <option value="+251">+251 (Ethiopia)</option>
                                        <option value="+252">+252 (Somalia)</option>
                                        <option value="+253">+253 (Djibouti)</option>
                                        <option value="+254">+254 (Kenya)</option>
                                        <option value="+255">+255 (Tanzania)</option>
                                        <option value="+256">+256 (Uganda)</option>
                                        <option value="+257">+257 (Burundi)</option>
                                        <option value="+258">+258 (Mozambique)</option>
                                        <option value="+260">+260 (Zambia)</option>
                                        <option value="+261">+261 (Madagascar)</option>
                                        <option value="+262">+262 (Réunion)</option>
                                        <option value="+263">+263 (Zimbabwe)</option>
                                        <option value="+264">+264 (Namibia)</option>
                                        <option value="+265">+265 (Malawi)</option>
                                        <option value="+266">+266 (Lesotho)</option>
                                        <option value="+267">+267 (Botswana)</option>
                                        <option value="+268">+268 (Eswatini)</option>
                                        <option value="+269">+269 (Comoros)</option>
                                        <option value="+290">+290 (Saint Helena)</option>
                                        <option value="+297">+297 (Aruba)</option>
                                        <option value="+298">+298 (Faroe Islands)</option>
                                        <option value="+299">+299 (Greenland)</option>
                                        <option value="+350">+350 (Gibraltar)</option>
                                        <option value="+351">+351 (Portugal)</option>
                                        <option value="+352">+352 (Luxembourg)</option>
                                        <option value="+353">+353 (Ireland)</option>
                                        <option value="+354">+354 (Iceland)</option>
                                        <option value="+355">+355 (Albania)</option>
                                        <option value="+356">+356 (Malta)</option>
                                        <option value="+357">+357 (Cyprus)</option>
                                        <option value="+358">+358 (Finland)</option>
                                        <option value="+359">+359 (Bulgaria)</option>
                                        <option value="+370">+370 (Lithuania)</option>
                                        <option value="+371">+371 (Latvia)</option>
                                        <option value="+372">+372 (Estonia)</option>
                                        <option value="+373">+373 (Moldova)</option>
                                        <option value="+374">+374 (Armenia)</option>
                                        <option value="+375">+375 (Belarus)</option>
                                        <option value="+376">+376 (Andorra)</option>
                                        <option value="+377">+377 (Monaco)</option>
                                        <option value="+378">+378 (San Marino)</option>
                                        <option value="+380">+380 (Ukraine)</option>
                                        <option value="+381">+381 (Serbia)</option>
                                        <option value="+382">+382 (Montenegro)</option>
                                        <option value="+383">+383 (Kosovo)</option>
                                        <option value="+385">+385 (Croatia)</option>
                                        <option value="+386">+386 (Slovenia)</option>
                                        <option value="+387">+387 (Bosnia & Herzegovina)</option>
                                        <option value="+389">+389 (North Macedonia)</option>
                                        <option value="+420">+420 (Czech Republic)</option>
                                        <option value="+421">+421 (Slovakia)</option>
                                        <option value="+423">+423 (Liechtenstein)</option>
                                        <option value="+852">+852 (Hong Kong)</option>
                                        <option value="+855">+855 (Cambodia)</option>
                                        <option value="+856">+856 (Laos)</option>
                                        <option value="+880">+880 (Bangladesh)</option>
                                        <option value="+886">+886 (Taiwan)</option>
                                        <option value="+960">+960 (Maldives)</option>
                                        <option value="+961">+961 (Lebanon)</option>
                                        <option value="+962">+962 (Jordan)</option>
                                        <option value="+963">+963 (Syria)</option>
                                        <option value="+964">+964 (Iraq)</option>
                                        <option value="+965">+965 (Kuwait)</option>
                                        <option value="+966">+966 (Saudi Arabia)</option>
                                        <option value="+967">+967 (Yemen)</option>
                                        <option value="+968">+968 (Oman)</option>
                                        <option value="+970">+970 (Palestine)</option>
                                        <option value="+971">+971 (United Arab Emirates)</option>
                                        <option value="+972">+972 (Israel)</option>
                                        <option value="+973">+973 (Bahrain)</option>
                                        <option value="+974">+974 (Qatar)</option>
                                        <option value="+975">+975 (Bhutan)</option>
                                        <option value="+976">+976 (Mongolia)</option>
                                        <option value="+977">+977 (Nepal)</option>
                                        <option value="+992">+992 (Tajikistan)</option>
                                        <option value="+993">+993 (Turkmenistan)</option>
                                        <option value="+994">+994 (Azerbaijan)</option>
                                        <option value="+995">+995 (Georgia)</option>
                                        <option value="+996">+996 (Kyrgyzstan)</option>
                                        <option value="+998">+998 (Uzbekistan)</option>

                                    </select>
                                    <input type="tel" id="whatsapp" placeholder="WhatsApp Number" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <select id="program" required>
                                    <option value="">Select Program</option>
                                    <option value="professional-certification">Professional Certifications</option>
                                    <option value="qualification-programs">Qualification Programs</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <select id="elective" required>
                                    <option value="">Select Elective</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="country" required>
                                    <option value="">Select Country</option>
                                    <option value="AF">Afghanistan</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AU">Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BY">Belarus</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivia</option>
                                    <option value="BA">Bosnia and Herzegovina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BR">Brazil</option>
                                    <option value="BN">Brunei</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                                    <option value="KH">Cambodia</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CA">Canada</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">China</option>
                                    <option value="CO">Colombia</option>
                                    <option value="KM">Comoros</option>
                                    <option value="CG">Congo</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="HR">Croatia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CY">Cyprus</option>
                                    <option value="CZ">Czech Republic</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EG">Egypt</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="EE">Estonia</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="FI">Finland</option>
                                    <option value="FR">France</option>
                                    <option value="DE">Germany</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GR">Greece</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GN">Guinea</option>
                                    <option value="HT">Haiti</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HK">Hong Kong</option>
                                    <option value="HU">Hungary</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IN" selected>India</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IR">Iran</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IE">Ireland</option>
                                    <option value="IL">Israel</option>
                                    <option value="IT">Italy</option>
                                    <option value="JP">Japan</option>
                                    <option value="JO">Jordan</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KP">North Korea</option>
                                    <option value="KR">South Korea</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="LA">Laos</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LB">Lebanon</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libya</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="MO">Macau</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MV">Maldives</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MX">Mexico</option>
                                    <option value="MD">Moldova</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="MM">Myanmar</option>
                                    <option value="NA">Namibia</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NL">Netherlands</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NO">Norway</option>
                                    <option value="OM">Oman</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PL">Poland</option>
                                    <option value="PT">Portugal</option>
                                    <option value="QA">Qatar</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russia</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SN">Senegal</option>
                                    <option value="RS">Serbia</option>
                                    <option value="SG">Singapore</option>
                                    <option value="SK">Slovakia</option>
                                    <option value="SI">Slovenia</option>
                                    <option value="ZA">South Africa</option>
                                    <option value="ES">Spain</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SE">Sweden</option>
                                    <option value="CH">Switzerland</option>
                                    <option value="SY">Syria</option>
                                    <option value="TW">Taiwan</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TZ">Tanzania</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TL">Timor-Leste</option>
                                    <option value="TG">Togo</option>
                                    <option value="TN">Tunisia</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="US">United States</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VE">Venezuela</option>
                                    <option value="VN">Vietnam</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" id="coupon" placeholder="Coupon Code (Optional)" />
                            </div>
                            <button type="submit" class="btn btn-primary btn-full">
                                Submit Application
                            </button>
                            <p class="form-note">
                                Our admissions team will contact you within 24 hours to guide
                                you through the next steps.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="why-choose" id="why-choose">
        <div class="container">
            <div class="section-header">
                <h2>Why Choose ASTI ACADEMY DWC?</h2>
                <p>
                    Trusted by learners worldwide for delivering accredited, career-focused education.
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>Globally Recognized Certification</h3>
                    <p>Qualifications accepted by employers and academic institutions worldwide.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Flexible Online & On-Campus Learning</h3>
                    <p>Study from anywhere or attend classes in Dubai with full support.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>Career-Driven Curriculum</h3>
                    <p>Courses aligned with real industry needs to support strong job outcomes.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>Qualified Expert Faculty</h3>
                    <p>Learn from experienced professionals guiding you throughout your learning path.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="courses" id="courses">
        <div class="container">
            <div class="section-header">
                <h2>Explore Our Industry-Recognized Professional Programs</h2>
                <p>
                    Choose industry-ready programs to build your professional career.
                </p>
            </div>
            <div class="courses-grid">
                <div class="course-card">
                    <div class="course-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Block chain Technology Program</h3>
                    <p>
                        Gain practical knowledge in block chain fundamentals, smart contracts, and decentralized
                        applications.
                    </p>
                    <div class="course-meta">
                        <span class="duration"><i class="fas fa-clock"></i> 6 Months</span>
                    </div>
                    <a href="#apply" class="btn btn-outline">Learn More</a>
                </div>
                <div class="course-card">
                    <div class="course-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3>Artificial Intelligence Program</h3>
                    <p>
                        Learn AI concepts, machine learning techniques, automation, and real-time data analytics for modern
                        industries.
                    </p>
                    <div class="course-meta">
                        <span class="duration"><i class="fas fa-clock"></i> 6 Months</span>
                    </div>
                    <a href="#apply" class="btn btn-outline">Learn More</a>
                </div>
                <div class="course-card">
                    <div class="course-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Oracle Financials Program</h3>
                    <p>
                        Master Oracle Financials modules for enterprise-level financial management and reporting systems.
                    </p>
                    <div class="course-meta">
                        <span class="duration"><i class="fas fa-clock"></i> 6 Months</span>
                    </div>
                    <a href="#apply" class="btn btn-outline">Learn More</a>
                </div>
                <div class="course-card">
                    <div class="course-icon">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <h3>Electric Vehicle Engineering Course</h3>
                    <p>Understand EV technology, battery systems, charging infrastructure, and modern vehicle design
                        principles.</p>
                    <div class="course-meta">
                        <span class="duration"><i class="fas fa-clock"></i> 6 Months</span>
                    </div>
                    <a href="#apply" class="btn btn-outline">Learn More</a>
                </div>
                <div class="course-card">
                    <div class="course-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h3>Level 3 Foundation Diploma in Accountancy</h3>
                    <p>Develop essential accounting principles, bookkeeping techniques, and financial documentation skills.
                    </p>
                    <div class="course-meta">
                        <span class="duration"><i class="fas fa-clock"></i> 12 Months</span>
                    </div>
                    <a href="#apply" class="btn btn-outline">Learn More</a>
                </div>
                <div class="course-card">
                    <div class="course-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Cyber Security</h3>
                    <p>
                        Gain practical knowledge in cybersecurity fundamentals, network security, ethical hacking, and
                        security operations.
                    </p>
                    <div class="course-meta">
                        <span class="duration"><i class="fas fa-clock"></i> 6 Months</span>
                    </div>
                    <a href="#apply" class="btn btn-outline">Learn More</a>
                </div>
            </div>
            <div class="section-cta">
                <a href="#home" class="btn btn-primary">View All IT Programs</a>
            </div>
        </div>
    </section>

    <section class="different" id="about">
        <div class="container">
            <div class="section-header">
                <h2>What Makes ASTI Academy Different from Other Institutions?</h2>
                <p>
                    Internationally trusted, career-driven, and recognised vocational & technical training for the modern
                    job market.
                </p>
            </div>
            <div class="different-grid">
                <div class="different-item">
                    <div class="different-icon">
                        <i class="fas fa-university"></i>
                    </div>
                    <h3>Government-Recognised Qualifications</h3>
                    <p>Programmes approved by UAE authorities and aligned to international standards.</p>
                </div>
                <div class="different-item">
                    <div class="different-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3>Global Reach</h3>
                    <p>Students from around the world engage in our online and blended training.</p>
                </div>
                <div class="different-item">
                    <div class="different-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>Hands-On Learning</h3>
                    <p>Real-world assignments, live case studies and job-ready skills built into every course.</p>
                </div>
                <div class="different-item">
                    <div class="different-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Flexible Study</h3>
                    <p>Online, self-paced and accessible from anywhere—designed to suit busy professionals.</p>
                </div>
                <div class="different-item">
                    <div class="different-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>Career Support</h3>
                    <p>Assistance with resumes, job preparation, internships and industry exposure.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="recognition">
        <div class="container">
            <div class="recognition-content">
                <div class="section-header">
                    <h2>ASTI Academy’s Accredited Qualifications with Global Recognition</h2>
                    <p>
                        Earn diplomas and certifications that are respected by employers and institutions across the UAE and
                        beyond.
                    </p>
                </div>
                <div class="recognition-text">
                    <p>
                        ASTI Academy DWC cooperates with recognised awarding bodies and ensures all programmes meet
                        regulatory and international training standards—helping you pursue your career with confidence.
                    </p>
                    <blockquote>
                        “Your qualification will be globally recognised — opening doors to higher education and
                        international career opportunities.”
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- dream-job-section -->
    <section class="dream-job-section">
        <div class="container">
            <h2>
                Thousands of students achieved their <span>dream job</span> at
            </h2>

            <div class="company-logos">
                <img src="/frontend/assets/images/Amazon_logo.svg.png" alt="Amazon">
                <img src="/frontend/assets/images/google-logo-2.webp" alt="Google">
                <img src="/frontend/assets/images/microsoft-logo-2.png" alt="Microsoft">
                <img src="/frontend/assets/images/Goldman-Sachs-Logo.png" alt="Goldman Sachs">
                <img src="/frontend/assets/images/paypal-logo.png" alt="PayPal">
                <img src="/frontend/assets/images/samsung-logo-2.png" alt="Samsung">
                <img src="/frontend/assets/images/salesforce-logo.png" alt="Salesforce">
                <img src="/frontend/assets/images/NetApp-Symbol.png" alt="NetApp">
                <img src="/frontend/assets/images/Hitachi-logo.jpg" alt="Hitachi">
                <img src="/frontend/assets/images/jpmorgan-logo.jpg" alt="JPMorgan">
                <img src="/frontend/assets/images/ibm-logo.png" alt="IBM">
                <img src="/frontend/assets/images/dell-logo.png" alt="Dell">
                <img src="/frontend/assets/images/deloitte-logo.png" alt="Deloitte">
                <img src="/frontend/assets/images/kpmg.png" alt="KPMG">
                <img src="/frontend/assets/images/mercedes-logo.png" alt="Mercedes-Benz">
                <img src="/frontend/assets/images/ey-logo.png" alt="EY">

            </div>
        </div>
    </section>

    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>Our Learners, Their Success</h2>
                <p>
                    Hear from students who transformed their careers through ASTI Academy DWC.
                </p>
            </div>
            <div class="testimonials-slider">
                <div class="testimonial-track" id="testimonialTrack">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <i class="fas fa-quote-left quote-icon"></i>
                            <p>
                                “The accounting programme at ASTI Dubai equipped me with practical skills and boosted my
                                confidence for the finance industry.”
                            </p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="author-info">
                                <h4>Ahmed Al Mansoori</h4>
                                <p>UAE</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <i class="fas fa-quote-left quote-icon"></i>
                            <p>
                                “The Level 4/5 Education & Training diploma at ASTI Dubai helped me move into a teaching
                                role and understand real-life classroom dynamics.”
                            </p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="author-info">
                                <h4>Sara Thomas</h4>
                                <p>UAE</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <i class="fas fa-quote-left quote-icon"></i>
                            <p>
                                “Joining the Business & Accounting pathway at ASTI Dubai meant I could switch careers
                                quickly with support and hands-on internships.”
                            </p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="author-info">
                                <h4>Khalid Sharif</h4>
                                <p>UAE</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="slider-btn prev" id="prevBtn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="slider-btn next" id="nextBtn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="container">
            <div class="section-header">
                <h2>ASTI Academy DWC in Numbers</h2>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3 class="stat-number">10,000+</h3>
                    <p>Global Students Enrolled</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="stat-number">UK-Accredited </h3>
                    <p>Programmes across multiple disciplines</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="stat-number">85%</h3>
                    <p>Graduates Employed or Promoted</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="stat-number">100+</h3>
                    <p>Expert Mentors & Trainers</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="stat-number">24/7</h3>
                    <p>Academic & Technical Support</p>
                </div>
            </div>
        </div>
    </section>

    <section class="faq" id="faq">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
            </div>
            <div class="faq-container">
                <div class="faq-item">
                    <button class="faq-question">
                        <span>Are your courses internationally recognised?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Yes — our programmes are aligned with UAE and global vocational training standards.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">
                        <span>Can I study if I’m based outside the UAE?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Yes, our online and blended programmes are accessible from anywhere.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">
                        <span>Will I receive a certificate at the end?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Yes, you will be awarded a recognised diploma or certification once you complete the programme.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">
                        <span>What are the entry requirements?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Basic English proficiency and a desire to learn — many programmes do not require prior
                            specialist qualifications.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">
                        <span>Do you offer discounts or promotional codes?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Yes, from time to time. Please contact our admissions team to ask about current offers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="final-cta" id="apply">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Begin Your Career Journey with ASTI Dubai?</h2>
                <p>
                    Enroll today and take the next step toward a globally recognized qualification and real career
                    opportunities.
                </p>
                <div class="cta-buttons">
                    <a href="#home" class="btn btn-primary btn-large">Enroll Today</a>
                    <a href="#contact" class="btn btn-secondary btn-large">Talk to an Advisor</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>About ASTI ACADEMY DWC</h3>
                    <p>
                        ASTI Academy DWC provides globally recognized vocational and professional training programs to
                        students and working professionals across the globe.
                        Our mission is to make high-quality education accessible, practical, and career-focused — enabling
                        learners to gain real skills for real careers.

                    </p>
                </div>
                <div class="footer-col">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#courses">IT Courses</a></li>
                        <li><a href="#testimonials">Testimonials</a></li>
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Contact Info</h3>
                    <ul class="contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt"></i> 17-1-16/A, 6th-Floor Pinnacle Towers,
                            Santosh Nagar, Saidabad, Hyderabad- 500059
                        </li>
                        <li><i class="fas fa-globe"></i>astidubai.ac.ae</li>
                        <li>
                            <i class="fas fa-envelope"></i> enquire@astidubai.ac.ae

                        </li>
                        <li><i class="fas fa-phone"></i> +91 8885514426</li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Follow Us</h3>
                    <div class="social-links">
                        <a href="https://www.linkedin.com/company/astiacademyonline/posts/" class="social-link"><i
                                class="fab fa-linkedin"></i></a>
                        <a href="https://www.facebook.com/astionlineuae" class="social-link"><i
                                class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/astiacademydwc/" class="social-link"><i
                                class="fab fa-instagram"></i></a>
                        {{-- <a href="https://x.com/AstiOnline" class="social-link"><i class="fab fa-twitter"></i></a> --}}
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 ASTI ACADEMY DWC. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
@endsection


@push('scripts')
    <script src="{{ asset('frontend/assets/js/professional-courses.js') }}"></script>
@endpush
