@extends('layouts.Member.master')

@section('content')
<div class="container mt-5">
    <!-- Judul Halaman -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">{{ __('messages.ticket_detail') }}</h2>
        <p class="text-muted">{{ __('messages.view_ticket_info') }}</p>
    </div>

    <!-- Tabel Detail Tiket Layanan -->
    <div class="card shadow-lg border-light rounded">
        <div class="card-body">
            <h3 class="mb-4 text-secondary">{{ __('messages.ticket_detail') }}</h3>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('messages.service_type') }}</th>
                        <th>{{ __('messages.service_description') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><i class="fas fa-cogs me-2"></i>{{ __('messages.service_type') }}:</th>
                        <td>{{ $ticket->jenis_layanan }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-info-circle me-2"></i>{{ __('messages.service_description') }}:</th>
                        <td>{{ $ticket->keterangan_layanan }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-calendar-alt me-2"></i>{{ __('messages.submission_date') }}:</th>
                        <td>{{ \Carbon\Carbon::parse($ticket->tgl_pengajuan)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-clipboard-check me-2"></i>{{ __('messages.status') }}:</th>
                        <td>
                            <span class="badge  
                                @if($ticket->status == 'open') bg-success 
                                @elseif($ticket->status == 'progress') bg-warning 
                                @else bg-secondary @endif">
                                {{ __('messages.' . $ticket->status) }} <!-- Correct translation -->
                            </span>
                        </td>
                    </tr>
                    @if ($ticket->file_pendukung_layanan)
                        <tr>
                            <th><i class="fas fa-paperclip me-2"></i>{{ __('messages.attached_document') }}:</th>
                            <td><a href="{{ asset($ticket->file_pendukung_layanan) }}" target="_blank"
                                    class="text-primary">{{ __('messages.view_document') }}</a></td>
                        </tr>
                    @endif
                    <tr>
                        <th><i class="fas fa-users me-2"></i>{{ __('messages.technical_team') }}:</th>
                        <td>
                            @if ($ticket->tim_teknis)
                                <span class="badge bg-success">{{ $ticket->tim_teknis }}</span>
                            @else
                                <span class="badge bg-secondary">{{ __('messages.not_assigned') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-clipboard-list me-2"></i>{{ __('messages.action_description') }}:</th>
                        <td>{{ $ticket->keterangan_tindakan ?? __('messages.no_action_description') }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-file-alt me-2"></i>{{ __('messages.action_document') }}:</th>
                        <td>
                            @if ($ticket->dok_pendukung_tindakan)
                                <a href="{{ asset($ticket->dok_pendukung_tindakan) }}" target="_blank"
                                    class="text-primary"><i
                                        class="fas fa-file-alt me-2"></i>{{ __('messages.view_action_document') }}</a>
                            @else
                                <span class="text-muted">{{ __('messages.no_action_document') }}</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-start gap-3 mt-4">
                <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-2"></i>{{ __('messages.back') }}
                </a>
                <a href="{{ route('tickets.edit', $ticket->id_after_sales) }}" class="btn btn-outline-warning btn-sm">
                    <i class="fas fa-edit me-2"></i>{{ __('messages.edit_ticket') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection