@extends('layouts.Member.master2')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row border rounded-5 p-0 bg-white shadow box-area overflow-hidden">
        <!-- Left Column -->
        <div class="col-md-6 left-box p-0 d-flex flex-column">
            <div class="gradient-bg d-flex flex-column h-100">
                <!-- Logo at top with more spacing -->
                <div class="logo-container text-center mb-3">
                    <img src="{{ asset('assets/img/Logo.png') }}" class="img-fluid logo-image" alt="Simplify">
                </div>
                
                <!-- Main content with handshake as background -->
                <div class="partnership-content position-relative d-flex flex-column justify-content-center align-items-center flex-grow-1">
                    <!-- Handshake background image positioned higher -->
                    <div class="handshake-container">
                        <img src="{{ asset('assets/icons/login/hand.svg') }}" class="handshake-img" alt="Partnership">
                    </div>
                    
                    <!-- Text positioned at bottom of handshake -->
                    <div class="partnership-text-overlay text-white text-center px-4">
                        <h2 class="partnership-title text-white mb-3">Partnership for<br>Business Growth</h2>
                        <p class="partnership-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Column -->
        <div class="col-md-6 right-box">
            <!-- Back button -->
            <div class="back-button mt-4 ms-4">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 19L8 12L15 5" stroke="#FF5722" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="ms-2 return-text">Return Home</span>
                </a>
            </div>

            <div class="login-container d-flex flex-column justify-content-center h-75 px-5">
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Login header -->
                <div class="header-text text-center mb-5">
                    <h2 class="welcome-text mb-2">WELCOME BACK EXCLUSIVE MEMBER</h2>
                    <p class="login-subtitle">LOG IN TO CONTINUE</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email input -->
                    <div class="mb-4">
                        <div class="input-group">
                            <div class="position-relative w-100">
                                <span class="input-icon">
                                    <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 0H2C0.9 0 0.00999999 0.9 0.00999999 2L0 14C0 15.1 0.9 16 2 16H18C19.1 16 20 15.1 20 14V2C20 0.9 19.1 0 18 0ZM18 4L10 9L2 4V2L10 7L18 2V4Z" fill="#999999"/>
                                    </svg>
                                </span>
                                <input id="email" type="email" 
                                    class="form-control custom-input @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="example@email.com">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Password input -->
                    <div class="mb-4">
                        <div class="input-group">
                            <div class="position-relative w-100">
                                <span class="input-icon">
                                    <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 15C9.1 15 10 14.1 10 13C10 11.9 9.1 11 8 11C6.9 11 6 11.9 6 13C6 14.1 6.9 15 8 15ZM14 7H13V5C13 2.24 10.76 0 8 0C5.24 0 3 2.24 3 5V7H2C0.9 7 0 7.9 0 9V19C0 20.1 0.9 21 2 21H14C15.1 21 16 20.1 16 19V9C16 7.9 15.1 7 14 7ZM5 5C5 3.34 6.34 2 8 2C9.66 2 11 3.34 11 5V7H5V5ZM14 19H2V9H14V19Z" fill="#999999"/>
                                    </svg>
                                </span>
                                <input id="password" type="password" 
                                    class="form-control custom-input @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password"
                                    placeholder="••••••••">
                                <span class="password-toggle" onclick="togglePassword()">
                                    SHOW
                                </span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Remember me checkbox (hidden but functional) -->
                    <div class="d-none">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    </div>

                    <!-- Login button -->
                    <div class="mb-4">
                        <button type="submit" class="btn proceed-btn w-100">
                            <span>Proceed to my Account</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM10 18C5.58 18 2 14.42 2 10C2 5.58 5.58 2 10 2C14.42 2 18 5.58 18 10C18 14.42 14.42 18 10 18ZM8.8 5.9L13 10L8.8 14.1L7.4 12.7L10.2 10L7.4 7.3L8.8 5.9Z" fill="white"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Password recovery link -->
                    <div class="text-center mb-5">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="password-help">
                                Having issues with your Password?
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f5f7f9;
    }

    .box-area {
        width: 950px;
        max-width: 100%;
        height: 650px;
        border-radius: 8px !important;
        overflow: hidden;
        border: none !important;
    }

    /* Left column styling */
    .left-box {
        padding: 0;
        overflow: hidden;
    }

    .gradient-bg {
        background: linear-gradient(180deg, #FFFFFF 0%, #235585 42%, #0E263C 81%);
        height: 100%;
        position: relative;
    }

    .logo-container {
        margin-top: 50px; /* Added 50px more to move logo down */
    }

    .logo-image {
        width: 180px;
        height: auto;
    }

    /* Handshake container styling */
    .partnership-content {
        overflow: hidden;
    }

    .handshake-container {
        position: absolute;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        top: -130px; /* Move handshake image higher */
    }

    .handshake-img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    /* Text overlay styling */
    .partnership-text-overlay {
        position: absolute;
        z-index: 10;
        bottom: 50px; /* Position text at bottom */
        width: 100%;
        text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .partnership-title {
        font-size: 28px;
        font-weight: 700;
    }

    .partnership-desc {
        font-size: 14px;
        opacity: 0.9;
        max-width: 300px;
        margin: 0 auto;
    }

    /* Right column styling */
    .right-box {
        padding: 0;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .back-button a {
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .return-text {
        color: #FF5722;
    }

    .welcome-text {
        font-size: 20px;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #1e293b;
    }

    .login-subtitle {
        font-size: 14px;
        color: #666;
        letter-spacing: 1px;
    }

    .custom-input {
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        padding: 12px 16px 12px 45px;
        height: 50px;
        font-size: 16px;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        z-index: 3;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #333;
        font-size: 12px;
        font-weight: 600;
    }

    .proceed-btn {
        background-color: #1e293b;
        color: white;
        border-radius: 4px;
        padding: 12px;
        height: 50px;
        font-size: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s;
    }

    .proceed-btn:hover {
        background-color: #334155;
    }

    .password-help {
        color: #666;
        font-size: 14px;
        text-decoration: none;
    }

    .footer-content {
        margin-top: auto;
        color: #999;
        font-size: 12px;
    }

    /* Responsive design */
    @media only screen and (max-width: 768px) {
        .box-area {
            flex-direction: column;
            height: auto;
        }

        .left-box {
            height: 300px;
        }

        .partnership-title {
            font-size: 24px;
        }
    }
</style>

<script>
    function togglePassword() {
        var passwordField = document.getElementById('password');
        var passwordToggle = document.querySelector('.password-toggle');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordToggle.textContent = 'HIDE';
        } else {
            passwordField.type = 'password';
            passwordToggle.textContent = 'SHOW';
        }
    }
</script>
@endsection