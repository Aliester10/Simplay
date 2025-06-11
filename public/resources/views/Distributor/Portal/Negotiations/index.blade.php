@extends('layouts.Member.master')

@section('content')
<!-- Header Start -->
<div class="container mt-5"></div>
<h1 class="text-center mb-4">Daftar Negosiasi</h1>
<ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
    <li class="breadcrumb-item active text-primary">Daftar Negosiasi</li>
</ol>
<!-- Header End -->

<div class="container mt-5">
    <div class="p-4 shadow-sm rounded bg-white">
        <div class="card-body">
            <!-- Search Form -->
            <!-- Search Form with flexible width using flexbox -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <form method="GET" action="{{ route('distributor.quotations.negotiations.index') }}"
                    class="d-flex w-100">
                    <div class="input-group w-100">
                        <input type="text" name="search" class="form-control" placeholder="Search by Quotation Number"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> {{ __('messages.cari') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center" style="vertical-align: middle;">ID</th>
                            <th scope="col" class="text-center" style="vertical-align: middle;">Quotation Number</th>
                            <th scope="col" class="text-center" style="vertical-align: middle;">Status</th>
                            <th scope="col" class="text-center" style="vertical-align: middle;">Notes</th>
                            <th scope="col" class="text-center" style="vertical-align: middle;">Admin Notes</th>
                            <th scope="col" class="text-center" style="vertical-align: middle;">Actions</th>

                        </tr>
                    </thead>
                    <tbody style="background-color: #f9f9f9;">
                        @foreach($negotiations as $negotiation)
                            <tr style="vertical-align: middle;">
                                <td class="text-center">{{ $negotiation->id }}</td>
                                <td class="text-center">{{ $negotiation->quotation->quotation_number }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $negotiation->status == 'accepted' ? 'bg-success' : ($negotiation->status == 'rejected' ? 'bg-danger' : 'bg-warning') }} text-uppercase">
                                        {{ ucfirst($negotiation->status) }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $negotiation->notes }}</td>
                                <td class="text-center">{{ $negotiation->admin_notes ?? 'N/A' }}</td>
                                <td class="text-center">
                                    @if ($negotiation->status === 'accepted' && !$negotiation->quotation->purchaseOrder)
                                        <!-- Tombol Create PO hanya muncul jika PO belum dibuat -->
                                        <a href="{{ route('quotations.create_po', $negotiation->quotation->id) }}"
                                            class="btn btn-success btn-sm rounded-pill">
                                            <i class="fas fa-file-invoice-dollar"></i> Create PO
                                        </a>
                                    @elseif ($negotiation->status === 'pending' || $negotiation->status === 'in_progress')
                                        <!-- Tombol Nego -->
                                        <a href="{{ route('distributor.quotations.negotiations.create', $negotiation->quotation->id) }}"
                                            class="btn btn-warning btn-sm rounded-pill">
                                            <i class="fas fa-handshake"></i> Nego
                                        </a>
                                    @endif

                                    <!-- Tombol Download PDF -->
                                    @if ($negotiation->quotation->pdf_path)

                                        <a href="{{ asset($negotiation->quotation->pdf_path) }}" download
                                            class="btn btn-outline-secondary ms-2 shadow-sm">
                                            <i class="fas fa-download me-2"></i> Download PDF
                                        </a>
                                    @else
                                        <span class="text-muted d-block mt-2">No PDF Available</span>
                                    @endif
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination Links -->
                <div class="d-flex justify-content-between mt-4">
                    <div>
                        Showing {{ $negotiations->firstItem() }} to {{ $negotiations->lastItem() }} of
                        {{ $negotiations->total() }} results
                    </div>
                    <div>
                        {{ $negotiations->links() }}
                    </div>
                </div>
                <!-- Tombol Kembali -->
                <div class="text-end mt-4">

                    <a href="{{ route('distribution.request-quotation') }}"
                        class="btn btn-outline-secondary ms-2 shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    /* Styling Form Pencarian */
    .input-group {
        display: flex;
        max-width: flex;
        margin: 0 auto;
        flex: 1;
    }

    .input-group .form-control {
        border-radius: 5px;
        margin-right: 10px;
        height: 40px;
        font-size: 16px;
        flex-grow: 1;
    }

    .input-group .btn-primary {
        border-radius: 5px;
        padding-left: 20px;
        padding-right: 20px;
        height: 40px;
        font-size: 16px;
    }
</style>