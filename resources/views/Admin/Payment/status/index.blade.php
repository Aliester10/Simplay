@extends('layouts.Admin.master')

@section('title', 'Status Pembayaran')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="page-title">Status Pembayaran</h3>
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
                <a href="#">Status Pembayaran</a>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar Status Pembayaran</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter dan Search -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('Admin.Payment.status.index') }}" id="filterForm">
                                <div class="form-group">
                                    <label>Filter Status:</label>
                                    <select class="form-control" name="status" onchange="document.getElementById('filterForm').submit();">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('Admin.Payment.status.index') }}">
                                <div class="form-group">
                                    <label>Pencarian:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Cari invoice, customer..." value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div>
                                    @if(request('status') || request('search'))
                                        <a href="{{ route('Admin.Payment.status.index') }}" class="btn btn-secondary">
                                            <i class="fa fa-refresh"></i> Reset Filter
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Status Pembayaran -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $index => $payment)
                                    <tr>
                                        <td>{{ $payments->firstItem() + $index }}</td>
                                        <td><strong>{{ $payment->invoice_id }}</strong></td>
                                        <td>
                                            {{ $payment->customer_name }}<br>
                                            <small class="text-muted">{{ $payment->customer_email }}</small>
                                        </td>
                                        <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ strtoupper($payment->payment_method) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $payment->status_badge }}">{{ ucfirst($payment->status) }}</span>
                                        </td>
                                        <td>{{ $payment->payment_date ? $payment->payment_date->format('d/m/Y H:i') : '-' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('Admin.Payment.status.show', $payment->id) }}" class="btn btn-sm btn-info" title="Detail">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                
                                                @if($payment->status === 'pending')
                                                    <button type="button" class="btn btn-sm btn-success" onclick="approvePayment({{ $payment->id }})" title="Approve">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="rejectPayment({{ $payment->id }})" title="Reject">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                @endif
                                                
                                                <a href="{{ route('Admin.Payment.status.edit', $payment->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                
                                                <button type="button" class="btn btn-sm btn-secondary" onclick="deletePayment({{ $payment->id }})" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data pembayaran</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $payments->appends(request()->query())->links() }}
                    </div>
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
                    <p>Apakah Anda yakin ingin menghapus data pembayaran ini? Tindakan ini tidak dapat dibatalkan.</p>
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