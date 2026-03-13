import { useState } from 'react';
import axios from 'axios';

const GEIDEA_SDK_URL = 'https://payments.geidea.ae/hpp/geideaCheckout.min.js';

function loadGeideaSdk() {
    return new Promise((resolve, reject) => {
        if (window.GeideaCheckout) {
            resolve();
            return;
        }
        const existing = document.querySelector(`script[src="${GEIDEA_SDK_URL}"]`);
        if (existing) {
            existing.addEventListener('load', resolve);
            existing.addEventListener('error', reject);
            return;
        }
        const script = document.createElement('script');
        script.src = GEIDEA_SDK_URL;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
}

export default function InstallmentPaymentModal({ course, installmentNo, installmentProgress, userId, onSuccess, onClose }) {
    const [processing, setProcessing] = useState(false);
    const amount = (course.price / 3).toFixed(2);

    const handlePay = async () => {
        setProcessing(true);

        try {
            await loadGeideaSdk();

            const { data } = await axios.post('/create-session', {
                slug: course.slug,
                currency: 'USD',
                callback_url: window.location.origin + '/payment/callback',
                language: 'en',
                amount,
            });

            if (!data.session?.id) {
                alert('Failed to initiate payment. Please try again.');
                setProcessing(false);
                return;
            }

            const checkout = new window.GeideaCheckout(
                async (paymentData) => {
                    try {
                        await axios.post(`/courses/${course.id}/users/${userId}/enroll`, {
                            orderId: paymentData.orderId,
                            amount,
                            payment_method: 'emi',
                            installment_no: installmentNo,
                            installment_progress: installmentProgress,
                        });
                        onSuccess(installmentProgress);
                    } catch {
                        alert('Payment succeeded but enrollment failed. Please contact support.');
                    }
                    setProcessing(false);
                },
                (error) => {
                    console.error('Payment error:', error);
                    alert('Payment failed. Please try again.');
                    setProcessing(false);
                },
                () => {
                    setProcessing(false);
                }
            );

            checkout.startPayment(data.session.id);
        } catch {
            alert('Connection error. Please try again.');
            setProcessing(false);
        }
    };

    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
            <div className="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6">
                <div className="flex items-center justify-between mb-5">
                    <h3 className="text-base font-semibold text-gray-800">
                        Pay Installment {installmentNo}
                    </h3>
                    <button
                        onClick={onClose}
                        className="text-gray-400 hover:text-gray-600 text-2xl leading-none"
                    >
                        &times;
                    </button>
                </div>

                <div className="bg-indigo-50 rounded-xl p-4 mb-5 text-center">
                    <p className="text-xs text-gray-500 mb-1">Amount Due</p>
                    <p className="text-3xl font-bold text-indigo-700">${amount}</p>
                    <p className="text-xs text-gray-400 mt-1">Installment {installmentNo} of 3</p>
                </div>

                <p className="text-xs text-gray-500 mb-5 text-center">
                    Paying this installment will unlock the next section of your course content.
                </p>

                <button
                    onClick={handlePay}
                    disabled={processing}
                    className="w-full bg-indigo-600 text-white rounded-xl py-3 text-sm font-semibold hover:bg-indigo-700 disabled:opacity-50 transition-colors"
                >
                    {processing ? 'Processing...' : `Pay $${amount} Now`}
                </button>
            </div>
        </div>
    );
}
