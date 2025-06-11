@extends('layouts.Member.master')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">{{ __('messages.edit_ticket') }}</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
        <li class="breadcrumb-item active text-primary">{{ __('messages.update_ticket_info') }}</li>
    </ol>
</div>

<div class="container mt-5">

    <!-- Formulir Edit Tiket Layanan -->
    <div class="card shadow-lg border-light rounded">
        
        <div class="card-body">
        <h3 class="fw-bold text-secondary">{{ __('messages.update_ticket_info') }}</h3> <br>
            <form action="{{ route('distribution.tickets.update', $ticket->id_after_sales) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Textbox Container -->
                <div class="border p-3 rounded">
                    <!-- Jenis Layanan -->
                    <div class="form-group mb-3">
                        <label for="jenis_layanan" class="form-label"><i class="fas fa-cogs me-2"></i>{{ __('messages.service_type') }}</label>
                        <select name="jenis_layanan" id="jenis_layanan" class="form-control">
                            <option value="Permintaan Data" {{ $ticket->jenis_layanan == 'Permintaan Data' ? 'selected' : '' }}>{{ __('messages.service_type_options.data_request') }}</option>
                            <option value="Maintanance" {{ $ticket->jenis_layanan == 'Maintanance' ? 'selected' : '' }}>{{ __('messages.service_type_options.maintenance') }}</option>
                            <option value="Visit" {{ $ticket->jenis_layanan == 'Visit' ? 'selected' : '' }}>{{ __('messages.service_type_options.visit') }}</option>
                            <option value="Installasi" {{ $ticket->jenis_layanan == 'Installasi' ? 'selected' : '' }}>{{ __('messages.service_type_options.installation') }}</option>
                        </select>
                    </div>

                    <!-- Keterangan Pengajuan -->
                    <div class="form-group mb-3">
                        <label for="keterangan_layanan" class="form-label"><i class="fas fa-info-circle me-2"></i>{{ __('messages.service_description') }}</label>
                        <textarea name="keterangan_layanan" id="keterangan_layanan" class="form-control" rows="4" placeholder="{{ __('messages.service_description') }}...">{{ $ticket->keterangan_layanan }}</textarea>
                    </div>

                    <!-- Dokumen Pendukung -->
                    <div class="form-group mb-4">
                        <label for="file_pendukung_layanan" class="form-label"><i class="fas fa-paperclip me-2"></i>{{ __('messages.supporting_document') }}</label>
                        <input type="file" name="file_pendukung_layanan" id="file_pendukung_layanan" class="form-control">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-start gap-3 mt-4">
                    <a href="{{ route('distribution.tickets.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-2"></i>{{ __('messages.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-save me-2"></i>{{ __('messages.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
