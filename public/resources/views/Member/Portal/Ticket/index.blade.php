@extends('layouts.Member.master')  

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">{{ __('messages.ticket_list') }}</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active text-primary">{{ __('messages.ticket_list') }}</li>
    </ol>
</div>

<!-- Content Start -->
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('tickets.create') }}" class="btn btn-primary custom-rounded">
            <i class="fas fa-plus-circle me-2"></i>{{ __('messages.create_ticket') }}
        </a>
    </div>

    <div class="card shadow-lg border-light rounded">
        <div class="card-body">
            <h3 class="mb-4 text-secondary">{{ __('messages.ticket_list') }}</h3>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>{{ __('messages.service_type') }}</th>
                        <th>{{ __('messages.service_description') }}</th>
                        <th>{{ __('messages.submission_date') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.action_date') }}</th>
                        <th>{{ __('messages.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $key => $ticket)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $ticket->jenis_layanan }}</td>
                            <td>{{ Str::limit($ticket->keterangan_layanan, 30) }}</td>
                            <td>{{ \Carbon\Carbon::parse($ticket->tgl_pengajuan)->format('d M Y') }}</td>
                            <td>
                            <span class="badge  
                                @if($ticket->status == 'open') bg-success 
                                @elseif($ticket->status == 'progress') bg-warning 
                                @else bg-secondary @endif">
                                {{ __( 'messages.' . $ticket->status ) }} <!-- Correct translation -->
                            </span>
                            </td>
                            <td>
                                @if($ticket->status == 'open')
                                    <span class="text-muted">{{ __('messages.not_processed') }}</span>
                                @elseif($ticket->status == 'progress' && $ticket->tgl_mulai_tindakan)
                                    {{ __('messages.start_date') }}: {{ \Carbon\Carbon::parse($ticket->tgl_mulai_tindakan)->format('d M Y') }}
                                @elseif($ticket->status == 'close' && $ticket->tgl_mulai_tindakan && $ticket->tgl_selesai_tindakan)
                                    {{ __('messages.start_date') }}: {{ \Carbon\Carbon::parse($ticket->tgl_mulai_tindakan)->format('d M Y') }}<br>
                                    {{ __('messages.end_date') }}: {{ \Carbon\Carbon::parse($ticket->tgl_selesai_tindakan)->format('d M Y') }}
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('tickets.show', $ticket->id_after_sales) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> {{ __('messages.view') }}
                                </a>

                                @if($ticket->status == 'open')
                                    <a href="{{ route('tickets.edit', $ticket->id_after_sales) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                    </a>

                                    <form action="{{ route('tickets.cancel', $ticket->id_after_sales) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-times-circle"></i> {{ __('messages.cancel') }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">{{ __('messages.no_tickets') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Content End -->

@endsection

<style>
    /* Custom style for rounded button */
    .btn-primary.custom-rounded {
        border-radius: 10px; /* Subtle rounded corners */
    }
</style>
