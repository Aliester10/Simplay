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
                <a href="#">Edit</a>
            </li>
        </ul>
    </div>

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
                    <h4 class="card-title">Edit Status Pembayaran - {{ $payment->invoice_id }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('Admin.Payment.status.update', $payment->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Invoice ID</label>
                                    <input type="text" name="invoice_id" class="form-control" value="{{ old('invoice_id', $payment->invoice_id) }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Customer</label>
                                    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', $payment->customer_name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Email Customer</label>
                                    <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email', $payment->customer_email) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" name="amount" class="form-control" value="{{ old('amount', $payment->amount) }}" step="0.01" required>
                                </div>
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select name="payment_method" class="form-control" required>
                                        <option value="bank_transfer" {{ old('payment_method', $payment->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        <option value="qris" {{ old('payment_method', $payment->payment_method) == 'qris' ? 'selected' : '' }}>QRIS</option>
                                        <option value="other" {{ old('payment_method', $payment->payment_method) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pembayaran</label>
                                    <input type="datetime-local" name="payment_date" class="form-control" 
                                           value="{{ old('payment_date', $payment->payment_date ? $payment->payment_date->format('Y-m-d\TH:i') : '') }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Status Pembayaran</label>
                            <select name="status" class="form-control" required id="statusSelect">
                                <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status', $payment->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status', $payment->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="form-group" id="rejectReasonGroup" style="{{ old('status', $payment->status) == 'rejected' ? '' : 'display: none;' }}">
                            <label>Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea name="reject_reason" class="form-control" rows="3" placeholder="Masukkan alasan penolakan...">{{ old('reject_reason', $payment->reject_reason) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Catatan Admin</label>
                            <textarea name="admin_notes" class="form-control" rows="3" placeholder="Catatan admin...">{{ old('admin_notes', $payment->admin_notes) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Upload Bukti Pembayaran Baru (Opsional)</label>
                            <input type="file" name="payment_proof" class="form-control" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah bukti pembayaran</small>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update Status
                            </button>
                            <a href="{{ route('Admin.Payment.status.show', $payment->id) }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            @if($payment->payment_proof)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bukti Pembayaran Saat Ini</h4>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $payment->payment_proof_url }}" alt="Bukti Pembayaran" class="img-fluid mb-3" style="max-height: 300px;">
                        <div>
                            <a href="{{ $payment->payment_proof_url }}" target="_blank" class="btn btn-info btn-sm">
                                <i class="fa fa-external-link"></i> Lihat Full Size
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi</h4>
                </div>
                <div class="card-body">
                    <p><strong>Dibuat:</strong><br>{{ $payment->created_at->format('d/m/Y H:i:s') }}</p>
                    <p><strong>Terakhir Update:</strong><br>{{ $payment->updated_at->format('d/m/Y H:i:s') }}</p>
                    @if($payment->approvedBy)
                        <p><strong>Diproses oleh:</strong><br>{{ $payment->approvedBy->name }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('statusSelect').addEventListener('change', function() {
    const rejectGroup = document.getElementById('rejectReasonGroup');
    if (this.value === 'rejected') {
        rejectGroup.style.display = 'block';
        rejectGroup.querySelector('textarea').setAttribute('required', 'required');
    } else {
        rejectGroup.style.display = 'none';
        rejectGroup.querySelector('textarea').removeAttribute('required');
    }
});
</script>
@endsection