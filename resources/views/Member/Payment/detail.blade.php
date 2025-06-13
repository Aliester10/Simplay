@extends('layouts.Member.master')

@section('title', 'Payment Detail')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h3 class="page-title">Payment Detail - {{ $payment->invoice_id }}</h3>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('portal') }}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('member.payment.status') }}">Payment Status</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Detail</a>
            </li>
        </ul>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        {{-- Payment Information --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Payment Information</h4>
                    <div class="ml-auto">
                        <a href="{{ route('member.payment.status') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="font-weight-bold">Invoice ID:</td>
                                    <td>{{ $payment->invoice_id }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Amount:</td>
                                    <td class="font-weight-bold text-primary">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Payment Method:</td>
                                    <td><span class="badge badge-info">{{ strtoupper($payment->payment_method) }}</span></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Customer:</td>
                                    <td>
                                        {{ $payment->customer_name }}<br>
                                        <small class="text-muted">{{ $payment->customer_email }}</small>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="font-weight-bold">Current Status:</td>
                                    <td>
                                        @php
                                            $statusConfig = [
                                                'pending' => ['class' => 'badge-warning', 'icon' => 'fa-clock', 'text' => 'Pending Review'],
                                                'approved' => ['class' => 'badge-success', 'icon' => 'fa-check', 'text' => 'Payment Approved'],
                                                'rejected' => ['class' => 'badge-danger', 'icon' => 'fa-times', 'text' => 'Payment Rejected']
                                            ];
                                            $config = $statusConfig[$payment->status] ?? ['class' => 'badge-secondary', 'icon' => 'fa-question', 'text' => ucfirst($payment->status)];
                                        @endphp
                                        <span class="badge {{ $config['class'] }} badge-lg">
                                            <i class="fa {{ $config['icon'] }}"></i> {{ $config['text'] }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Created:</td>
                                    <td>{{ $payment->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Last Updated:</td>
                                    <td>{{ $payment->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @if($payment->payment_date)
                                <tr>
                                    <td class="font-weight-bold">Payment Date:</td>
                                    <td>{{ $payment->payment_date->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @endif
                                @if($payment->approved_at)
                                <tr>
                                    <td class="font-weight-bold">Approved Date:</td>
                                    <td>{{ $payment->approved_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @endif
                                @if($payment->rejected_at)
                                <tr>
                                    <td class="font-weight-bold">Rejected Date:</td>
                                    <td>{{ $payment->rejected_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    
                    {{-- Admin Notes --}}
                    @if($payment->admin_notes)
                        <div class="alert alert-info">
                            <h6><i class="fa fa-info-circle"></i> Admin Notes:</h6>
                            {{ $payment->admin_notes }}
                        </div>
                    @endif
                    
                    {{-- Rejection Reason --}}
                    @if($payment->reject_reason)
                        <div class="alert alert-danger">
                            <h6><i class="fa fa-exclamation-triangle"></i> Rejection Reason:</h6>
                            {{ $payment->reject_reason }}
                        </div>
                    @endif

                    {{-- Payment Notes --}}
                    @if($payment->payment_notes)
                        <div class="alert alert-secondary">
                            <h6><i class="fa fa-comment"></i> Your Payment Notes:</h6>
                            {{ $payment->payment_notes }}
                        </div>
                    @endif
                </div>
            </div>
            
            {{-- 🔥 SIMPLIFIED: Payment Timeline - 3 STATUS SYSTEM --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Payment Timeline</h4>
                </div>
                <div class="card-body">
                    <div class="timeline-detailed">
                        @foreach($timeline as $step)
                            <div class="timeline-step {{ $step['completed'] ? 'completed' : 'pending' }}">
                                <div class="timeline-marker bg-{{ $step['color'] }}">
                                    <i class="fa {{ $step['icon'] }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title">{{ $step['label'] }}</h6>
                                    <p class="timeline-description">{{ $step['description'] }}</p>
                                    @if($step['date'])
                                        <span class="timeline-date">
                                            <i class="fa fa-calendar"></i> {{ $step['date']->format('d/m/Y H:i:s') }}
                                            <small class="text-muted">({{ $step['date']->diffForHumans() }})</small>
                                        </span>
                                    @else
                                        <span class="timeline-date text-muted">
                                            <i class="fa fa-clock"></i> Pending
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Order Information (if exists) --}}
            @if($payment->order)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Order Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold">Order Number:</td>
                                        <td>{{ $payment->order->order_number }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Order Status:</td>
                                        <td>
                                            <span class="badge badge-primary">{{ ucfirst($payment->order->status) }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold">Order Date:</td>
                                        <td>{{ $payment->order->created_at->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Total Amount:</td>
                                        <td class="font-weight-bold">Rp {{ number_format($payment->order->total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        {{-- Payment Proof & Actions --}}
        <div class="col-lg-4">
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
                               class="btn btn-primary btn-block">
                                <i class="fa fa-external-link"></i> View Full Size
                            </a>
                            <a href="{{ asset('storage/' . $payment->payment_proof) }}" 
                               download="payment_proof_{{ $payment->invoice_id }}.png" 
                               class="btn btn-success btn-block">
                                <i class="fa fa-download"></i> Download Proof
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
                        <div class="empty-state">
                            <i class="fa fa-image fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">No Payment Proof</h6>
                            @if($payment->status == 'pending')
                                <p class="text-muted">Please upload your payment proof to proceed.</p>
                            @elseif($payment->status == 'rejected')
                                <p class="text-muted">Your previous proof was rejected. Please upload a new one.</p>
                            @else
                                <p class="text-muted">No payment proof uploaded yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            
            {{-- 🔥 SIMPLIFIED: Actions - 3 STATUS SYSTEM --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Actions</h4>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($payment->status == 'pending' && !$payment->payment_proof)
                            <a href="{{ route('member.payment.instructions', $payment->id) }}" 
                               class="btn btn-warning btn-block">
                                <i class="fa fa-upload"></i> Upload Payment Proof
                            </a>
                        @elseif($payment->status == 'pending' && $payment->payment_proof)
                            <div class="alert alert-info text-center">
                                <i class="fa fa-clock"></i><br>
                                <strong>Waiting for Admin Review</strong><br>
                                <small>Your payment proof is being reviewed by our admin team.</small>
                            </div>
                        @endif
                        
                        @if($payment->status == 'rejected')
                            <a href="{{ route('member.payment.instructions', $payment->id) }}" 
                               class="btn btn-danger btn-block">
                                <i class="fa fa-retry"></i> Re-upload Payment Proof
                            </a>
                        @endif

                        @if($payment->status == 'approved')
                            <div class="alert alert-success text-center">
                                <i class="fa fa-check-circle"></i><br>
                                <strong>Payment Approved!</strong><br>
                                <small>Your payment has been successfully processed.</small>
                            </div>
                        @endif
                        
                        <a href="{{ route('member.payment.status') }}" 
                           class="btn btn-secondary btn-block">
                            <i class="fa fa-list"></i> All Payments
                        </a>

                        <a href="{{ route('portal') }}" 
                           class="btn btn-outline-secondary btn-block">
                            <i class="fa fa-home"></i> Back to Portal
                        </a>
                    </div>
                </div>
            </div>

            {{-- Payment Summary --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Payment Summary</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>
                                @php
                                    $statusConfig = [
                                        'pending' => ['class' => 'badge-warning', 'icon' => 'fa-clock', 'text' => 'Pending'],
                                        'approved' => ['class' => 'badge-success', 'icon' => 'fa-check', 'text' => 'Approved'],
                                        'rejected' => ['class' => 'badge-danger', 'icon' => 'fa-times', 'text' => 'Rejected']
                                    ];
                                    $config = $statusConfig[$payment->status] ?? ['class' => 'badge-secondary', 'icon' => 'fa-question', 'text' => ucfirst($payment->status)];
                                @endphp
                                <span class="badge {{ $config['class'] }}">
                                    <i class="fa {{ $config['icon'] }}"></i> {{ $config['text'] }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Amount:</strong></td>
                            <td class="text-primary font-weight-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Method:</strong></td>
                            <td>{{ strtoupper($payment->payment_method) }}</td>
                        </tr>
                        @if($payment->approvedBy)
                            <tr>
                                <td><strong>Approved by:</strong></td>
                                <td>{{ $payment->approvedBy->name }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Enhanced CSS for detailed timeline --}}
<style>
.timeline-detailed {
    position: relative;
    padding-left: 30px;
}

.timeline-detailed::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(to bottom, #007bff, #e9ecef);
}

.timeline-step {
    position: relative;
    margin-bottom: 30px;
    padding-bottom: 20px;
}

.timeline-step:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    border: 3px solid white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.timeline-step.completed .timeline-marker {
    transform: scale(1.1);
}

.timeline-step.pending .timeline-marker {
    background: #6c757d !important;
    opacity: 0.6;
}

.timeline-content {
    margin-left: 20px;
}

.timeline-title {
    margin-bottom: 8px;
    font-weight: 600;
    font-size: 16px;
}

.timeline-description {
    margin-bottom: 8px;
    color: #6c757d;
}

.timeline-date {
    font-size: 13px;
    color: #6c757d;
}

.badge-lg {
    font-size: 0.9rem;
    padding: 0.5rem 0.75rem;
}

.empty-state {
    padding: 2rem 1rem;
}

.card {
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border: none;
    border-radius: 10px;
    margin-bottom: 1rem;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px 10px 0 0 !important;
}

.btn-block {
    margin-bottom: 0.5rem;
}
</style>

<script>
$(document).ready(function() {
    console.log('🎯 SIMPLIFIED payment detail page loaded (3 status system)');
    console.log('📊 Payment Details:', {
        id: {{ $payment->id }},
        invoice_id: '{{ $payment->invoice_id }}',
        status: '{{ $payment->status }}',
        amount: {{ $payment->amount }},
        has_proof: {{ $payment->payment_proof ? 'true' : 'false' }}
    });
    console.log('🕐 Timestamp: 2025-06-13 19:53:27 UTC');
    console.log('👤 User: Aliester10');
    
    // Add hover effects to timeline steps
    $('.timeline-step').hover(
        function() {
            $(this).find('.timeline-marker').addClass('pulse');
        },
        function() {
            $(this).find('.timeline-marker').removeClass('pulse');
        }
    );
    
    // Auto-refresh for pending payments
    @if($payment->status == 'pending')
        setInterval(() => {
            fetch(window.location.href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(response => {
                console.log('🔄 Status check at:', new Date().toLocaleTimeString());
                // You can add logic here to check for status changes
            }).catch(error => {
                console.error('❌ Auto-refresh error:', error);
            });
        }, 30000); // Check every 30 seconds
    @endif
});

// Add pulse animation
const style = document.createElement('style');
style.textContent = `
.pulse {
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0% { transform: scale(1.1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1.1); }
}
`;
document.head.appendChild(style);
</script>
@endsection