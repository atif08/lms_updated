@extends('layouts.master')

@section('title', __('Payment Details'))

@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Payments') }}
        @endslot
        @slot('title')
            {{ __('Payment Details') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title">General Information</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">Student :</th>
                                    <td>{{ $payment->user->name }} ({{ $payment->user->email }})</td>
                                </tr>
                                <tr>
                                    <th scope="row">Course :</th>
                                    <td>{{ $payment->course->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Amount :</th>
                                    <td>{{ $payment->amount }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Method :</th>
                                    <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status :</th>
                                    <td>
                                        <span class="badge {{ $payment->status === \Domain\Payments\Enums\PaymentStatusEnum::COMPLETED()->value ? 'bg-soft-success' : ($payment->status === \Domain\Payments\Enums\PaymentStatusEnum::REJECTED()->value ? 'bg-soft-danger' : 'bg-soft-info') }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Date :</th>
                                    <td>{{ $payment->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @if($payment->transaction_id)
                                <tr>
                                    <th scope="row">Transaction ID :</th>
                                    <td>{{ $payment->transaction_id }}</td>
                                </tr>
                                @endif
                                @if($payment->installment_no)
                                <tr>
                                    <th scope="row">Installment No :</th>
                                    <td>{{ $payment->installment_no }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @if($payment->status === \Domain\Payments\Enums\PaymentStatusEnum::PENDING()->value)
                    <div class="mt-4">
                        <form action="{{ route('payments.confirm', $payment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to confirm this payment? This will unlock the course content for the student.');">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Confirm Payment
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title">Payment Proof</h5>
                </div>
                <div class="card-body text-center">
                    @php
                        $media = $payment->getFirstMedia('payment_proofs');
                    @endphp
                    @if($media)
                        <a href="{{ $media->getUrl() }}" target="_blank">
                            <img src="{{ $media->getUrl() }}" alt="Payment Proof" class="img-fluid rounded mb-3" style="max-height: 400px;">
                        </a>
                        <br>
                        <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-external-link-alt"></i> View Full Image
                        </a>
                    @else
                        <div class="py-5 text-muted">
                            <i class="fas fa-image fa-3x mb-3"></i>
                            <p>No proof uploaded for this payment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
