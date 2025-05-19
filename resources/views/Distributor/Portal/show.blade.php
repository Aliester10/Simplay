@extends('layouts.Member.master')

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Detail Permintaan Quotation</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
        <li class="breadcrumb-item active text-primary">Detail Permintaan Quotation</li>
    </ol>
</div>



<div class="container mt-5">
    <div class="p-4 shadow-sm rounded bg-white">
        <div class="card-body">

            <!-- Informasi Umum Quotation -->
            <div class="mb-4">
                <p><strong>Status:</strong>
                    <span class="badge 
                        @if($quotation->status === 'cancelled') bg-danger
                        @elseif($quotation->status === 'quotation') bg-success
                        @else bg-warning @endif">
                        {{ ucfirst($quotation->status) }}
                    </span>
                </p>
                <p><strong>Tanggal Permintaan:</strong> {{ $quotation->created_at->format('d M Y') }}</p>
            </div>
            <!-- Menampilkan Daftar Quotation -->
            <div class="table-responsive">
                <h3 class="mt-5 text-start">Detail Quotation:</h3>
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>No Pengajuan</th>
                            <th>Tanggal</th>
                            <th>Nomor Quotation</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #f9f9f9;">
                        <tr>
                            <td>1</td>
                            <td>{{ $quotation->nomor_pengajuan ?? 'Nomor pengajuan tidak tersedia' }}</td>
                            <td>{{ $quotation->created_at->format('d M Y') ?? 'Tanggal tidak tersedia' }}</td>
                            <td>
                                @if ($quotation->status === 'quotation')
                                    {{ $quotation->quotation_number ?? 'Nomor quotation tidak tersedia' }}
                                @else
                                    <span class="text-muted">Nomor quotation tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Menampilkan file PDF jika ada -->
            <div class="mt-4">
                <h5 style="color: #00796b;">Dokumen PDF:</h5>
                @if($quotation->pdf_path)
                <p>
    <a href="{{ asset($quotation->pdf_path) }}" class="btn btn-primary ms-2 d-inline-block" style="width: auto;">
        <i class="fas fa-file-alt me-2"></i>Lihat Dokumen PDF
    </a>
</p>
<p>
    <a href="{{ asset($quotation->pdf_path) }}" download class="btn btn-outline-secondary ms-2 d-inline-block" style="width: auto;">
        <i class="fas fa-download me-2"></i>Download PDF
    </a>
</p>

                @else
                    <p class="text-muted">Tidak ada dokumen tersedia.</p>
                @endif
            </div>

            <!-- Tombol Kembali -->
            <div class="text-end mt-4">
                <a href="{{ route('distribution.request-quotation') }}"
                    class="btn btn-secondary ms-2 shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

        </div>
    </div>
</div>
@endsection