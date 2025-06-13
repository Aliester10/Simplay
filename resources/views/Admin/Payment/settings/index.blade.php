@extends('layouts.Admin.master')

@section('title', 'Pengaturan Metode Pembayaran')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="page-title">Pengaturan Metode Pembayaran</h3>
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
                <a href="#">Payment</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Settings</a>
            </li>
        </ul>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Payment Method Settings -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">
                            <i class="fas fa-credit-card"></i> Pengaturan Metode Pembayaran
                        </h4>
                        <a href="{{ route('Admin.Payment.settings.edit') }}" class="btn btn-primary btn-sm ml-auto">
                            <i class="fa fa-edit"></i> Edit Settings
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($paymentSettings)
                        <!-- Bank Transfer Section -->
                        <div class="payment-method-section mb-4">
                            <h5 class="section-title">
                                <i class="fas fa-university text-primary"></i> Bank Transfer
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-group mb-3">
                                        <label class="info-label">Nama Bank:</label>
                                        <p class="info-value">{{ $paymentSettings->bank_name ?: 'Belum diatur' }}</p>
                                    </div>
                                    <div class="info-group mb-3">
                                        <label class="info-label">No Rekening:</label>
                                        <p class="info-value">{{ $paymentSettings->account_number ?: 'Belum diatur' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-group mb-3">
                                        <label class="info-label">Nama Pemilik:</label>
                                        <p class="info-value">{{ $paymentSettings->account_name ?: 'Belum diatur' }}</p>
                                    </div>
                                    <div class="info-group mb-3">
                                        <label class="info-label">Status:</label>
                                        <p class="info-value">
                                            <span class="badge badge-{{ $paymentSettings->status === 'active' ? 'success' : 'secondary' }} badge-lg">
                                                <i class="fa fa-{{ $paymentSettings->status === 'active' ? 'check' : 'times' }}"></i>
                                                {{ ucfirst($paymentSettings->status) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- QR Code Payment Section -->
                        <div class="payment-method-section mb-4">
                            <h5 class="section-title">
                                <i class="fas fa-qrcode text-info"></i> QR Code Payment
                            </h5>
                            @if($paymentSettings->qr_image)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <img src="{{ $paymentSettings->qr_image }}" alt="QR Code Payment" class="img-thumbnail qr-preview" style="max-width: 200px;">
                                            <p class="mt-2 text-muted">QR Code untuk pembayaran digital</p>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="info-group">
                                            <label class="info-label">Status QR Code:</label>
                                            <p class="info-value">
                                                <span class="badge badge-success badge-lg">
                                                    <i class="fa fa-check"></i> Tersedia
                                                </span>
                                            </p>
                                        </div>
                                        <div class="info-group">
                                            <label class="info-label">Jenis Pembayaran:</label>
                                            <p class="info-value">QRIS, Dana, OVO, GoPay, LinkAja, ShopeePay</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <i class="fas fa-qrcode fa-3x text-muted mb-3"></i>
                                    <h6>QR Code belum diatur</h6>
                                    <p class="text-muted">Upload QR Code untuk mengaktifkan pembayaran digital</p>
                                </div>
                            @endif
                        </div>

                        <!-- Payment Instructions Section -->
                        <div class="payment-method-section">
                            <h5 class="section-title">
                                <i class="fas fa-info-circle text-warning"></i> Instruksi Pembayaran
                            </h5>
                            <div class="alert alert-info">
                                {{ $paymentSettings->payment_instructions ?: 'Belum ada instruksi pembayaran yang diatur' }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-exclamation-triangle fa-4x text-warning mb-4"></i>
                            <h4>Belum ada pengaturan metode pembayaran</h4>
                            <p class="text-muted mb-4">Atur metode pembayaran untuk memungkinkan customer melakukan transaksi</p>
                            <a href="{{ route('Admin.Payment.settings.edit') }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-plus"></i> Setup Payment Methods
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Statistics Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-chart-pie"></i> Status Sistem
                    </h4>
                </div>
                <div class="card-body">
                    <div class="status-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-university text-primary"></i> Bank Transfer:</span>
                            <span class="badge badge-{{ $paymentSettings && $paymentSettings->bank_name ? 'success' : 'warning' }}">
                                {{ $paymentSettings && $paymentSettings->bank_name ? 'Configured' : 'Not Set' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="status-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-qrcode text-info"></i> QR Code:</span>
                            <span class="badge badge-{{ $paymentSettings && $paymentSettings->qr_image ? 'success' : 'warning' }}">
                                {{ $paymentSettings && $paymentSettings->qr_image ? 'Available' : 'Not Set' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="status-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-info-circle text-warning"></i> Instructions:</span>
                            <span class="badge badge-{{ $paymentSettings && $paymentSettings->payment_instructions ? 'success' : 'warning' }}">
                                {{ $paymentSettings && $paymentSettings->payment_instructions ? 'Set' : 'Not Set' }}
                            </span>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="status-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><strong><i class="fas fa-toggle-on"></i> System Status:</strong></span>
                            <span class="badge badge-{{ $paymentSettings && $paymentSettings->status === 'active' ? 'success' : 'danger' }} badge-lg">
                                {{ $paymentSettings && $paymentSettings->status === 'active' ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('Admin.Payment.settings.edit') }}" class="btn btn-primary btn-block mb-2">
                        <i class="fa fa-edit"></i> Edit Payment Methods
                    </a>
                    <a href="{{ route('Admin.Payment.status.index') }}" class="btn btn-info btn-block mb-2">
                        <i class="fa fa-list"></i> View Payment Status
                    </a>
                    @if($paymentSettings && $paymentSettings->qr_image)
                        <button type="button" class="btn btn-success btn-block" onclick="viewQRCode()">
                            <i class="fa fa-eye"></i> Preview QR Code
                        </button>
                    @endif
                </div>
            </div>

            <!-- Last Updated Info -->
            @if($paymentSettings)
                <div class="card">
                    <div class="card-body">
                        <h6><i class="fas fa-clock"></i> Last Updated</h6>
                        <small class="text-muted">
                            {{ $paymentSettings->updated_at->format('d/m/Y H:i:s') }}<br>
                            <em>by {{ $paymentSettings->updated_by ?? 'System' }}</em>
                        </small>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- QR Code Preview Modal -->
@if($paymentSettings && $paymentSettings->qr_image)
<div class="modal fade" id="qrPreviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">QR Code Payment</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ $paymentSettings->qr_image }}" alt="QR Code" class="img-fluid" style="max-width: 400px;">
                <p class="mt-3 text-muted">Scan QR Code ini untuk melakukan pembayaran digital</p>
            </div>
        </div>
    </div>
</div>
@endif

<style>
.payment-method-section {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    background-color: #f8f9fa;
}

.section-title {
    border-bottom: 2px solid #dee2e6;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.info-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 5px;
    display: block;
}

.info-value {
    color: #212529;
    margin-bottom: 0;
    font-size: 1.1em;
}

.info-group {
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.info-group:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.badge-lg {
    font-size: 0.9em;
    padding: 0.5em 0.8em;
}

.status-item {
    padding: 8px 0;
    border-bottom: 1px solid #f1f1f1;
}

.status-item:last-child {
    border-bottom: none;
}

.qr-preview {
    transition: transform 0.3s ease;
    cursor: pointer;
}

.qr-preview:hover {
    transform: scale(1.05);
}
</style>

<script>
function viewQRCode() {
    $('#qrPreviewModal').modal('show');
}
</script>
@endsection