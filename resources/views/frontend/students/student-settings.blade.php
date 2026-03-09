<?php $page = 'students.get.settings'; ?>
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
                                    <li><a href="{{ route('students.get.settings') }}" class="active"><i
                                                class="bx bx-edit"></i>Edit Profile</a></li>
                                    <li><a href="{{ route('students.get.change-password') }}"><i class="bx bx-lock"></i>Change
                                            Password</a></li>
                                    {{--                                    <li><a href="{{ url('student-social-profile') }}"><i--}}
                                    {{--                                                class="bx bx-user-circle"></i>Social Profiles</a></li>--}}
                                    {{--                                    <li><a href="{{ url('student-linked-accounts') }}"><i class="bx bx-link"></i>Linked--}}
                                    {{--                                            Accounts</a></li>--}}
                                    {{--                                    <li><a href="{{ url('student-notifications') }}"><i--}}
                                    {{--                                                class="bx bx-bell"></i>Notifications</a></li>--}}
                                </ul>
                            </div>
                            <form method="post" action="{{route('students.post.settings')}}">
                                @csrf
                                {{--                                <div class="course-group profile-upload-group mb-0 d-flex">--}}
                                {{--                                    <div class="course-group-img profile-edit-field d-flex align-items-center">--}}
                                {{--                                        <a href="{{ url('student-profile') }}" class="profile-pic"><img--}}
                                {{--                                                src="{{ URL::asset('frontend/img/user/user16.jpg') }}" alt="Img"--}}
                                {{--                                                class="img-fluid"></a>--}}
                                {{--                                        <div class="profile-upload-head">--}}
                                {{--                                            <h4><a href="{{ url('student-profile') }}">Your avatar</a></h4>--}}
                                {{--                                            <p>PNG or JPG no bigger than 800px width and height</p>--}}
                                {{--                                            <div class="new-employee-field">--}}
                                {{--                                                <div class="d-flex align-items-center mt-2">--}}
                                {{--                                                    <div class="image-upload mb-0">--}}
                                {{--                                                        <input type="file">--}}
                                {{--                                                        <div class="image-uploads">--}}
                                {{--                                                            <i class="bx bx-cloud-upload"></i>--}}
                                {{--                                                        </div>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <div class="img-delete">--}}
                                {{--                                                        <a href="#" class="delete-icon"><i--}}
                                {{--                                                                class="bx bx-trash"></i></a>--}}
                                {{--                                                    </div>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="checkout-form settings-wrap">
                                    <div class="edit-profile-info">
                                        <h5>Personal Details</h5>
                                        <p>Edit your personal information</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-block">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="first_name"
                                                       value="{{Auth::user()->first_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" name="last_name"
                                                       value="{{Auth::user()->last_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block">
                                                <label class="form-label">User Name</label>
                                                <input type="text" class="form-control" value="{{Auth::user()->name}}"
                                                       name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block">
                                                <label class="form-label">Phone Number</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select class="form-select" name="country_code">
                                                            <option value="+92">+92</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-8">

                                                        <input type="text" class="form-control" name="mobile"
                                                               value="{{Auth::user()->mobile}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block">
                                                <label class="form-label">Education</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input placeholder="Qualification.." type="text"
                                                               class="form-control" name="qualification_name"
                                                               value="{{Auth::user()->qualification_name}}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input placeholder="Institution" type="text"
                                                               class="form-control" name="institution"
                                                               value="{{Auth::user()->institution}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block">
                                                <label class="form-label">Graduation Year</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input placeholder="Qualification.." type="text"
                                                               class="form-control" name="graduation_year"
                                                               value="{{Auth::user()->graduation_year}}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input placeholder="Major Subject.." type="text"
                                                               class="form-control" name="major"
                                                               value="{{Auth::user()->major}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="input-block">
                                                        <label class="form-label">National Document ID</label>
                                                        <input name="national_id" placeholder="National Document ID"
                                                               type="text" class="form-control"
                                                               value="{{Auth::user()->national_id}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="input-block">
                                                        <label class="form-label">Gender</label>
                                                        <select class="form-select" name="gender">
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="input-block">
                                                <label class="form-label">Bio</label>
                                                <textarea rows="4" class="form-control">Hello! I'm Ronald Richard. I'm passionate about developing innovative software solutions, analyzing classic literature. I aspire to become a software developer, work as an editor. In my free time, I enjoy coding, reading, hiking etc.</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Profile</label>
                                            <x-media-library-collection max-items="1" name="media" collection="default" :model="\Illuminate\Support\Facades\Auth::user()" />
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary" type="submit">Update Profile</button>
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
