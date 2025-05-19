@extends('layouts.Member.master')

@section('content')
    <div class="container-fluid page-header mb-5 py-5"
        style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .1)), url('{{ asset('assets/img/bg.jpg') }}') center center no-repeat; background-size: cover; height: 300px;">
        <div class="container">
            <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('messages.my_product_2') }}</h1>
        </div>
    </div>


    <!-- Product Details Start -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body p-0">
                        @if ($produk->images->isNotEmpty())
                            <!-- Display all images if available -->
                            <div id="productImagescarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($produk->images as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image->gambar) }}" class="d-block w-100"
                                                alt="{{ $produk->nama }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev custom-carousel-control" type="button"
                                    data-bs-target="#productImagescarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next custom-carousel-control" type="button"
                                    data-bs-target="#productImagescarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>

                                <style>
                                    /* Custom styles for carousel controls */
                                    .custom-carousel-control .carousel-control-prev-icon,
                                    .custom-carousel-control .carousel-control-next-icon {
                                        background-color: black;
                                        /* Change the background color of the control icons */
                                        border-radius: 50%;
                                        /* Optional: Add border-radius for a round effect */
                                    }

                                    /* Optional: Adjust the size of the icons */
                                    .custom-carousel-control .carousel-control-prev-icon,
                                    .custom-carousel-control .carousel-control-next-icon {
                                        background-size: 50% 50%;
                                        /* Adjust icon size if needed */
                                    }

                                    /* Optional: Make sure the icon color is white */
                                    .custom-carousel-control .carousel-control-prev-icon::after,
                                    .custom-carousel-control .carousel-control-next-icon::after {
                                        color: white;
                                        /* Ensure the arrow is visible */
                                    }
                                </style>

                            </div>
                        @else
                            <!-- Display a default image if there are no images -->
                            <img src="{{ asset('assets/img/default.jpg') }}" class="img-fluid" alt="{{ $produk->nama }}">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h2 class="card-title mb-4">{{ $produk->nama }}</h2>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Merk</th>
                                    <td>{{ $produk->merk }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kegunaan</th>
                                    <td>{{ $produk->kegunaan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Via</th>
                                    <td>{{ $produk->via }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kategori</th>
                                    <td>{{ $produk->kategori->nama ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Purchase Date</th>
                                    <td>{{ $userProduk->pembelian ?? 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ url('/portal') }}" class="btn btn-primary mt-3">Back</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Product Details End -->

@endsection
