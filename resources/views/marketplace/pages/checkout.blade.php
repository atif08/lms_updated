@extends('marketplace.layouts.front_layout')

@section('content')
<section class="section-1" style="padding-top: 150px; background-color: #f8f9fa;">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row intro">
            <div class="col-12 text-center">
                <h2 class="featured alt">Course Enrollment</h2>
                <p>Select your preferred payment method for <strong>{{ $course->name }}</strong></p>
                <h4 class="mt-2" style="color: #e52e71;">Total Fee: ${{ $course->price }}</h4>
            </div>
        </div>

        <div class="row mt-5">
            <!-- Card Payment -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 20px; transition: transform 0.3s;">
                    <div class="card-body text-center p-4">
                        <div class="mb-4">
                            <i class="fas fa-credit-card fa-3x" style="color: #ff8a00;"></i>
                        </div>
                        <h4 class="card-title">Card Payment</h4>
                        <p class="card-text">Pay securely using your credit or debit card through Geidea.</p>
                        <button id="pay-button" class="btn primary-button mt-3 w-100">Pay Now</button>
                    </div>
                </div>
            </div>

            <!-- Bank Transfer -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 20px; transition: transform 0.3s;">
                    <div class="card-body text-center p-4">
                        <div class="mb-4">
                            <i class="fas fa-university fa-3x" style="color: #e52e71;"></i>
                        </div>
                        <h4 class="card-title">Bank Transfer</h4>
                        <p class="card-text">Transfer funds directly to our bank account and upload the receipt.</p>
                        <button class="btn primary-button mt-3 w-100" data-toggle="modal" data-target="#bankTransferModal">Select Bank Transfer</button>
                    </div>
                </div>
            </div>

            <!-- EMI Plan -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 20px; transition: transform 0.3s;">
                    <div class="card-body text-center p-4">
                        <div class="mb-4">
                            <i class="fas fa-calendar-alt fa-3x" style="color: #d63031;"></i>
                        </div>
                        <h4 class="card-title">EMI Plan</h4>
                        <p class="card-text">Divide the payment into 3 monthly installments of <strong>${{ number_format($course->price / 3, 2) }}</strong>.</p>
                        <button class="btn primary-button mt-3 w-100" data-toggle="modal" data-target="#emiModal">Select EMI Plan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bank Transfer Modal -->
<div class="modal fade" id="bankTransferModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title">Bank Transfer Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('payment.bank.submit', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info" style="border-radius: 12px;">
                        <p class="mb-1"><strong>Account Name:</strong> ASTI ACADEMY DWC LLC</p>
                        <p class="mb-1"><strong>Account Number:</strong> 0333131412001</p>
                        <p class="mb-1"><strong>IBAN Number:</strong> AE620400000333131412001</p>
                        <p class="mb-1"><strong>Bank Name:</strong> RAK BANK</p>
                        <p class="mb-1"><strong>Bank Branch:</strong> Umm Hurrair Branch, Bur Dubai, Dubai, UAE</p>
                        <p class="mb-1"><strong>Account Currency:</strong> AED</p>

                        <hr class="my-2" style="border-top: 1px solid #799bea;">

                        <h6 class="font-weight-bold mt-2 mb-2">RAK BANK USD</h6>
                        <p class="mb-1"><strong>Account Name:</strong> ASTI ACADEMY DWC LLC</p>
                        <p class="mb-1"><strong>Account Number:</strong> 333131412002</p>
                        <p class="mb-1"><strong>IBAN Number:</strong> AE35040000333131412002</p>
                        <p class="mb-1"><strong>Bank Name:</strong> RAK BANK</p>
                        <p class="mb-1"><strong>Bank Branch:</strong> Umm Hurrair Branch, Bur Dubai, Dubai, UAE</p>
                        <p class="mb-1"><strong>Account Currency:</strong> USD</p>
                        <p class="mb-0"><strong>Reference:</strong> {{ auth()->user()->id }}-{{ $course->name }}</p>
                    </div>
                    <div class="form-group mt-3">
                        <label>Upload Screenshot / Receipt</label>
                        <input
                            type="file"
                            name="proof"
                            class="form-control-file"
                            accept="image/*"
                            required
                        >
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn primary-button w-100">Submit Progress</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EMI Modal -->
<div class="modal fade" id="emiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0 shadow-none">
                <h5 class="modal-title font-weight-bold">EMI Payment Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row align-items-center mb-4">
                    <div class="col-md-5">
                        <div class="bg-light p-4" style="border-radius: 15px;">
                            <h6 class="text-primary mb-3">How it works?</h6>
                            <p class="small text-muted mb-0">Your course content will be unlocked in 3 stages. Each payment unlocks a new set of modules (1/3 of the course).</p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        @php
                            $installment_amount = $course->price / 3;
                            $installments = [
                                1 => 'Pay today to start',
                                2 => 'Due in 30 days',
                                3 => 'Due in 60 days',
                            ];
                        @endphp
                        <div class="installment-list">
                            @foreach($installments as $no => $label)
                                @php
                                    $isPaid   = $installmentProgress >= $no;
                                    $isDueNow = !$isPaid && $installmentProgress === $no - 1;
                                @endphp
                                <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded
                                    @if($isPaid) border-success bg-light
                                    @elseif($isDueNow) border-primary bg-light
                                    @else shadow-none @endif">
                                    <div>
                                        <h6 class="mb-0 {{ $isPaid || $isDueNow ? '' : 'text-muted' }}">Installment {{ $no }}</h6>
                                        <span class="small text-muted">{{ $label }}</span>
                                    </div>
                                    <div class="text-right">
                                        <h6 class="mb-0 {{ $isPaid || $isDueNow ? '' : 'text-muted' }}">${{ number_format($installment_amount, 2) }}</h6>
                                        @if($isPaid)
                                            <span class="badge badge-success">Paid ✓</span>
                                        @elseif($isDueNow)
                                            <span class="badge badge-primary">Due Now</span>
                                        @else
                                            <span class="badge badge-secondary">Upcoming</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0">
                @if($installmentProgress >= 3)
                    <div class="alert alert-success w-100 text-center mb-0">All installments paid. You have full access.</div>
                @else
                    <button id="pay-emi-button" class="btn primary-button w-100 py-3" style="font-size: 1.1rem;"
                        data-installment-no="{{ $installmentProgress + 1 }}"
                        data-installment-progress="{{ $installmentProgress + 1 }}">
                        Confirm & Pay Installment {{ $installmentProgress + 1 }}
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('frontend/assets/js/geidea-smart-payment.js') }}"></script>
<script>
    $(document).ready(function() {
        console.log('Checkout scripts loaded - Refactored Version');

        const paymentHandler = new GeideaSmartPayment();

        // EMI Payment Handler
        $('#pay-emi-button').on('click', function(e) {
            e.preventDefault();
            const $btn = $(this);

            if ($btn.data('processing')) return;

            const paymentDetails = {
                amount: '{{ number_format($course->price / 3, 2, '.', '') }}',
                courseId: '{{$course->id}}',
                userId: '{{ auth()->id() }}',
                courseSlug: '{{$course->slug}}',
                installmentNo: parseInt($btn.data('installment-no')),
                installmentProgress: parseInt($btn.data('installment-progress')),
                paymentMethod: 'emi',
                redirectUrl: '/courses/enrolled'
            };

            paymentHandler.initiatePayment(paymentDetails, $btn);
        });

        // ---------------------------------------------------------
        // Full Payment (Card) Handler - Keeping existing or refactoring?
        // ---------------------------------------------------------
        // If we want to use the same handler for full payment:
        $('#pay-button').off('click').on('click', function(e) {
             e.preventDefault();
             // Full payment logic usually differs slightly (amount, progress, etc.)
             // Assuming full payment enrolls with progress=3 (complete)?
             // For now, let's keep the legacy global handler if it exists, OR better: use our new handler.

             // Check if we should use the new handler for full payment too?
             // The old code used `createAndStartPayment` global function.
             // Let's defer to the new handler to unify it.

             const $btn = $(this);
             const paymentDetails = {
                amount: '{{ number_format($course->price, 2, '.', '') }}', // Full price
                courseId: '{{$course->id}}',
                userId: '{{ auth()->id() }}',
                courseSlug: '{{$course->slug}}',
                installmentNo: null, // Full payment
                installmentProgress: 3, // Full access
                paymentMethod: 'card',
                redirectUrl: '/courses/enrolled'
            };

            paymentHandler.initiatePayment(paymentDetails, $btn);
        });
    });
</script>
@endpush
