<html lang="en">

<head>
    @include('marketplace.layouts.front-partial.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Meta Pixel Code -->
    @stack('styles')

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FFNENJDRMN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-FFNENJDRMN');
    </script>
    <!--end of  Google tag (gtag.js) -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17642806863"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-17642806863');
    </script>
</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6X9DPPX" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1007818057796060&ev=PageView&noscript=1" /></noscript>

    <!-- Popup -->
    <!--<div id="popup">-->
    <!--  <div class="popup-content">-->
    <!--    <button class="close-btn" onclick="closePopup()">-->
    <!--      <i class="fas fa-times"></i>-->
    <!--    </button>-->
    <!--    <button class="apply-btn" onclick="redirectToContact()">-->
    <!--      Apply Now-->
    <!--    </button>-->
    <!--  </div>-->
    <!--</div>-->

    <!-- Navbar code starts here Header -->
    @include('marketplace.layouts.front-partial.header')

    <!-- navbar code ends here -->
    <div class="social-button">
        <button class="btn firstbtn">Call Now</button>
        <a href="tel:+971-564157272" class="scheduleBtn right-menubar"><i class="fa fa-phone phone"></i></a>


        <button class="btn thirdbtn">WhatsApp</button>
        <a href="https://wa.me/971566033332" class="whatsappBtn"><i class="fab fa-whatsapp whatsapp"></i></a>

        <button class="btn fourthbtn">Enquiry Now</button>
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=enquire@astidubai.ac.ae" target="_blank"
            class="enquiryBtn"><i class="fa fa-envelope envelope"></i></a>


        <button class="btn sixthbtn">Enroll Now</button>
        <a href="/courses/courses" class="applyBtn">
            <i class="fa-duotone fa-solid fa-file-import applynow"></i>
        </a>
    </div>
    @yield('content')


    <!-- Contact -->
    <section id="contact" class="section-7">
        <div class="container">
            <form id="hubspot-form-3" method="POST" action="{{ route('contact.form.submit') }}">

                @csrf

                <div class="row align-items-center">
                    <div class="col-12 col-md-6 align-self-start text-center text-md-left">

                        <div class="row intro form-content">
                            <div class="col-12 p-0">
                                <div class="step-title">
                                    <h2 class="featured alt">Let's Build Your Future Together</h2>
                                    <p>
                                        Don't wait until tomorrow. Talk to one of our consultants
                                        today and learn how to start leveraging your business.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row text-center form-content">
                            <div class="col-12 p-0">
                                <fieldset class="step-group">

                                    <div class="row">
                                        <div class="col-12 input-group p-0">
                                            <input type="text" name="firstname" class="form-control"
                                                placeholder="Name" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 input-group p-0">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Email" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 input-group p-0">
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="Phone" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 input-group p-0">
                                            <select name="country_of_residence" class="form-control" required>
                                                <option value="">Select Country</option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="Brunei">Brunei</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cabo Verde">Cabo Verde</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Central African Republic">Central African Republic
                                                </option>
                                                <option value="Chad">Chad</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)
                                                </option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Democratic Republic of the Congo">Democratic Republic of
                                                    the Congo</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Eswatini">Eswatini</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran">Iran</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Ivory Coast">Ivory Coast</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Laos">Laos</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libya">Libya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Micronesia">Micronesia</option>
                                                <option value="Moldova">Moldova</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montenegro">Montenegro</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Namibia">Namibia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherlands">Netherlands</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="North Korea">North Korea</option>
                                                <option value="North Macedonia">North Macedonia</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau">Palau</option>
                                                <option value="Palestine State">Palestine State</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russia">Russia</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                <option value="Saint Lucia">Saint Lucia</option>
                                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the
                                                    Grenadines</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Serbia">Serbia</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="South Korea">South Korea</option>
                                                <option value="South Sudan">South Sudan</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syria">Syria</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania">Tanzania</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Timor-Leste">Timor-Leste</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States of America">United States of America
                                                </option>
                                                <option value="Uruguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Vatican City">Vatican City</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 input-group p-0">
                                            <select id="program_type" name="program_type" class="form-control"
                                                required>
                                                <option value="">Select Program Type</option>
                                                <option value="professional">Professional Certifications</option>
                                                <option value="qualification">Qualification Programs</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 input-group p-0">
                                            <select id="course_title-1" name="course_title" class="form-control"
                                                required>
                                                <option value="">Select Course</option>
                                                {{-- <option value="Laravel LMS">Laravel LMS</option>
                                                <option value="React Frontend">React Frontend</option> --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 input-group p-0">
                                        <button type="submit" class="btn primary-button" id="submitBtn">
                                            Submit <i class="icon-arrow-right-circle left"></i>
                                        </button>
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                    </div>

                    <div class="content-images col-12 col-md-6 pl-md-5 d-none d-md-block">
                        <div style="direction: flex; align-items:strect; height:600px" class="image-wrapper">
                            <img style="width: 100%; height:100%; object-fit:cover; border-radius:8px"
                                src="/frontend/assets/images/contact-img.jpeg" alt="Consultation Meeting">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>

    @include('marketplace.layouts.front-partial.footer')


    <!-- #region Global ============================ -->

    <!-- Modal [search] -->
    <div id="search" class="p-0 modal fade" role="dialog" aria-labelledby="search" aria-hidden="true">

        <div class="modal-dialog modal-dialog-slideout" role="document">
            <div class="modal-content full">
                <div class="modal-header" data-dismiss="modal">
                    Search <i class="icon-close"></i>
                </div>
                <div class="modal-body">
                    <form class="row">
                        <div class="col-12 p-0 align-self-center">
                            <div class="row">
                                <div class="col-12 p-0 pb-3">
                                    <h2>What are you looking for?</h2>
                                    <p>
                                        Search for services and news about the best that happens
                                        in the world.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group">
                                    <input type="text" class="form-control" placeholder="Enter Keywords" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group align-self-center">
                                    <button class="btn primary-button">
                                        <i class="icon-magnifier"></i>SEARCH
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal [sign] -->
    <div id="sign" class="p-0 modal fade" role="dialog" aria-labelledby="sign" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout" role="document">
            <div class="modal-content full">
                <div class="modal-header" data-dismiss="modal">
                    Sign In Form <i class="icon-close"></i>
                </div>
                <div class="modal-body">
                    <form action="/" class="row">
                        <div class="col-12 p-0 align-self-center">
                            <div class="row">
                                <div class="col-12 p-0 pb-3">
                                    <h2>Sign In</h2>
                                    <p>
                                        Don't have an account?
                                        <a href="#" class="primary-color" data-toggle="modal"
                                            data-target="#register">Register now</a>.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group">
                                    <input type="email" class="form-control" placeholder="Email" required />
                                </div>
                                <div class="col-12 p-0 input-group">
                                    <input type="password" class="form-control" placeholder="Password" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group align-self-center">
                                    <button class="btn primary-button">
                                        <i class="icon-login"></i>LOGIN
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal [register] -->
    <div id="register" class="p-0 modal fade" role="dialog" aria-labelledby="register" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout" role="document">
            <div class="modal-content full">
                <div class="modal-header" data-dismiss="modal">
                    Register Form <i class="icon-close"></i>
                </div>
                <div class="modal-body">
                    <form action="/" class="row">
                        <div class="col-12 p-0 align-self-center">
                            <div class="row">
                                <div class="col-12 p-0 pb-3">
                                    <h2>Register</h2>
                                    <p>
                                        Have an account?
                                        <a href="#" class="primary-color" data-toggle="modal"
                                            data-target="#sign">Sign In</a>.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group">
                                    <input type="text" class="form-control" placeholder="Name" required />
                                </div>
                                <div class="col-12 p-0 input-group">
                                    <input type="email" class="form-control" placeholder="Email" required />
                                </div>
                                <div class="col-12 p-0 input-group">
                                    <input type="password" class="form-control" placeholder="Password" required />
                                </div>
                                <div class="col-12 p-0 input-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password"
                                        required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group align-self-center">
                                    <button class="btn primary-button">
                                        <i class="icon-rocket"></i>REGISTER
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal [responsive menu] -->
    <div id="menu" class="p-0 modal fade" role="dialog" aria-labelledby="menu" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout" role="document">
            <div class="modal-content full">
                <div class="modal-header" data-dismiss="modal">
                    <img src="/frontend/assets/images/logo.png" alt=" ASTI Academy " width="150" /> <i
                        class="icon-close"></i>
                </div>
                <div class="menu modal-body">
                    <div class="row w-100">
                        <div class="items p-0 col-12 text-center">
                            <!-- Append [navbar] -->
                        </div>
                        <div class="contacts p-0 col-12 text-center">
                            <!-- Append [navbar] -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll [to top] -->
    <div id="scroll-to-top" class="scroll-to-top">
        <a href="#header" class="smooth-anchor">
            <i class="icon-arrow-up"></i>
        </a>
    </div>
    @include('marketplace.layouts.front-partial.scripts')
    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const programType = document.getElementById("program_type");
            const courseSelect = document.getElementById("course_title-1");
            const form = document.getElementById("hubspot-form-3");

            // Course Data
            const professionalCourses = [
                "Oracle Financials",
                "Blockchain Technology",
                "Property Management Programme",
                "Design Engineering Programme",
                "Artificial Intelligence Programme",
                "Quantity Surveying Programme",
                "Biomedical Engineering Programme",
                "Mechatronics Engineering Programme",
                "Petroleum Engineering Programme",
                "Chemical Engineering Programme",
                "Electrical Vehicle Engineering Course",
                "Data Analysis Training Course",
                "Data Science with AI Training Course",
                "Python Web Development Course",
                "Health Administration",
                "Digital Marketing Management",
                "Marketing Management Sales Management"
            ];

            const qualificationCourses = [
                "Level-3 Foundation Diploma in Higher Education",
                "Level-3 Diploma in Education and Training",
                "Level-4 Diploma in Accounting and Business",
                "Level-4 Diploma in Education and Training",
                "Level-5 Diploma in Accounting and Business"


            ];

            // Program type change handler
            programType.addEventListener("change", function() {

                courseSelect.innerHTML = '<option value="">Select Course</option>';
                courseSelect.disabled = true;

                let courses = [];

                if (this.value === "professional") {
                    courses = professionalCourses;
                } else if (this.value === "qualification") {
                    courses = qualificationCourses;
                }

                if (courses.length > 0) {
                    courseSelect.disabled = false;

                    courses.forEach(course => {
                        const option = document.createElement("option");
                        option.value = course;
                        option.textContent = course;
                        courseSelect.appendChild(option);
                    });
                }
            });

            // Basic validation before submit
            form.addEventListener("submit", function(e) {

                if (!programType.value) {
                    alert("Please select a Program Type");
                    programType.focus();
                    e.preventDefault();
                    return;
                }

                if (!courseSelect.value) {
                    alert("Please select a Course");
                    courseSelect.focus();
                    e.preventDefault();
                    return;
                }

            });

        });
    </script>

    <script>
        document.getElementById('hubspot-form-3').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const submitBtn = document.getElementById('submitBtn');

            // Disable button
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Submitting...';

            let formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Submit';

                    alert(data.message);
                    form.reset();
                })
                .catch(() => {
                    alert('Submission failed. Try again.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Submit';
                });
        });
    </script>




</body>

</html>
