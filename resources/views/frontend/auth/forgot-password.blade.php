<?php $page = 'forgot-password'; ?>
@extends('frontend.layouts.mainlayout')
@section('content')
    <div class="row">
        @component('components.frontend.loginbanner')
        @endcomponent
        <div class="col-md-6 login-wrap-bg">
            <!-- Login -->
            <div class="login-wrapper">

                <div class="loginbox">
                    <div class="img-logo">
                        <img src="{{ URL::asset('/frontend/img/logo.svg') }}" class="img-fluid" alt="Logo">
                        <div class="back-home">
                            <a href="{{ url('/') }}">Back to Home</a>
                        </div>
                    </div>
                    <h1>Forgot Password ?</h1>
                    <div class="reset-password">
                        <p>Enter your email to reset your password.</p>
                    </div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="input-block">
                            <label class="form-control-label">Email</label>
                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-start" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Login -->

        </div>
    </div>
@endsection
