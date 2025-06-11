@extends('layouts.Member.master')

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Purchase Orders</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
        <li class="breadcrumb-item active text-primary">Purchase Orders</li>
    </ol>
</div>



<div class="container mt-5">
    <div class="p-4 shadow-sm rounded bg-white">
        <div class="card-body">

            @if ($purchaseOrders->isEmpty())
                <!-- Pesan Jika Tidak Ada Purchase Order -->
                <div class="alert alert-info text-center">
                    <p class="mb-3">Anda belum memiliki Purchase Order. Silakan lihat Quotation Anda dan ajukan quotation
                        untuk memulai proses.</p>
                    <a href="{{ route('distribution.request-quotation') }}" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fas fa-file-alt me-2"></i>Lihat Quotation
                    </a>
                </div>
            @else


                <!-- Tabel Purchase Orders -->
                <div class="table-responsive">
                    <h3 class="mt-5 text-start">Detail Purchase Order:</h3>
                    
                    <!-- Search Form -->
                    <form action="{{ route('admin.purchase-orders.index') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari berdasarkan nomor PO atau distributor..."
                                value="{{ request()->input('search') }}">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>

                    <table class="table table-bordered table-hover align-middle" text-align: center;">
                        <thead class="table-light ">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">PO Number</th>
                                <th class="text-center">PO Date</th>
                                <th class="text-center">Quotation Number</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #f9f9f9; text-align: center;">
                            @foreach ($purchaseOrders as $po)
                                <tr>
                                    <td>{{ $po->id }}</td>
                                    <td>{{ $po->po_number }}</td>
                                    <td>{{ \Carbon\Carbon::parse($po->po_date)->format('d M Y') }}</td>
                                    <td>{{ $po->quotation->quotation_number ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('quotations.show', $po->quotation_id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View Quotation
                                        </a>
                                        @if ($po->proformaInvoice)
                                            <!-- View Proforma Invoice -->
                                            <a href="{{ route('distributor.proforma-invoices.index', $po->proformaInvoice->id) }}"
                                                class="btn btn-primary btn-sm ">
                                                <i class="fas fa-file-invoice"></i> View Proforma Invoice
                                            </a>
                                        @else
                                            <!-- Proforma Invoice Pending -->
                                            <span class="text-muted">Proforma Invoice akan segera dikirim</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Links -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $purchaseOrders->appends(request()->input())->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
        <!-- Tombol Lihat Quotation -->
        <div class="mb-4 text-end">
                        <a href="{{ route('distribution.request-quotation') }}" class="btn btn-primary ms-2">
                            <i class="fas fa-arrow-left me-2"></i>Lihat Quotation
                        </a>

                    </div>
    </div>
</div>
@endsection