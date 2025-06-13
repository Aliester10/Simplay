@extends('layouts.Member.master-black')

@section('content')
<div class="payment-status-wrapper container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">Payment Status</h1>
                <div class="payment-actions">
                    <a href="{{ route('portal') }}" class="btn btn-outline-primary">
                        <i class="fas fa-home"></i> Back to Portal
                    </a>
                    @if(isset($paymentSettings) && $paymentSettings)
                    <a href="{{ route('Admin.Payment.settings.edit') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-cog"></i> Payment Settings
                    </a>
                    @endif
                </div>
            </div>
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('portal') }}">Portal</a></li>
                    <li class="breadcrumb-item active">Payment Status</li>
                </ol>
            </nav>
            
            <!-- Payment Status Stats -->
            @if(isset($payments) && $payments->count() > 0)
            <div class="payment-stats mb-4">
                <div class="row">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-clock text-warning"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $payments->where('status', 'pending')->count() }}</h3>
                                <p>Pending</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-upload text-info"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $payments->where('status', 'uploaded')->count() }}</h3>
                                <p>Uploaded</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $payments->where('status', 'verified')->count() }}</h3>
                                <p>Verified</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-times text-danger"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $payments->where('status', 'rejected')->count() }}</h3>
                                <p>Rejected</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Payment Status List -->
            @if(isset($payments) && $payments->count() > 0)
                <div class="payment-status-content">
                    <div class="row">
                        @foreach($payments as $payment)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="payment-card">
                                <div class="payment-card-header">
                                    <h5 class="payment-title">{{ $payment->invoice_id ?? 'INV-' . $payment->id }}</h5>
                                    <span class="payment-status-badge status-{{ strtolower($payment->status ?? 'pending') }}">
                                        {{ ucfirst($payment->status ?? 'Pending') }}
                                    </span>
                                </div>
                                <div class="payment-card-body">
                                    <div class="payment-info">
                                        <div class="info-row">
                                            <span class="info-label">Amount:</span>
                                            <span class="info-value">Rp {{ number_format($payment->amount ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Method:</span>
                                            <span class="info-value">{{ ucfirst($payment->payment_method ?? 'Not set') }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Payment Date:</span>
                                            <span class="info-value">
                                                @if($payment->payment_date)
                                                    {{ $payment->payment_date->format('d M Y, H:i') }}
                                                @else
                                                    <span class="text-muted">Not set</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Created:</span>
                                            <span class="info-value">
                                                @if($payment->created_at)
                                                    {{ $payment->created_at->format('d M Y, H:i') }}
                                                @else
                                                    <span class="text-muted">Not available</span>
                                                @endif
                                            </span>
                                        </div>
                                        @if($payment->admin_notes)
                                        <div class="info-row">
                                            <span class="info-label">Notes:</span>
                                            <span class="info-value">{{ $payment->admin_notes }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    @if($payment->payment_proof)
                                    <div class="payment-proof mt-3">
                                        <h6>Payment Proof:</h6>
                                        <img src="{{ asset('storage/' . $payment->payment_proof) }}" 
                                             alt="Payment Proof" 
                                             class="payment-proof-image"
                                             onclick="showImageModal('{{ asset('storage/' . $payment->payment_proof) }}')">
                                    </div>
                                    @endif
                                </div>
                                <div class="payment-card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            Updated: 
                                            @if($payment->updated_at)
                                                {{ $payment->updated_at->format('d M Y, H:i') }}
                                            @else
                                                Not available
                                            @endif
                                        </small>
                                        @if($payment->status === 'pending')
                                        <button class="btn btn-sm btn-primary" onclick="uploadPaymentProof({{ $payment->id }})">
                                            <i class="fas fa-upload"></i> Upload Proof
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    @if(method_exists($payments, 'links'))
                        <div class="d-flex justify-content-center mt-4">
                            {{ $payments->links() }}
                        </div>
                    @endif
                </div>
            @else
                <div class="empty-payments text-center py-5">
                    <i class="fas fa-receipt fa-5x mb-4 text-muted"></i>
                    <h3>No Payment Records</h3>
                    <p class="text-muted mb-4">You haven't made any payments yet.</p>
                    <a href="{{ route('cart.index') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-cart"></i> Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Upload Payment Proof Modal -->
<div class="modal fade" id="uploadProofModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Payment Proof</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadProofForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="paymentId" name="payment_id">
                    <div class="mb-3">
                        <label for="paymentProof" class="form-label">Payment Proof Image</label>
                        <input type="file" class="form-control" id="paymentProof" name="payment_proof" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="paymentNotes" class="form-label">Notes (Optional)</label>
                        <textarea class="form-control" id="paymentNotes" name="notes" rows="3" placeholder="Add any additional information..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload Proof
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Proof</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Payment Proof" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<style>
.payment-status-wrapper {
    background-color: #fff;
    border-radius: 16px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
    padding: 40px;
    margin-top: 5rem;
    margin-bottom: 30px;
}

.payment-actions {
    display: flex;
    gap: 10px;
}

.payment-stats {
    margin-bottom: 30px;
}

.stat-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    font-size: 2rem;
    opacity: 0.8;
}

.stat-info h3 {
    margin: 0;
    font-size: 2rem;
    font-weight: bold;
}

.stat-info p {
    margin: 0;
    opacity: 0.9;
}

.payment-card {
    background: #fff;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    overflow: hidden;
}

.payment-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
}

.payment-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    position: relative;
}

.payment-title {
    margin: 0;
    font-weight: 600;
    font-size: 1.1rem;
}

.payment-status-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-pending {
    background-color: #ffc107;
    color: #212529;
}

.status-uploaded {
    background-color: #17a2b8;
    color: white;
}

.status-verified {
    background-color: #28a745;
    color: white;
}

.status-rejected {
    background-color: #dc3545;
    color: white;
}

.payment-card-body {
    padding: 20px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f8f9fa;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: #6c757d;
}

.info-value {
    color: #333;
    font-weight: 500;
}

.payment-proof-image {
    max-width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-proof-image:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.payment-card-footer {
    background-color: #f8f9fa;
    padding: 15px 20px;
    border-top: 1px solid #e9ecef;
}

.empty-payments {
    background-color: #f9f9f9;
    border-radius: 12px;
    padding: 80px 20px;
}

.empty-payments i {
    color: #ccc;
}

@media (max-width: 768px) {
    .payment-status-wrapper {
        padding: 20px;
    }
    
    .payment-actions {
        flex-direction: column;
        gap: 5px;
    }
    
    .stat-card {
        padding: 15px;
    }
    
    .payment-card-header {
        padding: 15px;
    }
    
    .payment-title {
        font-size: 1rem;
        margin-bottom: 10px;
    }
    
    .payment-status-badge {
        position: static;
        display: inline-block;
        margin-top: 5px;
    }
}
</style>

<script>
function showImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    new bootstrap.Modal(document.getElementById('imageModal')).show();
}

function uploadPaymentProof(paymentId) {
    document.getElementById('paymentId').value = paymentId;
    new bootstrap.Modal(document.getElementById('uploadProofModal')).show();
}

// Handle upload form submission
document.getElementById('uploadProofForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const paymentId = document.getElementById('paymentId').value;
    const formData = new FormData(this);
    
    fetch(`{{ url('/portal/payment/upload-proof') }}/${paymentId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Payment proof uploaded successfully!');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error uploading payment proof');
    });
});

console.log('💳 Payment Status View Loaded - Time: 2025-06-13 07:09:51 UTC');
console.log('👤 User: Aliester10');
console.log('🔧 Fixed: Undefined variable $paymentSettings');
console.log('✅ Null-safe date formatting: ACTIVE');
</script>
@endsection