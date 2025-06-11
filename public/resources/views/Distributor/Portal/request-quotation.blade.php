@extends('layouts.Member.master')

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Pilih Produk & Permintaan Quotation</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
        <li class="breadcrumb-item active text-primary">Pilih Produk & Permintaan Quotation</li>
    </ol>
</div>

<div class="container mt-5">
    <!-- Content Box -->
    <div class="p-4 shadow-sm rounded bg-white">
        <!-- Button Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ url('/en/products') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Ajukan Quotation
                </a>
                <a href="{{ route('quotations.cart') }}" class="btn btn-outline-secondary ms-2">
                    <i class="fas fa-shopping-cart me-2"></i>Lihat Keranjang
                </a>
            </div>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('distribution.request-quotation') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Nomor Pengajuan atau Status" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> {{ __('messages.cari') }}
                </button>
            </div>
        </form>

        <!-- Quotation Requests Table -->
        <div class="table-responsive">
            <h3 class="mt-4 text-center">Daftar Permintaan Quotation</h3>
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nomor Pengajuan</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Topik</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotations as $key => $quotation)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $quotation->nomor_pengajuan ?? '-' }}</td>
                            <td class="text-center">{{ $quotation->created_at->format('d M Y') ?? '-' }}</td>
                            <td class="text-center">{{ $quotation->topik ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge 
                                    @if ($quotation->status === 'cancelled') bg-danger
                                    @elseif ($quotation->status === 'quotation') bg-success
                                    @else bg-warning 
                                    @endif">
                                    {{ ucfirst($quotation->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('quotations.show', $quotation->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if ($quotation->pdf_path)
                                    <a href="{{ asset($quotation->pdf_path) }}" download class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-download"></i>
                                    </a>
                                @endif
                                @if ($quotation->status === 'pending')
                                    <form action="{{ route('quotations.cancel', $quotation->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Apakah Anda yakin ingin membatalkan permintaan quotation ini?');">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @elseif ($quotation->status === 'quotation' && !$quotation->purchaseOrder)
                                    @if (!$quotation->negotiation || $quotation->negotiation->status !== 'accepted')
                                        <a href="{{ route('distributor.quotations.negotiations.create', $quotation->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-handshake"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('quotations.create_po', $quotation->id) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada permintaan quotation.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $quotations->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@endsection
