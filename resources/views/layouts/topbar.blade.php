<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{route('home')}}" class="logo logo-dark">
                    <span class="logo-sm">
{{--                        <img src="{{ URL::asset('images/logo-sm.png') }}" alt="" height="60">--}}
                    </span>
                    <span class="logo-lg">
{{--                        <img src="{{ URL::asset('images/logo-dark.png') }}" alt="" height="60">--}}
                    </span>
                </a>

                <a href="{{route('home')}}" class="logo logo-light">
                    <span class="logo-sm">
{{--                        <img src="{{ URL::asset('images/logo-sm.png') }}" alt="" height="60">--}}
                    </span>
                    <span class="logo-lg">
{{--                        <img src="{{ URL::asset('images/logo-light.png') }}" alt="" height="60">--}}
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div class="dropdown d-inline-block">
{{--                @hasSection('li_a')--}}
{{--                    <button type="button" class="btn header-item waves-effect" onclick="window.location='@yield('li_a')'">--}}
{{--                        <i class="fas fa-lg fa-arrow-circle-left"></i>&nbsp;--}}
{{--                        {{ __('Back') }}--}}
{{--                    </button>--}}
{{--                @endif--}}
                <button type="button" class="btn header-item waves-effect"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <ol class="breadcrumb m-0 mt-1">
                        @hasSection('li_1')
                            <li class="breadcrumb-item">@yield('li_1')</li>
                        @endif
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </button>
            </div>
        </div>

        <div class="d-flex">
            @if(!($settings_page ?? false) && isset($current_account))
                {{-- Marketplace Switcher --}}
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon marketplace-wrapper waves-effect">
                    <span
                        class="font-size-13 me-2 fi fi-{{ strtolower( ($current_account->marketplace->code === 'UK') ? 'gb' : $current_account->marketplace->code) }}"></span>
                        <span
                            class="font-size-13 mp-name">{{ $current_account->parent->name . ' / ' . ($current_account->name ?: $current_account->seller_id) }}</span>
                    </button>
                </div>
                {{-- End of Marketplace Switcher --}}
            @endif

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ URL::asset('images/users/default.png') }}"
                         alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ucfirst($user->name)}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('profile.get.index') }}"><i
                            class="bx bx-user font-size-16 align-middle me-1"></i> <span>{{ __('Profile') }}</span></a>

                    @if($user->user_type === \Domain\Users\Enums\UserTypeEnum::TEACHER()->value && $user->referral_code)
                    <div class="dropdown-divider"></div>
                    <div class="px-3 py-2">
                        <p class="text-muted mb-1" style="font-size:11px;">YOUR REFERRAL CODE</p>
                        <div class="d-flex align-items-center gap-2">
                            <code id="teacher-ref-code" class="bg-light px-2 py-1 rounded" style="font-size:13px;letter-spacing:1px;">{{ $user->referral_code }}</code>
                            <button type="button" onclick="copyReferralLink()" class="btn btn-sm btn-outline-primary py-0 px-2" title="Copy referral link">
                                <i class="bx bx-copy"></i>
                            </button>
                        </div>
                        <p class="text-muted mt-1 mb-0" style="font-size:10px;">Share link: <span class="text-primary">/register?ref={{ $user->referral_code }}</span></p>
                    </div>
                    @endif

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">{{ __('Sign out') }}</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

@if($user->user_type === \Domain\Users\Enums\UserTypeEnum::TEACHER()->value && $user->referral_code)
<script>
function copyReferralLink() {
    var code = document.getElementById('teacher-ref-code').innerText.trim();
    var url = window.location.origin + '/register?ref=' + code;
    navigator.clipboard.writeText(url).then(function() {
        var btn = event.currentTarget;
        var icon = btn.querySelector('i');
        icon.classList.remove('bx-copy');
        icon.classList.add('bx-check');
        setTimeout(function() {
            icon.classList.remove('bx-check');
            icon.classList.add('bx-copy');
        }, 2000);
    });
}
</script>
@endif
