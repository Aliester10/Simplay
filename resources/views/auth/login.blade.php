@extends('layouts.Member.master2')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row border rounded-5 p-3 bg-white shadow box-area">
        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
            style="background: #5bc0de;">
            <!-- bantu buatkan part ini -->
            <div class="inner-box rounded-4 p-4"
                style="background: #ffffff; width: 70%; margin: 40px 0; cursor: pointer;"
                onclick="window.location.href='{{ route('home') }}'">
                <div class="featured-image mb-3 d-flex justify-content-center">
                    <img src="{{ asset('assets/img/Logo.png') }}" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-dark text-wrap text-center">Email anda telah terverifikasi.</p>
                <p class="text-dark text-wrap text-center">Temukan teknologi terbaru bersama kami.</p>
                
            </div>
            <!-- hingga part ini -->
        </div>
        <div class="col-md-6 right-box">
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2 class="text-primary font-weight-bold">Selamat Datang Kembali!</h2>
                        <p>Kami senang Anda kembali.</p>
                    </div>

                    <div class="input-group mb-3">
                        <input id="email" type="email"
                            class="form-control form-control-lg bg-light @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Alamat Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="password" type="password"
                            class="form-control form-control-lg bg-light @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Kata Sandi">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-5 d-flex justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="formCheck" {{ old('remember') ? 'checked' : '' }}>
                            <label for="formCheck" class="form-check-label text-secondary"><small>Simpan Akun
                                    Saya</small></label>
                        </div>
                        <div class="forgot">
                            @if (Route::has('password.request'))
                                <small><a href="{{ route('password.request') }}" style="color: #5bc0de;">Lupa Password
                                        Anda?</a></small>
                            @endif
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-lg text-white w-100 fs-6"
                            style="background: #5bc0de;">Masuk</button>
                    </div>

                    <!-- Add registration link here -->
                    <div class="text-center mt-3">
                        <p>Belum punya akun? <a href="{{ route('distributors.register') }}"
                                style="color: #5bc0de;">Daftar sebagai distributor</a></p>
                    </div>
                    <!-- End of registration link -->

                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f5f7f9;
    }

    .box-area {
        width: 930px;
    }

    .right-box {
        padding: 40px 30px 40px 40px;
    }

    ::placeholder {
        font-size: 16px;
        color: #9e9e9e;
    }

    .rounded-4 {
        border-radius: 20px;
    }

    .rounded-5 {
        border-radius: 30px;
    }

    .small-text {
        font-size: 1.25rem;
    }

    @media only screen and (max-width: 768px) {
        .box-area {
            margin: 0 10px;
        }

        .left-box {
            height: auto;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .right-box {
            padding: 20px;
        }

        .inner-box {
            width: auto;
            padding: 20px;
            text-align: center;
        }

        .left-box .inner-box p {
            display: none;
        }

        .left-box .featured-image img {
            width: 150px;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-danger {
        animation: fadeIn 0.5s ease-in-out;
    }

    .font-weight-bold {
        font-weight: 700;
    }
</style>
@endsection