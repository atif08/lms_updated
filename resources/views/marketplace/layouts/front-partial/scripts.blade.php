<!-- ==============================================
        Google reCAPTCHA // Put your site key here
        =============================================== -->
<script src="https://www.google.com/recaptcha/api.js?render=6Lf-NwEVAAAAAPo_wwOYxFW18D9_EKvwxJxeyUx7"></script>

<!-- ==============================================
        Form Scripts
        =============================================== -->
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.8.1/build/js/intlTelInput.min.js"></script>

<!-- ==============================================
        Vendor Scripts
        =============================================== -->
<script src="/frontend/assets/js/vendor/jquery.min.js"></script>
<script src="/frontend/assets/js/vendor/jquery.easing.min.js"></script>
<script src="/frontend/assets/js/vendor/jquery.inview.min.js"></script>
<script src="/frontend/assets/js/vendor/popper.min.js"></script>
<script src="/frontend/assets/js/vendor/bootstrap.min.js"></script>
<script src="/frontend/assets/js/vendor/ponyfill.min.js"></script>
<script src="/frontend/assets/js/vendor/slider.min.js"></script>
<script src="/frontend/assets/js/vendor/animation.min.js" defer></script>
<script src="/frontend/assets/js/vendor/progress-radial.min.js"></script>
<script src="/frontend/assets/js/vendor/bricklayer.min.js"></script>
<script src="/frontend/assets/js/vendor/gallery.min.js"></script>
<script src="/frontend/assets/js/vendor/shuffle.min.js"></script>
<script src="/frontend/assets/js/vendor/particles.min.js"></script>
<script src="/frontend/assets/js/main.js"></script>
<script src="/frontend/assets/js/lite-yt-embed.js"></script>
<script src="https://payments.geidea.ae/hpp/geideaCheckout.min.js"></script>
<script>window.$zoho = window.$zoho || {};
    $zoho.salesiq = $zoho.salesiq || {
        ready: function () {
        }
    }
</script>
<script>
    gtag('event', 'conversion', {'send_to': 'AW-816748671/4BjBCO6Cs8kZEP-wuoUD'});
</script>
<script>
    !function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1007818057796060');
    fbq('track', 'PageView');
</script>
<script id="zsiqscript"
        src="https://salesiq.zohopublic.com/widget?wc=siq06d12c65ad998dfcdf021e83352509de2ec99e097d171a648b020dfe2034e4d9"
        defer></script>
<script>
    const input = document.querySelector("#phone-2");
    window.intlTelInput(input, {
        utilsScript:
            "https://cdn.jsdelivr.net/npm/intl-tel-input@23.8.1/build/js/utils.js",
    });
</script>

<script>
    // Show popup after 2 seconds
    window.addEventListener("load", function () {
        setTimeout(() => {
            document.getElementById("popup").classList.add("active");
        }, 2000);
    });

    // Close popup function
    function closePopup() {
        document.getElementById("popup").classList.remove("active");
    }

    // Redirect to /contact page
    function redirectToContact() {
        document.getElementById("popup").classList.remove("active");
        const contactSection = document.getElementById("contact");
        if (contactSection) {
            contactSection.scrollIntoView({behavior: "smooth", block: "start"});
        }
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

</script>
<script>
    $(document).ready(function() {
        console.log('Script loaded and ready');
        $('#pay-button').on('click', function() {
            createAndStartPayment();
        });
    });
    createAndStartPayment = function() {
        var xhr = new XMLHttpRequest();
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Set up the request
        xhr.open('POST', '{{ route('create.session') }}');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        // Set up a function to handle the response
        xhr.onload = function() {
            var response = xhr.responseText.trim();

            if (xhr.status === 200) {

                // Get the response text
                // Check if the response is empty or not
                if (response.length > 0) {
                    response = JSON.parse(response)
                    // Start the payment with the session ID
                    startPayment(response.session.id);
                } else {
                    alert('Error: Empty response from server');
                }
            } else {
                console.log(response);
                alert('Error: ' + JSON.parse(response).error);
            }
        };

        // Set up a function to handle network errors
        xhr.onerror = function() {
            alert('Error: Network Error');
        };

        // Send the request with the JSON string
        var data = {
            slug: "{{request()->segment(2)}}",
            currency: "USD",
            callback_url: "{{url('/payment/callback')}}",
            language: "en",
        };
        xhr.send(JSON.stringify(data));
    }

    function startPayment(sessionId) {
        // Initialize GeideaCheckout
        var payment = new GeideaCheckout(onSuccess, onError, onCancel);
        // Start the payment
        payment.startPayment(sessionId);
    }

    // Define the onSuccess function
    let onSuccess = function(data) {
        const courseId = '{{@$course?->id}}'; // get this dynamically in your JS
        const userId = '{{ auth()->id() }}'; // or pass from Blade
        // After payment success, call your backend to confirm and enroll user
        $.ajax({
            url:`/courses/${courseId}/users/${userId}/enroll`,
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: "application/json",
            data: JSON.stringify({
                orderId: data.orderId,
                reference: data.reference,
                course_slug: '{{request()->segment(2)}}', // or pass as parameter
                paymentData: data
            }),
            success: function(response) {
                alert(response.message || 'Enrollment successful!');
                // Optionally redirect or update UI here
            },
            error: function(xhr) {
                alert('Enrollment failed: ' + (xhr.responseJSON?.message || xhr.statusText));
            }
        });
    };

    // Define the onError function
    let onError = function(data) {
        alert('Getting error in payment process.');
    };

    // Define the onCancel function
    let onCancel = function(data) {
    };
</script>


