@extends('layouts.master')

@section('title', __('Record Offline Payment'))

@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Payments') }}
        @endslot
        @slot('title')
            {{ __('Record Offline Payment') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ __('Offline Payment Details') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">{{ __('Student') }} <span class="text-danger">*</span></label>
                                <select name="user_id" id="user_id" class="form-select select2" required>
                                    <option value="">{{ __('Select Student') }}</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="course_id" class="form-label">{{ __('Course') }} <span class="text-danger">*</span></label>
                                <select name="course_id" id="course_id" class="form-select select2" required>
                                    <option value="">{{ __('Select Course') }}</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">{{ __('Amount') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="amount" id="amount" class="form-control" required placeholder="0.00">
                                </div>
                                @error('amount')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="transaction_id" class="form-label">{{ __('Transaction ID') }} ({{ __('Optional') }})</label>
                                <input type="text" name="transaction_id" id="transaction_id" class="form-control" placeholder="e.g. CASH-123">
                                @error('transaction_id')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> {{ __('Record Payment') }}
                            </button>
                            <a href="{{ route('payments.index') }}" class="btn btn-light ms-2">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "{{ __('Search...') }}",
                allowClear: true
            });
        });
    </script>
@endpush
