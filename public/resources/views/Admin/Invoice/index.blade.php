@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        <h1>Daftar Invoices</h1>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card-body">
                    <!-- Search Form -->
                    <form action="{{ route('invoices.index') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari berdasarkan nomor invoice, status, atau total..."
                                value="{{ request()->input('search') }}">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Invoice Number</th>
                                        <th>Invoice Date</th>
                                        <th>Subtotal</th>
                                        <th>PPN</th>
                                        <th>Grand Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</td>
                                            <td>{{ number_format($invoice->subtotal, 2) }}</td>
                                            <td>{{ number_format($invoice->ppn, 2) }}</td>
                                            <td>{{ number_format($invoice->grand_total_include_ppn, 2) }}</td>
                                            <td>{{ ucfirst($invoice->status) }}</td>
                                            <td>
                                                <a href="{{ asset($invoice->file_path) }}" target="_blank"
                                                    class="btn btn-info btn-sm">View PDF</a>
                                                <a href="{{ asset($invoice->file_path) }}" download
                                                    class="btn btn-secondary btn-sm">Download PDF</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">
                                                @if(request()->has('search'))
                                                    Data tidak ditemukan.
                                                @else
                                                    Belum ada Invoice.
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $invoices->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection