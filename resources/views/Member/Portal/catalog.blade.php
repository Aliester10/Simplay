@extends('layouts.Member.master')

@section('content')
    <!-- Header Start -->
            <h1 class="display-3 text-dark mb-3 animated slideInDown">{{ __('messages.about_us') }}</h1>
    <!-- Header End -->

    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                @forelse($produks as $produk)
                    <div class="col-md-4 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-img rounded-top border border-secondary" style="border-radius: 10px;">
                            <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                class="img-fluid rounded-top w-100" alt="{{ $produk->nama }}">
                            <div class="service-content-inner p-4" style="border-radius: 0 0 10px 10px;">
                                <h5 class="mb-4">{{ $produk->nama }}</h5>
                                <p class="mb-4">{{ $produk->kegunaan }}</p>
                                <a href="{{ route('product.show', $produk->id) }}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">You don't have any products in your catalog.</p>
                        <p class="text-center">Member belum memiliki produk yang di-claim oleh admin.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
