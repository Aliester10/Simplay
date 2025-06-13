@extends('layouts.Member.master-black')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Payment Details - {{ $payment->invoice_id }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted">Amount:</label>
                                <h5>Rp {{ number_format($payment->amount, 0, ',', '.') }}</h5>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted">Status:</label>
                                <br>
                                <span class="badge badge-{{ $payment->status_badge }}">{{ ucfirst($payment->status) }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted">Payment Method:</label>
                                <br>
                                <span class="badge badge-info">{{ strtoupper($payment->payment_method) }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted">Payment Date:</label>
                                <p>{{ $payment->payment_date->format('d M Y, H:i') }}</p>
                            </div>
                            @if($payment->approved_at)
                                <div class="mb-3">
                                    <label class="text-muted">Approved At:</label>
                                    <p>{{ $payment->approved_at->format('d M Y, H:i') }}</p>
                                </div>
                            @endif
                            @if($payment->rejected_at)
                                <div class="mb-3">
                                    <label class="text-muted">Rejected At:</label>
                                    <p>{{ $payment->rejected_at->format('d M Y, H:i') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    @if($payment->reject_reason)
                        <div class="alert alert-danger">
                            <strong>Rejection Reason:</strong> {{ $payment->reject_reason }}
                        </div>
                    @endif
                    
                    @if($payment->admin_notes)
                        <div class="alert alert-info">
                            <strong>Admin Notes:</strong> {{ $payment->admin_notes }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            @if($payment->payment_proof)
                <div class="card">
                    <div class="card-header">
                        <h6>Payment Proof</h6>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $payment->payment_proof_url }}" alt="Payment Proof" class="img-fluid mb-2" style="max-height: 300px;">
                        <a href="{{ $payment->payment_proof_url }}" target="_blank" class="btn btn-sm btn-info">
                            <i class="fa fa-external-link"></i> View Full Size
                        </a>
                    </div>
                </div>
            @endif
            
            @if($payment->status === 'pending' || $payment->status === 'rejected')
                <div class="card mt-3">
                    <div class="card-body">
                        <h6>Upload New Payment Proof</h6>
                        <form id="new-payment-proof-form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control" name="payment_proof" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Upload</button>
                        </form>
                    </div>
                </div>
            @endif
            
            <div class="card mt-3">
                <div class="card-body">
                    <h6>Actions</h6>
                    <a href="{{ route('member.payment.status') }}" class="btn btn-secondary btn-block">
                        <i class="fa fa-arrow-left"></i> Back to Payment Status
                    </a>
                    <a href="{{ route('portal') }}" class="btn btn-info btn-block">
                        <i class="fa fa-home"></i> Back to Portal
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .badge-pending { background-color: #ffc107; color: #212529; }
    .badge-approved { background-color: #28a745; }
    .badge-rejected { background-color: #dc3545; }
</style>

<script>
document.getElementById('new-payment-proof-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    
    try {
        const response = await fetch(`{{ route('member.payment.upload-proof', $payment->id) }}`, {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Payment proof uploaded successfully!');
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        alert('Error uploading payment proof');
    }
});
</script>
@endsection