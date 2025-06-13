@extends('layouts.Admin.master')

@section('title', 'Detail Status Pembayaran')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="page-title">Detail Status Pembayaran</h3>
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
                <a href="#">Detail</a>
            </li>
        </ul>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Informasi Pembayaran</h4>
                        <a href="{{ route('Admin.Payment.status.index') }}" class="btn btn-secondary btn-sm ml-auto">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Invoice ID:</strong></label>
                                <p class="mb-1">{{ $payment->invoice_id }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Customer:</strong></label>
                                <p class="mb-1">{{ $payment->customer_name }}</p>
                                <small class="text-muted">{{ $payment->customer_email }}</small>
                            </div>
                            <div class="form-group">
                                <label><strong>Amount:</strong></label>
                                <p class="mb-1"><strong>Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong></p>
                            </div>
                            <div class="form-group">
                                <label><strong>Payment Method:</strong></label>
                                <p class="mb-1">
                                    <span class="badge badge-info">{{ strtoupper($payment->payment_method) }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Status:</strong></label>
                                <p class="mb-1">
                                    <span class="badge {{ $payment->status_badge }}">{{ ucfirst($payment->status) }}</span>
                                </p>
                            </div>
                            <div class="form-group">
                                <label><strong>Tanggal Pembayaran:</strong></label>
                                <p class="mb-1">{{ $payment->payment_date ? $payment->payment_date->format('d/m/Y H:i:s') : '-' }}</p>
                            </div>
                            @if($payment->approved_at)
                                <div class="form-group">
                                    <label><strong>Tanggal Approve:</strong></label>
                                    <p class="mb-1">{{ $payment->approved_at->format('d/m/Y H:i:s') }}</p>
                                </div>
                            @endif
                            @if($payment->rejected_at)
                                <div class="form-group">
                                    <label><strong>Tanggal Reject:</strong></label>
                                    <p class="mb-1">{{ $payment->rejected_at->format('d/m/Y H:i:s') }}</p>
                                </div>
                            @endif
                            @if($payment->approvedBy)
                                <div class="form-group">
                                    <label><strong>Diproses oleh:</strong></label>
                                    <p class="mb-1">{{ $payment->approvedBy->name }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($payment->admin_notes)
                        <div class="form-group">
                            <label><strong>Catatan Admin:</strong></label>
                            <div class="alert alert-info">{{ $payment->admin_notes }}</div>
                        </div>
                    @endif

                    @if($payment->reject_reason)
                        <div class="form-group">
                            <label><strong>Alasan Penolakan:</strong></label>
                            <div class="alert alert-danger">{{ $payment->reject_reason }}</div>
                        </div>
                    @endif

                    @if($payment->order)
                        <div class="form-group">
                            <label><strong>Informasi Order:</strong></label>
                            <div class="card border">
                                <div class="card-body">
                                    <p><strong>Order Number:</strong> {{ $payment->order->order_number }}</p>
                                    <p><strong>Status Order:</strong> 
                                        <span class="badge {{ $payment->order->status_badge }}">{{ ucfirst($payment->order->status) }}</span>
                                    </p>
                                    <p><strong>Total Amount:</strong> Rp {{ number_format($payment->order->total_amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
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
                        <img src="{{ $payment->payment_proof_url }}" alt="Bukti Pembayaran" class="img-fluid mb-3" style="max-height: 400px;">
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
                    <h4 class="card-title">Aksi</h4>
                </div>
                <div class="card-body">
                    @if($payment->status === 'pending')
                        <button type="button" class="btn btn-success btn-block mb-2" onclick="approvePayment({{ $payment->id }})">
                            <i class="fa fa-check"></i> Approve Pembayaran
                        </button>
                        <button type="button" class="btn btn-danger btn-block mb-2" onclick="rejectPayment({{ $payment->id }})">
                            <i class="fa fa-times"></i> Reject Pembayaran
                        </button>
                    @endif
                    
                    <a href="{{ route('Admin.Payment.status.edit', $payment->id) }}" class="btn btn-warning btn-block mb-2">
                        <i class="fa fa-edit"></i> Edit Status
                    </a>
                    
                    <button type="button" class="btn btn-secondary btn-block" onclick="deletePayment({{ $payment->id }})">
                        <i class="fa fa-trash"></i> Hapus Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Approve -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="approveForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Approve Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="status" value="approved">
                    <div class="form-group">
                        <label>Catatan Admin (Opsional)</label>
                        <textarea name="admin_notes" class="form-control" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Approve
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk Reject -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="rejectForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Reject Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="status" value="rejected">
                    <div class="form-group">
                        <label>Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea name="reject_reason" class="form-control" rows="3" placeholder="Masukkan alasan penolakan..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Catatan Admin (Opsional)</label>
                        <textarea name="admin_notes" class="form-control" rows="2" placeholder="Catatan tambahan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-times"></i> Reject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data pembayaran <strong>{{ $payment->invoice_id }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function approvePayment(id) {
    $('#approveForm').attr('action', '{{ route("Admin.Payment.status.update", ":id") }}'.replace(':id', id));
    $('#approveModal').modal('show');
}

function rejectPayment(id) {
    $('#rejectForm').attr('action', '{{ route("Admin.Payment.status.update", ":id") }}'.replace(':id', id));
    $('#rejectModal').modal('show');
}

function deletePayment(id) {
    $('#deleteForm').attr('action', '{{ route("Admin.Payment.status.destroy", ":id") }}'.replace(':id', id));
    $('#deleteModal').modal('show');
}
</script>
@endsection