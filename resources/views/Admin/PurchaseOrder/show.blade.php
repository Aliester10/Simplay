@extends('layouts.Admin.master')

@section('content')
<div class="container py-5">
    {{-- Card Wrapper --}}
    <div class="card shadow-sm border-0 rounded">
        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="card-title mb-0">Detail Purchase Order #{{ $purchaseOrder->po_number }}</h1>
        </div>
            <div class="card-body">
                <h5 class="card-title mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">
                    Purchase Order Information
                </h5>
                <p><strong>PO Number:</strong> {{ $purchaseOrder->po_number }}</p>
                <p><strong>PO Date:</strong> {{ \Carbon\Carbon::parse($purchaseOrder->po_date)->format('d M Y') }}</p>
                <p><strong>Distributor:</strong> {{ $purchaseOrder->user->name }}</p>

                @if($purchaseOrder->file_path)
                    <p><strong>Attached File:</strong>
                        <a href="{{ asset($purchaseOrder->file_path) }}" target="_blank"
                            class="btn btn-primary btn-sm  shadow-sm">
                            <i class="fas fa-file-alt"></i> View File
                        </a>
                    </p>
                @else
                    <p><strong>Attached File:</strong> <span class="text-muted">No file uploaded</span></p>
                @endif
                <!-- Back to PO List Button -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.purchase-orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to PO List
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection