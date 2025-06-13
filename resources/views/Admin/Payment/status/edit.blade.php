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
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <h6><i class="fa fa-exclamation-triangle"></i> Validation Errors:</h6>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
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
                    <form method="POST" action="{{ route('Admin.Payment.status.update', $payment->id) }}" id="editPaymentForm">
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
                                    <p class="form-control-plaintext text-primary font-weight-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label><strong>Payment Method:</strong></label>
                                    <p class="form-control-plaintext">
                                        <span class="badge badge-info">{{ strtoupper($payment->payment_method) }}</span>
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label><strong>Current Status:</strong></label>
                                    <p class="form-control-plaintext">
                                        @php
                                            $currentStatusConfig = [
                                                'pending' => ['class' => 'badge-warning', 'icon' => 'fa-clock', 'text' => 'Pending Review'],
                                                'approved' => ['class' => 'badge-success', 'icon' => 'fa-check', 'text' => 'Approved'],
                                                'rejected' => ['class' => 'badge-danger', 'icon' => 'fa-times', 'text' => 'Rejected']
                                            ];
                                            $currentConfig = $currentStatusConfig[$payment->status] ?? ['class' => 'badge-secondary', 'icon' => 'fa-question', 'text' => ucfirst($payment->status)];
                                        @endphp
                                        <span class="badge {{ $currentConfig['class'] }}">
                                            <i class="fa {{ $currentConfig['icon'] }}"></i> {{ $currentConfig['text'] }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                {{-- 🔥 SIMPLIFIED: 3 STATUS OPTIONS ONLY --}}
                                <div class="form-group">
                                    <label for="status"><strong>New Status <span class="text-danger">*</span></strong></label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>
                                            📋 Pending Review
                                        </option>
                                        <option value="approved" {{ $payment->status == 'approved' ? 'selected' : '' }}>
                                            ✅ Approved
                                        </option>
                                        <option value="rejected" {{ $payment->status == 'rejected' ? 'selected' : '' }}>
                                            ❌ Rejected
                                        </option>
                                    </select>
                                    <small class="form-text text-muted">
                                        <i class="fa fa-info-circle"></i> Select the new status for this payment
                                    </small>
                                </div>
                                
                                <div class="form-group">
                                    <label for="admin_notes"><strong>Admin Notes</strong></label>
                                    <textarea name="admin_notes" id="admin_notes" class="form-control" rows="4" placeholder="Add admin notes (optional)...">{{ old('admin_notes', $payment->admin_notes) }}</textarea>
                                    <small class="form-text text-muted">
                                        <i class="fa fa-comment"></i> Internal notes for admin reference
                                    </small>
                                </div>
                                
                                {{-- 🔥 REJECTION REASON FIELD - SHOWS/HIDES BASED ON STATUS --}}
                                <div class="form-group" id="reject-reason-group" style="{{ $payment->status == 'rejected' ? '' : 'display: none;' }}">
                                    <label for="reject_reason"><strong>Rejection Reason <span class="text-danger">*</span></strong></label>
                                    <textarea name="reject_reason" id="reject_reason" class="form-control" rows="3" placeholder="Enter rejection reason...">{{ old('reject_reason', $payment->reject_reason) }}</textarea>
                                    <small class="form-text text-muted">
                                        <i class="fa fa-exclamation-triangle"></i> Required when status is "Rejected" - this will be shown to the customer
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        {{-- SYSTEM INFORMATION --}}
                        <div class="row">
                            <div class="col-12">
                                <h5><i class="fa fa-info-circle"></i> System Information</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong>Created:</strong></label>
                                            <p class="form-control-plaintext">{{ $payment->created_at->format('d/m/Y H:i:s') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong>Last Updated:</strong></label>
                                            <p class="form-control-plaintext">{{ $payment->updated_at->format('d/m/Y H:i:s') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong>Payment Date:</strong></label>
                                            <p class="form-control-plaintext">{{ $payment->payment_date ? $payment->payment_date->format('d/m/Y H:i:s') : '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong>Has Proof:</strong></label>
                                            <p class="form-control-plaintext">
                                                @if($payment->payment_proof)
                                                    <span class="badge badge-success"><i class="fa fa-check"></i> Yes</span>
                                                @else
                                                    <span class="badge badge-warning"><i class="fa fa-times"></i> No</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- APPROVAL HISTORY --}}
                                @if($payment->approved_at)
                                    <div class="alert alert-success">
                                        <i class="fa fa-check-circle"></i> <strong>Approval History:</strong><br>
                                        Approved by: <strong>{{ $payment->approvedBy->name ?? 'Unknown' }}</strong><br>
                                        Date: {{ $payment->approved_at->format('d/m/Y H:i:s') }} ({{ $payment->approved_at->diffForHumans() }})
                                    </div>
                                @endif

                                @if($payment->rejected_at)
                                    <div class="alert alert-danger">
                                        <i class="fa fa-times-circle"></i> <strong>Rejection History:</strong><br>
                                        Rejected on: {{ $payment->rejected_at->format('d/m/Y H:i:s') }} ({{ $payment->rejected_at->diffForHumans() }})<br>
                                        @if($payment->reject_reason)
                                            Reason: {{ $payment->reject_reason }}
                                        @endif
                                    </div>
                                @endif

                                {{-- CUSTOMER NOTES --}}
                                @if($payment->payment_notes)
                                    <div class="alert alert-info">
                                        <i class="fa fa-comment"></i> <strong>Customer Notes:</strong><br>
                                        {{ $payment->payment_notes }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <a href="{{ route('Admin.Payment.status.show', $payment->id) }}" class="btn btn-secondary">
                                <i class="fa fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary" id="updateButton">
                                <i class="fa fa-save"></i> Update Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        {{-- PAYMENT PROOF SIDEBAR --}}
        <div class="col-md-4">
            @if($payment->payment_proof)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Payment Proof</h4>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $payment->payment_proof) }}" 
                             alt="Payment Proof" 
                             class="img-fluid mb-3" 
                             style="max-height: 300px; border: 1px solid #ddd; border-radius: 8px;"
                             onload="console.log('✅ Payment proof loaded successfully')"
                             onerror="console.error('❌ Payment proof failed to load'); this.style.display='none'; this.nextElementSibling.style.display='block';">
                        
                        <div style="display: none;" class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i> Image failed to load
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ asset('storage/' . $payment->payment_proof) }}" 
                               target="_blank" 
                               class="btn btn-info btn-sm btn-block">
                                <i class="fa fa-external-link"></i> View Full Size
                            </a>
                            <a href="{{ route('Admin.Payment.status.proof', $payment->id) }}" 
                               target="_blank" 
                               class="btn btn-primary btn-sm btn-block">
                                <i class="fa fa-image"></i> View via Admin Route
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Payment Proof</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="empty-state py-4">
                            <i class="fa fa-image fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">No Payment Proof</h6>
                            <p class="text-muted">Customer hasn't uploaded payment proof yet.</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- QUICK ACTION SIDEBAR --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Quick Actions</h4>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($payment->status == 'pending')
                            <button type="button" class="btn btn-success btn-sm btn-block" onclick="quickApprove()">
                                <i class="fa fa-check"></i> Quick Approve
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btn-block" onclick="quickReject()">
                                <i class="fa fa-times"></i> Quick Reject
                            </button>
                        @endif
                        
                        <a href="{{ route('Admin.Payment.status.index') }}" class="btn btn-outline-secondary btn-sm btn-block">
                            <i class="fa fa-list"></i> All Payments
                        </a>
                    </div>
                </div>
            </div>

            {{-- STATUS GUIDE --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Status Guide</h4>
                </div>
                <div class="card-body">
                    <div class="status-guide">
                        <div class="status-item mb-2">
                            <span class="badge badge-warning">📋 Pending</span>
                            <small class="d-block text-muted">Waiting for admin review</small>
                        </div>
                        <div class="status-item mb-2">
                            <span class="badge badge-success">✅ Approved</span>
                            <small class="d-block text-muted">Payment accepted and processed</small>
                        </div>
                        <div class="status-item mb-2">
                            <span class="badge badge-danger">❌ Rejected</span>
                            <small class="d-block text-muted">Payment declined with reason</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ENHANCED JAVASCRIPT FOR 3-STATUS SYSTEM --}}
<script>
$(document).ready(function() {
    console.log('🎯 SIMPLIFIED Admin payment edit form loaded (3 status system)');
    console.log('📊 Payment Details:', {
        id: {{ $payment->id }},
        invoice_id: '{{ $payment->invoice_id }}',
        current_status: '{{ $payment->status }}',
        amount: {{ $payment->amount }},
        has_proof: {{ $payment->payment_proof ? 'true' : 'false' }}
    });
    console.log('🕐 Timestamp: 2025-06-13 19:58:42 UTC');
    console.log('👤 Admin User: Aliester10');
    
    // Show/hide reject reason field based on status
    $('#status').change(function() {
        const selectedStatus = $(this).val();
        const rejectGroup = $('#reject-reason-group');
        const rejectTextarea = $('#reject_reason');
        
        if (selectedStatus === 'rejected') {
            rejectGroup.slideDown();
            rejectTextarea.prop('required', true);
            rejectTextarea.focus();
        } else {
            rejectGroup.slideUp();
            rejectTextarea.prop('required', false);
            rejectTextarea.val(''); // Clear rejection reason if not rejecting
        }
        
        // Update button text based on status
        updateButtonText(selectedStatus);
    });
    
    function updateButtonText(status) {
        const button = $('#updateButton');
        const icons = {
            'pending': 'fa-clock',
            'approved': 'fa-check',
            'rejected': 'fa-times'
        };
        const texts = {
            'pending': 'Set to Pending',
            'approved': 'Approve Payment',
            'rejected': 'Reject Payment'
        };
        const classes = {
            'pending': 'btn-warning',
            'approved': 'btn-success',
            'rejected': 'btn-danger'
        };
        
        button.removeClass('btn-primary btn-success btn-warning btn-danger')
               .addClass(classes[status])
               .html(`<i class="fa ${icons[status]}"></i> ${texts[status]}`);
    }
    
    // Form validation
    $('#editPaymentForm').submit(function(e) {
        const status = $('#status').val();
        const rejectReason = $('#reject_reason').val().trim();
        const currentStatus = '{{ $payment->status }}';
        
        // Validate rejection reason
        if (status === 'rejected' && !rejectReason) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Rejection Reason Required',
                text: 'Please provide a reason for rejecting this payment.',
                confirmButtonText: 'OK'
            });
            $('#reject_reason').focus();
            return false;
        }
        
        // Confirm status change
        if (status !== currentStatus) {
            e.preventDefault();
            
            const messages = {
                'pending': 'set this payment back to pending review',
                'approved': 'approve this payment',
                'rejected': 'reject this payment'
            };
            
            Swal.fire({
                icon: 'question',
                title: 'Confirm Status Change',
                text: `Are you sure you want to ${messages[status]}?`,
                showCancelButton: true,
                confirmButtonText: 'Yes, Update Status',
                cancelButtonText: 'Cancel',
                confirmButtonColor: status === 'approved' ? '#28a745' : (status === 'rejected' ? '#dc3545' : '#ffc107')
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    $('#updateButton').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
                    
                    // Submit form
                    $('#editPaymentForm')[0].submit();
                }
            });
        }
    });
    
    // Quick action functions
    window.quickApprove = function() {
        $('#status').val('approved').trigger('change');
        $('#admin_notes').val('Quick approved by admin');
    };
    
    window.quickReject = function() {
        $('#status').val('rejected').trigger('change');
        $('#reject_reason').focus();
    };
    
    // Initialize button text
    updateButtonText('{{ $payment->status }}');
});

// Enhanced SweetAlert2 integration
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session("success") }}',
        timer: 3000,
        showConfirmButton: false
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session("error") }}',
        confirmButtonText: 'OK'
    });
@endif
</script>

{{-- ENHANCED CSS --}}
<style>
.status-guide .status-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.badge {
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.empty-state {
    opacity: 0.7;
}

.btn-block {
    margin-bottom: 0.5rem;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.btn:hover {
    animation: pulse 0.3s ease-in-out;
}
</style>
@endsection