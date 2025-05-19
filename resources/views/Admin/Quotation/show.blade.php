@extends('layouts.Admin.master')

@section('content')

<div class="container py-5">
    {{-- Card Wrapper --}}
    <div class="card shadow-sm border-0 rounded">
        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Detail Quotation: {{ $quotation->id }}</h2>
        </div>
            <div class="card-body">
                <h5 class="card-title">Informasi Produk dalam Quotation</h5>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Merek</th>
                                    <th>Tipe</th>
                                    <th>Quantity</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quotation->quotationProducts as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->equipment_name ?? 'Produk tidak tersedia' }}</td>
                                        <td>{{ $product->merk_type ?? 'Tidak tersedia' }}</td>
                                        <td>{{ $product->tipe ?? 'Tidak tersedia' }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ number_format($product->unit_price, 2) }}</td>
                                        <td>{{ number_format($product->total_price, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Tidak ada produk dalam quotation ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Dokumen Pendukung</h5>

                    <!-- Dokumentasi PDF -->
                    @if($quotation->pdf_path)
                        <p>
                            <a href="{{ asset($quotation->pdf_path) }}" target="_blank" class="text-primary">
                                <i class="fas fa-file-alt me-2"></i>Lihat Dokumen PDF
                            </a>
                        </p>
                        <p>
                            <a href="{{ asset($quotation->pdf_path) }}" download class="text-secondary">
                                <i class="fas fa-download me-2"></i>Download PDF
                            </a>
                        </p>
                    @else
                        <p class="text-muted">Tidak ada file PDF untuk quotation ini.</p>
                    @endif
                </div>
                <!-- Tombol Kembali -->
                
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.quotations.index') }}" class="btn btn-secondary"> <i class="fas fa-arrow-left me-2"></i> Back to list</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection