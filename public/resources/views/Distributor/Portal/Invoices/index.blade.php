@extends('layouts.Member.master')

@section('content')

<div class="container mt-5"></div>
<h1 class="text-center mb-4">{{ __('messages.invoice_list') }}</h1>
<ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
    <li class="breadcrumb-item active text-primary">{{ __('messages.invoice_list') }}</li>
</ol>

<div class="container mt-5">

    <!-- Tabel Invoices -->
    <div class="p-4 shadow-sm rounded bg-white">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($invoices->isEmpty())
                <div class="alert alert-info">
                    <p>{{ __('messages.no_invoices_available') }}</p>
                </div>
            @else
                <div class="mb-3">
                    <a href="{{ route('distributor.proforma-invoices.index') }}" class="btn btn-dark rounded-3">
                        <i class="fas fa-file-invoice"></i> {{ __('messages.view_proforma_invoices') }}
                    </a>
                </div>

                <!-- Form Pencarian -->
                <form method="GET" action="{{ route('distributor.invoices.index') }}"
                    class="d-flex justify-content-center mb-4">
                    <div class="input-group">
                        <input type="text" name="invoice_number" placeholder="{{ __('messages.search_No') }}" class="form-control"
                            value="{{ request('invoice_number') }}">
                        <input type="date" name="invoice_date" class="form-control" value="{{ request('invoice_date') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> {{ __('messages.cari') }}
                        </button>
                    </div>
                </form>


                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">{{ __('messages.id') }}</th>
                                <th class="text-center">{{ __('messages.invoice_number') }}</th>
                                <th class="text-center">{{ __('messages.invoice_date') }}</th>
                                <th class="text-center">{{ __('messages.subtotal') }}</th>
                                <th class="text-center">{{ __('messages.ppn') }}</th>
                                <th class="text-center">{{ __('messages.grand_total') }}</th>
                                <th class="text-center">{{ __('messages.status') }}</th>
                                <th class="text-center">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td class="text-center">{{ $invoice->id }}</td>
                                    <td class="text-center">{{ $invoice->invoice_number }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}
                                    </td>
                                    <td class="text-center">{{ number_format($invoice->subtotal, 2) }}</td>
                                    <td class="text-center">{{ number_format($invoice->ppn, 2) }}</td>
                                    <td class="text-center">{{ number_format($invoice->grand_total_include_ppn, 2) }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge 
                                                                                                                                                                @if($invoice->status == 'paid') badge-success 
                                                                                                                                                                @elseif($invoice->status == 'unpaid') badge-danger 
                                                                                                                                                                @elseif($invoice->status == 'partial') badge-warning
                                                                                                                                                                @else badge-secondary @endif">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start gap-2">
                                            <!-- Tombol untuk melihat PDF Invoice -->
                                            <a href="{{ asset($invoice->file_path) }}" target="_blank"
                                                class="btn btn-info btn-sm w-100 mb-2">
                                                <i class="fas fa-eye"></i> {{ __('messages.view_pdf') }}
                                            </a>
                                            <!-- Tombol untuk mengunduh PDF Invoice -->
                                            <a href="{{ asset($invoice->file_path) }}" download
                                                class="btn btn-success btn-sm w-100 mb-2">
                                                <i class="fas fa-download"></i> {{ __('messages.download_pdf') }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $invoices->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@endsection

<style>
    /* Styling Table */
    .table {
        width: 100%;
        font-size: 1rem;
        text-align: center;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 15px;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: bold;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Button Styles */
    .btn-dark:hover {
        background-color: #343a40;
        color: #fff;
    }

    .btn-info:hover {
        background-color: #17a2b8;
        color: #fff;
    }

    .btn-success:hover {
        background-color: #28a745;
        color: #fff;
    }

    /* Title Styles */
    h3.text-secondary {
        font-weight: 600;
        color: #6c757d;
    }

    /* Badge for invoice status */
    .badge {
        font-size: 14px;
        padding: 5px 10px;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    .badge-warning {
        background-color: #ffc107;
    }

    .badge-secondary {
        background-color: #6c757d;
    }

    /* Styling button view/download */
    .btn-info,
    .btn-success {
        font-size: 14px;
        padding: 10px 20px;
        border-radius: 5px;
        text-align: center;
    }

    .d-flex {
        display: flex;
        justify-content: start;
    }

    /* Space between buttons */
    .gap-2 {
        gap: 10px;
    }

    /* Styling Form Pencarian */
    .input-group {
        max-width: flex;
        margin: 0 auto;
    }

    .input-group .form-control {
        border-radius: 5px;
        margin-right: 10px;
    }

    .input-group .btn-primary {
        border-radius: 5px;
    }
</style>