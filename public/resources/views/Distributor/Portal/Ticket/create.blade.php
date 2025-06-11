@extends('layouts.Member.master')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">{{ __('messages.create_ticket') }}</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
        <li class="breadcrumb-item active text-primary">{{ __('messages.service_type') }}</li>
    </ol>
</div>

<div class="container mt-5">

    <!-- Form Card -->
    <div class="card shadow-lg border-light rounded">
        <div class="card-body">
            <form action="{{ route('distribution.tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Jenis Layanan -->
                <div class="mb-4">
                    <label for="jenis_layanan" class="form-label">{{ __('messages.service_type') }}</label>
                    <select name="jenis_layanan" id="jenis_layanan" class="form-control">
                        <option value="Permintaan Data">{{ __('messages.service_type_options.data_request') }}</option>
                        <option value="Maintanance">{{ __('messages.service_type_options.maintenance') }}</option>
                        <option value="Visit">{{ __('messages.service_type_options.visit') }}</option>
                        <option value="Installasi">{{ __('messages.service_type_options.installation') }}</option>
                    </select>
                </div>

                <!-- Keterangan Layanan -->
                <div class="mb-4">
                    <label for="keterangan_layanan" class="form-label">{{ __('messages.service_description') }}</label>
                    <textarea name="keterangan_layanan" id="keterangan_layanan" class="form-control" rows="4"
                        placeholder="{{ __('messages.service_description') }}..."></textarea>
                </div>

                <!-- Dokumen Pendukung -->
                <div class="mb-4">
                    <label for="file_pendukung_layanan" class="form-label">{{ __('messages.supporting_document') }}</label>
                    <input type="file" name="file_pendukung_layanan" id="file_pendukung_layanan" class="form-control">
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-start">
                    <a href="{{ route('distribution.tickets.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bx bx-x-circle me-2"></i>{{ __('messages.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bx bx-paper-plane me-2"></i>{{ __('messages.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<!-- Custom Styles -->
<style>
    /* Minimalistic Form Styling */
    .card-body {
        padding: 2rem;
    }

    .form-control {
        border-radius: 10px;
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #007bff;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }

    .btn-outline-secondary {
        border-radius: 10px;
        border: 1px solid #6c757d;
        color: #6c757d;
    }

    .btn-primary {
        border-radius: 10px;
        background-color: #007bff;
        border: 1px solid #007bff;
        color: white;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        color: white;
    }

    /* Adjust spacing for inputs */
    .mb-4 {
        margin-bottom: 1.5rem;
    }
</style>
