<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<meta name="p:domain_verify" content="99e8421f7aa269927e9c760fe074916e" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!--[if IE]>
<meta http-equiv="x-ua-compatible" content="IE=9"/><![endif]-->


<title>{{ $page }}</title>

<meta name="description"
    content="Online professional , technical,  vocational education training & TVET approved institute in UAE. ASTI offers KHDA approved programs in Dubai" />
<meta name="subject" content="Educational Programs" />
<meta name="author" content="Codings" />

<!-- ==============================================
    Favicons
    =============================================== -->
<link rel="canonical" href="https://www.astidubai.ac.ae/">
<link rel="shortcut icon" href="/frontend/assets/images/icon.png" />
<link rel="apple-touch-icon" href="/frontend/assets/images/apple-touch-icon.png" />
<link rel="apple-touch-icon" sizes="72x72" href="/frontend/assets/images/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="114x114" href="/frontend/assets/images/apple-touch-icon-114x114.png" />

<!-- ==============================================
    Vendor Stylesheet
    =============================================== -->
<link rel="stylesheet" href="/frontend/assets/css/vendor/bootstrap.min.css" />
<link rel="stylesheet" href="/frontend/assets/css/vendor/slider.min.css" />
<link rel="stylesheet" href="/frontend/assets/css/main.css" />
<link rel="stylesheet" href="/frontend/assets/css/custom.css" />
<link rel="stylesheet" href="/frontend/assets/css/vendor/icons.min.css" />
<link rel="stylesheet" href="/frontend/assets/css/vendor/animation.min.css" />
<link rel="stylesheet" href="/frontend/assets/css/vendor/gallery.min.css" />
<link rel="stylesheet" href="/frontend/assets/css/vendor/cookie-notice.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
<!-- ==============================================
    Custom Stylesheet
    =============================================== -->
<link rel="stylesheet" href="/frontend/assets/css/default.css" />
<link rel="stylesheet" href="/frontend/assets/css/theme-orange.css" />
<link rel="stylesheet" href="/frontend/assets/css/lite-yt-embed.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.8.1/build/css/intlTelInput.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="/frontend/assets/css/over-ride.css">
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

    #slider {
        background-image: url("/frontend/assets/images/mainbg.webp");
        background-size: cover;
        background-position: center;
    }

    .iti {
        width: 100%;
    }

    .field-phone {
        padding-left: 100px !important;
    }

    .iti__selected-country {
        background: #eeeeee;
    }

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

    /* Popup styles */
    #popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1050;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.3s ease-in-out;
    }

    #popup.active {
        visibility: visible;
        opacity: 1;
    }

    .popup-content {
        position: relative;
        background-image: url("./frontend/assets/images/popup-02-02-02.png");
        background-size: cover;
        background-position: center;
        width: 90%;
        max-width: 800px;
        height: 400px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .close-btn:hover {
        background-color: rgba(255, 255, 255, 1);
    }

    .close-btn i {
        color: black;
    }

    .apply-btn {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background-color: white;
        color: black;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
    }

    .apply-btn:hover {
        background-color: #f0f0f0;
        color: black;
    }

    .progress-steps {
        position: relative;
        display: flex;
        justify-content: space-between;
        margin-bottom: 3rem;
        padding: 0 1rem;
    }

    .progress-line {
        position: absolute;
        top: 20px;
        left: 50px;
        right: 50px;
        height: 4px;
        background-color: #dee2e6;
        z-index: 1;
    }

    .progress-line-fill {
        width: 33%;
        height: 100%;
        background-color: #fc5130;
        transition: width 0.3s ease;
    }

    .step {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
    }

    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #adb5bd;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .step.active .step-circle {
        background-color: #fc5130;
    }

    .step.active .step-text {
        color: #fc5130;
    }

    .step-text {
        font-size: 0.875rem;
        font-weight: 500;
        color: #6c757d;
        text-align: center;
    }

    .content-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: #fde8ec;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fc5130;
        font-size: 1.5rem;
        transform: rotate(-45deg);
        transition: transform 0.3s ease;
    }

    .content-section:hover .content-icon {
        transform: rotate(0deg);
    }

    @media (max-width: 768px) {
        .content-flex {
            flex-direction: column !important;
            align-items: flex-start !important;
        }

        .content-icon {
            margin-bottom: 1rem;
        }

        .progress-steps {
            padding: 0;
        }

        .progress-line {
            left: 20px;
            right: 20px;
        }

        .step-text {
            font-size: 0.75rem;
        }

        .content-section {
            padding: 0 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .progress-steps {
            margin-bottom: 2rem;
        }

        .step-circle {
            width: 32px;
            height: 32px;
            font-size: 0.875rem;
        }

        .content-icon {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
        }

        h3.h4 {
            font-size: 1.125rem;
        }

        .content-section {
            margin-bottom: 1.5rem;
        }
    }

    .pricing {
        display: none !important;
    }
</style>
<!-- ==============================================
    Theme Settings
    =============================================== -->


@yield('style')
