@extends('layouts.Member.master')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">{{ __('messages.monitoring_2') }}</h2>
</div>

<!-- Inspeksi Maintenance Details Start -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Inspeksi Maintenance for {{ $userProduk->produk->nama }}</h2>

    <!-- Display Inspeksi Maintenance Info -->
    @if($userProduk->inspeksiMaintenance->count() > 0)
    <div class="row">
        @foreach($userProduk->inspeksiMaintenance as $inspeksi)
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Inspeksi Maintenance - {{ $inspeksi->pic }}</h5>
                    <p><strong>PIC:</strong> {{ $inspeksi->pic }}</p>
                    <p><strong>Waktu:</strong> {{ $inspeksi->waktu }}</p>
                    <p><strong>Deskripsi:</strong> {!! $inspeksi->deskripsi !!}</p>
                    <p><strong>Status:</strong> {{ $inspeksi->status }}</p>

                    <!-- Display gambar if available -->
                    @if($inspeksi->gambar)
                        <p><strong>File:</strong></p>

                        @php
                            // Determine the file type based on the extension
                            $fileExtension = pathinfo($inspeksi->gambar, PATHINFO_EXTENSION);
                        @endphp

                        @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                            <!-- Display image -->
                            <img src="{{ asset('storage/' . $inspeksi->gambar) }}" class="img-fluid" alt="Inspeksi Image" width="200">
                        @elseif($fileExtension === 'pdf')
                            <!-- Display PDF with a download/view link -->
                            <a href="{{ asset('storage/' . $inspeksi->gambar) }}" target="_blank" class="btn btn-info">Lihat PDF</a>
                            <embed src="{{ asset('storage/' . $inspeksi->gambar) }}" type="application/pdf" width="100%" height="500px" />
                        @endif
                    @else
                        <p>No file available.</p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="alert alert-warning">
        No inspeksi maintenance data available for this product.
    </div>
@endif


    <a href="{{ url('/portal') }}" class="btn btn-primary mt-4">Back to Portal</a>
</div>
<!-- Inspeksi Maintenance Details End -->
@endsection
