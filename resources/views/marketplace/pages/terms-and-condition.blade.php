<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('marketplace.layouts.front_layout')
@section('style')
  <style>
      :root {
        --header-bg-color: #f5f5f5;
        --nav-item-color: #2f323a;
        --top-nav-item-color: #2f323a;
        --hero-bg-color: #f5f5f5;

        --section-1-bg-color: #eeeeee;
        --section-2-bg-color: #e5e5e5;
        --section-3-bg-color: #f5f5f5;
        --section-4-bg-color: #eeeeee;
        --section-5-bg-color: #e5e5e5;
        --section-6-bg-color: #f5f5f5;
        --section-7-bg-color: #eeeeee;

        --footer-bg-color: #191919;
      }

      .visa-accepted {
        max-width: 150px;
        height: auto;
        display: block;
        /* margin: 10px auto; */
        opacity: 0.95;
      }
    </style>

    <style>
      /* body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #ffffff;
  color: #333333;
  line-height: 1.6;
} */

      #terms-wrapper {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
        position: relative;
        top: 50px;
      }

      #terms-wrapper h1 {
        font-size: 2rem;
        text-align: center;
        color: #003366;
        margin-bottom: 25px;
      }

      #terms-wrapper section h2 {
        font-size: 1.4rem;
        color: #003366;
        margin-bottom: 10px;
      }

      #terms-wrapper h3 {
        font-size: 1.2rem;
        color: #003366;
        margin-top: 20px;
        margin-bottom: 5px;
      }

      #terms-srapper section {
        /* margin-bottom: 20px !important; Force override large bottom margins */
        padding-bottom: 10px;
      }

      #terms-wrapper section ul {
        padding-left: 20px;
        margin-top: 5px;
      }

      #terms-wrapper section li {
        margin-bottom: 5px;
      }

      #terms-wrapper section p {
        margin: 6px 0;
      }

      .note {
        font-style: italic;
        background-color: #f0f8ff;
        padding: 10px;
        border-left: 4px solid #003366;
        margin-top: 10px;
      }

      @media (max-width: 768px) {
        h1 {
          font-size: 1.6rem;
        }

        #terms-wrapper {
          padding: 15px;
        }
      }

      @media (max-width: 480px) {
        h1 {
          font-size: 1.4rem;
        }

        h2 {
          font-size: 1.1rem;
        }

        h3 {
          font-size: 1rem;
        }
      }
    </style>
@endsection
@section('content')

  <!-- content-section stats here -->

    <div id="terms-wrapper">
      <h1>Terms and Conditions</h1>

      <section style="margin-top: -100px">
        <h2>1. General Terms</h2>
        <ul>
          <li>These Terms and Conditions apply to all users of our website.</li>
          <li>
            By enrolling in a course, you agree to comply with all the rules,
            policies, and guidelines set by ASTI DWC.
          </li>
          <li>
            ASTI DWC reserves the right to amend these terms at any time without
            prior notice. Continued use of the platform indicates your
            acceptance of the revised terms.
          </li>
        </ul>
      </section>

      <section style="margin-top: -250px">
        <h2>2. Course Enrollment and Access</h2>
        <ul>
          <li>
            Access to course materials will be granted upon successful
            enrollment and full payment.
          </li>
          <li>
            Each enrollment is non-transferable and intended for individual use
            only.
          </li>
          <li>
            Course content is for personal educational use and must not be
            reproduced, distributed, or shared without written permission.
          </li>
        </ul>
      </section>

      <section style="margin-top: -250px">
        <h2>3. Payments and Fees</h2>
        <ul>
          <li>All prices are listed in USD unless otherwise stated.</li>
          <li>
            Payment must be completed in full before course access,
            certification, or any related services are provided.
          </li>
          <li>We accept secure online payments through approved gateways.</li>
        </ul>
      </section>

      <section style="margin-top: -250px">
        <h2>4. Certificate Issuance and Additional Services</h2>

        <h3>4.1 Physical Certificate Issuance</h3>
        <p>
          A fee of <strong>USD 45</strong> is applicable for issuing a physical
          copy of your course completion certificate.
        </p>

        <h3>4.2 UAE Ministry of Foreign Affairs (MOFA) Attestation</h3>
        <p>
          An additional fee of <strong>USD 65</strong> is required for MOFA
          attestation of your certificate.
        </p>

        <h3>4.3 Certificate Delivery Charges</h3>
        <p>
          A delivery fee of <strong>USD 10</strong> applies for shipping the
          physical certificate to your address.
        </p>

        <p class="note">
          Note: All above fees must be <strong>paid in advance</strong>.
          Processing will only begin after confirmation of payment.
        </p>
      </section>

      <section style="margin-top: -250px">
        <h2>5. Refund Policy</h2>
        <ul>
          <li>
            Course fees are non-refundable once access to the materials has been
            granted.
          </li>
          <li>
            Fees paid for physical certificates, attestations, and delivery are
            also non-refundable.
          </li>
        </ul>
      </section>

      <section style="margin-top: -250px">
        <h2>6. Limitation of Liability</h2>
        <ul>
          <li>
            ASTI DWC is not liable for any indirect, incidental, or
            consequential damages arising from your use of the platform or
            services.
          </li>
          <li>
            We are not responsible for delays in delivery due to third-party
            shipping providers or force majeure events.
          </li>
        </ul>
      </section>

      <section style="margin-top: -250px">
        <h2>7. Intellectual Property</h2>
        <ul>
          <li>
            All course content, videos, documents, and branding are the property
            of ASTI DWC or its licensors.
          </li>
          <li>
            Unauthorized reproduction or distribution is strictly prohibited.
          </li>
        </ul>
      </section>

      <section style="margin-top: -250px">
        <h2>8. Governing Law</h2>
        <p>
          These Terms and Conditions shall be governed by and construed in
          accordance with the laws of the United Arab Emirates.
        </p>
      </section>

      <section style="margin-top: -250px;">
        <h2>9. Contact Information</h2>
        <p>For any questions or support, please contact us at:</p>
        <ul>
          <li><strong>Email:</strong> enquire@astidubai.ac.ae</li>
          <li><strong>Phone:</strong> +971564157272</li>
          <li><strong>Address:</strong>Dubai South Office, A1 Building, 5th Floor, Jabel Ali Free zone, Dubai, UAE</li>
        </ul>
      </section>
    </div>

@endsection
