@extends('layouts.Member.master')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">{{ __('messages.my_product') }}</h1>
</div>

<!-- Main Content Start -->
<div class="container py-5">
    <div class="row g-4">
        @forelse($produks as $produk)
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    <img src="{{ asset($produk->produk->images->first()->gambar ?? 'assets/img/default.jpg') }}" class="card-img-top" alt="{{ $produk->produk->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produk->produk->nama }}</h5>
                        <small class="text-muted"><strong>Purchase Date:</strong> {{ $produk->pembelian ?? 'N/A' }}</small>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('user-product.show', $produk->produk->id) }}" class="btn btn-primary rounded-pill">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <p class="mb-0">You don't have any products in your catalog.</p>
                    <p class="mb-0">Member belum memiliki produk yang di-claim oleh admin.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
<!-- Main Content End -->

@endsection
