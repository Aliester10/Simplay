@extends('layouts.Member.master')

@php
    $compro = \App\Models\CompanyParameter::first();
    $brand = \App\Models\BrandPartner::where('type', 'brand', 'nama')->get();
@endphp

@section('content')
<!-- Header Start -->
<div class="container-fluid page-header mb-5 py-5"
    style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .1)), url('{{ asset('assets/img/contact.jpg') }}') center center no-repeat; background-size: cover; height: 300px;">
    <div class="container">
        <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('messages.contact') }}</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">{{ __('messages.home') }}</a>
                </li>
                <li class="breadcrumb-item text-white active" aria-current="page">{{ __('messages.contact') }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Header End -->

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="container-fluid">
            <div class="row text-center justify-content-center">
                <h1 class="mb-4">{{ __('messages.contact_title') }}</h1>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <a href="tel:(021) 85850913" class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-phone-alt fa-2x" style="color: white;"></i>
                            </a>
                            <h5 class="text-dark">{{ __('messages.phone_title') }}</h5>
                            <p class="mb-0 text-dark" style="font-weight: bold;">{{ $compro->no_telepon }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <div class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF;"
                                onclick="confirmRedirect()">
                                <i class="fab fa-whatsapp fa-3x" style="color: white;"></i>
                            </div>
                            <h5 class="text-dark">{{ __('messages.wa_title') }}</h5>
                            <p class="mb-0 text-dark" style="font-weight: bold;">{{ $compro->no_wa }}</p>
                        </div>
                    </div>
                </div>

                <script>
                    function confirmRedirect() {
                        const phoneNumber = '{{ $compro->no_wa }}'; // Get the WhatsApp number dynamically from the PHP variable
                        const formattedPhoneNumber = phoneNumber.replace(/\D/g, ''); // Remove non-numeric characters, if any

                        const confirmMessage = 'Are you sure you want to open WhatsApp to message ' + phoneNumber + '?';

                        if (confirm(confirmMessage)) {
                            window.location.href = `https://wa.me/${formattedPhoneNumber}`;
                        }
                    }
                </script>

                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <a href="mailto:info@labtek.id"
                                class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-envelope-open fa-2x" style="color: white;"></i>
                            </a>
                            <h5 class="text-dark">{{ __('messages.email_title') }}</h5>
                            <p class="mb-0 text-dark" style="font-weight: bold;">{{ $compro->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <a href="https://www.labtek.id" target="_blank"
                                class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-globe fa-2x" style="color: white;"></i>
                            </a>
                            <h5 class="text-dark">{{ __('messages.website_title') }}</h5>
                            <p class="mb-0 text-dark" style="font-weight: bold;">{{ $compro->website }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <a href="https://maps.app.goo.gl/tyu8r4ncFS69fCmH7" target="_blank"
                                class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-map-marker-alt fa-2x" style="color: white;"></i>
                            </a>
                            <h5 class="text-dark">{{ __('messages.address_title') }}</h5>
                            <p class="mb-0 text-dark" style="font-weight: bold;">{{ $compro->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br>
        <!-- Booking Start -->

        <!-- Message Start -->
        <div class="container-fluid my-5 px-0"><br><br></div>
        <div id="message" class="container position-relative wow fadeInUp" data-wow-delay="0.1s"
            style="margin-top: -6rem;">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-light text-center p-5">
                        <h1 class="mb-4">{{ __('messages.leave_message') }}</h1>
                        <form action="{{ route('guest-messages.store') }}" method="POST" class="bg-light p-4 rounded"
                            style="text-align: left;">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <label for="first_name" class="form-label">{{ __('messages.full_name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="email" class="form-label">{{ __('messages.email') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="company" class="form-label">{{ __('messages.company') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="company" name="company" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="phone" class="form-label">{{ __('messages.phone') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" id="no_wa" name="no_wa" class="form-control" required
                                        pattern="\d{10,12}"
                                        title="Nomor WhatsApp harus terdiri dari 10 hingga 12 digit angka"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="12">
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">{{ __('messages.your_message') }} <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="3"
                                        required></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3"
                                        type="submit">{{ __('messages.send_message') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Message End -->
</div>
</div>
<!-- Contact End -->
@endsection