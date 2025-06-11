@extends('layouts.Member.master')

@section('content')

<div class="container mt-5"></div>
<h1 class="text-center mb-4">Daftar Proforma Invoices</h1>
<ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
    <li class="breadcrumb-item active text-primary">Daftar Proforma Invoices</li>
</ol>


<div class="container mt-5">
    <div class="p-4 shadow-sm rounded bg-white">
        <div class="card-body">

            <!-- Flash Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Jika Tidak Ada Proforma Invoices -->
            @if ($proformaInvoices->isEmpty())
                <div class="alert alert-info text-center">
                    <p class="mb-3">Belum ada Proforma Invoice tersedia.</p>
                    <p>Silakan buat Purchase Order (PO) terlebih dahulu untuk memulai proses.</p>
                    <a href="{{ route('distributor.purchase-orders.index') }}" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i>Lihat Purchase Orders
                    </a>
                </div>
            @else
                <!-- Tombol untuk melihat Invoice -->
                <div class="mb-4 text-end">
                    <a href="{{ route('distributor.invoices.index') }}"
                        class="btn btn-outline-secondary ms-2 d-inline-block" style="width: auto;">
                        <i class="fas fa-file-invoice me-2"></i>Lihat Invoices
                    </a>
                </div>

                <!-- Search Form -->
                <form method="GET" action="{{ route('distributor.proforma-invoices.index') }}" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Search by PI Number, PO Number, or Quotation Number"
                            value="{{ request()->input('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> {{ __('messages.cari') }}
                        </button>
                    </div>
                </form>

                <!-- Tabel Proforma Invoices -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">PI Number</th>
                                <th class="text-center">PI Date</th>
                                <th class="text-center">PO Number</th>
                                <th class="text-center">Quotation Number</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #f9f9f9;">
                            @foreach($proformaInvoices as $invoice)
                                <tr>
                                    <td class="text-center">{{ $invoice->id }}</td>
                                    <td class="text-center">{{ $invoice->pi_number }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($invoice->pi_date)->format('d M Y') }}</td>
                                    <td class="text-center">{{ $invoice->purchaseOrder->po_number }}</td>
                                    <td class="text-center">{{ $invoice->purchaseOrder->quotation->quotation_number ?? 'N/A' }}
                                    </td> <!-- Tampilkan nomor quotation -->
                                    <td class="text-center">Rp{{ number_format($invoice->subtotal, 2) }}</td>

                                    <td class="text-center">
                                        <!-- Button to go to detail page -->
                                        <a href="{{ route('distributor.proforma-invoices.show', $invoice->id) }}"
                                            class="btn btn-outline-primary ms-2 d-inline-block" style="width: auto;">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $proformaInvoices->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection