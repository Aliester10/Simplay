@extends('layouts.Member.master')

@section('title', 'Payment Status')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h3 class="page-title">Payment Status & History</h3>
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
                <a href="#">Payment Status</a>
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

    {{-- 🔥 SIMPLIFIED: Statistics Dashboard - 3 STATUS ONLY --}}
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 col-sm-6">
            <div class="card card-stats card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-coins"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Total Payments</p>
                                <h4 class="card-title">{{ $statistics['total_payments'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 col-sm-6">
            <div class="card card-stats card-warning">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-clock"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Pending Review</p>
                                <h4 class="card-title">{{ $statistics['pending_payments'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 col-sm-6">
            <div class="card card-stats card-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-check"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Approved</p>
                                <h4 class="card-title">{{ $statistics['approved_payments'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 col-sm-6">
            <div class="card card-stats card-danger">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-close"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Rejected</p>
                                <h4 class="card-title">{{ $statistics['rejected_payments'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- 🔥 SIMPLIFIED: Payment History Table - 3 STATUS ONLY --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Payment History</h4>
                        <div class="ml-auto">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="filterStatus('all')">All</button>
                                <button type="button" class="btn btn-outline-warning btn-sm" onclick="filterStatus('pending')">Pending</button>
                                <button type="button" class="btn btn-outline-success btn-sm" onclick="filterStatus('approved')">Approved</button>
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="filterStatus('rejected')">Rejected</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($payments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="payment-table">
                                <thead>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment Date</th>
                                        <th>Progress</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                        <tr data-status="{{ $payment->status }}">
                                            <td>
                                                <div class="font-weight-bold">{{ $payment->invoice_id }}</div>
                                                <small class="text-muted">{{ $payment->payment_method }}</small>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $statusConfig = [
                                                        'pending' => ['class' => 'badge-warning', 'icon' => 'fa-clock', 'text' => 'Pending Review'],
                                                        'approved' => ['class' => 'badge-success', 'icon' => 'fa-check', 'text' => 'Approved'],
                                                        'rejected' => ['class' => 'badge-danger', 'icon' => 'fa-times', 'text' => 'Rejected']
                                                    ];
                                                    $config = $statusConfig[$payment->status] ?? ['class' => 'badge-secondary', 'icon' => 'fa-question', 'text' => ucfirst($payment->status)];
                                                @endphp
                                                <span class="badge {{ $config['class'] }}">
                                                    <i class="fa {{ $config['icon'] }}"></i> {{ $config['text'] }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($payment->payment_date)
                                                    {{ $payment->payment_date->format('d/m/Y H:i') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $progress = [
                                                        'pending' => 50,
                                                        'approved' => 100,
                                                        'rejected' => 100
                                                    ];
                                                    $progressValue = $progress[$payment->status] ?? 25;
                                                    $progressClass = $payment->status == 'rejected' ? 'bg-danger' : ($progressValue == 100 ? 'bg-success' : 'bg-warning');
                                                @endphp
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar {{ $progressClass }}" 
                                                         style="width: {{ $progressValue }}%"
                                                         title="{{ $progressValue }}% Complete"></div>
                                                </div>
                                                <small class="text-muted">{{ $progressValue }}%</small>
                                            </td>
                                            <td>
                                                {{-- 🔥 SIMPLIFIED: Action Buttons for 3 Status System --}}
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('member.payment.detail', $payment->id) }}" 
                                                       class="btn btn-primary btn-sm" 
                                                       title="View Details">
                                                        <i class="fa fa-eye"></i> View Detail
                                                    </a>
                                                    
                                                    @if($payment->status == 'pending' && !$payment->payment_proof)
                                                        <a href="{{ route('member.payment.instructions', ['orderId' => $payment->order_id ?? $payment->id]) }}" 
                                                           class="btn btn-warning btn-sm" 
                                                           title="Upload Proof">
                                                            <i class="fa fa-upload"></i> Upload Proof
                                                        </a>
                                                    @endif
                                                    
                                                    @if($payment->status == 'rejected')
                                                        <a href="{{ route('member.payment.instructions', ['orderId' => $payment->order_id ?? $payment->id]) }}" 
                                                           class="btn btn-danger btn-sm" 
                                                           title="Re-upload Proof">
                                                            <i class="fa fa-retry"></i> Re-upload
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        {{-- Pagination --}}
                        <div class="d-flex justify-content-center">
                            {{ $payments->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fa fa-receipt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Payment Records Found</h5>
                            <p class="text-muted">You haven't made any payments yet.</p>
                            <a href="{{ route('portal') }}" class="btn btn-primary">
                                <i class="fa fa-shopping-cart"></i> Start Shopping
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        {{-- 🔥 SIMPLIFIED: Recent Activity Sidebar --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Activity</h4>
                </div>
                <div class="card-body">
                    @if($recentActivity->count() > 0)
                        <div class="timeline">
                            @foreach($recentActivity as $activity)
                                <div class="timeline-item">
                                    <div class="timeline-marker {{ $activity->status == 'approved' ? 'bg-success' : ($activity->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                        <i class="fa fa-circle"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">{{ $activity->invoice_id }}</h6>
                                        <p class="timeline-description">
                                            Status: <strong>{{ ucfirst($activity->status) }}</strong>
                                            @if($activity->admin_notes)
                                                <br><small class="text-muted">{{ $activity->admin_notes }}</small>
                                            @endif
                                            @if($activity->reject_reason)
                                                <br><small class="text-danger">{{ $activity->reject_reason }}</small>
                                            @endif
                                        </p>
                                        <span class="timeline-date">{{ $activity->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fa fa-history fa-2x text-muted mb-2"></i>
                            <p class="text-muted">No recent activity</p>
                        </div>
                    @endif
                </div>
            </div>
            
            {{-- 🔥 SIMPLIFIED: Quick Actions --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Quick Actions</h4>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('portal.cart') }}" class="btn btn-primary btn-block">
                            <i class="fa fa-shopping-cart"></i> View Cart
                        </a>
                        <a href="{{ route('product.index') }}" class="btn btn-outline-primary btn-block">
                            <i class="fa fa-search"></i> Browse Products
                        </a>
                        <a href="{{ route('portal') }}" class="btn btn-outline-secondary btn-block">
                            <i class="fa fa-home"></i> Back to Portal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Enhanced CSS for timeline and animations --}}
<style>
.timeline {
    position: relative;
    padding-left: 20px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 8px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -12px;
    top: 5px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 8px;
}

.timeline-content {
    margin-left: 15px;
}

.timeline-title {
    margin-bottom: 5px;
    font-weight: 600;
}

.timeline-description {
    margin-bottom: 5px;
    font-size: 14px;
}

.timeline-date {
    font-size: 12px;
    color: #6c757d;
}

.card-stats .icon-big {
    font-size: 3rem;
}

.card-stats .numbers {
    text-align: right;
}

.badge {
    font-size: 0.75rem;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #5a5a5a;
}

.progress {
    border-radius: 3px;
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

{{-- Enhanced JavaScript for filtering and interactions --}}
<script>
let currentFilter = 'all';

function filterStatus(status) {
    currentFilter = status;
    const rows = document.querySelectorAll('#payment-table tbody tr');
    
    // Update button states
    document.querySelectorAll('.btn-group .btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // Filter rows
    rows.forEach(row => {
        const rowStatus = row.getAttribute('data-status');
        if (status === 'all' || rowStatus === status) {
            row.style.display = '';
            row.style.animation = 'fadeIn 0.3s ease-in-out';
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update counter
    const visibleRows = document.querySelectorAll('#payment-table tbody tr[style=""]').length;
    console.log(`🎯 SIMPLIFIED: Showing ${visibleRows} payments with status: ${status}`);
}

// Auto-refresh functionality
let refreshInterval;

function startAutoRefresh() {
    refreshInterval = setInterval(() => {
        // Check for status updates every 30 seconds
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(response => {
            if (response.ok) {
                console.log('🔄 Status checked at:', new Date().toLocaleTimeString());
            }
        }).catch(error => {
            console.error('❌ Auto-refresh error:', error);
        });
    }, 30000); // 30 seconds
}

function stopAutoRefresh() {
    if (refreshInterval) {
        clearInterval(refreshInterval);
    }
}

// Initialize
$(document).ready(function() {
    console.log('🎯 SIMPLIFIED payment status page loaded (3 status system)');
    console.log('📊 Statistics:', {
        total: {{ $statistics['total_payments'] }},
        pending: {{ $statistics['pending_payments'] }},
        approved: {{ $statistics['approved_payments'] }},
        rejected: {{ $statistics['rejected_payments'] }}
    });
    console.log('🕐 Timestamp: 2025-06-13 19:53:27 UTC');
    console.log('👤 User: Aliester10');
    
    // Start auto-refresh
    startAutoRefresh();
    
    // Tooltip initialization
    $('[title]').tooltip();
    
    // Default filter button
    document.querySelector('.btn-group .btn').classList.add('active');
});

// Stop auto-refresh when leaving page
window.addEventListener('beforeunload', stopAutoRefresh);

// Add CSS animation
const style = document.createElement('style');
style.textContent = `
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
`;
document.head.appendChild(style);
</script>
@endsection