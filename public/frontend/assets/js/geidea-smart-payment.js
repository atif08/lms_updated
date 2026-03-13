/**
 * Geidea Smart Payment Handler
 * Handles EMI and Full payments via Geidea Payment Gateway
 */
class GeideaSmartPayment {
    constructor(config) {
        this.config = Object.assign({
            createSessionUrl: '/create-session',
            enrollUrlStub: '/courses/{courseId}/users/{userId}/enroll', // Replace placeholders
            callbackUrl: window.location.origin + '/payment/callback',
            currency: 'USD',
            language: 'en',
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        }, config);
    }

    /**
     * Start the payment process
     * @param {Object} paymentDetails - { amount, courseId, userId, courseSlug, installmentNo, installmentProgress, paymentMethod }
     * @param {HTMLElement} $btn - Button element to manage state
     */
    initiatePayment(paymentDetails, $btn) {
        if (!paymentDetails.amount || !paymentDetails.courseSlug) {
            console.error('Missing required payment details');
            return;
        }

        this.setButtonProcessing($btn, true);

        const sessionData = {
            slug: paymentDetails.courseSlug,
            currency: this.config.currency,
            callback_url: this.config.callbackUrl,
            language: this.config.language,
            amount: paymentDetails.amount
        };

        $.ajax({
            url: this.config.createSessionUrl,
            method: 'POST',
            contentType: 'application/json',
            headers: { 'X-CSRF-TOKEN': this.config.csrfToken },
            data: JSON.stringify(sessionData),
            success: (response) => {
                if (response.session && response.session.id) {
                    this.startGeideaCheckout(response.session.id, paymentDetails, $btn);
                } else {
                    console.error('Invalid session response:', response);
                    alert('Failed to initiate payment. Please try again.');
                    this.setButtonProcessing($btn, false);
                }
            },
            error: (xhr) => {
                console.error('Session creation error:', xhr);
                alert('Connection error. Please check your internet or try again later.');
                this.setButtonProcessing($btn, false);
            }
        });
    }

    startGeideaCheckout(sessionId, paymentDetails, $btn) {
        try {
            if (typeof GeideaCheckout === 'undefined') {
                console.error('GeideaCheckout library not loaded');
                alert('Payment system not ready. Please refresh the page.');
                this.setButtonProcessing($btn, false);
                return;
            }

            const onSuccess = (data) => this.handleSuccess(data, paymentDetails, $btn);
            const onError = (err) => this.handleError(err, $btn);
            const onCancel = () => this.handleCancel($btn);

            const payment = new GeideaCheckout(onSuccess, onError, onCancel);
            payment.startPayment(sessionId);

        } catch (e) {
            console.error('Error starting payment:', e);
            this.setButtonProcessing($btn, false);
        }
    }

    handleSuccess(data, paymentDetails, $btn) {
        console.log('Payment Success:', data);

        const enrollUrl = this.config.enrollUrlStub
            .replace('{courseId}', paymentDetails.courseId)
            .replace('{userId}', paymentDetails.userId);

        const payload = {
            orderId: data.orderId,
            reference: data.reference,
            course_slug: paymentDetails.courseSlug,
            paymentData: data,
            payment_method: paymentDetails.paymentMethod || 'emi',
            installment_progress: paymentDetails.installmentProgress,
            installment_no: paymentDetails.installmentNo,
            amount: paymentDetails.amount
        };

        $.ajax({
            url: enrollUrl,
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': this.config.csrfToken },
            contentType: "application/json",
            data: JSON.stringify(payload),
            success: (response) => {
                if (paymentDetails.redirectUrl) {
                    window.location.href = paymentDetails.redirectUrl;
                } else {
                    window.location.reload();
                }
            },
            error: (xhr) => {
                console.error('Enrollment error:', xhr);
                alert('Payment succeeded but enrollment update failed. Please contact support.');
                this.setButtonProcessing($btn, false);
            }
        });
    }

    handleError(err, $btn) {
        console.error('Payment Error:', err);
        alert('Payment failed or declined. Please try again.');
        this.setButtonProcessing($btn, false);
    }

    handleCancel($btn) {
        console.log('Payment Cancelled');
        this.setButtonProcessing($btn, false);
    }

    setButtonProcessing($btn, isProcessing) {
        if (!$btn) return;

        // Handle both jQuery object and raw DOM element
        const btn = $btn.jquery ? $btn[0] : $btn;
        const $jqueryBtn = $btn.jquery ? $btn : $(btn);

        if (isProcessing) {
            $jqueryBtn.data('original-text', btn.innerText);
            btn.innerText = 'Processing...';
            btn.disabled = true;
        } else {
            btn.innerText = $jqueryBtn.data('original-text') || 'Pay Now';
            btn.disabled = false;
        }
    }
}
