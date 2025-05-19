@extends('layouts.Member.master')

@section('content')
    <div class="container mt-5">
        <!-- Page Title -->
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">{{ __('messages.title_edit') }}</h2>
            <p class="text-muted">{{ __('messages.description_edit') }}</p>
        </div>

        <!-- Edit Service Ticket Form -->
        <div class="card shadow-lg border-light rounded">
            <div class="card-body">
                <h3 class="fw-bold text-secondary">{{ __('messages.form_title') }}</h3> <br>
                <form action="{{ route('tickets.update', $ticket->id_after_sales) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Textbox Container -->
                    <div class="border p-3 rounded">
                        <!-- Service Type -->
                        <div class="form-group mb-3">
                            <label for="jenis_layanan" class="form-label"><i class="fas fa-cogs me-2"></i>{{ __('messages.service_type') }}</label>
                            <select name="jenis_layanan" id="jenis_layanan" class="form-control">
                                <option value="Permintaan Data" {{ $ticket->jenis_layanan == 'Permintaan Data' ? 'selected' : '' }}>{{ __('messages.service_type') }} 1</option>
                                <option value="Maintanance" {{ $ticket->jenis_layanan == 'Maintanance' ? 'selected' : '' }}>{{ __('messages.service_type') }} 2</option>
                                <option value="Visit" {{ $ticket->jenis_layanan == 'Visit' ? 'selected' : '' }}>{{ __('messages.service_type') }} 3</option>
                                <option value="Installasi" {{ $ticket->jenis_layanan == 'Installasi' ? 'selected' : '' }}>{{ __('messages.service_type') }} 4</option>
                            </select>
                        </div>

                        <!-- Service Description -->
                        <div class="form-group mb-3">
                            <label for="keterangan_layanan" class="form-label"><i class="fas fa-info-circle me-2"></i>{{ __('messages.service_description') }}</label>
                            <textarea name="keterangan_layanan" id="keterangan_layanan" class="form-control" rows="4" placeholder="{{ __('messages.service_description') }}...">{{ $ticket->keterangan_layanan }}</textarea>
                        </div>

                        <!-- Supporting Documents -->
                        <div class="form-group mb-4">
                            <label for="file_pendukung_layanan" class="form-label"><i class="fas fa-paperclip me-2"></i>{{ __('messages.supporting_documents') }}</label>
                            <input type="file" name="file_pendukung_layanan" id="file_pendukung_layanan" class="form-control">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-start gap-3 mt-4">
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary btn-sm">
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
