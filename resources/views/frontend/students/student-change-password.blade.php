<?php $page = 'student-change-password'; ?>
@extends('frontend.layouts.mainlayout')
@section('content')
    @component('components.frontend.breadcrumb')
        @slot('title')
            Settings
        @endslot
        @slot('item1')
            Home
        @endslot
        @slot('item2')
            Edit Profile
        @endslot
    @endcomponent
<!-- Page Content -->
<div class="page-content">
    <div class="container">
        <div class="row">

           @component('components.frontend.sidebar')

           @endcomponent
            <!-- Student Settings -->
            <div class="col-xl-9 col-lg-9">

                <div class="settings-widget card-details">
                    <div class="settings-menu p-0">
                        <div class="profile-heading">
                            @component('components.admin.alert')
                            @endcomponent
                            <h3>Settings</h3>
                            <p>You have full control to manage your own account settings</p>
                        </div>
                        <div class="settings-page-head">
                            <ul class="settings-pg-links">
                                <li><a href="{{ route('students.get.settings') }}"><i class="bx bx-edit"></i>Edit Profile</a></li>
                                <li><a href="{{route('students.get.change-password')}}" class="active"><i class="bx bx-lock"></i>Change Password</a></li>
                            </ul>
                        </div>
                        <form method="post" action="{{route('students.post.change-password')}}">
                            @csrf
                            <div class="checkout-form settings-wrap">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-block">
                                            <label class="form-label">Current Password</label>
                                            <input name="current_password" type="password" class="form-control">
                                            @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="input-block">
                                            <label class="form-label">New Password</label>
                                            <input name="password" type="password" class="form-control">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="input-block">
                                            <label class="form-label">Re-type New Password</label>
                                            <input name="password_confirmation" type="password" class="form-control">
                                            @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" type="submit">Reset Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Student Settings -->

        </div>
    </div>
</div>
<!-- /Page Content -->





    @endsection
