@extends('layouts.Member.master')

@section('content')

<div class="container mt-5"></div>
<h1 class="text-center mb-4">Detail Proforma Invoices</h1>
<ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
    <li class="breadcrumb-item active text-primary">Detail Proforma Invoices</li>
</ol>


<div class="container mt-5">
    <div class="p-4 shadow-sm rounded bg-white">
        <div class="card-body">
            <h2 class="text-start mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Detail Proforma
                Invoice</h2>

            <!-- Informasi Proforma Invoice -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    
                            <table class="table table-striped table-bordered table-hover align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 30%;">Field</th>
                                        <th style="width: 70%;">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>PI Number</strong></td>
                                        <td>{{ $proformaInvoice->pi_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>PI Date</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($proformaInvoice->pi_date)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>PO Number</strong></td>
                                        <td>{{ $proformaInvoice->purchaseOrder->po_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Subtotal</strong></td>
                                        <td>Rp{{ number_format($proformaInvoice->subtotal, 2) }}</td>
                                    </tr>
                                    @if (!empty($proformaInvoice->purchaseOrder->quotation->discount) && $proformaInvoice->purchaseOrder->quotation->discount > 0)
                                        <tr>
                                            <th>Discount</th>
                                            <td>Rp{{ number_format($proformaInvoice->purchaseOrder->quotation->discount, 2) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td><strong>PPN</strong></td>
                                        <td>Rp{{ number_format($proformaInvoice->ppn, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Grand Total</strong></td>
                                        <td>Rp{{ number_format($proformaInvoice->grand_total_include_ppn, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>DP</strong></td>
                                        <td>Rp{{ number_format($proformaInvoice->dp, 2) }}
                                            ({{ $proformaInvoice->dp_percent }}%)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Installments</strong></td>
                                        <td>{{ $proformaInvoice->installments }} kali pembayaran</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Next Payment Amount</strong></td>
                                        <td>
                                            @if (!empty($proformaInvoice->next_payment_amount) && !empty($proformaInvoice->purchaseOrder->quotation->subtotal_price))
                                                {{ number_format($proformaInvoice->next_payment_amount, 2) }} IDR
                                                ({{ number_format(($proformaInvoice->next_payment_amount / $proformaInvoice->purchaseOrder->quotation->subtotal_price) * 100, 2) }}%)
                                            @else
                                                <span class="text-muted">Belum ada pembayaran berikutnya</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Payments Completed</strong></td>
                                        <td>{{ $proformaInvoice->payments_completed }} dari
                                            {{ $proformaInvoice->installments }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>
                                            <span class="badge 
                                    @if ($proformaInvoice->status === 'unpaid') bg-danger
                                    @elseif ($proformaInvoice->status === 'partially_paid') bg-warning
                                    @elseif ($proformaInvoice->status === 'paid') bg-success @endif">
                                                {{ ucfirst($proformaInvoice->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Remarks</strong></td>
                                        <td>
                                            @if (!empty($proformaInvoice->remarks))
                                                {{ $proformaInvoice->remarks }}
                                            @else
                                                <span class="text-muted">Belum ada catatan dari admin.</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Aksi -->
                            <div class="mt-4">
                                <h4>Aksi</h4>
                                <div class="d-flex flex-column gap-2">
                                    <!-- View & Download PDF -->
                                    <a href="{{ asset($proformaInvoice->file_path) }}" target="_blank"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-file-pdf"></i> View PDF
                                    </a>
                                    <a href="{{ asset($proformaInvoice->file_path) }}" download
                                        class="btn btn-secondary btn-sm">
                                        <i class="fas fa-download"></i> Download PDF
                                    </a>

                                    <!-- Upload Payment Proof -->
                                    @if ($proformaInvoice->status !== 'paid' && $proformaInvoice->payments_completed < $proformaInvoice->installments)
                                        @if ($proformaInvoice->payments_completed === 0 || $proformaInvoice->last_payment_status === 'approved')
                                            <form
                                                action="{{ route('distributor.proforma-invoices.upload', $proformaInvoice->id) }}"
                                                method="POST" enctype="multipart/form-data" class="mt-2">
                                                @csrf
                                                <input type="file" name="payment_proof" class="form-control mb-2"
                                                    accept=".pdf,.jpg,.jpeg,.png" required>
                                                <button type="submit" class="btn btn-outline-success btn-sm">
                                                    <i class="fas fa-upload"></i> Upload Pembayaran
                                                    ke-{{ $proformaInvoice->payments_completed + 1 }}
                                                </button>
                                                <small class="text-muted">
                                                    {{ $proformaInvoice->payments_completed + 1 === 1 ? 'DP' : 'Pembayaran Tahap ' . ($proformaInvoice->payments_completed + 1) }}
                                                </small>
                                            </form>
                                        @else
                                            <span class="text-muted">Menunggu persetujuan admin untuk pembayaran
                                                sebelumnya.</span>
                                        @endif
                                    @else
                                        <span class="text-muted">All payments completed or awaiting admin approval.</span>
                                    @endif


                                    @if (!empty($proformaInvoice->payment_proof_paths))
                                        @foreach ($proformaInvoice->payment_proof_paths as $index => $filePath)
                                            <div class="mt-2">
                                                <a href="{{ asset($filePath) }}" target="_blank"
                                                    class="btn btn-outline-success btn-sm">
                                                    <i class="fas fa-receipt"></i> View Payment Proof {{ $index + 1 }}
                                                </a>
                                                <a href="{{ asset($filePath) }}" download
                                                    class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-download"></i> Download Payment Proof {{ $index + 1 }}
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Belum ada bukti pembayaran yang diunggah.</span>
                                    @endif
                                </div>
                            </div>
            </div>
        </div>
    </div>
    </div>
    
    @endsection