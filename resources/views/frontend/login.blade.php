@extends('layouts.frontend')

@section('title','Login')

@push('css')

@endpush

@section('content')

<div class="main-content">
    <div class="login-main">
        <div class="login-container">
            <div class="logo-section">
                <div class="logo">
                    <div class="logo-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 11C22.5523 11 23 11.4477 23 12C23 12.5523 22.5523 13 22 13L2 13C1.44772 13 1 12.5523 1 12C1 11.4477 1.44772 11 2 11L22 11Z" fill="white"/>
                            <path d="M3 20L3 12C3 11.4477 3.44772 11 4 11C4.55228 11 5 11.4477 5 12L5 20L5.00488 20.0986C5.02757 20.3276 5.12883 20.5429 5.29297 20.707C5.48051 20.8946 5.73478 21 6 21L18 21C18.2652 21 18.5195 20.8946 18.707 20.707C18.8946 20.5195 19 20.2652 19 20V12C19 11.4477 19.4477 11 20 11C20.5523 11 21 11.4477 21 12L21 20C21 20.7957 20.6837 21.5585 20.1211 22.1211C19.5585 22.6837 18.7957 23 18 23L6 23C5.20435 23 4.44152 22.6837 3.87891 22.1211C3.38671 21.6289 3.08291 20.9835 3.01465 20.2969L3 20Z" fill="white"/>
                            <path d="M19.7578 3.03029C20.2935 2.89649 20.8358 3.22211 20.9697 3.75783C21.1035 4.29355 20.7779 4.83581 20.2422 4.96974L4.24221 8.96974C3.70649 9.10354 3.16422 8.77792 3.03029 8.2422C2.8965 7.70648 3.22211 7.16422 3.75783 7.03029L19.7578 3.03029Z" fill="white"/>
                            <path d="M11.5598 1.0903C11.9418 0.994634 12.3392 0.973946 12.7288 1.0317C13.1195 1.08968 13.4947 1.22477 13.8333 1.42819C14.1717 1.63157 14.4668 1.8996 14.7014 2.21725C14.9355 2.5344 15.1046 2.89519 15.1995 3.2778L15.6497 5.0776C15.7836 5.61339 15.4579 6.15654 14.9221 6.29049C14.3866 6.42409 13.8443 6.09831 13.7102 5.56295L13.26 3.76217L13.259 3.76022C13.2275 3.63243 13.1712 3.51164 13.093 3.40573C13.0148 3.29977 12.9159 3.20989 12.803 3.14205C12.6902 3.07435 12.565 3.02951 12.4348 3.01022C12.3046 2.99094 12.1718 2.99761 12.0442 3.02975L12.0403 3.03073L10.0999 3.5112L10.0989 3.51022C9.97359 3.54255 9.8561 3.59994 9.75223 3.67721C9.64682 3.75567 9.55784 3.85441 9.49051 3.96725C9.42328 4.07996 9.37867 4.20459 9.35965 4.33444C9.34541 4.43196 9.34502 4.53128 9.35965 4.62838L9.37918 4.72506L9.38016 4.72897L9.83036 6.53854L9.84989 6.63912C9.92192 7.14088 9.60337 7.62552 9.10086 7.75045C8.56503 7.88343 8.02314 7.55679 7.88993 7.02096L7.43973 5.21139L7.44071 5.21041C7.345 4.82968 7.32341 4.43387 7.38016 4.04537C7.43716 3.65541 7.57079 3.2803 7.77274 2.94186C7.97472 2.60342 8.24174 2.30805 8.55789 2.07272C8.87401 1.83747 9.23342 1.66711 9.61551 1.57077L9.61942 1.56881L11.5598 1.0903Z" fill="white"/>
                        </svg>
                    </div>
                    <span class="logo-text">Stone Cobblers</span>
                </div>
                <p class="company-tagline">Central</p>
            </div>
        
            <form class="login-form" id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email"
                        class="form-input" 
                        placeholder="Enter your email"
                        required
                    >
                    <div class="error-message" id="emailError"></div>
                </div>
        
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-container">
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            class="form-input" 
                            placeholder="Enter your password"
                            required
                        >
                        <button type="button" class="password-toggle" id="passwordToggle">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="passwordError"></div>
                </div>
        
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" id="rememberMe" name="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-password" id="forgotPasswordLink">Forgot password?</a>
                </div>
        
                <button type="submit" class="login-button" id="loginButton">
                    Sign In
                </button>
        
                <div class="success-message" id="successMessage">
                    Login successful! Redirecting...
                </div>
            </form>
        
            <!-- <div class="divider">
                <span>or continue with</span>
            </div> -->
        
            <!-- <div class="social-login">
                <button class="social-button" id="googleLogin">
                    <span><i class="fas fa-search"></i></span>
                    Google
                </button>
                <button class="social-button" id="microsoftLogin">
                    <span>🪟</span>
                    Microsoft
                </button>
            </div> -->
        
            <!-- <div class="footer-text">
                Don't have an account? <a href="#" id="signupLink">Sign up</a>
            </div> -->
        </div>
    </div>
</div>

<!-- Forgot Password Modal (hidden) -->
<div class="modal" id="forgotPasswordModal" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="modalTitle">Reset your password</h2>
            <button class="close-btn" onclick="closeModal()">&times;</button>
        </div>

        <div class="login-modal__content">
            <p>Enter the email address associated with your account. We'll send a link to reset your password.</p>
            <br>
            <form id="forgotForm">
                @csrf
                <div class="form-group">
                    <label for="forgot-email" class="form-label">Email</label>
                    <input type="email" name="email" id="forgot-email" class="form-input" placeholder="Enter your email" required>
                    <div class="error-message" id="forgotEmailError" style="display:none"></div>
                </div>
                <div class="form__btn-group">
                    <button type="button" class="btn secondary" data-close-modal>Cancel</button>
                    <button type="submit" class="btn theme" id="forgotSubmit">Send reset link</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

<script>
    $(function () {

        // show modal
        $('#forgotPasswordLink').on('click', function(e){
            e.preventDefault();
            $('#forgotPasswordModal').show().attr('aria-hidden','false');
            $('#forgot-msg').hide();
            $('#forgot-email').val('');
            $('#forgotEmailError').hide();
        });

        // close modal
        $(document).on('click', '[data-close-modal]', function(){
            $(this).closest('.modal').hide().attr('aria-hidden','true');
        });

        // submit forgot password
        $('#forgotForm').on('submit', function(e){
            e.preventDefault();

            var $btn = $('#forgotSubmit');
            $btn.prop('disabled', true).text('Sending...');

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('password.email') }}",
                method: "POST",
                dataType: "json",
                data: data
            }).done(function(res){
                if (res && res.status) {
                    toastr.success(res.message || 'Email sent. Check your inbox.');
                    $('#forgot-msg').text(res.message || 'Email sent.').show();
                    // optionally auto-close after a few seconds
                    setTimeout(function(){ $('#forgotPasswordModal').hide(); }, 1800);
                } else {
                    toastr.error(res && res.message ? res.message : 'Failed to send reset email.');
                    if (res && res.errors && res.errors.email) {
                        $('#forgotEmailError').text(res.errors.email[0]).show();
                    }
                }
            }).fail(function(xhr){
                if (xhr.status === 422) {
                    var json = xhr.responseJSON || {};
                    var errs = json.errors || {};
                    if (errs.email) {
                        $('#forgotEmailError').text(errs.email[0]).show();
                    } else {
                        toastr.error('Validation error.');
                    }
                } else {
                    toastr.error('Failed to send reset email.');
                }
            }).always(function(){
                $btn.prop('disabled', false).text('Send reset link');
            });
        });
    
        const loginForm = $('#loginForm');
        const emailInput = $('#email');
        const passwordInput = $('#password');
        const loginButton = $('#loginButton');

        // ✅ Password toggle
        $('#passwordToggle').on('click', function () {
            let type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
            passwordInput.attr('type', type);
            $(this).html(type === 'password' ? '<i class="fa-solid fa-eye"></i>' : '<i class="fa-solid fa-eye-slash"></i>');
        });

        // ✅ Validate email
        function validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        // ✅ Show/Hide error
        function showError(selector, message) {
            $(selector).text(message).show();
        }
        function hideError(selector) {
            $(selector).text('').hide();
        }

        // ✅ Real-time validation
        emailInput.on('input', function () {
            if ($(this).val() && !validateEmail($(this).val())) {
                showError('#emailError', 'Please enter a valid email address');
            } else {
                hideError('#emailError');
            }
        });

        passwordInput.on('input', function () {
            if ($(this).val() && $(this).val().length < 6) {
                showError('#passwordError', 'Password must be at least 6 characters');
            } else {
                hideError('#passwordError');
            }
        });

        // ✅ Submit form with AJAX
        loginForm.on('submit', function (e) {
            e.preventDefault();

            let email = emailInput.val().trim();
            let password = passwordInput.val().trim();
            let isValid = true;

            hideError('#emailError');
            hideError('#passwordError');

            if (!email) {
                showError('#emailError', 'Email is required');
                isValid = false;
            } else if (!validateEmail(email)) {
                showError('#emailError', 'Please enter a valid email address');
                isValid = false;
            }

            if (!password) {
                showError('#passwordError', 'Password is required');
                isValid = false;
            } else if (password.length < 6) {
                showError('#passwordError', 'Password must be at least 6 characters');
                isValid = false;
            }

            if (isValid) {
                loginButton.prop('disabled', true).text('Signing in...');

                $.ajax({
                    url: "{{ route('login.post') }}",
                    type: "POST",
                    dataType: "json",
                    data: loginForm.serialize(),
                    success: function (res) {
                        if(res.status) {
                            toastr.success(res.message);
                            setTimeout(() => window.location.href = res.redirect, 200);
                        } else {
                            toastr.error(res.message || "Login failed. Please try again.");
                        }
                        loginButton.prop('disabled', false).text('Sign In');
                    },
                    error: function (xhr) {
                        loginButton.prop('disabled', false).text('Sign In');
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, val) {
                                $('#' + key + 'Error').text(val[0]).show();
                            });
                        } else {
                            toastr.error("Login failed. Please try again.");
                        }
                    }
                });
            }
        });

        // ✅ Social login placeholders
        $('#googleLogin').on('click', () => alert('Google login functionality would be implemented here'));
        $('#microsoftLogin').on('click', () => alert('Microsoft login functionality would be implemented here'));
        $('#signupLink').on('click', (e) => { e.preventDefault(); alert('Sign up functionality would be implemented here'); });
        // $('.forgot-password').on('click', (e) => { e.preventDefault(); alert('Password reset functionality would be implemented here'); });

        // ✅ Redirect if already logged in (localStorage dummy check)
        if (localStorage.getItem('isLoggedIn') === 'true') {
            window.location.href = 'dashboard.html';
        }

    });

    function closeModal() {
        document.getElementById('forgotPasswordModal').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('forgotPasswordModal');
        if (event.target === modal) {
            closeModal();
        }
    }

</script>
@endpush
