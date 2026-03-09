<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>BTC Study Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,600;1,600&display=swap"
        rel="stylesheet"
    />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        rel="stylesheet"
    />
    <link rel="icon" href="{{URL::asset('frontend/img/login/buc-favicon.ico')}}" type="image/x-icon"/>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <style>
        body {
            background-color: #1d1d56;
            /* background-image: url("frontend/img/login/buc-login-bg.png");
            background-size: cover;
            background-position: center; */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
        }

        .login-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 2rem;
            width: 400px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .login-card img {
            max-width: 150px;
            display: block;
            margin: 0 auto 20px;
        }

        .login-card h2 {
            color: #1d1d56;
            text-align: center;
            margin-bottom: 1rem;
        }

        .btn-primary {
            border-radius: 20px;
        }

        .btn-primary {
            background-color: #1d1d56;
            border-color: #1d1d56;
        }

        .btn-primary:hover {
            background-color: #0e0e2c;
            border-color: #0e0e2c;
        }

        .form-check-label a {
            color: #1d1d56;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        .text-center a {
            color: #1d1d56;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .input-group .form-control:focus {
            box-shadow: none;
            outline: none;
            border-color: #d3d3d3;
        }

        .form-select {
            box-shadow: none;
            outline: none;
            border: 1px solid #ced4da;
        }

        .form-select:focus {
            box-shadow: none;
            outline: none;
            border-color: #d3d3d3;
        }

        .form-check-input:focus {
            box-shadow: none;
            outline: none;
            border-color: #1d1d56;
        }

        .form-check-input:checked {
            background-color: #1d1d56;
            border-color: #1d1d56;
        }

        .alert-container {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 400px;
            z-index: 1;
        }

        .alert {
            border-radius: 10px;
        }

        .btn-close:focus {
            box-shadow: none;
            outline: none;
        }

        .animate__animated.animate__fadeInDown {
            --animate-duration: 2s;
        }

        .custom-display {
            display: none;
        }

        .input-group .eye-icon {
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1000 !important;
        cursor: pointer;
        color: #000000;
      }

        @media (max-width: 600px) {
            .body {
                align-items: start;
            }

            .login-card {
                width: auto;
            }

            .alert-container {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="alert-container animate__animated animate__fadeInDown">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>ALERT:</strong>Important Login Information<br /><br />
        Attention users,<br/>
        When logging into the BTC Portal, please double-check your login ID and password for accuracy.
        If you've forgotten your password, simply click "Forgot Password?" for help.
        <br /><br />
        Thank you!
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
    </div>
</div>
<div class="login-card">
    <img src="{{URL::asset('frontend/img/login/logo.jpeg')}}" alt="Logo"/>
    <x-auth-session-status class="mb-4" :status="session('status')"/>
    <form id="loginForm" method="post" action="{{ route('post.login') }}">
        @csrf
        <div class="mb-3">
            <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
            </div>
            <div class="text-danger pt-2">
                @error('0')
                {{ $message }}
                @enderror
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <div class="input-group position-relative">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control rounded-end pe-5 pass-input"
                       name="password"
                       id="password" placeholder="Password">
                <span
                class="position-absolute end-0 top-50 translate-middle-y pe-2 eye-icon"
                onclick="togglePasswordVisibility()"
                >
                       <i id="eye-icon" class="fas fa-eye"></i>
                     </span>
            </div>
            <div class="text-danger pt-2">
                @error('0')
                {{ $message }}
                @enderror
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        {{--        <div class="mb-3">--}}
        {{--            <label for="role" class="form-label"--}}
        {{--            >Select Role <span class="text-danger">*</span></label--}}
        {{--            >--}}
        {{--            <select class="form-select" id="role" required>--}}
        {{--                <option value selected>Select your role</option>--}}
        {{--                <option value="student">Student</option>--}}
        {{--                <option value="teacher">Staff</option>--}}
        {{--            </select>--}}
        {{--        </div>--}}
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="auth-remember-check"
                   name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <div class="d-flex justify-content-between mb-4">
                <a href="#" class="text-muted" id="forgotPasswordLink">Forgot Your Password?</a>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block w-100">
            Login
        </button>
    </form>
    <!-- Password Reset Form (Initially Hidden) -->
    <form method="POST" id="resetForm" class="custom-display" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <x-auth-session-status class="mb-4" :status="session('status')" />
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block w-100">Send Password Reset Link</button>
    </form>
</div>
<script>
    // reset password input show function
    document.getElementById('forgotPasswordLink').addEventListener('click', function (event) {
        event.preventDefault();

        // Hide the login form and show the reset form
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('resetForm').style.display = 'block';
    });
     // toggle visibility of password
     function togglePasswordVisibility() {
        const passwordField = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        if (passwordField.type === "password") {
          passwordField.type = "text";
          eyeIcon.classList.remove("fa-eye");
          eyeIcon.classList.add("fa-eye-slash");
        } else {
          passwordField.type = "password";
          eyeIcon.classList.remove("fa-eye-slash");
          eyeIcon.classList.add("fa-eye");
        }
      }


    // temporary animation
    const duration = 3 * 1000,
  animationEnd = Date.now() + duration,
  defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

function randomInRange(min, max) {
  return Math.random() * (max - min) + min;
}

      document.getElementById('forgotPasswordLink').addEventListener('click', function(event) {
        event.preventDefault();

        // Hide the login form and show the reset form
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('resetForm').style.display = 'block';
      });
</script>
<script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
