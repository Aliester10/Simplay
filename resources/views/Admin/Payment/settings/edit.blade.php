@extends('layouts.Admin.master')

@section('title', 'Edit Metode Pembayaran')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="page-title">Edit Metode Pembayaran</h3>
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
                <a href="{{ route('Admin.Payment.settings.index') }}">Payment Settings</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Edit</a>
            </li>
        </ul>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Validation Error!</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-credit-card"></i> Pengaturan Metode Pembayaran
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('Admin.Payment.settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Bank Transfer Section -->
                        <div class="payment-section mb-4">
                            <h5 class="section-header">
                                <i class="fas fa-university text-primary"></i> Bank Transfer Settings
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Bank <span class="text-danger">*</span></label>
                                        <input type="text" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" 
                                               value="{{ old('bank_name', $paymentSettings->bank_name ?? '') }}" 
                                               placeholder="Contoh: Bank Mandiri" required>
                                        @error('bank_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Nomor Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="account_number" class="form-control @error('account_number') is-invalid @enderror" 
                                               value="{{ old('account_number', $paymentSettings->account_number ?? '') }}" 
                                               placeholder="Contoh: 1234567890" required>
                                        @error('account_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Pemilik Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="account_name" class="form-control @error('account_name') is-invalid @enderror" 
                                               value="{{ old('account_name', $paymentSettings->account_name ?? '') }}" 
                                               placeholder="Contoh: PT. Simplay Indonesia" required>
                                        @error('account_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Status System <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                            <option value="active" {{ old('status', $paymentSettings->status ?? '') == 'active' ? 'selected' : '' }}>
                                                ✓ Aktif - Customer dapat melakukan pembayaran
                                            </option>
                                            <option value="inactive" {{ old('status', $paymentSettings->status ?? '') == 'inactive' ? 'selected' : '' }}>
                                                ✗ Tidak Aktif - Pembayaran dinonaktifkan
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- QR Code Section -->
                        <div class="payment-section mb-4">
                            <h5 class="section-header">
                                <i class="fas fa-qrcode text-info"></i> QR Code Payment Settings
                            </h5>
                            
                            <div class="form-group">
                                <label>Upload QR Code untuk Pembayaran Digital</label>
                                <input type="file" name="qr_image" class="form-control @error('qr_image') is-invalid @enderror" accept="image/*">
                                @error('qr_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Upload QR Code QRIS/Dana/OVO/GoPay yang akan ditampilkan kepada customer. 
                                    Format: JPG, PNG, GIF. Max: 2MB. Kosongkan jika tidak ingin mengubah.
                                </small>
                            </div>
                        </div>

                        <!-- Instructions Section -->
                        <div class="payment-section mb-4">
                            <h5 class="section-header">
                                <i class="fas fa-info-circle text-warning"></i> Instruksi Pembayaran
                            </h5>
                            
                            <div class="form-group">
                                <label>Panduan Pembayaran untuk Customer</label>
                                <textarea name="payment_instructions" class="form-control @error('payment_instructions') is-invalid @enderror" 
                                          rows="5" placeholder="Contoh: 1. Transfer ke rekening di atas&#10;2. Upload bukti pembayaran&#10;3. Tunggu konfirmasi dari admin">{{ old('payment_instructions', $paymentSettings->payment_instructions ?? '') }}</textarea>
                                @error('payment_instructions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    <i class="fas fa-lightbulb"></i> 
                                    Berikan instruksi yang jelas dan mudah dipahami customer
                                </small>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-save"></i> Update Payment Settings
                            </button>
                            <a href="{{ route('Admin.Payment.settings.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Current Settings Preview -->
            @if($paymentSettings)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fas fa-eye"></i> Current Settings
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Bank Info -->
                        <div class="preview-section mb-3">
                            <h6><i class="fas fa-university text-primary"></i> Bank Transfer</h6>
                            <div class="preview-item">
                                <small class="text-muted">Bank:</small>
                                <p>{{ $paymentSettings->bank_name ?: 'Belum diatur' }}</p>
                            </div>
                            <div class="preview-item">
                                <small class="text-muted">Rekening:</small>
                                <p>{{ $paymentSettings->account_number ?: 'Belum diatur' }}</p>
                            </div>
                            <div class="preview-item">
                                <small class="text-muted">Pemilik:</small>
                                <p>{{ $paymentSettings->account_name ?: 'Belum diatur' }}</p>
                            </div>
                        </div>

                        <!-- QR Code Preview -->
                        @if($paymentSettings->qr_image)
                            <div class="preview-section mb-3">
                                <h6><i class="fas fa-qrcode text-info"></i> QR Code Current</h6>
                                <div class="text-center">
                                    <img src="{{ $paymentSettings->qr_image }}" alt="Current QR" class="img-thumbnail" style="max-width: 150px;">
                                    <p class="mt-2"><small class="text-muted">QR Code saat ini</small></p>
                                </div>
                            </div>
                        @endif

                        <!-- Status -->
                        <div class="preview-section">
                            <h6><i class="fas fa-toggle-on"></i> Status</h6>
                            <p>
                                <span class="badge badge-{{ $paymentSettings->status === 'active' ? 'success' : 'secondary' }} badge-lg">
                                    {{ ucfirst($paymentSettings->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Help Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-question-circle"></i> Bantuan Setup
                    </h4>
                </div>
                <div class="card-body">
                    <div class="help-item mb-3">
                        <h6><i class="fas fa-university text-primary"></i> Bank Transfer</h6>
                        <small class="text-muted">
                            Atur informasi rekening bank yang akan ditampilkan kepada customer untuk pembayaran transfer
                        </small>
                    </div>
                    <div class="help-item mb-3">
                        <h6><i class="fas fa-qrcode text-info"></i> QR Code Payment</h6>
                        <small class="text-muted">
                            Upload QR Code QRIS untuk pembayaran digital (Dana, OVO, GoPay, LinkAja, ShopeePay)
                        </small>
                    </div>
                    <div class="help-item mb-3">
                        <h6><i class="fas fa-info-circle text-warning"></i> Instruksi</h6>
                        <small class="text-muted">
                            Berikan panduan step-by-step yang jelas untuk customer melakukan pembayaran
                        </small>
                    </div>
                    <div class="help-item">
                        <h6><i class="fas fa-toggle-on text-success"></i> Status System</h6>
                        <small class="text-muted">
                            Aktifkan untuk memungkinkan customer melakukan pembayaran
                        </small>
                    </div>
                </div>
            </div>

            <!-- Last Updated Info -->
            @if($paymentSettings)
                <div class="card">
                    <div class="card-body">
                        <h6><i class="fas fa-clock"></i> Update Information</h6>
                        <small class="text-muted">
                            Last Update: {{ $paymentSettings->updated_at->format('d/m/Y H:i:s') }}<br>
                            Created: {{ $paymentSettings->created_at->format('d/m/Y H:i:s') }}
                        </small>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.payment-section {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    background-color: #f8f9fa;
}

.section-header {
    border-bottom: 2px solid #dee2e6;
    padding-bottom: 10px;
    margin-bottom: 20px;
    color: #495057;
}

.preview-section {
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 15px;
    margin-bottom: 15px;
}

.preview-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.preview-item {
    margin-bottom: 10px;
}

.preview-item:last-child {
    margin-bottom: 0;
}

.preview-item small {
    font-weight: 600;
    color: #6c757d;
}

.preview-item p {
    color: #212529;
    margin-bottom: 0;
    font-size: 0.95em;
}

.help-item {
    border-left: 3px solid #e9ecef;
    padding-left: 15px;
    margin-bottom: 15px;
}

.help-item:last-child {
    margin-bottom: 0;
}

.badge-lg {
    font-size: 0.9em;
    padding: 0.5em 0.8em;
}
</style>
@endsection