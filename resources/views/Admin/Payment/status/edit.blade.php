@extends('layouts.Admin.master')

@section('title', 'Edit Status Pembayaran')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="page-title">Edit Status Pembayaran</h3>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('dashboard') }}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('Admin.Payment.status.index') }}">Status Pembayaran</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('Admin.Payment.status.show', $payment->id) }}">Detail</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Edit</a>
            </li>
        </ul>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Edit Status Pembayaran - {{ $payment->invoice_id }}</h4>
                        <a href="{{ route('Admin.Payment.status.show', $payment->id) }}" class="btn btn-secondary btn-sm ml-auto">
                            <i class="fa fa-arrow-left"></i> Kembali ke Detail
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('Admin.Payment.status.update', $payment->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Invoice ID:</strong></label>
                                    <p class="form-control-plaintext">{{ $payment->invoice_id }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label><strong>Customer:</strong></label>
                                    <p class="form-control-plaintext">{{ $payment->customer_name }}</p>
                                    <small class="text-muted">{{ $payment->customer_email }}</small>
                                </div>
                                
                                <div class="form-group">
                                    <label><strong>Amount:</strong></label>
                                    <p class="form-control-plaintext">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label><strong>Payment Method:</strong></label>
                                    <p class="form-control-plaintext">
                                        <span class="badge badge-info">{{ strtoupper($payment->payment_method) }}</span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status"><strong>Status Pembayaran <span class="text-danger">*</span></strong></label>
                                    <select name="status" id="status" class="form-control" required>
                                        @foreach($statusOptions as $value => $label)
                                            <option value="{{ $value }}" {{ $payment->status == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">
                                        Current status: <strong>{{ ucfirst($payment->status) }}</strong>
                                    </small>
                                </div>
                                
                                <div class="form-group">
                                    <label for="admin_notes"><strong>Catatan Admin</strong></label>
                                    <textarea name="admin_notes" id="admin_notes" class="form-control" rows="4" placeholder="Tambahkan catatan admin (opsional)...">{{ old('admin_notes', $payment->admin_notes) }}</textarea>
                                    <small class="form-text text-muted">Catatan ini akan dicatat dalam sistem.</small>
                                </div>
                                
                                <div class="form-group" id="reject-reason-group" style="{{ $payment->status == 'rejected' ? '' : 'display: none;' }}">
                                    <label for="reject_reason"><strong>Alasan Penolakan <span class="text-danger">*</span></strong></label>
                                    <textarea name="reject_reason" id="reject_reason" class="form-control" rows="3" placeholder="Masukkan alasan penolakan...">{{ old('reject_reason', $payment->reject_reason) }}</textarea>
                                    <small class="form-text text-muted">Wajib diisi jika status diubah menjadi "Rejected".</small>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-12">
                                <h5>Informasi Sistem</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>Payment Date:</strong></label>
                                            <p class="form-control-plaintext">{{ $payment->payment_date ? $payment->payment_date->format('d/m/Y H:i:s') : '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>Created:</strong></label>
                                            <p class="form-control-plaintext">{{ $payment->created_at->format('d/m/Y H:i:s') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>Last Updated:</strong></label>
                                            <p class="form-control-plaintext">{{ $payment->updated_at->format('d/m/Y H:i:s') }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($payment->approvedBy)
                                    <div class="alert alert-info">
                                        <strong>Previously approved by:</strong> {{ $payment->approvedBy->name }} 
                                        @if($payment->approved_at)
                                            on {{ $payment->approved_at->format('d/m/Y H:i:s') }}
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <a href="{{ route('Admin.Payment.status.show', $payment->id) }}" class="btn btn-secondary">
                                <i class="fa fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            @if($payment->payment_proof)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bukti Pembayaran</h4>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $payment->payment_proof) }}" 
                             alt="Bukti Pembayaran" 
                             class="img-fluid mb-3" 
                             style="max-height: 300px; border: 1px solid #ddd; border-radius: 5px;">
                        
                        <div>
                            <a href="{{ asset('storage/' . $payment->payment_proof) }}" 
                               target="_blank" 
                               class="btn btn-info btn-sm">
                                <i class="fa fa-external-link"></i> Lihat Full Size
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Show/hide reject reason field based on status
    $('#status').change(function() {
        const selectedStatus = $(this).val();
        const rejectGroup = $('#reject-reason-group');
        const rejectTextarea = $('#reject_reason');
        
        if (selectedStatus === 'rejected') {
            rejectGroup.show();
            rejectTextarea.prop('required', true);
        } else {
            rejectGroup.hide();
            rejectTextarea.prop('required', false);
        }
    });
    
    // Form validation
    $('form').submit(function(e) {
        const status = $('#status').val();
        const rejectReason = $('#reject_reason').val().trim();
        
        if (status === 'rejected' && !rejectReason) {
            e.preventDefault();
            alert('Alasan penolakan wajib diisi jika status diubah menjadi "Rejected".');
            $('#reject_reason').focus();
            return false;
        }
        
        // Confirm status change
        const currentStatus = '{{ $payment->status }}';
        if (status !== currentStatus) {
            const confirmation = confirm(`Apakah Anda yakin ingin mengubah status dari "${currentStatus}" menjadi "${status}"?`);
            if (!confirmation) {
                e.preventDefault();
                return false;
            }
        }
    });
});

console.log('🎯 Payment status edit form loaded');
</script>
@endsection